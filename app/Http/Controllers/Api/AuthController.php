<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\StudentProgress;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        // 1. Validasi Input Dasar
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:6',
            'name' => 'required'
        ]);

        // 2. Bersihkan spasi dari email input
        $cleanEmail = trim($request->email);

        // 3. Validasi ke Dataset CSV (Case-Insensitive & Ignore Spasi)
        $isStudentExist = StudentProgress::where('email', 'LIKE', $cleanEmail)->exists();

        // JIKA TIDAK ADA DI DATASET -> ERROR 403
        if (!$isStudentExist) {
            return response()->json([
                'message' => 'Email ini tidak terdaftar sebagai peserta (tidak ditemukan di dataset).',
                'email_input' => $cleanEmail
            ], 403);
        }

        // 4. Validasi Duplikat User (Agar tidak daftar 2x)
        if (User::where('email', $cleanEmail)->exists()) {
            return response()->json([
                'message' => 'Email sudah terdaftar. Silahkan Login.'
            ], 409);
        }

        // 5. Create User Baru
        $user = User::create([
            'name' => $request->name,
            'email' => $cleanEmail,
            'password' => Hash::make($request->password),
        ]);

        $token = $user->createToken('auth_token')->plainTextToken;

        return response()->json([
            'message' => 'Registrasi berhasil',
            'user' => $user,
            'access_token' => $token,
            'token_type' => 'Bearer',
        ]);
    }

    public function login(Request $request)
    {
        if (!Auth::attempt($request->only('email', 'password'))) {
            return response()->json([
                'message' => 'Login gagal, periksa email dan password'
            ], 401);
        }

        $user = User::where('email', $request['email'])->firstOrFail();
        $token = $user->createToken('auth_token')->plainTextToken;

        return response()->json([
            'message' => 'Login berhasil',
            'access_token' => $token,
            'token_type' => 'Bearer',
            'user' => $user
        ]);
    }
}