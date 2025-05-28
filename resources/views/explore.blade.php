<x-app-layout>
    @include('components.sidebar')
    <div class="p-4 sm:ml-64">
        @auth
            @if(Auth::user()->is_premium && Auth::user()->background_image)
                <div
                    class="fixed inset-0 z-0"
                    style="background: url('{{ secure_asset(Auth::user()->background_image) }}') center center / cover no-repeat; opacity: 0.35;">
                </div>
            @endif
        @endauth
        <div class="relative p-4 rounded-lg mt-14 z-10">


    <section class="px-4 sm:px-8 py-10  min-h-screen">
        @guest
            @isset($commercial)
                <x-ad-card :commercial="$commercial" />
            @endisset
        @endguest

        @auth
            @isset(Auth::user()->is_premium)
                @if(Auth::user()->is_premium==0)
                    @isset($commercial)
                        <x-ad-card :commercial="$commercial" />
                    @endisset
                @endif
            @endisset
        @endauth
        <form method="GET" action="{{ route('explore') }}" class="max-w-sm mx-auto">
        <div class="flex">
                <div class="relative">
                    <select id="category" name="category"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-auto p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                        <option value="">All categories</option>
                        <option value="photography" {{ request('category') == 'photography' ? 'selected' : '' }}>Photography</option>
                        <option value="tattoos" {{ request('category') == 'tattoos' ? 'selected' : '' }}>Tattoos</option>
                        <option value="painting" {{ request('category') == 'painting' ? 'selected' : '' }}>Painting</option>
                        <option value="draws" {{ request('category') == 'draws' ? 'selected' : '' }}>Draws</option>
                        <option value="fashion" {{ request('category') == 'fashion' ? 'selected' : '' }}>Fashion</option>
                        <option value="other" {{ request('category') == 'other' ? 'selected' : '' }}>Other</option>
                    </select>
                </div>

                <div class="relative w-full">
                    <input type="search" name="search" id="search"
                           value="{{ request('search') }}"
                           class="block p-2.5 w-full z-20 text-sm text-gray-900 bg-gray-50 rounded-e-lg border border-gray-300 focus:ring-purple-500 focus:border-purple-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:border-purple-500"
                           placeholder="Search posts by name..." />
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

        <h1 class="text-3xl font-bold mb-6 text-center text-gray-800">
            @if(request('search') || request('category'))
                Results
                @if(request('search')) for <span class="text-purple-600">"{{ request('search') }}"</span>@endif
                @if(request('category'))
                    @if(request('search')) in @else for the category @endif
                    <span class="text-purple-600">{{ ucfirst(request('category')) }}</span>
                @endif
            @else
            {{__('Explore new posts')}}
            @endif
        </h1>

        @if($publications->isEmpty())
            <p class="text-center text-gray-600 dark:text-gray-400 mt-10 text-lg">
                {{__('No posts found')}}
                @if(request('search'))
                    para <span class="text-purple-600">"{{ request('search') }}"</span>
                @endif
                @if(request('category'))
                    @if(request('search')) en @else en la categoría @endif
                    <span class="text-purple-600">{{ ucfirst(request('category')) }}</span>
                @endif
            </p>
        @else

        <div class="grid grid-cols-2 md:grid-cols-4  gap-y-7 gap-x-3">
            @foreach ($publications as $publication)

                    <div class="focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-2 break-inside-avoid" data-popover-target="popover-user-profile-{{ $publication->id }}" data-popover-trigger="hover">

                    <a href="{{ route('publications.show', $publication->id) }}">
                        @php
                            $isUrl = Str::startsWith($publication->image_route, ['http://', 'https://']);
                            $imageSrc = $isUrl ? $publication->image_route : secure_asset('storage/'. $publication->image_route);
                        @endphp

                        <img src="{{ $imageSrc }}" alt="{{ $publication->title }}"  class="w-full rounded-lg shadow hover:scale-[1.02] transition duration-300 ease-in-out">

                        @if($publication->user->is_premium===1)
                            <div data-popover id="popover-user-profile-{{ $publication->id }}" role="tooltip" class="absolute z-10 invisible inline-block w-64 text-sm text-white transition-opacity duration-300 bg-gradient-to-r from-purple-400 via-pink-500 to-red-400  border-5 border-x-4 border-y-4 border-fuchsia-400 rounded-lg shadow-xs opacity-0">
                        @else
                        <div data-popover id="popover-user-profile-{{ $publication->id }}" role="tooltip" class="absolute z-10 invisible inline-block w-64 text-sm text-gray-500 transition-opacity duration-300 bg-red-50 border border-gray-200 rounded-lg shadow-xs opacity-0 dark:text-gray-400 dark:bg-gray-800 dark:border-gray-600">
                        @endif
                            <div class="p-3">
                                <div class="flex items-center gap-6 mb-2">
                                    <a href="{{ route('profile.view', $publication->user->id) }}">
                                        @php
                                            $isUrl = Str::startsWith($publication->user->profile_picture, ['http://', 'https://']);
                                            $imageSrc = $isUrl ? $publication->user->profile_picture : secure_asset('storage/' . $publication->user->profile_picture);
                                        @endphp
                                        <img src="{{ $imageSrc }}" alt="{{ $publication->user->name." ".$publication->user->surname}}" class="w-20 h-20 rounded-full" />
                                    </a>

                                    @if (Auth::check() && Auth::id() !== $publication->user->id)

                                        @php
                                            $isFollowing = auth()->check() && auth()->user()->isFollowing($publication->user);
                                        @endphp

                                        <form method="POST" action="{{ route('follow.toggle', $publication->user->id) }}" class="follow-form">
                                            @csrf

                                            <input type="hidden" id="{{$publication->user->id}}" value="{{ $publication->user->is_premium }}">
                                            @if($publication->user->is_premium===1)
                                                <button
                                                    type="submit"
                                                    data-user-id="{{ $publication->user->id }}"
                                                    data-is-premium="{{ $publication->user->is_premium }}"
                                                    class="follow-btn px-4 py-2 text-lg text-white rounded-lg
                                            {{ $isFollowing ? 'bg-gray-500 hover:bg-gray-600' : 'bg-yellow-400 hover:bg-pink-400' }}"
                                                >
                                                    {{ $isFollowing ? 'Unfollow' : 'Follow' }}
                                                </button>
                                            @else
                                                <button
                                                    type="submit"
                                                    data-user-id="{{ $publication->user->id }}"
                                                    class="follow-btn px-4 py-2 text-lg text-white rounded-lg
                                            {{ $isFollowing ? 'bg-gray-500 hover:bg-gray-600' : 'bg-red-400 hover:bg-pink-400' }}"
                                                >
                                                    {{ $isFollowing ? 'Unfollow' : 'Follow' }}
                                                </button>
                                            @endif
                                        </form>


                                    @elseif (!Auth::check())
                                        <div class="flex justify-center mt-2">
                                            <a href="{{ route('login', ['redirect' => url()->current()]) }}">
                                                @if($publication->user->is_premium===1)
                                            <button data-modal-target="popup-modal" data-modal-toggle="popup-modal" class="block text-white bg-yellow-400 hover:bg-pink-400 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800" type="button">
                                                @else
                                                    <button data-modal-target="popup-modal" data-modal-toggle="popup-modal" class="block text-white bg-red-400 hover:bg-pink-400 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800" type="button">
                                                    @endif
                                                Follow
                                            </button>
                                            </a>
                                        </div>

                                    @endif


                                    </div>

                                <p class="text-base font-semibold leading-none text-gray-900 dark:text-white">
                                    <a href="{{ route('profile.view', $publication->user->id) }}">
                                        {{ $publication->user->name }}
                                    </a>

                                </p>
                                <p class="mb-3 text-sm font-normal">
                                    <a href="{{ route('profile.view', $publication->user->id) }}" class="hover:underline">{{"@". $publication->user->username ?? Str::slug($publication->user->name) }}</a>
                                </p>
                                <p class="mb-4 text-sm">
                                    {{ $publication->user->description ?? 'Artista de la comunidad.' }}
                                </p>
                                <ul class="flex text-sm">
                                    <li class="me-2">
                                        @if($publication->user->is_premium===1)
                                            <span class="font-semibold text-white ">{{ $publication->user->following_count }}</span>
                                            <span class="font-semibold text-white ">Following</span>
                                        @else
                                            <span class="font-semibold text-gray-900 ">{{ $publication->user->following_count }}</span>
                                            <span>Following</span>
                                        @endif
                                    </li>
                                    <li>
                                        @if($publication->user->is_premium===1)
                                            <span id="followers-count-{{ $publication->user->id }}" class="font-semibold text-white ">{{ $publication->user->followers_count}}</span>
                                            <span class="font-semibold text-white ">Followers</span>
                                        @else
                                            <span id="followers-count-{{ $publication->user->id }}" class="font-semibold text-gray-900 ">{{ $publication->user->followers_count}}</span>
                                            <span>Followers</span>
                                        @endif
                                    </li>
                                </ul>
                            </div>

                            <div data-popper-arrow></div>
                        </div>
                    </a>

                </div>
            @endforeach
        </div>
        @endif
        <div class="mt-8 flex justify-center gap-3">
            @if ($publications->onFirstPage())
            <span class="flex items-center justify-center px-4 h-10 text-base font-medium text-gray-400 bg-gray-200 border border-gray-300 rounded-lg cursor-not-allowed">Previous</span>
            @else
                <a href="{{ $publications->previousPageUrl() }}" class="flex items-center justify-center px-4 h-10 text-base font-medium text-gray-500 bg-white border border-gray-300 rounded-lg hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white">
                    <svg class="w-3.5 h-3.5 me-2 rtl:rotate-180" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 10">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 5H1m0 0 4 4M1 5l4-4"/>
                    </svg>
                    Previous
                </a>
            @endif

            @if ($publications->hasMorePages())
                <a href="{{ $publications->nextPageUrl() }}" class="flex items-center justify-center px-4 h-10 text-base font-medium text-gray-500 bg-white border border-gray-300 rounded-lg hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white">
                    Next
                    <svg class="w-3.5 h-3.5 ms-2 rtl:rotate-180" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 10">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 5h12m0 0L9 1m4 4L9 9"/>
                    </svg>
                </a>
            @else
                <span class="flex items-center justify-center px-4 h-10 text-base font-medium text-gray-400 bg-gray-200 border border-gray-300 rounded-lg cursor-not-allowed">Next</span>
            @endif
        </div>
    </section>
        </div>
    </div>
</x-app-layout>

<script>
    document.addEventListener('DOMContentLoaded', () => {
        const trigger = document.querySelector('[data-popover-target="popover-user-profile"]');
        const popover = document.getElementById('popover-user-profile');

        let timeout;

        const showPopover = () => {
            clearTimeout(timeout);
            popover.classList.remove('invisible', 'opacity-0');
        };

        const hidePopover = () => {
            timeout = setTimeout(() => {
                popover.classList.add('invisible', 'opacity-0');
            }, 200); // pequeño delay para evitar parpadeo
        };

        document.querySelectorAll('.follow-form').forEach(form => {
            form.addEventListener('submit', async function (e) {
                e.preventDefault();


                const button = this.querySelector('.follow-btn');
                const userId = button.dataset.userId;
                const isPremium = button.dataset.isPremium === '1';
                const csrfToken = this.querySelector('input[name="_token"]').value;
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
                            if (currentLabel === 'Follow') {
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
