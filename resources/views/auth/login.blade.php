@extends('layouts.app')

@section('content')
<div class="min-h-[80vh] flex items-center justify-center px-4 relative overflow-hidden">
    <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-[500px] h-[500px] bg-primary/10 rounded-full blur-[100px] -z-10"></div>

    <div class="max-w-md w-full bg-dark-800 rounded-2xl border border-dark-700 shadow-2xl p-8 z-10">
        <div class="text-center mb-8">
            <h2 class="text-3xl font-bold text-white">Selamat Datang</h2>
            <p class="text-gray-400 mt-2">Masuk untuk melanjutkan progress belajarmu.</p>
        </div>

        <form id="login-form" class="space-y-6">
            <div>
                <label class="block text-sm font-medium text-gray-300 mb-2">Email Address</label>
                <input type="email" id="email" class="w-full bg-dark-900 border border-dark-600 rounded-lg px-4 py-3 text-white focus:border-primary focus:ring-1 focus:ring-primary focus:outline-none placeholder-gray-600 transition" placeholder="nama@email.com" required>
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-300 mb-2">Password</label>
                <input type="password" id="password" class="w-full bg-dark-900 border border-dark-600 rounded-lg px-4 py-3 text-white focus:border-primary focus:ring-1 focus:ring-primary focus:outline-none placeholder-gray-600 transition" placeholder="••••••••" required>
            </div>

            <button type="submit" id="btn-login" class="w-full bg-primary hover:bg-blue-600 text-white font-bold py-3 rounded-lg transition transform active:scale-95 flex justify-center items-center">
                Masuk Sekarang
            </button>
        </form>

        <p class="mt-8 text-center text-gray-400 text-sm">
            Belum punya akun? <a href="{{ url('/register') }}" class="text-primary font-bold hover:underline">Daftar Gratis</a>
        </p>
    </div>
</div>

<script>
    document.getElementById('login-form').addEventListener('submit', async (e) => {
        e.preventDefault();
        const btn = document.getElementById('btn-login');
        const originalText = btn.innerText;

        // Loading State
        btn.innerHTML = '<svg class="animate-spin h-5 w-5 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path></svg>';
        btn.disabled = true;

        try {
            // 1. Hit API Login
            const res = await axios.post('/api/login', {
                email: document.getElementById('email').value,
                password: document.getElementById('password').value
            });

            // 2. Simpan Token ke Browser
            const token = res.data.access_token || res.data.token;
            localStorage.setItem('auth_token', token);

            // 3. Redirect ke Home
            window.location.href = '/';

        } catch (err) {
            console.error(err);
            alert('Login Gagal: ' + (err.response?.data?.message || 'Cek email/password Anda.'));
            btn.innerHTML = originalText;
            btn.disabled = false;
        }
    });
</script>
@endsection
