@extends('layouts.app')

@section('content')
<div class="max-w-3xl mx-auto h-[calc(100vh-140px)] flex flex-col px-4">
    <div class="bg-dark-800 p-4 rounded-t-xl border border-dark-700 flex items-center gap-4 shadow-md">
        <div class="w-10 h-10 rounded-full bg-gradient-to-r from-primary to-purple-600 flex items-center justify-center text-white font-bold">
            AI
        </div>
        <div>
            <h2 class="font-bold text-white">DevCareer Buddy</h2>
            <p class="text-xs text-green-400 flex items-center gap-1">
                <span class="w-2 h-2 rounded-full bg-green-400 animate-pulse"></span> Online
            </p>
        </div>
    </div>

    <div id="chat-box" class="flex-grow bg-dark-900 border-x border-dark-700 overflow-y-auto p-6 space-y-4">
        <div class="flex justify-start">
            <div class="bg-dark-800 border border-dark-700 text-gray-200 px-5 py-3 rounded-2xl rounded-tl-none max-w-[80%]">
                Halo! 👋 Ada yang bisa saya bantu tentang coding hari ini?
            </div>
        </div>
    </div>

    <div class="bg-dark-800 p-4 rounded-b-xl border border-dark-700 shadow-lg">
        <form id="chat-form" class="flex gap-2 relative">
            <input
                type="text"
                id="msg-input"
                class="w-full bg-dark-900 text-white border border-dark-600 rounded-xl px-5 py-3 focus:outline-none focus:border-primary focus:ring-1 focus:ring-primary placeholder-gray-500"
                placeholder="Tulis pertanyaanmu..."
                autocomplete="off"
            >
            <button type="submit" class="bg-primary hover:bg-blue-600 text-white px-6 rounded-xl font-bold transition flex items-center">
                Kirim
            </button>
        </form>
    </div>
</div>

<script>
    const form = document.getElementById('chat-form');
    const box = document.getElementById('chat-box');
    const input = document.getElementById('msg-input');

    function addBubble(text, isUser) {
        const div = document.createElement('div');
        div.className = `flex ${isUser ? 'justify-end' : 'justify-start'} animate-fade-in`;

        const bubble = document.createElement('div');
        bubble.className = isUser
            ? 'bg-primary text-white px-5 py-3 rounded-2xl rounded-tr-none max-w-[80%] shadow-lg'
            : 'bg-dark-800 border border-dark-700 text-gray-200 px-5 py-3 rounded-2xl rounded-tl-none max-w-[80%]';

        bubble.innerText = text;
        div.appendChild(bubble);
        box.appendChild(div);
        box.scrollTop = box.scrollHeight;
    }

    form.addEventListener('submit', async (e) => {
        e.preventDefault();
        const msg = input.value.trim();
        if(!msg) return;

        addBubble(msg, true);
        input.value = '';
        input.disabled = true;

        try {
            // Tembak ke API Laravel
            const res = await axios.post('/api/chat', { message: msg });
            const reply = res.data.reply || res.data.message || "Maaf, saya tidak mengerti.";
            addBubble(reply, false);
        } catch (err) {
            console.error(err);
            addBubble("Gagal terhubung ke server.", false);
        } finally {
            input.disabled = false;
            input.focus();
        }
    });
</script>
@endsection
