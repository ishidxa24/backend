<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dicoding - Bangun Karir Developer</title>
    <link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@400;500;600;700&display=swap" rel="stylesheet">

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="antialiased min-h-screen flex flex-col bg-[#18181b] text-white font-sans scroll-smooth">
    <nav class="fixed w-full z-50 bg-[#18181b]/90 backdrop-blur border-b border-gray-800 transition-all duration-300">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center justify-between h-20">

                <div class="flex items-center gap-10">
                    <a href="{{ url('/') }}" class="text-3xl font-bold tracking-tight flex items-center gap-2 group">
                        <span class="text-white group-hover:text-gray-200 transition">DICODING</span>
                    </a>

                    @if(!request()->is('learning-paths/*'))
                        <div class="hidden md:flex items-center space-x-1">
                            <a href="{{ url('/learning-paths') }}" class="text-gray-300 hover:text-white px-4 py-2 text-sm font-semibold transition rounded-full hover:bg-white/5">
                                Learning Paths
                            </a>
                            <a href="#" class="text-gray-300 hover:text-white px-4 py-2 text-sm font-semibold transition rounded-full hover:bg-white/5">
                                Langganan
                            </a>
                            <a href="{{ url('/roadmap') }}" class="flex items-center gap-2 text-gray-300 hover:text-blue-400 px-4 py-2 text-sm font-semibold transition-all duration-300 transform hover:-translate-y-0.5">
                                <span class="text-lg">🗺️</span> Roadmap
                            </a>
                        </div>
                    @else
                        <div class="hidden md:flex items-center">
                            <a href="{{ url('/') }}" class="flex items-center gap-2 text-gray-400 hover:text-white transition border border-gray-700 hover:border-gray-500 px-4 py-2 rounded-lg text-sm font-medium">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" /></svg>
                                Kembali ke Homepage
                            </a>
                        </div>
                    @endif
                </div>

                <div>
                    <div id="nav-guest" class="hidden flex items-center gap-4">
                        <a href="{{ url('/login') }}" class="text-white border border-gray-600 px-5 py-2 rounded-md text-sm font-bold hover:bg-gray-800 transition">
                            Masuk
                        </a>
                        <a href="{{ url('/register') }}" class="bg-white text-black px-5 py-2 rounded-md text-sm font-bold hover:bg-gray-200 transition shadow-lg shadow-white/10">
                            Daftar
                        </a>
                    </div>

                    <div id="nav-auth" class="hidden flex items-center gap-6">
                        <div class="hidden md:block text-right">
                            <p class="text-[10px] uppercase tracking-wider text-gray-500 font-bold">Developer</p>
                            <p class="text-sm font-bold text-white leading-none truncate max-w-[150px]" id="user-name-display">User</p>
                        </div>

                        @if(!request()->is('learning-paths/*'))
                        <a href="{{ url('/chat') }}" onclick="checkChatAccess(event)" class="text-gray-400 hover:text-blue-400 transition relative group" title="Tanya AI">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z" /></svg>
                            <span class="absolute -top-1 -right-1 flex h-2.5 w-2.5">
                              <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-blue-400 opacity-75"></span>
                              <span class="relative inline-flex rounded-full h-2.5 w-2.5 bg-blue-500"></span>
                            </span>
                        </a>
                        @endif

                        <button onclick="logout()" class="text-gray-400 hover:text-red-500 transition" title="Keluar">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" /></svg>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </nav>

    <main class="flex-grow pt-20">
        @yield('content')
    </main>

    <footer class="bg-[#111113] border-t border-gray-800 mt-auto py-12">
        <div class="max-w-7xl mx-auto px-4 grid grid-cols-1 md:grid-cols-4 gap-8 text-sm text-gray-400">
            <div class="col-span-1 md:col-span-2">
                <h3 class="text-2xl font-bold text-white mb-4">DICODING</h3>
                <p class="leading-relaxed">Bangun karirmu sebagai developer profesional. <br>Platform belajar pemrograman nomor #1 di Indonesia.</p>
            </div>
            <div>
                <h4 class="font-bold text-white mb-4 uppercase tracking-wider">Produk</h4>
                <ul class="space-y-2">
                    <li><a href="#" class="hover:text-blue-400 transition">Academy</a></li>
                    <li><a href="#" class="hover:text-blue-400 transition">Challenge</a></li>
                </ul>
            </div>
            <div>
                <h4 class="font-bold text-white mb-4 uppercase tracking-wider">Perusahaan</h4>
                <ul class="space-y-2">
                    <li><a href="#" class="hover:text-blue-400 transition">Tentang Kami</a></li>
                    <li><a href="#" class="hover:text-blue-400 transition">Hubungi Kami</a></li>
                </ul>
            </div>
        </div>
        <div class="text-center text-gray-600 text-xs mt-12 border-t border-gray-900 pt-8">
            &copy; 2025 Dicoding Indonesia. All rights reserved.
        </div>
    </footer>

    <script>
        const authToken = localStorage.getItem('auth_token');
        const navGuest = document.getElementById('nav-guest');
        const navAuth = document.getElementById('nav-auth');
        const userNameDisplay = document.getElementById('user-name-display');

        if (authToken) {
            if(navGuest) navGuest.classList.add('hidden');
            if(navAuth) { navAuth.classList.remove('hidden'); navAuth.classList.add('flex'); }

            setTimeout(() => {
                if(window.axios) {
                     window.axios.get('/api/user').then(res => {
                        if(userNameDisplay) userNameDisplay.innerText = res.data.name;
                    }).catch(() => {});
                }
            }, 500);
        } else {
            if(navGuest) navGuest.classList.remove('hidden');
            if(navAuth) navAuth.classList.add('hidden');
        }

        // --- TAMBAHAN PENTING: CEK AKSES CHAT ---
        function checkChatAccess(e) {
            e.preventDefault();
            const token = localStorage.getItem('auth_token');

            if (!token) {
                if (confirm("🔒 AKSES TERBATAS\n\nFitur Learning Buddy (AI) hanya untuk member.\nSilakan Login atau Register untuk mulai bertanya.")) {
                    window.location.href = '/login';
                }
            } else {
                // Jika login, arahkan ke halaman chat
                window.location.href = '/chat';
            }
        }

        function logout() {
            if(confirm('Keluar dari Dicoding?')) {
                localStorage.removeItem('auth_token');
                window.location.href = '/login';
            }
        }
    </script>
</body>
</html>
