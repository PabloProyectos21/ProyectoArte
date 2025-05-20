
<x-app-layout>
    @include('components.sidebar')

    <div class=" p-4 sm:ml-64">
        @if($user->is_premium && $user->background_image)
            <div
                class="fixed inset-0 z-0"
                style="background: url('{{ secure_asset($user->background_image) }}') center center / cover no-repeat; opacity: 0.35;">
            </div>
        @endif
        <div class="relative p-4  rounded-lg mt-14 place-items-center z-10">
            @if($user->is_premium===1)
            <div class="max-w-sm bg-white border bg-gradient-to-r from-purple-400 via-pink-500 to-red-400  border-5 border-x-4 border-y-4 border-fuchsia-400 rounded-lg shadow-sm dark:bg-gray-800 dark:border-gray-700 place-items-center">
                @else
                    <div class="max-w-sm bg-white border border-gray-200 rounded-lg shadow-sm dark:bg-gray-800 dark:border-gray-700 place-items-center">
                    @endif
                @php
                    $isUrl = Str::startsWith($user->profile_picture, ['http://', 'https://']);
                    $imageSrc = $isUrl ? $user->profile_picture : secure_asset( $user->profile_picture);
                @endphp
                <img src="{{ $imageSrc }}" alt="{{ $user->name." ".$user->surname}}" class="w-30 h-30 pt-4 rounded-full" />
                <div class="p-5">
                    <a href="{{ route('profile.view', $user->id) }}">
                        @if($user->is_premium===1)
                            <h5 class="mb-2 text-2xl font-bold tracking-tight text-white">{{ $user->name." ".$user->surname}}</h5>
                            @else
                            <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">{{ $user->name." ".$user->surname}}</h5>

                        @endif
                                   </a>
                    @if($user->is_premium===1)
                    <p class="mb-3 font-normal text-white ">{{ $user->description}}</p>

                    @else
                        <p class="mb-3 font-normal text-gray-800 ">{{ $user->description}}</p>
                        @endif
                    @include('components.follow-form')
                    <ul class="flex text-sm">
                        @if($user->is_premium===1)
                        <li class="me-2">
                            <span class="font-semibold text-white ">{{ $user->following_count }}</span>
                            <span class="font-semibold text-white">Following</span>
                        </li>
                        <li>
                            <span class="font-semibold text-white">{{ $user->followers_count}}</span>
                            <span class="font-semibold text-white">Followers</span>
                        </li>
                        @else
                            <li class="me-2">
                                <span class="font-semibold text-gray-900 dark:text-white">{{ $user->following_count }}</span>
                                <span>Following</span>
                            </li>
                            <li>
                                <span class="font-semibold text-gray-900 dark:text-white">{{ $user->followers_count}}</span>
                                <span>Followers</span>
                            </li>
                        @endif
                    </ul>
                </div>
            </div>
            @php
                $canView = !$user->is_private || auth()->id() === $user->id || $user->followers->contains(auth()->id());
            @endphp

            @if (!$canView)
                <div class="mt-6 text-center text-red-600 dark:text-red-400 font-semibold">
                    {{ __('This profile is private.') }}
                </div>
            @else
                <x-user-publications :user="$user" />
            @endif
        </div>
        </div>
    </div>
</x-app-layout>
