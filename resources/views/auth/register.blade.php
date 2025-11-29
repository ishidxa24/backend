@extends('layouts.app')

@section('content')
<div class="min-h-[80vh] flex items-center justify-center px-4 relative overflow-hidden">
    <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-[500px] h-[500px] bg-purple-600/10 rounded-full blur-[100px] -z-10"></div>

    <div class="max-w-md w-full bg-dark-800 rounded-2xl border border-dark-700 shadow-2xl p-8 z-10">
        <div class="text-center mb-8">
            <h2 class="text-3xl font-bold text-white">Buat Akun Baru</h2>
            <p class="text-gray-400 mt-2">Mulai perjalanan karir developermu.</p>
        </div>

        <form id="register-form" class="space-y-4">
            <div>
                <label class="block text-sm font-medium text-gray-300 mb-2">Nama Lengkap</label>
                <input type="text" id="name" class="w-full bg-dark-900 border border-dark-600 rounded-lg px-4 py-3 text-white focus:border-primary focus:outline-none" required>
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-300 mb-2">Email Address</label>
                <input type="email" id="email" class="w-full bg-dark-900 border border-dark-600 rounded-lg px-4 py-3 text-white focus:border-primary focus:outline-none" required>
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-300 mb-2">Password</label>
                <input type="password" id="password" class="w-full bg-dark-900 border border-dark-600 rounded-lg px-4 py-3 text-white focus:border-primary focus:outline-none" required>
            </div>

            <button type="submit" id="btn-register" class="w-full bg-primary hover:bg-blue-600 text-white font-bold py-3 rounded-lg transition mt-4 flex justify-center items-center">
                Daftar Sekarang
            </button>
        </form>

        <p class="mt-8 text-center text-gray-400 text-sm">
            Sudah punya akun? <a href="{{ url('/login') }}" class="text-primary font-bold hover:underline">Masuk disini</a>
        </p>
    </div>
</div>

<script>
    document.getElementById('register-form').addEventListener('submit', async (e) => {
        e.preventDefault();
        const btn = document.getElementById('btn-register');
        const originalText = btn.innerText;

        btn.innerHTML = '<svg class="animate-spin h-5 w-5 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path></svg>';
        btn.disabled = true;

        try {
            // 1. Hit API Register
            const res = await axios.post('/api/register', {
                name: document.getElementById('name').value,
                email: document.getElementById('email').value,
                password: document.getElementById('password').value
            });

            // 2. Simpan Token (Auto Login)
            const token = res.data.access_token || res.data.token;
            localStorage.setItem('auth_token', token);

            alert('Pendaftaran Berhasil!');
            window.location.href = '/';

        } catch (err) {
            console.error(err);
            alert('Gagal Daftar: ' + (err.response?.data?.message || 'Email mungkin sudah terdaftar.'));
            btn.innerHTML = originalText;
            btn.disabled = false;
        }
    });
</script>
@endsection
