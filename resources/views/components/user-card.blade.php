<?php
@props(['user', 'isFollowing'])

<div class="flex items-center justify-between p-4 bg-white border rounded-lg shadow-sm dark:bg-gray-800 dark:border-gray-700">
    <div class="flex items-center space-x-4">
        <img src="{{ $user->profile_picture ?? asset('images/default-user.png') }}"
             alt="{{ $user->name }}"
             class="w-10 h-10 rounded-full object-cover">
        <div>
            <h4 class="text-sm font-medium text-gray-900 dark:text-white">{{ $user->name }}</h4>
            <p class="text-xs text-gray-500 dark:text-gray-400">{{ $user->email }}</p>
        </div>
    </div>

    <form method="POST" action="{{ route('follow.toggle', $user->id) }}">
        @csrf
        @method('POST')
        <button type="submit"
                class="text-white bg-{{ $isFollowing ? 'red' : 'blue' }}-600 hover:bg-{{ $isFollowing ? 'red' : 'blue' }}-700 font-medium rounded-lg text-sm px-4 py-2">
            {{ $isFollowing ? {{__('Unfollow')}} : {{__('Follow')}} }}
        </button>
    </form>
</div>
