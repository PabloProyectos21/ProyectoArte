@if (Auth::check() && Auth::id() !== $user->id)

    @php
        $isFollowing = auth()->check() && auth()->user()->isFollowing($user);
    @endphp

    <form method="POST" action="{{ route('follow.toggle', $user->id) }}" class="follow-form p-4">
        @csrf
        <input type="hidden" id="{{$user->id}}" value="{{ $user->is_premium }}">
        @if($user->is_premium===1)
        <button
            type="submit"
            data-user-id="{{ $user->id }}"
            data-is-premium="{{ $user->is_premium }}"
            class="follow-btn px-4 py-2 text-lg text-white rounded-lg
                                            {{ $isFollowing ? 'bg-gray-500 hover:bg-gray-600' : 'bg-yellow-400 hover:bg-pink-400' }}"
        >
            {{ $isFollowing ? 'Unfollow' : 'Follow' }}
        </button>
        @else
            <button
                type="submit"
                data-user-id="{{ $user->id }}"
                class="follow-btn px-4 py-2 text-lg text-white rounded-lg
                                            {{ $isFollowing ? 'bg-gray-500 hover:bg-gray-600' : 'bg-red-400 hover:bg-pink-400' }}"
            >
                {{ $isFollowing ? 'Unfollow' : 'Follow' }}
            </button>
        @endif
    </form>


@elseif (!Auth::check())
    <div class="flex justify-center mt-2">
        @if($user->is_premium)
        <button data-modal-target="popup-modal" data-modal-toggle="popup-modal" class="block text-white bg-yellow-400 hover:bg-pink-400 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800" type="button">
        @else
            <button data-modal-target="popup-modal" data-modal-toggle="popup-modal" class="block text-white bg-red-400 hover:bg-pink-400 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800" type="button">
           @endif
            Follow
        </button>
    </div>
    <div id="popup-modal" role="dialog" aria-modal="true" tabindex="-1" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
        <div class="relative p-4 w-full max-w-md max-h-full">
            <div class="relative bg-white rounded-lg shadow-sm dark:bg-gray-700">
                <button type="button" class="absolute top-3 end-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-hide="popup-modal">
                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                    </svg>
                    <span class="sr-only">Close modal</span>
                </button>
                <div class="p-4 md:p-5 text-center">
                    <svg class="mx-auto mb-4 text-gray-400 w-12 h-12 dark:text-gray-200" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 11V6m0 8h.01M19 10a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z"/>
                    </svg>
                    <h3 class="mb-5 text-lg font-normal text-gray-500 dark:text-gray-400">You need to be logged in to follow other artists</h3>
                    <a href="{{ route('login', ['redirect' => url()->current()]) }}">
                        <button data-modal-hide="popup-modal" type="button" class="text-white bg-red-400 hover:bg-pink-400 focus:ring-4 focus:outline-none focus:ring-red-300 dark:focus:ring-red-800 font-medium rounded-lg text-sm inline-flex items-center px-5 py-2.5 text-center">
                            Go to login page
                        </button>
                    </a>
                    <button data-modal-hide="popup-modal" type="button" class="py-2.5 px-5 ms-3 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-100 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700">No, cancel</button>
                </div>
            </div>
        </div>
    </div>

@endif
