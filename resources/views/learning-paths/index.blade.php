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
</style>

<div class="relative bg-[#18181b] border-b border-gray-800 pt-28 pb-24 overflow-hidden">

    <div class="absolute inset-0 w-full h-full pointer-events-none">
        <div class="absolute top-0 left-0 w-72 h-72 bg-purple-500/20 rounded-full mix-blend-screen filter blur-[80px] opacity-70 animate-blob"></div>
        <div class="absolute top-0 right-0 w-72 h-72 bg-blue-500/20 rounded-full mix-blend-screen filter blur-[80px] opacity-70 animate-blob animation-delay-2000"></div>
        <div class="absolute -bottom-8 left-1/2 transform -translate-x-1/2 w-72 h-72 bg-pink-500/20 rounded-full mix-blend-screen filter blur-[80px] opacity-70 animate-blob animation-delay-4000"></div>
    </div>

    <div class="relative z-10 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
        <div class="absolute top-[-3rem] left-4 md:left-8">
            <a href="{{ url('/') }}" class="inline-flex items-center gap-2 text-gray-400 hover:text-white transition group">
                <div class="w-8 h-8 rounded-full bg-gray-800 border border-gray-700 flex items-center justify-center group-hover:border-gray-500 transition">
                    <svg class="w-4 h-4 group-hover:-translate-x-0.5 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
                </div>
                <span class="text-sm font-medium">Beranda</span>
            </a>
        </div>

        <h1 class="text-4xl md:text-6xl font-extrabold text-white mb-6 tracking-tight">
            Daftar <span class="text-transparent bg-clip-text bg-gradient-to-r from-blue-400 to-purple-500">Learning Paths</span>
        </h1>
        <p class="text-gray-400 text-lg md:text-xl max-w-2xl mx-auto leading-relaxed">
            Kurikulum standar industri yang disusun oleh expert. Pilih jalur karirmu dan mulai belajar dari nol hingga mahir.
        </p>
    </div>
</div>

