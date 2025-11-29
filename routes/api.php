<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\BotController;
use App\Http\Controllers\Api\RoadmapController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
*/

// --- PUBLIC ROUTES (Hanya Login & Register yang boleh diakses tamu) ---

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);


// --- PROTECTED ROUTES (Harus Punya Token / Sudah Login) ---
// Semua route di dalam sini WAJIB menyertakan Token Auth
Route::middleware(['auth:sanctum'])->group(function () {

    // 1. Route Chatbot (Sekarang sudah aman di dalam benteng auth)
    Route::post('/chat', [BotController::class, 'chat']);

    // 2. User Info
    Route::get('/user', function (Request $request) {
        return $request->user();
    });

    // 3. Onboarding & Roadmap Flow
    Route::get('/roles', [RoadmapController::class, 'getRoles']);
    Route::get('/assessment/{role}', [RoadmapController::class, 'getAssessment']);
    Route::post('/assessment/evaluate', [RoadmapController::class, 'evaluate']);

});
