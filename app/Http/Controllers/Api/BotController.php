<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\Models\ChatHistory;
use App\Models\User;
use App\Models\StudentProgress; 
use Illuminate\Support\Facades\Log;

class BotController extends Controller
{
    private $mlApiUrl = 'http://127.0.0.1:8000/api/v1';

    public function chat(Request $request)
    {
        // 1. Validasi Input
        $request->validate([
            'query' => 'required|string',
            'skill_profile' => 'nullable|array',
        ]);

        /** @var \App\Models\User $user */
        $user = $request->user();

        // Cek defensif
        if (!$user) {
            return response()->json(['message' => 'Unauthorized'], 401);
        }

        $query = $request->input('query');
        $skillProfile = $request->input('skill_profile');

        // 2. Simpan Chat User ke DB (Simpan Pertanyaan ASLI)
        // Kita simpan yang asli agar history user terlihat natural
        ChatHistory::create([
            'user_id' => $user->id,
            'message' => $query,
            'role' => 'user'
        ]);

        // 3. Ambil History Chat (10 Terakhir)
        $history = ChatHistory::where('user_id', $user->id)
            ->latest()
            ->take(10)
            ->get()
            ->sortBy('created_at')
            ->map(function ($chat) {
                return [
                    'role' => $chat->role,
                    'text' => $chat->message
                ];
            })
            ->values()
            ->toArray();

        // ---------------------------------------------------------
        // 4. [OPTIMASI DATA] Ambil Riwayat Belajar dari Database (CSV)
        // ---------------------------------------------------------
        $progressData = StudentProgress::where('email', $user->email)->get();

        // Filter kelas yang sudah LULUS
        $completedCourses = $progressData->filter(function($item) {
            return $item->is_graduated == 1;
        })->map(function($item) {
            return $item->course_name . " (Nilai: " . $item->exam_score . ")";
        })->values()->toArray();

        // Filter kelas yang SEDANG AKTIF
        $activeCourses = $progressData->filter(function($item) {
            return $item->is_graduated == 0;
        })->pluck('course_name')->values()->toArray();


        // 5. Susun Skill Profile Cerdas
        $profileToSend = $skillProfile;
        
        if (empty($profileToSend)) {
            $profileToSend = [
                'user_status' => count($completedCourses) > 0 ? 'active_learner' : 'new_learner',
                'history_completed' => $completedCourses, 
                'history_active' => $activeCourses,       
                'current_focus' => count($activeCourses) > 0 ? $activeCourses[0] : 'general_exploration'
            ];
        }

        // ---------------------------------------------------------
        // 6. [OPTIMASI TOKEN] Manipulasi Query untuk Hemat Token
        // ---------------------------------------------------------
        // Kita modifikasi query HANYA untuk dikirim ke AI, tidak disimpan di DB.
        // Tujuannya agar jawaban AI pendek, padat, dan hemat token.
        $queryForAI = $query . " (Instruksi Sistem: Tolong jawab pertanyaan ini dengan ringkas, padat, dan to-the-point. Usahakan maksimal 3-4 kalimat saja. Jangan bertele-tele).";
        
        // 7. Siapkan Payload
        $payload = [
            'user_id' => (string) $user->id,
            'query' => $queryForAI, // <--- PENTING: Pakai query yang sudah dimodifikasi
            'skill_profile' => $profileToSend, 
            'chat_history' => $history
        ];

        Log::info('Mengirim ke Tim ML (Data CSV + Compact Mode):', $payload);

        try {
            // 8. Kirim ke Python
            $response = Http::timeout(30)
                ->asJson()
                ->post("{$this->mlApiUrl}/chat/ask", $payload);

            if ($response->successful()) {
                $data = $response->json();
                $answer = $data['answer'] ?? 'Maaf, saya tidak mengerti.';

                // Simpan Jawaban Bot
                ChatHistory::create([
                    'user_id' => $user->id,
                    'message' => $answer,
                    'role' => 'bot'
                ]);

                return response()->json([
                    'status' => 'success',
                    'answer' => $answer,
                    'history' => $history
                ]);
            } else {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Tim ML menolak request.',
                    'python_status' => $response->status(),
                    'python_error' => $response->json()
                ], $response->status());
            }

        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Gagal terhubung ke Service ML',
                'detail' => $e->getMessage()
            ], 500);
        }
    }
}