<div class="bg-[#111113] min-h-screen py-16">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

        <div class="flex flex-col md:flex-row justify-between items-center mb-10 gap-4">
            <span class="text-gray-400 text-sm font-medium" id="count-label">{{ $paths->count() }} Path Tersedia</span>

            <div class="relative w-full md:w-80">
                <input type="text" id="searchInput" placeholder="Cari: Android, Web, Backend..."
                       class="w-full bg-[#202024] border border-gray-700 text-white text-sm rounded-full px-5 py-3 focus:outline-none focus:border-blue-500 transition shadow-sm placeholder-gray-500 focus:ring-1 focus:ring-blue-500">
                <svg class="w-5 h-5 text-gray-500 absolute right-4 top-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8" id="pathsGrid">
            @forelse($paths as $index => $path)
                @php
                    $title = $path->title;
                    $titleLower = strtolower($title);
                    $targetUrl = url('/learning-paths/' . $path->id);

                    // --- LOGIKA IKON SVG (HARDCODED AGAR PASTI MUNCUL) ---
                    // Default values
                    $iconSvg = '<svg class="w-20 h-20 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/></svg>';
                    $bgClass = 'from-gray-700 to-gray-900';

                    if (str_contains($titleLower, 'android')) {
                        $bgClass = 'from-green-600 to-teal-900';
                        $iconSvg = '<svg class="w-20 h-20 text-white fill-current" viewBox="0 0 24 24"><path d="M17.523 15.3414c-.5511 0-.9993-.4486-.9993-.9997s.4482-.9993.9993-.9993c.5511 0 .9993.4482.9993.9993.0001.5511-.4482.9997-.9993.9997m-11.046 0c-.5511 0-.9993-.4486-.9993-.9997s.4482-.9993.9993-.9993c.5511 0 .9993.4482.9993.9993 0 .5511-.4482.9997-.9993.9997m11.4045-6.02l1.9973-3.4592a.416.416 0 00-.1521-.5676.416.416 0 00-.5676.1521l-2.0223 3.503C15.5902 8.4213 13.8533 8.0854 12 8.0854s-3.5902.3359-5.1364.8647L4.8413 5.4471a.416.416 0 00-.5676-.1521.416.416 0 00-.1521.5676l1.9973 3.4592C2.6889 11.1867.3432 14.6589 0 18.761h24c-.3432-4.1021-2.6889-7.5743-6.1185-9.4396"/></svg>';
                    }
                    elseif (str_contains($titleLower, 'ios')) {
                        $bgClass = 'from-gray-600 to-slate-900';
                        $iconSvg = '<svg class="w-20 h-20 text-white fill-current" viewBox="0 0 24 24"><path d="M18.71 19.5c-.83 1.24-1.71 2.45-3.05 2.47-1.34.03-1.77-.79-3.29-.79-1.53 0-2 .77-3.27.82-1.31.05-2.3-1.32-3.14-2.53C4.25 17 2.94 12.45 4.7 9.39c.87-1.52 2.43-2.48 4.12-2.51 1.28-.02 2.5.87 3.29.87.78 0 2.26-1.07 3.81-.91.65.03 2.47.26 3.64 1.98-.09.06-2.17 1.28-2.15 3.81.03 3.02 2.65 4.03 2.68 4.04-.03.07-.42 1.44-1.38 2.83M13 3.5c.73-.83 1.21-1.96 1.07-3.11-1.05.05-2.31.72-3.03 1.64-.65.82-1.19 2.06-1.02 3.16 1.15.09 2.26-.86 2.98-1.69z"/></svg>';
                    }
                    elseif (str_contains($titleLower, 'react')) {
                        $bgClass = 'from-sky-500 to-indigo-900';
                        $iconSvg = '<svg class="w-20 h-20 text-white animate-spin-slow" viewBox="-11.5 -10.23174 23 20.46348"><circle cx="0" cy="0" r="2.05" fill="currentColor"/><g stroke="currentColor" stroke-width="1" fill="none"><ellipse rx="11" ry="4.2" transform="rotate(60)"/><ellipse rx="11" ry="4.2" transform="rotate(120)"/><ellipse rx="11" ry="4.2"/></g></svg>';
                    }
                    elseif (str_contains($titleLower, 'web') || str_contains($titleLower, 'front')) {
                        $bgClass = 'from-orange-500 to-red-900';
                        $iconSvg = '<svg class="w-20 h-20 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="M9.75 17L9 20l-1 1h8l-1-1-.75-3M3 13h18M5 17h14a2 2 0 002-2V5a2 2 0 00-2-2H8a2 2 0 00-2 2v14a2 2 0 002 2z"/></svg>';
                    }
                    elseif (str_contains($titleLower, 'back')) {
                        $bgClass = 'from-purple-600 to-indigo-900';
                        $iconSvg = '<svg class="w-20 h-20 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="M5 12h14M5 12a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v4a2 2 0 01-2 2M5 12a2 2 0 00-2 2v4a2 2 0 002 2h14a2 2 0 002-2v-4a2 2 0 00-2-2m-2-4h.01M17 16h.01"/></svg>';
                    }
                    elseif (str_contains($titleLower, 'machine') || str_contains($titleLower, 'data')) {
                        $bgClass = 'from-red-600 to-rose-900';
                        $iconSvg = '<svg class="w-20 h-20 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z"/></svg>';
                    }
                    elseif (str_contains($titleLower, 'multi') || str_contains($titleLower, 'flutter')) {
                        $bgClass = 'from-blue-500 to-cyan-800';
                        $iconSvg = '<svg class="w-20 h-20 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="M10.5 1.5H8.25A2.25 2.25 0 006 3.75v16.5a2.25 2.25 0 002.25 2.25h7.5A2.25 2.25 0 0018 20.25V3.75a2.25 2.25 0 00-2.25-2.25H13.5m-3 0V3h3V1.5m-3 0h3m-3 18.75h3"/></svg>';
                    }
                @endphp

                <div class="learning-path-card flex flex-col h-full group bg-[#18181b] border border-gray-800 rounded-2xl overflow-hidden hover:border-blue-500/50 transition-all duration-300 hover:shadow-2xl hover:-translate-y-1 cursor-pointer"
                     data-title="{{ $title }}"
                     onclick="checkAccess('{{ $targetUrl }}', '{{ $title }}')">

                    <div class="h-40 bg-gradient-to-br {{ $bgClass }} p-6 flex items-center justify-center relative overflow-hidden">
                        <div class="absolute top-0 left-0 w-full h-full bg-white/5 opacity-0 group-hover:opacity-100 transition duration-500"></div>
                        <span class="absolute top-4 right-4 bg-black/30 backdrop-blur text-white text-[10px] font-bold px-2 py-1 rounded border border-white/10">ACADEMY</span>

                        <div class="relative z-10 drop-shadow-2xl transform group-hover:scale-110 transition duration-300 text-white">
                            {!! $iconSvg !!}
                        </div>
                    </div>

                    <div class="p-6 flex flex-col flex-grow">

                        <div class="mb-4">
                            <span class="text-xs font-bold text-blue-400 uppercase tracking-wider mb-1 block">Career Path</span>
                            <h3 class="text-2xl font-bold text-white group-hover:text-blue-400 transition">
                                {{ $title }}
                            </h3>
                        </div>

                        <div class="flex-grow space-y-4 mb-6 border-t border-gray-800 pt-4">
                            <p class="text-xs text-gray-500 font-bold uppercase">Materi Utama:</p>

                            @if($path->courses->count() > 0)
                                <ul class="space-y-3">
                                    @foreach($path->courses as $course)
                                        <li class="flex items-start gap-3 text-sm text-gray-300 group/item">
                                            <div class="w-1.5 h-1.5 rounded-full bg-blue-500 mt-1.5 flex-shrink-0 group-hover/item:scale-125 transition"></div>
                                            <span class="line-clamp-2 leading-relaxed group-hover/item:text-white transition">{{ $course->title }}</span>
                                        </li>
                                    @endforeach

                                    @if($path->courses_count > 3)
                                        <li class="text-xs text-blue-400 font-medium pl-4 pt-1">+ {{ $path->courses_count - 3 }} materi lainnya</li>
                                    @endif
                                </ul>
                            @else
                                <div class="p-3 bg-gray-800/50 rounded-lg text-sm text-gray-400 italic text-center">
                                    Materi sedang disiapkan oleh instruktur.
                                </div>
                            @endif
                        </div>

                        <div class="pt-4 border-t border-gray-800 flex items-center justify-between text-xs font-medium text-gray-500">
                            <span class="flex items-center gap-1.5 bg-gray-800/50 px-2 py-1 rounded">
                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                {{ ($path->courses_count ?: 5) * 10 }} Jam
                            </span>
                            <span class="flex items-center gap-1 group-hover:text-blue-400 transition">
                                Detail Kurikulum <span aria-hidden="true">&rarr;</span>
                            </span>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-span-full text-center py-20 border-2 border-dashed border-gray-800 rounded-xl bg-[#18181b]">
                    <div class="text-6xl mb-4">📂</div>
                    <h3 class="text-xl font-bold text-white">Belum Ada Data</h3>
                    <p class="text-gray-500 mt-2">Jalankan seeder untuk mengisi data.</p>
                </div>
            @endforelse
        </div>

    </div>
</div>

<div id="authModal" class="fixed inset-0 z-[100] hidden" aria-labelledby="modal-title" role="dialog" aria-modal="true">
    <div class="fixed inset-0 bg-black/80 backdrop-blur-sm transition-opacity" onclick="closeModal()"></div>
    <div class="fixed inset-0 z-10 w-screen overflow-y-auto">
        <div class="flex min-h-full items-end justify-center p-4 text-center sm:items-center sm:p-0">
            <div class="relative transform overflow-hidden rounded-2xl bg-[#1F2937] text-left shadow-2xl transition-all sm:my-8 sm:w-full sm:max-w-lg border border-gray-700 ring-1 ring-white/10">
                <button onclick="closeModal()" class="absolute top-4 right-4 text-gray-400 hover:text-white transition">
                    <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" /></svg>
                </button>
                <div class="px-6 pb-6 pt-8 text-center">
                    <div class="mx-auto flex h-16 w-16 items-center justify-center rounded-full bg-blue-900/20 mb-6">
                        <svg class="h-8 w-8 text-blue-400" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M16.5 10.5V6.75a4.5 4.5 0 10-9 0v3.75m-.75 11.25h10.5a2.25 2.25 0 002.25-2.25v-6.75a2.25 2.25 0 00-2.25-2.25H6.75a2.25 2.25 0 00-2.25 2.25v6.75a2.25 2.25 0 002.25 2.25z" /></svg>
                    </div>
                    <h3 class="text-xl font-bold text-white mb-2">Akses Terbatas 🔒</h3>
                    <p class="text-sm text-gray-400 leading-relaxed">
                        Untuk mengakses materi <span id="targetPathName" class="font-bold text-blue-400 text-base">...</span><br>
                        Silakan masuk ke akun Dicoding Anda terlebih dahulu.
                    </p>
                </div>
                <div class="bg-gray-800/50 px-6 py-4 sm:flex sm:flex-row-reverse sm:gap-3">
                    <a href="{{ route('register') }}" class="inline-flex w-full justify-center rounded-xl bg-blue-600 px-4 py-2.5 text-sm font-semibold text-white shadow-sm hover:bg-blue-500 sm:w-auto transition">Daftar Gratis</a>
                    <a href="{{ route('login') }}" class="mt-3 inline-flex w-full justify-center rounded-xl bg-white px-4 py-2.5 text-sm font-semibold text-gray-900 shadow-sm hover:bg-gray-100 sm:mt-0 sm:w-auto transition">Masuk Akun</a>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    // 1. Fitur Search Real-time
    document.getElementById('searchInput').addEventListener('keyup', function() {
        const query = this.value.toLowerCase();
        const cards = document.querySelectorAll('.learning-path-card');
        const countLabel = document.getElementById('count-label');
        let visibleCount = 0;

        cards.forEach(card => {
            const title = card.getAttribute('data-title').toLowerCase();
            if(title.includes(query)) {
                card.style.display = 'flex';
                visibleCount++;
            } else {
                card.style.display = 'none';
            }
        });
        countLabel.innerText = visibleCount + ' Path Ditemukan';
    });

    // 2. Fitur Cek Akses
    function checkAccess(url, title) {
        const token = localStorage.getItem('auth_token');
        if (token) {
            window.location.href = url;
        } else {
            document.getElementById('targetPathName').innerText = title;
            document.getElementById('authModal').classList.remove('hidden');
        }
    }

    function closeModal() {
        document.getElementById('authModal').classList.add('hidden');
    }
</script>
@endsection
