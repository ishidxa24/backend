<?php

use Illuminate\Support\Facades\Route;
use App\Models\LearningPath;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// ==========================================
// 1. AUTHENTICATION (Login & Register)
// ==========================================
// Rute ini menampilkan view login/register.
// Proses POST-nya ditangani oleh API (AuthController) via Axios.

Route::get('/login', function () {
    return view('auth.login');
})->name('login');

Route::get('/register', function () {
    return view('auth.register');
})->name('register');


// ==========================================
// 2. HOMEPAGE (Landing Page)
// ==========================================
Route::get('/', function () {
    // Mengambil 3 Learning Path teratas untuk ditampilkan di cuplikan Home
    $paths = LearningPath::withCount('courses')->limit(3)->get();
    return view('home', compact('paths'));
});


// ==========================================
// 3. LEARNING PATHS (Academy)
// ==========================================

// Halaman Index: Menampilkan semua daftar kelas
Route::get('/learning-paths', function () {
    // Ambil data path, hitung jumlah courses, DAN ambil 3 course pertama untuk preview
    $paths = \App\Models\LearningPath::with(['courses' => function($query) {
        $query->limit(3); // Ambil 3 materi saja untuk preview di kartu
    }])->withCount('courses')->get();

    return view('learning-paths.index', compact('paths'));
});

// Halaman Show: Menampilkan detail satu kelas spesifik
Route::get('/learning-paths/{id}', function ($id) {
    // Mengambil detail path beserta daftar materi (courses) di dalamnya
    // Menggunakan findOrFail agar return 404 jika ID tidak ditemukan
    $path = LearningPath::with('courses')->findOrFail($id);
    return view('learning-paths.show', compact('path'));
});


// ==========================================
// 4. FITUR TAMBAHAN (Roadmap & Chat)
// ==========================================

// Halaman Roadmap Interaktif (Assessment Minat)
Route::get('/roadmap', function () {
    return view('roadmap.index');
})->name('roadmap');

// Halaman Chatbot (Learning Buddy)
Route::get('/chat', function () {
    return view('chat.index');
});
