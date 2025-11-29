@extends('layouts.app')

@section('content')

<style>
    @keyframes blob {
        0% { transform: translate(0px, 0px) scale(1); }
        33% { transform: translate(30px, -50px) scale(1.1); }
        66% { transform: translate(-20px, 20px) scale(0.9); }
        100% { transform: translate(0px, 0px) scale(1); }
    }
    .animate-blob {
        animation: blob 7s infinite;
    }
    .animation-delay-2000 {
        animation-delay: 2s;
    }
    .animation-delay-4000 {
        animation-delay: 4s;
    }
    .glass-modal {
        background: rgba(30, 30, 35, 0.7);
        backdrop-filter: blur(12px);
        -webkit-backdrop-filter: blur(12px);
        border: 1px solid rgba(255, 255, 255, 0.1);
    }
</style>

<div class="relative bg-[#18181b] overflow-hidden border-b border-gray-800">

    <div class="absolute inset-0 w-full h-full pointer-events-none">
        <div class="absolute top-0 right-0 w-96 h-96 bg-blue-600/20 rounded-full mix-blend-screen filter blur-[100px] opacity-50 animate-blob"></div>
        <div class="absolute top-40 left-20 w-72 h-72 bg-purple-600/20 rounded-full mix-blend-screen filter blur-[100px] opacity-50 animate-blob animation-delay-2000"></div>
        <div class="absolute -bottom-32 left-1/2 w-80 h-80 bg-pink-600/20 rounded-full mix-blend-screen filter blur-[100px] opacity-50 animate-blob animation-delay-4000"></div>
    </div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pt-16 pb-24 md:pt-32 md:pb-32 relative z-10">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-12 items-center">

            <div class="space-y-8">
                <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-gray-800/80 border border-gray-700 text-xs font-semibold text-blue-400 backdrop-blur-sm">
                    <span class="relative flex h-2 w-2">
                      <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-blue-400 opacity-75"></span>
                      <span class="relative inline-flex rounded-full h-2 w-2 bg-blue-500"></span>
                    </span>
                    Platform Belajar Coding #1 Indonesia
                </div>

                <h1 class="text-4xl md:text-6xl font-extrabold text-white leading-tight">
                    Bangun Karir <br/>
                    <span class="text-transparent bg-clip-text bg-gradient-to-r from-blue-400 via-purple-400 to-pink-400">
                        Developer Profesional
                    </span>
                </h1>

                <p class="text-lg text-gray-400 max-w-lg leading-relaxed">
                    Kurikulum standar industri global. Belajar dari nol hingga mahir dengan bimbingan AI Learning Buddy.
                </p>

                <div class="flex flex-wrap gap-4">
                    <a href="#learning-paths" class="bg-gradient-to-r from-blue-600 to-blue-700 hover:from-blue-500 hover:to-blue-600 text-white font-bold py-3.5 px-8 rounded-lg shadow-lg shadow-blue-900/40 transition transform hover:-translate-y-0.5">
                        Lihat Learning Paths
                    </a>

                    <a href="{{ url('/chat') }}" onclick="checkChatAccess(event)" class="bg-[#27272a]/80 backdrop-blur hover:bg-[#3f3f46] text-white border border-gray-700 font-bold py-3.5 px-8 rounded-lg transition flex items-center gap-2">
                        <span>🤖</span> Tanya AI Buddy
                    </a>
                </div>
            </div>

            <div class="hidden md:block relative">
                <div class="absolute inset-0 bg-gradient-to-tr from-blue-500/20 to-purple-500/20 rounded-2xl blur-xl"></div>

                <div class="relative bg-[#0f0f10]/90 backdrop-blur border border-gray-700 rounded-xl shadow-2xl p-6 overflow-hidden transform rotate-2 hover:rotate-0 transition duration-500 ring-1 ring-white/10">
                    <div class="flex items-center gap-2 mb-6 border-b border-gray-800 pb-4">
                        <div class="w-3 h-3 rounded-full bg-red-500 shadow-[0_0_8px_rgba(239,68,68,0.6)]"></div>
                        <div class="w-3 h-3 rounded-full bg-yellow-500 shadow-[0_0_8px_rgba(234,179,8,0.6)]"></div>
                        <div class="w-3 h-3 rounded-full bg-green-500 shadow-[0_0_8px_rgba(34,197,94,0.6)]"></div>
                        <div class="ml-auto text-xs text-gray-500 font-mono">future.js</div>
                    </div>
                    <div class="font-mono text-sm space-y-3">
                        <div class="flex gap-2">
                            <span class="text-purple-400">const</span>
                            <span class="text-blue-300">dreamJob</span>
                            <span class="text-white">=</span>
                            <span class="text-yellow-300">"Tech Lead"</span>;
                        </div>
                        <div class="flex gap-2">
                            <span class="text-purple-400">await</span>
                            <span class="text-blue-300">dicoding</span>.<span class="text-green-400">boostSkill</span>();
                        </div>
                        <div class="flex gap-2 pl-4 text-gray-500">
                            // Processing... 100%
                        </div>
                        <div class="flex gap-2">
                            <span class="text-purple-400">return</span>
                            <span class="text-white bg-blue-600/20 px-1 rounded text-blue-400">"Hired!"</span>;
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div id="learning-paths" class="bg-[#111113] py-20 border-t border-gray-900 relative">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

        <div class="flex flex-col md:flex-row md:items-end justify-between mb-10 gap-4">
            <div>
                <h2 class="text-3xl font-bold text-white mb-2">Daftar Learning Paths</h2>
                <p class="text-gray-400">Kurikulum didesain oleh expert industri untuk semua level.</p>
            </div>
            <a href="{{ url('/learning-paths') }}" class="text-blue-400 hover:text-blue-300 text-sm font-semibold flex items-center gap-1 transition group">
                Lihat Semua <span aria-hidden="true" class="group-hover:translate-x-1 transition">&rarr;</span>
            </a>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
            @forelse($paths as $index => $path)

            @php
                $colors = ['from-blue-600 to-blue-400', 'from-purple-600 to-purple-400', 'from-green-600 to-green-400', 'from-orange-600 to-orange-400'];
                $gradient = $colors[$index % count($colors)];
                $targetUrl = url('/learning-paths/' . $path->id);
                $title = $path->title;
                $titleLower = strtolower($title);

                // Manual Icon Logic
                $iconSvg = '<svg class="w-16 h-16 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/></svg>';

                if (str_contains($titleLower, 'android')) {
                    $iconSvg = '<svg class="w-16 h-16 text-white fill-current" viewBox="0 0 24 24"><path d="M17.523 15.3414c-.5511 0-.9993-.4486-.9993-.9997s.4482-.9993.9993-.9993c.5511 0 .9993.4482.9993.9993.0001.5511-.4482.9997-.9993.9997m-11.046 0c-.5511 0-.9993-.4486-.9993-.9997s.4482-.9993.9993-.9993c.5511 0 .9993.4482.9993.9993 0 .5511-.4482.9997-.9993.9997m11.4045-6.02l1.9973-3.4592a.416.416 0 00-.1521-.5676.416.416 0 00-.5676.1521l-2.0223 3.503C15.5902 8.4213 13.8533 8.0854 12 8.0854s-3.5902.3359-5.1364.8647L4.8413 5.4471a.416.416 0 00-.5676-.1521.416.416 0 00-.1521.5676l1.9973 3.4592C2.6889 11.1867.3432 14.6589 0 18.761h24c-.3432-4.1021-2.6889-7.5743-6.1185-9.4396"/></svg>';
                } elseif (str_contains($titleLower, 'ios')) {
                    $iconSvg = '<svg class="w-16 h-16 text-white fill-current" viewBox="0 0 24 24"><path d="M18.71 19.5c-.83 1.24-1.71 2.45-3.05 2.47-1.34.03-1.77-.79-3.29-.79-1.53 0-2 .77-3.27.82-1.31.05-2.3-1.32-3.14-2.53C4.25 17 2.94 12.45 4.7 9.39c.87-1.52 2.43-2.48 4.12-2.51 1.28-.02 2.5.87 3.29.87.78 0 2.26-1.07 3.81-.91.65.03 2.47.26 3.64 1.98-.09.06-2.17 1.28-2.15 3.81.03 3.02 2.65 4.03 2.68 4.04-.03.07-.42 1.44-1.38 2.83M13 3.5c.73-.83 1.21-1.96 1.07-3.11-1.05.05-2.31.72-3.03 1.64-.65.82-1.19 2.06-1.02 3.16 1.15.09 2.26-.86 2.98-1.69z"/></svg>';
                } elseif (str_contains($titleLower, 'react')) {
                    $iconSvg = '<svg class="w-16 h-16 text-white animate-spin-slow" viewBox="-11.5 -10.23174 23 20.46348"><circle cx="0" cy="0" r="2.05" fill="currentColor"/><g stroke="currentColor" stroke-width="1" fill="none"><ellipse rx="11" ry="4.2" transform="rotate(60)"/><ellipse rx="11" ry="4.2" transform="rotate(120)"/><ellipse rx="11" ry="4.2"/></g></svg>';
                } elseif (str_contains($titleLower, 'web') || str_contains($titleLower, 'front')) {
                    $iconSvg = '<svg class="w-16 h-16 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="M9.75 17L9 20l-1 1h8l-1-1-.75-3M3 13h18M5 17h14a2 2 0 002-2V5a2 2 0 00-2-2H8a2 2 0 00-2 2v14a2 2 0 002 2z"/></svg>';
                } elseif (str_contains($titleLower, 'back')) {
                    $iconSvg = '<svg class="w-16 h-16 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="M5 12h14M5 12a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v4a2 2 0 01-2 2M5 12a2 2 0 00-2 2v4a2 2 0 002 2h14a2 2 0 002-2v-4a2 2 0 00-2-2m-2-4h.01M17 16h.01"/></svg>';
                } elseif (str_contains($titleLower, 'machine') || str_contains($titleLower, 'data')) {
                    $iconSvg = '<svg class="w-16 h-16 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z"/></svg>';
                } elseif (str_contains($titleLower, 'multi') || str_contains($titleLower, 'flutter')) {
                    $iconSvg = '<svg class="w-16 h-16 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="M10.5 1.5H8.25A2.25 2.25 0 006 3.75v16.5a2.25 2.25 0 002.25 2.25h7.5A2.25 2.25 0 0018 20.25V3.75a2.25 2.25 0 00-2.25-2.25H13.5m-3 0V3h3V1.5m-3 0h3m-3 18.75h3"/></svg>';
                }
            @endphp

            <a href="{{ $targetUrl }}"
               onclick="checkAccess(event, '{{ $targetUrl }}', '{{ $title }}')"
               class="group relative flex flex-col sm:flex-row bg-[#18181b] border border-gray-800 hover:border-blue-600/50 rounded-2xl p-5 gap-6 transition duration-300 hover:shadow-xl hover:shadow-blue-900/10 hover:-translate-y-1">

                <div class="w-full sm:w-32 h-32 flex-shrink-0 rounded-xl bg-gradient-to-br {{ $gradient }} flex items-center justify-center shadow-lg overflow-hidden relative">
                    <div class="absolute top-0 left-0 w-full h-full bg-white/5 opacity-0 group-hover:opacity-100 transition duration-500"></div>
                    <div class="relative z-10 transform group-hover:scale-110 transition duration-300 drop-shadow-md">
                        {!! $iconSvg !!}
                    </div>
                </div>

                <div class="flex flex-col justify-between flex-grow">
                    <div>
                        <div class="flex justify-between items-start">
                            <h3 class="text-xl font-bold text-white group-hover:text-blue-400 transition mb-2">
                                {{ $path->title }}
                            </h3>
                            <svg class="w-5 h-5 text-gray-600 group-hover:text-white transition" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
                        </div>

                        <div class="flex items-center gap-1 text-sm mb-3">
                            <div class="flex text-yellow-500">
                                ★★★★★
                            </div>
                            <span class="text-gray-400 font-medium ml-1">4.8 ({{ rand(100, 500) }} Ulasan)</span>
                        </div>
                    </div>

                    <div class="flex items-center gap-4 text-xs font-semibold text-gray-500 border-t border-gray-800 pt-3 mt-2">
                        <span class="flex items-center gap-1 bg-gray-800/50 px-2 py-1 rounded text-gray-300">
                            <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path></svg>
                            Level Pemula
                        </span>
                        <span class="flex items-center gap-1 bg-gray-800/50 px-2 py-1 rounded text-gray-300">
                            <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                            {{ $path->courses_count * 10 }} Jam Belajar
                        </span>
                    </div>
                </div>
            </a>
            @empty
            <div class="col-span-full text-center py-12 border border-dashed border-gray-800 rounded-xl bg-[#18181b]">
                <p class="text-gray-500">Belum ada Learning Path tersedia.</p>
            </div>
            @endforelse
        </div>
    </div>
