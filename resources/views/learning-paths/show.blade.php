@extends('layouts.app')

@section('content')
<div class="bg-[#18181b] border-b border-gray-800 pt-12 pb-16">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

        <nav class="flex items-center text-sm text-gray-500 mb-8">
            <a href="{{ url('/learning-paths') }}" class="hover:text-white transition">Learning Paths</a>
            <span class="mx-2">/</span>
            <span class="text-white font-medium">{{ $path->title }}</span>
        </nav>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-12">
            <div class="lg:col-span-2 space-y-6">
                <h1 class="text-3xl md:text-5xl font-extrabold text-white leading-tight">
                    {{ $path->title }}
                </h1>
                <p class="text-gray-400 text-lg leading-relaxed">
                    {{ $path->description ?? 'Pelajari skill ini dari dasar hingga mahir dengan kurikulum standar industri.' }}
                </p>

                <div class="flex flex-wrap items-center gap-6 text-sm font-medium text-gray-300 pt-2">
                    <div class="flex items-center gap-1 text-yellow-500">
                        ★★★★★ <span class="text-white ml-1">4.8 (120 Review)</span>
                    </div>
                    <div class="flex items-center gap-2">
                        <svg class="w-4 h-4 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/></svg>
                        Level Pemula - Mahir
                    </div>
                </div>
            </div>

            <div class="lg:col-span-1">
                <div class="bg-[#202024] border border-gray-700 p-6 rounded-2xl shadow-xl sticky top-24">
                    <h3 class="text-white font-bold text-lg mb-4">Akses Kelas Ini</h3>
                    <button onclick="enrollCheck()" class="w-full bg-blue-600 hover:bg-blue-700 text-white font-bold py-3 px-6 rounded-lg transition mb-4 shadow-lg shadow-blue-900/30">
                        Mulai Belajar
                    </button>
                    <p class="text-xs text-center text-gray-500">
                        Akses selamanya • Sertifikat kompetensi
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-12">

        <div class="lg:col-span-2 space-y-10">

            <section>
                <h2 class="text-xl font-bold text-white mb-4">Tentang Learning Path</h2>
                <div class="text-gray-400 leading-relaxed text-justify space-y-4">
                    <p>Program ini dirancang untuk Anda yang ingin menguasai <strong>{{ $path->title }}</strong>. Materi disusun bertahap mulai dari pengenalan dasar hingga studi kasus kompleks.</p>
                    <p>Setelah menyelesaikan path ini, Anda diharapkan mampu membangun aplikasi nyata dan siap berkarir di industri.</p>
                </div>
            </section>

            <section>
                <div class="flex items-center justify-between mb-6 border-b border-gray-800 pb-2">
                    <h2 class="text-xl font-bold text-white">Kurikulum ({{ $path->courses->count() }} Materi)</h2>
                </div>

                <div class="space-y-4">
                    @forelse($path->courses as $index => $course)
                        @php
                            $cTitle = strtolower($course->title);
                            // Default Icon (Buku)
                            $iconColor = 'text-gray-400';
                            $iconBg = 'bg-gray-800';

                            // Logika Warna Icon berdasarkan Topik
                            if(str_contains($cTitle, 'python') || str_contains($cTitle, 'data')) { $iconColor = 'text-yellow-400'; $iconBg = 'bg-yellow-900/20'; }
                            elseif(str_contains($cTitle, 'kotlin') || str_contains($cTitle, 'android')) { $iconColor = 'text-green-400'; $iconBg = 'bg-green-900/20'; }
                            elseif(str_contains($cTitle, 'swift') || str_contains($cTitle, 'ios')) { $iconColor = 'text-orange-400'; $iconBg = 'bg-orange-900/20'; }
                            elseif(str_contains($cTitle, 'javascript') || str_contains($cTitle, 'web')) { $iconColor = 'text-blue-400'; $iconBg = 'bg-blue-900/20'; }
                            elseif(str_contains($cTitle, 'react')) { $iconColor = 'text-cyan-400'; $iconBg = 'bg-cyan-900/20'; }
                        @endphp

                        <div class="group bg-[#202024] border border-gray-800 hover:border-gray-600 rounded-lg p-5 transition cursor-pointer" onclick="enrollCheck()">
                            <div class="flex items-start gap-4">
                                <div class="flex-shrink-0 w-10 h-10 rounded-lg {{ $iconBg }} flex items-center justify-center {{ $iconColor }} border border-gray-700">
                                    @if(str_contains($cTitle, 'python'))
                                        <span class="text-xl">🐍</span>
                                    @elseif(str_contains($cTitle, 'kotlin') || str_contains($cTitle, 'android'))
                                        <span class="text-xl">🤖</span>
                                    @elseif(str_contains($cTitle, 'swift') || str_contains($cTitle, 'ios'))
                                        <span class="text-xl">🍎</span>
                                    @elseif(str_contains($cTitle, 'web') || str_contains($cTitle, 'html'))
                                        <span class="text-xl">🌐</span>
                                    @elseif(str_contains($cTitle, 'react'))
                                        <span class="text-xl animate-spin-slow">⚛️</span>
                                    @elseif(str_contains($cTitle, 'math'))
                                        <span class="text-xl">📐</span>
                                    @else
                                        <span class="font-bold text-sm">{{ $index + 1 }}</span>
                                    @endif
                                </div>

                                <div class="flex-grow">
                                    <h3 class="text-white font-bold text-lg group-hover:text-blue-400 transition">{{ $course->title }}</h3>
                                    <p class="text-sm text-gray-500 mt-1 line-clamp-1">{{ $course->description ?? 'Pelajari topik ini secara mendalam.' }}</p>
                                </div>

                                <div class="flex-shrink-0 text-gray-600 group-hover:text-white transition">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/></svg>
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="text-center py-8 text-gray-500 bg-[#202024] rounded-lg border border-dashed border-gray-800">
                            Belum ada materi kurikulum.
                        </div>
                    @endforelse
                </div>
            </section>
        </div>

        <div class="lg:col-span-1 space-y-6">
            <div class="bg-[#202024] border border-gray-800 rounded-xl p-6 sticky top-24">
                <h4 class="text-white font-bold mb-4 pb-2 border-b border-gray-800">Spesifikasi</h4>
                <ul class="space-y-4 text-sm">
                    <li class="flex justify-between">
                        <span class="text-gray-400">Estimasi Waktu</span>
                        <span class="text-white">± 40 Jam</span>
                    </li>
                    <li class="flex justify-between">
                        <span class="text-gray-400">Jumlah Modul</span>
                        <span class="text-white">{{ $path->courses->count() }} Modul</span>
                    </li>
                    <li class="flex justify-between">
                        <span class="text-gray-400">Tools</span>
                        <span class="text-white">VS Code, Git</span>
                    </li>
                </ul>
            </div>
        </div>

    </div>
</div>

<script>
    function enrollCheck() {
        const token = localStorage.getItem('auth_token');
        if(!token) {
            if(confirm("🔒 AKSES TERBATAS\n\nSilakan Login atau Register untuk mengakses materi ini.")) {
                window.location.href = '/login';
            }
        } else {
            alert("✅ Anda sudah terdaftar! Mengarahkan ke kelas...");
            // window.location.href = '/course/play/1';
        }
    }
</script>
@endsection
