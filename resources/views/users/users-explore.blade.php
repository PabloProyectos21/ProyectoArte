
<x-app-layout>
@include('components.sidebar')
    <div class="p-4 sm:ml-64">
        <div class="p-4 rounded-lg  mt-14">

            <form method="GET" action="{{ route('users.explore') }}" class="max-w-sm mx-auto">
                <div class="flex">


                    <div class="relative w-full">
                        <input type="search" name="search" id="search"
                               value="{{ request('search') }}"
                               class="block p-2.5 w-full z-20 text-sm text-gray-900 bg-gray-50 rounded-e-lg border border-gray-300 focus:ring-purple-500 focus:border-purple-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:border-purple-500"
                               placeholder="Search users by name..." />
                        <button type="submit"
                                class="absolute top-0 end-0 p-2.5 text-sm font-medium h-full text-white bg-purple-600 rounded-e-lg border border-purple-600 hover:bg-purple-700 focus:ring-4 focus:outline-none focus:ring-purple-300 dark:bg-purple-500 dark:hover:bg-purple-600 dark:focus:ring-purple-800">
                            <svg class="w-4 h-4" aria-hidden="true" fill="none" stroke="currentColor" stroke-width="2"
                                 viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                      d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                            </svg>
                            <span class="sr-only">Search</span>
                        </button>
                    </div>
                </div>
            </form>


            <section class="py-8 px-6  dark:bg-gray-900 min-h-screen">
                <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
                    @foreach ($users as $user)

                        @if (Auth::check() && $user->id === auth()->id())
                            @continue
                        @endif
                        @if($user->is_premium===1)
                        <div class="w-full max-w-sm bg-gradient-to-r from-purple-400 via-pink-500 to-red-400  border-5 border-x-4 border-y-4 border-fuchsia-400 rounded-lg shadow-sm dark:bg-blue-700 dark:border-blue-700">
                            @else
                                <div class="w-full max-w-sm bg-white border-blue-700 rounded-lg shadow-sm dark:bg-blue-700 dark:border-blue-700">
                        @endif
                                <div class="flex flex-col items-center pt-6 pb-10">
                                @php
                                    $isUrl = Str::startsWith($user->profile_picture, ['http://', 'https://']);
                                    $imageSrc = $user->profile_picture
                                        ? ($isUrl ? $user->profile_picture : asset('storage/' . $user->profile_picture))
                                        : asset('images/profile_pictures/default-user.jpg');
                                @endphp
                                <a href="{{ route('profile.view', $user->id) }}">
                                <img class="w-24 h-24 mb-3 rounded-full shadow-lg"
                                     src="{{ $imageSrc }}"
                                     alt="{{ $user->name }}" />
                                </a>
                                <h5 class="mb-1 text-xl font-medium text-gray-900 dark:text-white">{{ $user->name }}</h5>
                                    @if($user->is_premium===1)
                                <span class="text-sm text-white pb-1">{{"@". $user->username ?? 'Art Lover' }}</span>
                                    @else
                                        <span class="text-sm text-gray-500 dark:text-gray-400 pb-1">{{"@". $user->username ?? 'Art Lover' }}</span>
                                        @endif
                                @include('components.follow-form')
                                <ul class="flex text-sm">
                                    <li class="me-2">
                                        @if($user->is_premium===1)
                                        <span class="font-semibold text-white ">{{ $user->following_count }}</span>
                                        <span class="font-semibold text-white ">Following</span>
                                        @else
                                            <span class="font-semibold text-gray-900 ">{{ $user->following_count }}</span>
                                            <span>Following</span>
                                            @endif
                                    </li>
                                    <li>
                                        @if($user->is_premium===1)
                                        <span id="followers-count-{{ $user->id }}" class="font-semibold text-white ">{{ $user->followers_count}}</span>
                                            <span class="font-semibold text-white ">Followers</span>
                                        @else
                                        <span id="followers-count-{{ $user->id }}" class="font-semibold text-gray-900 ">{{ $user->followers_count}}</span>
                                        <span>Followers</span>
                                        @endif
                                    </li>
                                </ul>

                            </div>

                        </div>
                    @endforeach
                        <div class="mt-10 flex justify-center">
                            {{ $users->withQueryString()->links() }}
                        </div>

                </div>
            </section>
        </div>
    </div>
</x-app-layout>

<script>
    document.addEventListener('DOMContentLoaded', () => {
        document.querySelectorAll('.follow-form').forEach(form => {
            form.addEventListener('submit', async function (e) {
                e.preventDefault();


                const button = this.querySelector('.follow-btn');
                const userId = button.dataset.userId;
                const csrfToken = this.querySelector('input[name="_token"]').value;
                const isPremium = button.dataset.isPremium === '1';
                const followersCountEl = document.querySelector(`#followers-count-${userId}`);
                try {
                    const response = await fetch(`/follow/${userId}`, {
                        method: 'POST',
                        headers: {
                            'X-CSRF-TOKEN': csrfToken,
                            'Accept': 'application/json',
                        },
                    });

                    if (response.ok) {
                        const data = await response.json();
                        const currentLabel = button.textContent.trim();
                        button.textContent = currentLabel === 'Follow' ? 'Unfollow' : 'Follow';


                    if(isPremium) {
                        if (currentLabel === 'Follow' ) {
                            button.textContent = 'Unfollow';
                            button.classList.remove('bg-yellow-400', 'hover:bg-pink-400');
                            button.classList.add('bg-gray-500', 'hover:bg-gray-600');
                        } else {
                            button.textContent = 'Follow';
                            button.classList.remove('bg-gray-500', 'hover:bg-gray-600');
                            button.classList.add('bg-yellow-400', 'hover:bg-pink-400');
                        }
                    }else {
                        if (currentLabel === 'Follow' ) {
                            button.textContent = 'Unfollow';
                            button.classList.remove('bg-red-400', 'hover:bg-pink-400');
                            button.classList.add('bg-gray-500', 'hover:bg-gray-600');
                        } else {
                            button.textContent = 'Follow';
                            button.classList.remove('bg-gray-500', 'hover:bg-gray-600');
                            button.classList.add('bg-red-400', 'hover:bg-pink-400');
                        }
                    }
                        if (followersCountEl) {
                            followersCountEl.textContent = data.followersCount;
                        }
                    } else {
                        alert('Something went wrong.');
                    }
                } catch (error) {
                    console.error('Error:', error);
                }
            });
        });
    });
</script>


