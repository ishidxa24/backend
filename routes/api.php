<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\BotController;
use App\Http\Controllers\Api\RoadmapController;

// Public Routes (Bisa diakses tanpa login)
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

// User Info (Bawaan Laravel 11 biasanya sudah ada ini, bisa ditimpa atau disesuaikan)
Route::middleware(['auth:sanctum'])->get('/user', function (Request $request) {
    return $request->user();
});

// Protected Routes (Harus Login / Punya Token)
Route::middleware(['auth:sanctum'])->group(function () {

    // Chatbot General
    Route::post('/chat/ask', [BotController::class, 'chat']);

    // Onboarding & Roadmap Flow
    Route::get('/roles', [RoadmapController::class, 'getRoles']);
    Route::get('/assessment/{role}', [RoadmapController::class, 'getAssessment']);
    Route::post('/assessment/evaluate', [RoadmapController::class, 'evaluate']);

});