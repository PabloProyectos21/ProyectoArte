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
            <div class="max-w-2xl mx-auto py-8">
                <h1 class="text-2xl font-bold mb-6">Your Chats</h1>

                <form method="POST" action="{{ route('chats.store') }}" class="mb-6">
                    @csrf
                    <input type="hidden" id="selected_username" name="username">
                    <input type="hidden" id="selected_user_id" name="user_id">
                    <div class="relative">
                        <input type="text" id="user_search" name="user_search" placeholder="Search username..."
                               class="w-full border rounded-lg px-4 py-2" autocomplete="off" required>
                        <input type="hidden" id="selected_user_id" name="user_id">
                        <div id="autocomplete-list"
                             class="absolute z-30 bg-white w-full border rounded-lg mt-1 shadow-lg hidden"></div>
                    </div>
                    <button type="submit" class="mt-2 bg-purple-600 text-white rounded px-4 py-2">Start Chat</button>
                </form>


                <!-- Lista de chats existentes -->
                @if($chats->isEmpty())
                    <p class="text-gray-600">You have no chats yet.</p>
                @else
                    <ul class="space-y-4">
                        @foreach($chats as $chat)
                            <li>
                                <a href="{{ route('chats.show', $chat->id) }}" class="block p-4 rounded-lg bg-white shadow hover:bg-purple-100 transition">
                            <span class="font-semibold">
                                @foreach($chat->users as $participant)
                                    @if($participant->id !== auth()->id())
                                        {{ $participant->name }}{{ !$loop->last ? ',' : '' }}
                                    @endif
                                @endforeach
                            </span>
                                    <span class="block text-sm text-gray-500">
                                Last message:
                                {{ optional($chat->messages->last())->created_at ? $chat->messages->last()->created_at->diffForHumans() : 'No messages yet' }}
                            </span>
                                </a>
                            </li>
                        @endforeach
                    </ul>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const input = document.getElementById('user_search');
        const list = document.getElementById('autocomplete-list');
        const hiddenId = document.getElementById('selected_user_id');

        let timeout = null;
        input.addEventListener('input', function() {
            clearTimeout(timeout);
            const query = input.value.trim();
            hiddenId.value = ''; // Limpiar ID si cambias texto

            if (query.length === 0) {
                list.innerHTML = '';
                list.classList.add('hidden');
                return;
            }

            timeout = setTimeout(() => {
                fetch(`/users/search?q=${encodeURIComponent(query)}`)
                    .then(res => res.json())
                    .then(users => {
                        if(users.length === 0) {
                            list.innerHTML = '<div class="p-2 text-gray-500">No users found.</div>';
                            list.classList.remove('hidden');
                            return;
                        }
                        list.innerHTML = '';
                        users.forEach(user => {
                            const item = document.createElement('div');
                            item.className = 'p-2 cursor-pointer hover:bg-purple-100 flex items-center gap-2';
                            let profilePic;
                            if (!user.profile_picture) {
                                // No tiene imagen
                                profilePic = '/images/profile_pictures/default-user.jpg';
                            } else if (user.profile_picture.startsWith('http://') || user.profile_picture.startsWith('https://')) {
                                // Es una URL absoluta/remota
                                profilePic = user.profile_picture;
                            } else {
                                // Es imagen subida por usuario (ruta local)
                                profilePic = '/storage/' + user.profile_picture;
                            }

                            item.innerHTML = `
                            <img src="${profilePic}" class="w-6 h-6 rounded-full" />
                            <span>${user.username} (${user.name})</span>
`;
                            item.addEventListener('mousedown', function(e) {
                                input.value = user.username;
                                hiddenId.value = user.id;
                                document.getElementById('selected_username').value = user.username; // <-- Añade esto
                                list.classList.add('hidden');
                            });
                            list.appendChild(item);
                        });
                        list.classList.remove('hidden');
                    });
            }, 200); // pequeño delay para no spamear el servidor
        });

        // Cierra el autocomplete si clicas fuera
        document.addEventListener('click', function(e) {
            if (!input.contains(e.target) && !list.contains(e.target)) {
                list.classList.add('hidden');
            }
        });
    });
</script>
