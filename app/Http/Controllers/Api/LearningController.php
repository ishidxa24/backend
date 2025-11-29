<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\UserSkillProfile;
use App\Models\UserRoadmap;

class LearningController extends Controller
{
    /**
     * Menerima hasil assessment dari FE dan menyimpannya.
     */
    public function submitAssessment(Request $request)
    {
        $request->validate([
            'job_role' => 'required|string',
            'skills' => 'required|array', // Harapannya ini array of objects
            'skills.*.sub_skill_name' => 'required|string',
            'skills.*.level' => 'required|in:Beginner,Intermediate,Advanced',
        ]);

        $user = Auth::user();

        // 1. Simpan hasil assessment ke database
        foreach ($request->skills as $skill) {
            UserSkillProfile::updateOrCreate(
                [
                    'user_id' => $user->id,
                    'sub_skill_name' => $skill['sub_skill_name'],
                ],
                [
                    'level' => $skill['level']
                ]
            );
        }

        // 2. TODO: Panggil API Multi-layer Skill Assessment (dari Shidqi)
        // Setelah API Shidqi jadi, panggil di sini untuk generate roadmap.
        
        // 3. Untuk sekarang, kita buatkan mock roadmap
        $mockRoadmapData = [
            'module_1' => 'Dasar-Dasar ' . $request->job_role,
            'module_2' => 'Studi Kasus ' . $request->job_role,
            'module_3' => 'Expert Level ' . $request->job_role,
        ];

        UserRoadmap::create([
            'user_id' => $user->id,
            'job_role' => $request->job_role,
            'roadmap_data' => $mockRoadmapData,
            'is_active' => true,
        ]);

        return response()->json(['message' => 'Assessment berhasil disimpan'], 201);
    }

    /**
     * Mengambil roadmap aktif pengguna.
     */
    public function getRoadmap(Request $request)
    {
        $user = Auth::user();

        $roadmap = UserRoadmap::where('user_id', $user->id)
                              ->where('is_active', true)
                              ->first();

        if (! $roadmap) {
            // TODO: Nanti, panggil API Recommendation Engine (Maxwell) di sini
            
            // Untuk sekarang, kembalikan 'not found'
            return response()->json(['message' => 'Roadmap tidak ditemukan. Silakan isi assessment.'], 404);
        }

        return response()->json($roadmap);
    }

    /**
     * Menangani permintaan chat ke Learning Buddy.
     */
    public function chat(Request $request)
    {
        $request->validate([
            'message' => 'required|string',
        ]);

        $user = Auth::user();
        $userMessage = $request->message;

        // TODO: Panggil API Conversational AI (dari Shidqi/Maxwell)
        // $ai_response = Http::post('URL_API_ML_CHAT', [
        //     'user_id' => $user->id,
        //     'message' => $userMessage
        // ]);

        // Untuk sekarang, kita buat MOCK RESPONSE
        $mockResponse = "Ini adalah jawaban mock untuk: '" . $userMessage . "'. Nanti, saya akan menjawab berdasarkan progres Anda.";
        
        if (stripos($userMessage, 'skill') !== false) {
             $mockResponse = "Skill Anda yang paling berkembang (mock data) adalah 'JavaScript DOM'.";
        }

        return response()->json([
            'user_message' => $userMessage,
            'bot_response' => $mockResponse
        ]);
    }
}