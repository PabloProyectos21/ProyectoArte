<x-app-layout>
    @include('components.sidebar')
    <div class="p-4 sm:ml-64">
        @if($publication->user->is_premium && $publication->user->background_image)
            <div
                class="fixed inset-0 z-0"
                style="background: url('{{ secure_asset($publication->user->background_image) }}') center center / cover no-repeat; opacity: 0.35;">
            </div>
        @endif
        <div class="relative p-4  rounded-lg mt-14 place-items-center z-10">

        <div class="max-w-2xl mx-auto p-6 bg-white dark:bg-gray-800 rounded-lg shadow ">
            @php
            $isUrl = Str::startsWith($publication->user->profile_picture ?? '', ['http://', 'https://']);
            $avatar = $publication->user->profile_picture
            ? ($isUrl ? $publication->user->profile_picture : secure_asset('storage/'.$publication->user->profile_picture))
            : secure_asset('images/profile_pictures/default-user.jpg');
            @endphp
            <div class="flex items-center justify-left mb-4" >
                <a href="{{ route('profile.view', $publication->user->id) }}">
            <img src="{{ $avatar }}" alt="Avatar" class="w-9 h-9 rounded-full object-cover">
                </a>
                <div class="flex items-center px-2 ml-2">
                    <h5 class="text-sm font-semibold text-gray-900 dark:text-white">{{"@". $publication->user->username ?? 'Anonymous' }}</h5>
                    <span class="text-xs text-gray-400 ml-2">{{ $publication->created_at->diffForHumans() }}</span>
                </div>
                @auth
                    @if (auth()->id() === $publication->user_id || auth()->user()->user_permission_level === 'admin')
                        <div class="ml-auto flex gap-3">
                        <!-- Edit -->
                            <a href="{{ route('publications.edit', $publication->id) }}"
                               class="inline-block bg-gradient-to-r from-purple-500 to-pink-500 text-white font-semibold px-4 py-2 rounded-lg hover:shadow-lg transition">
                                Edit Post
                            </a>

                            <!-- Delete -->
                            <form action="{{ route('publications.destroy', $publication->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit"
                                        class="bg-red-600 hover:bg-red-700 text-white font-semibold px-4 py-2 rounded-lg shadow transition">
                                    Delete
                                </button>
                            </form>

                        </div>
                    @endif
                @endauth

            </div>

        <h1 class="text-3xl font-bold text-gray-900 dark:text-white mb-4">{{ $publication->title }}</h1>

            <h2 class="text-2xl font-bold text-gray-700 dark:text-white mb-4">{{ ucfirst($publication->category) }}</h2>

        <p class="text-gray-700 dark:text-gray-300 mb-2">{{ $publication->description }}</p>

        @php
            $isUrl = Str::startsWith($publication->image_route, ['http://', 'https://']);
            $imageSrc = $isUrl ? $publication->image_route : secure_asset('storage/'. $publication->image_route);
        @endphp

        <img src="{{ $imageSrc }}" alt="{{ $publication->title }}" class="w-full rounded mt-4" />
            @php
                $hasLiked = auth()->check() && $publication->ratings->contains('user_id', auth()->id());
            @endphp

            @php
                $hasLiked = auth()->check() && $publication->ratings->contains('user_id', auth()->id());
            @endphp
            <div class="pt-4 inline-flex items-center gap-1">
            @if (Auth::check() )

                <button
                    id="like-btn"
                    data-id="{{ $publication->id }}"
                    class="p-1 rounded-full transition
               {{ $hasLiked ? 'text-purple-600 hover:text-purple-700' : 'text-blue-400 hover:text-purple-500' }}">
                    <svg xmlns="http://www.w3.org/2000/svg"
                         viewBox="0 0 24 24"
                         fill="currentColor"
                         stroke="currentColor"
                         stroke-width="1.5"
                         class="size-6">
                        <path stroke-linecap="round"
                              stroke-linejoin="round"
                              d="M21 8.25c0-2.485-2.099-4.5-4.688-4.5-1.935 0-3.597 1.126-4.312 2.733-.715-1.607-2.377-2.733-4.313-2.733C5.1 3.75 3 5.765 3 8.25c0 7.22 9 12 9 12s9-4.78 9-12Z" />
                    </svg>
                </button>
                @elseif (!Auth::check())
                    <form method="GET" action="{{ route('login') }}" class="p-0 w-full sm:w-auto">
                        <button
                            type="submit"
                            class="p-1 rounded-full transition text-blue-400 hover:text-purple-500">
                            <svg xmlns="http://www.w3.org/2000/svg"
                                 viewBox="0 0 24 24"
                                 fill="currentColor"
                                 stroke="currentColor"
                                 stroke-width="1.5"
                                 class="size-6">
                                <path stroke-linecap="round"
                                      stroke-linejoin="round"
                                      d="M21 8.25c0-2.485-2.099-4.5-4.688-4.5-1.935 0-3.597 1.126-4.312 2.733-.715-1.607-2.377-2.733-4.313-2.733C5.1 3.75 3 5.765 3 8.25c0 7.22 9 12 9 12s9-4.78 9-12Z" />
                            </svg>
                        </button>
                    </form>
                @endif

                <span id="likes-count" class="text-gray-700 dark:text-gray-300">
        {{ $publication->number_of_ratings }}</span>
                    <div class="ml-4 inline-flex items-center gap-1 text-gray-600 dark:text-gray-300">
    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
  <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 12.76c0 1.6 1.123 2.994 2.707 3.227 1.068.157 2.148.279 3.238.364.466.037.893.281 1.153.671L12 21l2.652-3.978c.26-.39.687-.634 1.153-.67 1.09-.086 2.17-.208 3.238-.365 1.584-.233 2.707-1.626 2.707-3.228V6.741c0-1.602-1.123-2.995-2.707-3.228A48.394 48.394 0 0 0 12 3c-2.392 0-4.744.175-7.043.513C3.373 3.746 2.25 5.14 2.25 6.741v6.018Z" />
