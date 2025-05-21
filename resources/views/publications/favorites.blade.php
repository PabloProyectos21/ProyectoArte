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
        <div class="relative z-10 p-4 border-2 bg-white border-gray-200 rounded-lg dark:border-white-700 mt-14 place-items-center">
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
    <div class="p-4  mt-10">
        <h1 class="text-3xl font-bold text-gray-800 dark:text-white mb-10 text-center">Your Favorite Posts</h1>

        @if ($favorites->isEmpty())
            <p class="text-gray-500 dark:text-gray-400">You haven't saved any favorites yet.</p>
        @else
            <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
                @foreach ($favorites as $publication)
                    <a href="{{ route('publications.show', $publication->id) }}" class="block bg-white dark:bg-gray-800 rounded-lg overflow-hidden shadow hover:shadow-md transition">
                        @php
                            $isUrl = Str::startsWith($publication->image_route, ['http://', 'https://']);
                            $imageSrc = $isUrl ? $publication->image_route : secure_asset( 'storage/'.$publication->image_route);
                        @endphp

                        <img src="{{ $imageSrc }}" alt="{{ $publication->title }}" class="w-full rounded mt-4" />
                        @php
                            $hasLiked = auth()->check() && $publication->ratings->contains('user_id', auth()->id());
                        @endphp

                        @php
                            $hasLiked = auth()->check() && $publication->ratings->contains('user_id', auth()->id());
                        @endphp
                        <div class="p-4">
                            <h3 class="text-lg font-semibold text-gray-900 dark:text-white">{{ $publication->title }}</h3>
                            <p class="text-sm text-gray-600 dark:text-gray-400">{{ Str::limit($publication->description, 80) }}</p>
                        </div>
                    </a>
                @endforeach
            </div>

            <div class="mt-8 flex justify-center gap-3">
                @if ($favorites->onFirstPage())
                    <span class="flex items-center justify-center px-4 h-10 text-base font-medium text-gray-400 bg-gray-200 border border-gray-300 rounded-lg cursor-not-allowed">Previous</span>
                @else
                    <a href="{{ $favorites->previousPageUrl() }}" class="flex items-center justify-center px-4 h-10 text-base font-medium text-gray-500 bg-white border border-gray-300 rounded-lg hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white">
                        <svg class="w-3.5 h-3.5 me-2 rtl:rotate-180" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 10">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 5H1m0 0 4 4M1 5l4-4"/>
                        </svg>
                        Previous
                    </a>
                @endif

                @if ($favorites->hasMorePages())
                    <a href="{{ $favorites->nextPageUrl() }}" class="flex items-center justify-center px-4 h-10 text-base font-medium text-gray-500 bg-white border border-gray-300 rounded-lg hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white">
                        Next
                        <svg class="w-3.5 h-3.5 ms-2 rtl:rotate-180" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 10">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 5h12m0 0L9 1m4 4L9 9"/>
                        </svg>
                    </a>
                @else
                    <span class="flex items-center justify-center px-4 h-10 text-base font-medium text-gray-400 bg-gray-200 border border-gray-300 rounded-lg cursor-not-allowed">Next</span>
                @endif
            </div>
        @endif
    </div>
        </div>
    </div>
</x-app-layout>
