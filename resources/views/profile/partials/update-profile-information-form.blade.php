
<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900">
            {{ __('Profile Information') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600">
            {{ __("Update your account's profile information and email address.") }}
        </p>
    </header>

    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>

    <form method="POST" action="{{ route('profile.update') }}" enctype="multipart/form-data" class="mt-6 space-y-6">
        @csrf
        @method('patch')

        <div>
            <x-input-label for="name" :value="__('Name')" />
            <x-text-input id="name" name="name" type="text" class="mt-1 block w-full" :value="old('name', $user->name)" required autofocus autocomplete="name" />
            <x-input-error class="mt-2" :messages="$errors->get('name')" />
        </div>
        <div>
            <x-input-label for="surname" :value="__('Surname')" />
            <x-text-input id="surname" name="surname" type="text" class="mt-1 block w-full" :value="old('surname', $user->surname)" required autofocus autocomplete="surname" />
            <x-input-error class="mt-2" :messages="$errors->get('surname')" />
        </div>
        <div>
            <x-input-label for="description" :value="__('Description')" />
            <x-text-input id="description" name="description" type="text" class="mt-1 block w-full" :value="old('description', $user->description)" required autofocus autocomplete="description" />
            <x-input-error class="mt-2" :messages="$errors->get('description')" />
        </div>
        <div>

            @if ($user->profile_picture)
                <div class="mb-4">
                    <p class="text-sm text-gray-600 mb-2">{{ __('Current profile picture:') }}</p>
                    @php
                        $isUrl = Str::startsWith(auth()->user()->profile_picture, ['http://', 'https://']);
                        $imageSrc = auth()->user()->profile_picture
                            ? ($isUrl ? auth()->user()->profile_picture : secure_asset('storage/' . auth()->user()->profile_picture))
                            : secure_asset('images/profile_pictures/default-user.jpg');
                    @endphp

                    <img class="w-13 h-13 rounded-full"
                         src="{{ $imageSrc }}"
                         alt="{{ auth()->user()->name }}" />               </div>
            @endif
            <x-input-label for="profile_picture" :value="__('Profile Picture')" />

            <input
                id="profile_picture"
                name="profile_picture"
                type="file"
                accept="image/*"
                class="mt-1 block w-full text-sm text-gray-900 bg-gray-50 border border-gray-300 rounded-lg cursor-pointer focus:outline-none dark:text-gray-400 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400"
            />
            <x-input-error class="mt-2" :messages="$errors->get('profile_picture')" />
        </div>
        <div>
            <x-input-label for="is_private" :value="__('Profile Visibility')" />
            <select id="is_private" name="is_private" class="mt-1 block w-full border-gray-300 rounded-lg dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                <option value="0" {{ old('is_private', $user->is_private) == 0 ? 'selected' : '' }}>{{ __('Public') }}</option>
                <option value="1" {{ old('is_private', $user->is_private) == 1 ? 'selected' : '' }}>{{ __('Private') }}</option>
            </select>
            <x-input-error class="mt-2" :messages="$errors->get('is_private')" />
        </div>
        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" name="email" type="email" class="mt-1 block w-full" :value="old('email', $user->email)" required autocomplete="username" />
            <x-input-error class="mt-2" :messages="$errors->get('email')" />

            @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
                <div>
                    <p class="text-sm mt-2 text-gray-800">
                        {{ __('Your email address is unverified.') }}

                        <button form="send-verification" class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                            {{ __('Click here to re-send the verification email.') }}
                        </button>
                    </p>

                    @if (session('status') === 'verification-link-sent')
                        <p class="mt-2 font-medium text-sm text-green-600">
                            {{ __('A new verification link has been sent to your email address.') }}
                        </p>
                    @endif
                </div>
            @endif
        </div>
        @if(Auth::user()->is_premium==1)
        <div class="mb-6">
            <label class="block mb-2 text-sm font-medium text-gray-700 dark:text-gray-200">
                Elige el fondo para tu perfil premium:
            </label>
            <div class="grid grid-cols-2 sm:grid-cols-3 gap-4">
                @for ($i = 1; $i <= 5; $i++)
                    <label>
                        <input type="radio" name="background_image" value="fondos/fondo{{ $i }}.png"
                               class="peer sr-only"
                        {{ (old('background_image', $user->background_image ?? '') == 'fondos/fondo'.$i.'.png') ? 'checked' : '' }}/>
                        <img src="{{ secure_asset('fondos/fondo'.$i.'.png') }}" alt="backgorundimage"
                             class="w-full h-32 object-cover rounded-lg border-4 border-transparent peer-checked:border-purple-600 cursor-pointer transition">
                    </label>
                @endfor
            </div>
            @error('profile_background')
            <p class="text-red-500 text-xs mt-2">{{ $message }}</p>
            @enderror
        </div>
        @endif
        <div class="flex items-center gap-4">
            <x-primary-button>{{ __('Save') }}</x-primary-button>

            @if (session('status') === 'profile-updated')
                <p
                    x-data="{ show: true }"
                    x-show="show"
                    x-transition
                    x-init="setTimeout(() => show = false, 2000)"
                    class="text-sm text-gray-600"
                >{{ __('Saved.') }}</p>
            @endif
        </div>
    </form>
</section>
