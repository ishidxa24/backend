@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-[#18181b] py-12 px-4 sm:px-6 lg:px-8 relative overflow-hidden">

    <div class="absolute top-0 left-0 w-[500px] h-[500px] bg-blue-600/10 rounded-full blur-[120px] -translate-x-1/2 -translate-y-1/2 pointer-events-none"></div>
    <div class="absolute bottom-0 right-0 w-[500px] h-[500px] bg-purple-600/10 rounded-full blur-[120px] translate-x-1/2 translate-y-1/2 pointer-events-none"></div>

    <div class="max-w-5xl mx-auto relative z-10">

        <div class="text-center mb-12">
            <h1 class="text-3xl md:text-5xl font-extrabold text-white mb-4">
                Personalized Learning Roadmap
            </h1>
            <p class="text-gray-400 max-w-2xl mx-auto text-lg" id="page-subtitle">
                Temukan jalur belajar yang paling cocok untuk karir impianmu melalui assessment AI kami.
            </p>
        </div>

        <div id="section-roles" class="animate-fade-in">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6" id="roles-container">
                <div class="col-span-3 text-center py-12">
                    <svg class="animate-spin h-8 w-8 text-blue-500 mx-auto" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path></svg>
                    <p class="text-gray-500 mt-4">Memuat Pilihan Karir...</p>
                </div>
            </div>
        </div>

        <div id="section-quiz" class="hidden animate-fade-in max-w-2xl mx-auto">
            <div class="bg-[#202024] border border-gray-700 rounded-xl p-8 shadow-2xl">
                <div class="mb-6 flex items-center justify-between">
                    <h2 class="text-xl font-bold text-white">Assessment Minat</h2>
                    <span class="text-xs font-mono bg-blue-900/30 text-blue-400 px-2 py-1 rounded">AI POWERED</span>
                </div>

                <form id="quiz-form">
                    <div id="questions-container" class="space-y-6">
                        </div>

                    <div class="mt-8 pt-6 border-t border-gray-700 flex justify-end gap-3">
                        <button type="button" onclick="resetToRoles()" class="text-gray-400 hover:text-white px-4 py-2 transition">Batal</button>
                        <button type="submit" id="btn-submit-quiz" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-6 rounded-lg transition shadow-lg">
                            Analisis Jawaban
                        </button>
                    </div>
                </form>
            </div>
        </div>

        <div id="section-result" class="hidden animate-fade-in">
            <div class="bg-[#202024] border border-gray-700 rounded-xl p-8 shadow-2xl mb-8">
                <h2 class="text-2xl font-bold text-white mb-2">Rekomendasi Roadmap Anda</h2>
                <p class="text-gray-400 mb-6">Berdasarkan hasil analisis, berikut adalah kurikulum yang kami sarankan:</p>

                <div class="relative border-l-2 border-gray-700 ml-3 space-y-8 pb-4" id="roadmap-timeline">
                    </div>

                <div class="mt-8 text-center">
                    <button onclick="window.location.reload()" class="border border-gray-600 text-gray-300 hover:text-white hover:border-white px-6 py-2 rounded-lg transition">
                        Ulangi Assessment
                    </button>
                </div>
            </div>
        </div>

    </div>
</div>

<script>
    // --- VARIABEL GLOBAL ---
    let selectedRole = null;
    const rolesContainer = document.getElementById('roles-container');
    const questionsContainer = document.getElementById('questions-container');
    const roadmapTimeline = document.getElementById('roadmap-timeline');

    // Section Elements
    const secRoles = document.getElementById('section-roles');
    const secQuiz = document.getElementById('section-quiz');
    const secResult = document.getElementById('section-result');
    const pageSubtitle = document.getElementById('page-subtitle');

    // --- 1. INISIALISASI (LOAD ROLES) ---
    document.addEventListener('DOMContentLoaded', () => {
        fetchRoles();
    });

    async function fetchRoles() {
        try {
            // Panggil API Backend
            const res = await window.axios.get('/api/roles');
            renderRoles(res.data);
        } catch (err) {
            console.error(err);
            rolesContainer.innerHTML = `<div class="col-span-3 text-red-400 text-center">Gagal memuat data role. Pastikan Anda sudah Login.</div>`;
        }
    }

    function renderRoles(roles) {
        rolesContainer.innerHTML = '';

        // Cek struktur data backend (apakah array langsung atau di dalam .data)
        const data = Array.isArray(roles) ? roles : roles.data;

        data.forEach(role => {
            const card = document.createElement('div');
            card.className = `group bg-[#202024] border border-gray-700 hover:border-blue-500 rounded-xl p-6 cursor-pointer transition duration-300 hover:-translate-y-1 hover:shadow-xl`;
            card.onclick = () => startAssessment(role.id || role.name); // Sesuaikan key ID/Name

            card.innerHTML = `
                <div class="w-12 h-12 bg-blue-900/30 rounded-lg flex items-center justify-center mb-4 group-hover:bg-blue-600 transition">
                    <span class="text-2xl">🚀</span>
                </div>
                <h3 class="text-xl font-bold text-white mb-2">${role.name || role}</h3>
                <p class="text-gray-400 text-sm">Klik untuk memulai assessment jalur karir ini.</p>
            `;
            rolesContainer.appendChild(card);
        });
    }

    // --- 2. MULAI ASSESSMENT ---
    async function startAssessment(role) {
        selectedRole = role;

        // UI Transition
        secRoles.classList.add('hidden');
        secQuiz.classList.remove('hidden');
        pageSubtitle.innerText = "Jawab pertanyaan berikut agar kami bisa menyusun materi yang tepat.";

        // Load Questions
        questionsContainer.innerHTML = '<div class="text-center text-gray-500">Memuat Pertanyaan...</div>';

        try {
            const res = await window.axios.get(`/api/assessment/${role}`);
            renderQuestions(res.data);
        } catch (err) {
            console.error(err);
            alert('Gagal memuat pertanyaan.');
            resetToRoles();
        }
    }

    function renderQuestions(questions) {
        questionsContainer.innerHTML = '';
        const data = Array.isArray(questions) ? questions : questions.data;

        data.forEach((q, index) => {
            const div = document.createElement('div');
            div.className = "space-y-3";
            div.innerHTML = `
                <label class="block text-white font-medium text-lg">${index + 1}. ${q.question}</label>
                <div class="space-y-2">
                    ${renderOptions(q, index)}
                </div>
            `;
            questionsContainer.appendChild(div);
        });
    }

    function renderOptions(question, index) {
        // Asumsi struktur options bisa berupa array string atau object
        // Sesuaikan dengan data Backend RoadmapController Anda
        // Contoh data dummy jika options tidak ada di API:
        const options = question.options || ['Sangat Tidak Setuju', 'Tidak Setuju', 'Netral', 'Setuju', 'Sangat Setuju'];

        return options.map(opt => `
            <label class="flex items-center space-x-3 p-3 rounded-lg border border-gray-700 hover:bg-gray-800 cursor-pointer transition">
                <input type="radio" name="q_${question.id}" value="${opt}" class="form-radio text-blue-600 bg-gray-900 border-gray-600 focus:ring-blue-500" required>
                <span class="text-gray-300">${opt}</span>
            </label>
        `).join('');
    }

    function resetToRoles() {
        secQuiz.classList.add('hidden');
        secResult.classList.add('hidden');
        secRoles.classList.remove('hidden');
        pageSubtitle.innerText = "Temukan jalur belajar yang paling cocok untuk karir impianmu.";
    }

    // --- 3. SUBMIT & SHOW RESULT ---
    document.getElementById('quiz-form').addEventListener('submit', async (e) => {
        e.preventDefault();
        const btn = document.getElementById('btn-submit-quiz');
        btn.innerHTML = 'Menganalisis...';
        btn.disabled = true;

        // Kumpulkan Jawaban
        const formData = new FormData(e.target);
        const answers = {};
        for (let [key, value] of formData.entries()) {
            answers[key.replace('q_', '')] = value;
        }

        try {
            const res = await window.axios.post('/api/assessment/evaluate', {
                role: selectedRole,
                answers: answers
            });

            renderRoadmap(res.data);

            // UI Transition
            secQuiz.classList.add('hidden');
            secResult.classList.remove('hidden');
            pageSubtitle.innerText = "Berikut adalah jalur belajar yang disarankan untuk Anda.";

        } catch (err) {
            console.error(err);
            alert('Gagal menganalisis jawaban. Coba lagi.');
        } finally {
            btn.innerHTML = 'Analisis Jawaban';
            btn.disabled = false;
        }
    });

    function renderRoadmap(data) {
        roadmapTimeline.innerHTML = '';

        // Asumsi data yang dikembalikan adalah array modul/course
        // Sesuaikan 'data.roadmap' atau 'data' tergantung response controller
        const courses = data.roadmap || data.courses || data;

        if(!courses || courses.length === 0) {
            roadmapTimeline.innerHTML = '<div class="pl-6 text-gray-500">Tidak ada rekomendasi spesifik.</div>';
            return;
        }

        courses.forEach((item, idx) => {
            const isLast = idx === courses.length - 1;
            const html = `
                <div class="relative pl-8 group">
                    <div class="absolute -left-[9px] top-0 bg-[#18181b] p-1">
                        <div class="w-4 h-4 rounded-full bg-blue-600 border-4 border-[#18181b] group-hover:scale-125 transition"></div>
                    </div>

                    <div class="bg-[#27272a] border border-gray-700 rounded-lg p-5 hover:border-blue-500 transition duration-300 shadow-lg">
                        <div class="flex justify-between items-start mb-2">
                            <h3 class="text-lg font-bold text-white group-hover:text-blue-400 transition">${item.title || item.course_name}</h3>
                            <span class="text-xs font-bold px-2 py-1 rounded bg-blue-900/30 text-blue-400 border border-blue-800">
                                STEP ${idx + 1}
                            </span>
                        </div>
                        <p class="text-sm text-gray-400 mb-4">${item.description || 'Materi fundamental yang wajib dikuasai.'}</p>

                        <a href="#" class="inline-flex items-center text-sm font-semibold text-white hover:text-blue-400 transition">
                            Mulai Belajar <span class="ml-1">&rarr;</span>
                        </a>
                    </div>
                </div>
            `;
            roadmapTimeline.insertAdjacentHTML('beforeend', html);
        });
    }
</script>
@endsection