</div>

<div id="authModal" class="fixed inset-0 z-[100] hidden" aria-labelledby="modal-title" role="dialog" aria-modal="true">

    <div class="fixed inset-0 bg-black/60 backdrop-blur-sm transition-opacity" onclick="closeModal()"></div>

    <div class="fixed inset-0 z-10 w-screen overflow-y-auto">
        <div class="flex min-h-full items-center justify-center p-4 text-center">

            <div class="relative transform overflow-hidden rounded-3xl bg-[#1e1e24] text-left shadow-2xl transition-all sm:w-full sm:max-w-md border border-gray-700 ring-1 ring-white/10">

                <div class="absolute top-0 left-0 w-full h-32 bg-gradient-to-br from-blue-600/20 to-purple-600/20 pointer-events-none"></div>

                <button onclick="closeModal()" class="absolute top-4 right-4 text-gray-400 hover:text-white transition bg-black/20 hover:bg-black/40 rounded-full p-1 z-20">
                    <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>

                <div class="px-6 pb-6 pt-10 text-center relative z-10">
                    <div class="mx-auto flex h-24 w-24 items-center justify-center rounded-full bg-[#18181b] border-4 border-[#2d2d33] mb-6 shadow-xl relative">
                        <div class="absolute inset-0 rounded-full bg-blue-500/20 blur-xl"></div>
                        <span class="text-5xl relative z-10">🚀</span>
                    </div>

                    <h3 class="text-2xl font-extrabold text-white mb-2">Ingin Akses Materi Ini?</h3>

                    <p class="text-gray-400 text-sm leading-relaxed px-4">
                        Materi <span id="targetPathName" class="font-bold text-blue-400">...</span> tersedia eksklusif untuk member. <br>
                        Gabung gratis sekarang untuk mulai belajar!
                    </p>
                </div>

                <div class="p-6 pt-0 space-y-3">
                    <a href="{{ route('register') }}" class="block w-full rounded-xl bg-gradient-to-r from-blue-600 to-purple-600 py-3.5 text-sm font-bold text-white shadow-lg hover:shadow-blue-500/25 hover:scale-[1.02] transition-all duration-200 text-center">
                        Buat Akun Gratis
                    </a>

                    <div class="relative flex py-1 items-center">
                        <div class="flex-grow border-t border-gray-700"></div>
                        <span class="flex-shrink-0 mx-4 text-xs text-gray-500 uppercase">Sudah punya akun?</span>
                        <div class="flex-grow border-t border-gray-700"></div>
                    </div>

                    <a href="{{ route('login') }}" class="block w-full rounded-xl bg-[#27272a] border border-gray-700 py-3.5 text-sm font-semibold text-gray-300 hover:text-white hover:bg-gray-700 transition-all text-center">
                        Masuk Sekarang
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="bg-gradient-to-r from-blue-900/20 to-purple-900/20 border-t border-gray-800 py-16 relative z-10">
    <div class="max-w-4xl mx-auto px-4 text-center">
        <h2 class="text-2xl md:text-3xl font-bold text-white mb-6">Siap Menjadi Developer Handal?</h2>
        <p class="text-gray-400 mb-8">Bergabunglah sekarang dan akses ratusan materi berkualitas.</p>
        <a href="{{ url('/register') }}" class="inline-block bg-white text-black font-bold py-3 px-8 rounded-lg hover:bg-gray-200 transition shadow-xl">
            Buat Akun Gratis
        </a>
    </div>
</div>

<script>
    // PROTEKSI AKSES COURSE
    function checkAccess(event, url, title) {
        event.preventDefault();
        const token = localStorage.getItem('auth_token');

        if (!token) {
            // Tampilkan Modal Cantik
            document.getElementById('targetPathName').innerText = title;
            document.getElementById('authModal').classList.remove('hidden');

            // Animasi Masuk
            const modalPanel = document.querySelector('#authModal > div > div > div');
            modalPanel.classList.remove('scale-95', 'opacity-0');
            modalPanel.classList.add('scale-100', 'opacity-100');
        } else {
            // Jika login, lanjut
            window.location.href = url;
        }
    }

    // PROTEKSI AKSES CHAT
    function checkChatAccess(event) {
        event.preventDefault();
        const token = localStorage.getItem('auth_token');
        if (!token) {
            document.getElementById('targetPathName').innerText = "AI Learning Buddy";
            document.getElementById('authModal').classList.remove('hidden');
        } else {
            window.location.href = '/chat';
        }
    }

    function closeModal() {
        document.getElementById('authModal').classList.add('hidden');
    }
</script>
@endsection
