@extends('layouts.frontend.header')
@section('home')

<head>
  <meta charset="utf-8">
  <title>Cameroon Child-Law Chatbot</title>
  <meta name="viewport" content="width=device-width, initial-scale=1"/>
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-50 text-gray-900">
  <div class="max-w-3xl mx-auto p-4">
    <header class="mb-4">
      <h1 class="text-2xl font-bold">Child-Law (Cameroon) & Orphanages – AI Assistant</h1>
      <p class="text-sm text-gray-600">
        For educational guidance only. Not a law firm. Verify with a qualified Cameroonian lawyer / Ministry of Social Affairs.
      </p>
    </header>

    <div id="chat" class="bg-white rounded-2xl shadow p-4 h-[60vh] overflow-y-auto space-y-4"></div>

    <form id="chat-form" class="mt-4 flex gap-2" autocomplete="off">
      <input id="msg" name="message" class="flex-1 border rounded-xl px-3 py-2 focus:outline-none"
             placeholder="Posez votre question (EN/FR) sur le droit de l'enfant ou les orphelinats au Cameroun..." />
      <button class="px-4 py-2 rounded-xl bg-blue-600 text-white hover:bg-blue-700">Send</button>
    </form>

    <div id="error" class="mt-3 text-sm text-red-600 hidden"></div>
  </div>

  <script>
    const chat = document.getElementById('chat');
    const form = document.getElementById('chat-form');
    const input = document.getElementById('msg');
    const errorBox = document.getElementById('error');

    function addBubble(text, who) {
      const div = document.createElement('div');
      div.className = who === 'you'
        ? 'flex justify-end'
        : 'flex justify-start';
      const bubble = document.createElement('div');
      bubble.className = who === 'you'
        ? 'bg-blue-600 text-white rounded-2xl px-4 py-2 max-w-[80%]'
        : 'bg-gray-100 text-gray-900 rounded-2xl px-4 py-2 max-w-[80%]';
      bubble.innerHTML = text.replace(/\n/g,'<br>');
      div.appendChild(bubble);
      chat.appendChild(div);
      chat.scrollTop = chat.scrollHeight;
    }

    function setError(msg) {
      errorBox.textContent = msg || '';
      errorBox.classList.toggle('hidden', !msg);
    }

    form.addEventListener('submit', async (e) => {
      e.preventDefault();
      setError('');
      const text = input.value.trim();
      if (!text) return;

      addBubble(text, 'you');
      input.value = '';

      const pending = document.createElement('div');
      pending.className = 'flex justify-start';
      pending.innerHTML = '<div class="animate-pulse bg-gray-200 rounded-2xl px-4 py-2">Thinking…</div>';
      chat.appendChild(pending);
      chat.scrollTop = chat.scrollHeight;

      try {
        const res = await fetch('{{ route('chat.ask') }}', {
          method: 'POST',
          headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector("meta[name='csrf-token']").content
          },
          body: JSON.stringify({ message: text })
        });

        const data = await res.json();
        pending.remove();

        if (!res.ok) {
          setError(data.error || 'Something went wrong.');
          addBubble('Sorry, I had trouble answering. Please try again.', 'bot');
          return;
        }

        if (data.blocked_by === 'domain_guard') {
          addBubble(data.answer, 'bot');
          return;
        }

        if (data.blocked_by === 'gemini_safety') {
          addBubble(data.answer, 'bot');
          return;
        }

        addBubble(data.answer, 'bot');
      } catch (err) {
        pending.remove();
        setError('Network error. Check your internet and try again.');
        addBubble('Network error. Please try again.', 'bot');
      }
    });
  </script>
@endsection 