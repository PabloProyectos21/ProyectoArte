<x-app-layout>
    @include('components.sidebar')
    <div class="p-4 sm:ml-64">
        @if(Auth::user()->is_premium && Auth::user()->background_image)
            <div
                class="fixed inset-0 z-0"
                style="background: url('{{ secure_asset(Auth::user()->background_image) }}') center center / cover no-repeat; opacity: 0.35;">
            </div>
        @endif
            <div class="relative p-4  rounded-lg mt-14 place-items-center z-10">

            <div class="max-w-4xl w-full mx-auto py-8 flex justify-center">
                <div class="w-full md:w-4/5 lg:w-3/4">
                    <h1 class="text-2xl font-bold mb-6">
                        Chat with
                        @foreach($chat->users as $participant)
                            @if($participant->id !== auth()->id())
                                {{ $participant->name }}
                                @php
                                    $user2=$participant;
                                @endphp
                            @endif
                        @endforeach
                    </h1>

                    <div class="bg-white rounded-lg shadow p-6 mb-6">
                        <!-- SCROLL SOLO AQUÍ -->
                        <div id="chat-messages" class="max-h-[550px] overflow-y-auto pr-2 mb-4">
                            {{-- Mensajes --}}
                            @forelse($chat->messages->sortBy('created_at') as $message)
                                <div class="mb-4 flex items-end gap-3 {{ $message->sender_id == auth()->id() ? 'justify-end' : 'justify-start' }}">
                                    @if($message->sender_id != auth()->id())
                                        {{-- Imagen del otro usuario a la izquierda --}}
                                        @php
                                            $isUrl = Str::startsWith($user2->profile_picture, ['http://', 'https://']);
                                            $imageSrc = $user2->profile_picture
                                                ? ($isUrl ? $user2->profile_picture : secure_asset('storage/'.$user2->profile_picture))
                                                : secure_asset('images/profile_pictures/default-user.jpg');
                                        @endphp
                                        <a href="{{ route('profile.view', $user2->id) }}">
                                            <img class="w-10 h-10 rounded-full" src="{{ $imageSrc }}" alt="{{ $user2->name }}" />
                                        </a>
                                    @endif

                                    <div class="{{ $message->sender_id == auth()->id() ? 'text-right' : 'text-left' }}">
                                        <div class="text-xs text-gray-400 mb-1">
                <span class="font-semibold">
                    {{ $message->sender_id == auth()->id() ? 'You' : $message->sender->name }}
                </span>
                                            •
                                            {{ $message->created_at->format('H:i d/m/Y') }}
                                        </div>
                                        <div class="inline-block px-4 py-2 rounded-lg mt-1
                {{ $message->sender_id == auth()->id()
                    ? 'bg-purple-500 text-white rounded-br-none'
                    : 'bg-gray-200 text-gray-800 rounded-bl-none' }}">
                                            {{ $message->content }}
                                        </div>
                                    </div>

                                    @if($message->sender_id == auth()->id())
                                        {{-- Imagen tuya a la derecha --}}
                                        @php
                                            $isUrl = Str::startsWith(auth()->user()->profile_picture, ['http://', 'https://']);
                                            $imageSrc = auth()->user()->profile_picture
                                                ? ($isUrl ? auth()->user()->profile_picture : secure_asset('storage/'.auth()->user()->profile_picture))
                                                : secure_asset('images/profile_pictures/default-user.jpg');
                                        @endphp
                                        <a href="{{ route('profile.view', auth()->user()->id) }}">
                                            <img class="w-10 h-10 rounded-full" src="{{ $imageSrc }}" alt="{{ auth()->user()->name }}" />
                                        </a>
                                    @endif
                                </div>
                            @empty
                                <p class="text-gray-500">No messages yet.</p>
                            @endforelse

                        </div>

                        <form id="message-form" method="POST" action="{{ route('chats.message', $chat->id) }}" class="flex gap-2">
                            @csrf
                            <input type="text" name="content" id="message-content" class="flex-1 border rounded-lg px-4 py-2" placeholder="Type your message..." required>
                            <button type="submit" class="bg-purple-600 text-white px-4 py-2 rounded-lg hover:bg-purple-700 transition">Send</button>
                        </form>
                    </div>
                    <a href="{{ route('chats.index') }}" class="block mt-6 text-purple-600 hover:underline">← Back to Chats </a>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>
<script>
    // Auto-scroll cuando carga la página
    function scrollToBottom() {
        var chatMessages = document.getElementById('chat-messages');
        if (chatMessages) {
            chatMessages.scrollTop = chatMessages.scrollHeight;
        }
    }

    document.addEventListener('DOMContentLoaded', function () {
        scrollToBottom();

        document.getElementById('message-form').addEventListener('submit', function(e) {
            e.preventDefault();

            var form = this;
            var input = document.getElementById('message-content');
            var content = input.value.trim();
            if (!content) return;

            var data = new FormData(form);

            fetch(form.action, {
                method: 'POST',
                headers: {
                    'X-Requested-With': 'XMLHttpRequest',
                    'X-CSRF-TOKEN': form.querySelector('input[name="_token"]').value
                },
                body: data
            })
                .then(response => {
                    if (!response.ok) throw new Error('Network error');
                    return response.text(); // Esperamos HTML parcial
                })
                .then(html => {
                    // Opcional: Recarga solo los mensajes (ideal: devuelve solo el html de mensajes)
                    // Aquí suponemos que tienes una ruta que te devuelve solo los mensajes actualizados
                    fetch(window.location.href, {
                        headers: { 'X-Requested-With': 'XMLHttpRequest' }
                    })
                        .then(resp => resp.text())
                        .then(page => {
                            // Extraer el bloque de mensajes del HTML recibido
                            var parser = new DOMParser();
                            var doc = parser.parseFromString(page, 'text/html');
                            var newMessages = doc.getElementById('chat-messages').innerHTML;
                            document.getElementById('chat-messages').innerHTML = newMessages;
                            scrollToBottom();
                        });
                    input.value = '';
                    input.focus();
                })
                .catch(error => {
                    alert('Failed to send message');
                });
        });
    });
</script>

