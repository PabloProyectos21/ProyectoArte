@if (Auth::check() && Auth::id() !== $user->id)
    @php
        $isFollowing = auth()->check() && auth()->user()->isFollowing($user);
    @endphp

    <form method="POST" action="{{ route('follow.toggle', $user->id) }}" class="follow-form p-0 w-full sm:w-auto">
        @csrf
        <input type="hidden" id="{{$user->id}}" value="{{ $user->is_premium }}">
        @if($user->is_premium===1)
            <button
                type="submit"
                data-user-id="{{ $user->id }}"
                data-is-premium="{{ $user->is_premium }}"
                class="follow-btn w-full sm:w-auto md:w-auto px-4 py-2 text-lg text-white rounded-lg
            {{ $isFollowing ? 'bg-gray-500 hover:bg-gray-600' : 'bg-yellow-400 hover:bg-pink-400' }}"
            >
                {{ $isFollowing ? 'Unfollow' : 'Follow' }}
            </button>
        @else
            <button
                type="submit"
                data-user-id="{{ $user->id }}"
                class="follow-btn w-full sm:w-auto md:w-auto px-4 py-2 text-lg text-white rounded-lg
                {{ $isFollowing ? 'bg-gray-500 hover:bg-gray-600' : 'bg-red-400 hover:bg-pink-400' }}"
            >
                {{ $isFollowing ? 'Unfollow' : 'Follow' }}
            </button>
        @endif
    </form>


@elseif (!Auth::check())
    <form method="GET" action="{{ route('login') }}" class="p-0 w-full sm:w-auto">
        <button
            type="submit"
            class="w-full sm:w-auto md:w-auto px-4 py-2 text-lg text-white rounded-lg
                bg-red-400 hover:bg-pink-400">
            Follow
        </button>
    </form>
@endif
