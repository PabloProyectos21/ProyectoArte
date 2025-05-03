<x-guest-layout>
    <div class="relative min-h-screen bg-gray-900 overflow-hidden">

        {{-- GALERÍA DE FONDO --}}
            @include('components.bg-images')
        {{-- CONTENIDO DEL FORMULARIO LOGIN --}}
        <section class="relative z-40 flex flex-col items-center justify-center px-6 py-8 mx-auto min-h-screen">
            <x-auth-session-status class="mb-4" :status="session('status')" />

            <div class="w-full max-w-md bg-white bg-opacity-90 backdrop-blur-md rounded-lg shadow-md p-6 dark:bg-gray-800 dark:bg-opacity-90">
                <a href="{{route('dashboard')}}" class="flex items-center mb-6 text-2xl font-semibold text-white-900 dark:text-white place-content-center">
                    <x-application-logo-login class="block h-[156px] w-auto"/>
                </a>
                <form method="POST" action="{{ route('login') }}">
                    @csrf

                    <!-- Email Address -->
                    <div>
                        <x-input-label for="email" :value="__('Email')" />
                        <x-text-input id="email" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
                        <x-input-error :messages="$errors->get('email')" class="mt-2" />
                    </div>

                    <!-- Password -->
                    <div class="mt-4">
                        <x-input-label for="password" :value="__('Password')" />
                        <x-text-input id="password" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" type="password" name="password" required autocomplete="current-password" />
                        <x-input-error :messages="$errors->get('password')" class="mt-2" />
                    </div>

                    <!-- Remember Me -->
                    <div class="block mt-4">
                        <label for="remember_me" class="inline-flex items-center">
                            <input id="remember_me" type="checkbox" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500" name="remember">
                            <span class="ms-2 text-sm text-gray-600">{{ __('Remember me') }}</span>
                        </label>
                    </div>
                    <p class="text-sm font-light text-gray-500 dark:text-gray-400">
                        {{ __('Don`t have an account?') }} <a href="{{ route('register') }}" class="font-medium text-purple-600 hover:underline dark:text-primary-500">{{ __('Register here') }}</a>
                    </p>
                    <div class="flex items-center justify-end mt-4">
                        @if (Route::has('password.request'))
                            <a class="underline text-sm text-gray-600 hover:text-gray-900 dark:text-gray-300 hover:dark:text-white" href="{{ route('password.request') }}">
                                {{ __('Forgot your password?') }}
                            </a>
                        @endif

                        <x-primary-button class="ms-3">
                            {{ __('Log in') }}
                        </x-primary-button>
                    </div>
                </form>
            </div>
        </section>
    </div>
</x-guest-layout>
