<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\Models\UserAssessment; // Pastikan Model ini sudah dibuat di tahap sebelumnya

class RoadmapController extends Controller
{
    // URL API Python
    private $mlApiUrl = 'http://127.0.0.1:8000/api/v1';

    // Endpoint 1: Ambil daftar Role
    public function getRoles()
    {
        try {
            $response = Http::get("{$this->mlApiUrl}/onboarding/roles");
            
            if ($response->successful()) {
                return $response->json();
            }
            
            return response()->json(['error' => 'Gagal mengambil data roles dari ML Service'], $response->status());
        } catch (\Exception $e) {
            return response()->json(['error' => 'Koneksi ke ML Service gagal'], 500);
        }
    }

    // Endpoint 2: Ambil Soal Assessment
    public function getAssessment($role)
    {
        try {
            $response = Http::get("{$this->mlApiUrl}/onboarding/assessment/{$role}");
            
            if ($response->successful()) {
                return $response->json();
            }

            return response()->json(['error' => 'Role tidak ditemukan'], 404);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Koneksi ke ML Service gagal'], 500);
        }
    }

    // Endpoint 3: Evaluasi Jawaban & Simpan Hasil
    public function evaluate(Request $request)
    {
        try {
            // Kirim jawaban user ke Python untuk dinilai
            $response = Http::post("{$this->mlApiUrl}/onboarding/evaluate", $request->all());
            
            if($response->successful()){
                $data = $response->json();
                
                /** @var \App\Models\User $user */
                $user = $request->user();

                // Simpan Hasil ke Database Laravel
                if ($user) {
                    UserAssessment::create([
                        'user_id' => $user->id,
                        'recommended_role' => $request->input('job_role'),
                        'skill_profile_data' => $data['skill_profile'] ?? [] // Gunakan null coalescing operator
                    ]);
                }

                return response()->json([
                    'status' => 'success',
                    'data' => $data
                ]);
            }

            return response()->json(['message' => 'Gagal melakukan evaluasi'], 500);

        } catch (\Exception $e) {
            return response()->json(['error' => 'Terjadi kesalahan server', 'detail' => $e->getMessage()], 500);
        }
    }
}