</svg>

    <span>{{ $numberOfComments }}</span>
                    </div>
                <div class=" ml-4 inline-flex gap-1 text-gray-600 dark:text-gray-300">
                    <button data-id="{{ $publication->id }}" class="favorite-btn ml-auto {{ Auth::user() && Auth::user()->favoritePublications->contains($publication->id) ? 'text-yellow-500' : 'text-gray-400' }}">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-6">
                            <path fill-rule="evenodd" d="M6.32 2.577a49.255 49.255 0 0 1 11.36 0c1.497.174 2.57 1.46 2.57 2.93V21a.75.75 0 0 1-1.085.67L12 18.089l-7.165 3.583A.75.75 0 0 1 3.75 21V5.507c0-1.47 1.073-2.756 2.57-2.93Z" clip-rule="evenodd" />
                        </svg>
                    </button>
                </div>
            </div>
            @if (Auth::check())
                <form method="POST" action="{{ route('comments.store', $publication->id) }}">
                    @csrf
                    <input type="hidden" name="parent_comment_id" id="parent_comment_id" />


                    <div class="w-full mt-6 mb-4 border border-gray-200 rounded-lg bg-gray-50 dark:bg-gray-700 dark:border-gray-600">
                        <div class="relative">
                            <input type="text" id="comment" name="comment" class="w-full px-4 py-2 border rounded" placeholder="Write a comment...">
                            <button type="button" id="emoji-btn" class="absolute right-2 top-2 text-xl">😊</button>
                            <div id="emoji-picker" class="hidden absolute bg-white border rounded shadow-md mt-2 p-2 z-50"></div>
                        </div>

                        <div class="flex items-center justify-between px-3 py-2 border-t dark:border-gray-600 border-gray-200">
                            <button type="submit" class="inline-flex items-center py-2.5 px-4 text-xs font-medium text-center text-white bg-blue-700 rounded-lg focus:ring-4 focus:ring-blue-200 dark:focus:ring-blue-900 hover:bg-blue-800">
                                Post comment
                            </button>
                            <div class="flex ps-0 space-x-1 rtl:space-x-reverse sm:ps-2">
                            </div>
                        </div>
                    </div>
                </form>
            @else
                <p class="mt-4 text-gray-600 dark:text-gray-400">{{ __('Log in to write a comment.') }}</p>
            @endif
            @php
                $mainComments = $publication->comments->whereNull('parent_comment_id');
            @endphp

        @if($mainComments->isNotEmpty())

                <div class="mt-6 space-y-4">
                    @foreach($mainComments as $comment)
                        @include('components.comment-item', [
                            'comment' => $comment,
                            'publication' => $publication,
                            'repliesGrouped' => $repliesGrouped
                        ])
                    @endforeach
                </div>
            @endif

        </div>
            @if($recommended->isNotEmpty())
                <div class="max-w-6xl mx-auto mt-10">
                    <h2 class="text-2xl font-semibold text-gray-900 dark:text-white mb-6">{{__('You might be interested
                        in')}}...</h2>
                    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6 break-inside-avoid focus:ring-4 focus:outline-none rounded-lg">
                        @foreach ($recommended as $rec)
                            @if($rec->id!=$publication->id)
                            @php
                                $isUrl = Str::startsWith($rec->image_route, ['http://', 'https://']);
                                $recImg = $isUrl ? $rec->image_route : secure_asset('storage/' . $rec->image_route);
                            @endphp
                            <a href="{{ route('publications.show', $rec->id) }}" class="block hover:scale-[1.02] transition duration-300 ease-in-out bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-lg overflow-hidden shadow hover:shadow-md transition">
                                <img src="{{ $recImg }}" alt="{{ $rec->title }}" class="w-full h-48 object-cover">
                                <div class="p-4">
                                    <h3 class="text-lg font-semibold text-gray-900 dark:text-white">{{ $rec->title }}</h3>
                                    <p class="text-sm text-gray-600 dark:text-gray-400">{{ Str::limit($rec->description, 80) }}</p>
                                </div>
                            </a>
                            @endif
                        @endforeach
                    </div>
                </div>
            @endif

        </div>
    </div>



</x-app-layout>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const likeBtn = document.querySelector('#like-btn');
            const likesCount = document.querySelector('#likes-count');

            if (likeBtn) {
                likeBtn.addEventListener('click', async () => {
                    const publicationId = likeBtn.dataset.id;

                    try {
                        const response = await fetch(`/publications/${publicationId}/like`, {
                            method: 'POST',
                            headers: {
                                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                                'Accept': 'application/json'
                            }
                        });

                        if (response.ok) {
                            const result = await response.json();

                            // Actualiza icono
                            likeBtn.classList.toggle('text-purple-600');
                            likeBtn.classList.toggle('text-blue-400');

                            // Actualiza contador
                            likesCount.textContent = result.count;
                        } else {
                            alert('Error al dar like.');
                        }
                    } catch (error) {
                        console.error('Error:', error);
                    }
                });
            }


                const emojiBtn = document.getElementById('emoji-btn');
                const emojiPicker = document.getElementById('emoji-picker');
                const commentInput = document.getElementById('comment');

                const emojis = ['😀','😂','😍','😎','😢','👍','🔥','❤️','🙌','🎉','🤯','😅','😭','🥰'];

                emojis.forEach(emoji => {
                const span = document.createElement('span');
                span.textContent = emoji;
                span.classList.add('cursor-pointer', 'text-xl', 'mx-1');
                span.addEventListener('click', () => {
                commentInput.value += emoji;
                emojiPicker.classList.add('hidden');
                commentInput.focus();
            });
                emojiPicker.appendChild(span);
            });

                emojiBtn.addEventListener('click', () => {
                emojiPicker.classList.toggle('hidden');
            });

                document.addEventListener('click', (e) => {
                if (!emojiPicker.contains(e.target) && e.target !== emojiBtn) {
                emojiPicker.classList.add('hidden');
            }
            });

            document.querySelectorAll('.reply-btn').forEach(button => {
                button.addEventListener('click', () => {
                    const name = button.dataset.userName;
                    const commentId = button.dataset.commentId;
                    const input = document.getElementById('comment');

                    if (name !== "") {
                        input.value = `@${name} `;
                    }

                    let hidden = document.querySelector('#parent_comment_id');
                    if (!hidden) {
                        hidden = document.createElement('input');
                        hidden.type = 'hidden';
                        hidden.name = 'parent_comment_id';
                        hidden.id = 'parent_comment_id';
                        document.querySelector('form').appendChild(hidden);
                    }

                    hidden.value = commentId;
                    input.focus();
                });
            });

            document.querySelectorAll('.comment-like-btn').forEach(button => {
                button.addEventListener('click', async () => {
                    const commentId = button.dataset.id;

                    const response = await fetch(`/comments/${commentId}/like`, {
                        method: 'POST',
                        headers: {
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                            'Accept': 'application/json'
                        }
                    });

                    if (response.ok) {
                        const data = await response.json();
                        const countSpan = button.nextElementSibling;
                        countSpan.textContent = data.count;

                        button.classList.toggle('text-gray-500');
                        button.classList.toggle('text-purple-400');
                    }
                });
            });
            document.querySelectorAll('.favorite-btn').forEach(btn => {
                btn.addEventListener('click', async () => {
                    const id = btn.dataset.id;
                    const response = await fetch(`/publications/${id}/favorite`, {
                        method: 'POST',
                        headers: {
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                            'Accept': 'application/json',
                        },
                    });
                    if (response.ok) {
                        const data = await response.json();
                        btn.classList.toggle('text-yellow-500', data.favorited);
                        btn.classList.toggle('text-gray-400', !data.favorited);
                    }
                });
            });


        });

    </script>



