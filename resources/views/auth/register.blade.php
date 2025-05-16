<x-guest-layout>

    <section class="relative  bg-gray-900 dark:bg-gray-900 overflow-hidden ">

            @include('components.bg-images')

        <div class= " relative z-40 flex flex-col items-center justify-center px-6 py-8 mx-auto md:h-screen lg:py-0 ">

            <div class="overflow-scroll w-full bg-opacity-90 backdrop-blur-md bg-gray-50 rounded-lg shadow dark:border md:mt-0 sm:max-w-md xl:p-0 dark:bg-gray-800 dark:border-gray-700 items-center justify-center">
                <a href="{{route('login')}}" class="flex items-center mb-6 text-2xl font-semibold text-white-900 dark:text-white place-content-center">
                    <x-application-logo-login class="block h-[193px] w-auto"/>
                </a>
                <div class="p-3 space-y-4 md:space-y-6 sm:p-8">
                    <h1 class="text-xl font-bold leading-tight tracking-tight text-gray-900 md:text-2xl dark:text-white">
                        {{__('Create an account')}}
                    </h1>
                    <form method="POST" class="space-y-1 md:space-y-4" action="{{ route('register') }}" enctype="multipart/form-data">
                        @csrf

                        <!-- Name -->
                        <div>
                            <label for="Name" >{{__('Name')}}</label>
                            <x-text-input type="name" name="name" :value="old('name')" id="name" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Jon" required autocomplete="name"/>
                            <x-input-error :messages="$errors->get('name')" class="mt-2" />
                        </div>
                        <div>
                            <label for="surname">{{ __('Surname') }}</label>
                            <x-text-input
                                type="text"
                                name="surname"
                                :value="old('surname')"
                                id="surname"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                placeholder="Doe"
                                required
                                autocomplete="family-name"
                            />
                            <x-input-error :messages="$errors->get('surname')" class="mt-2" />
                        </div>
                        <div>
                            <label for="Username" >{{__('Username')}}</label>
                            <x-text-input type="username" name="username" :value="old('username')" id="username" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="JonCena" required autocomplete="username"/>
                            <x-input-error :messages="$errors->get('username')" class="mt-2" />
                        </div>
                        <div>
                            <label for="email" >Your email</label>
                            <x-text-input type="email" name="email" :value="old('email')" id="email" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="name@email.com" />
                            <x-input-error :messages="$errors->get('email')" class="mt-2" />
                        </div>
                        <div>
                            <label for="profile_picture">{{ __('Upload profile picture') }}</label>
                            <input
                                id="profile_picture"
                                name="profile_picture"
                                type="file"
                                accept="image/*"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                            />
                            <x-input-error :messages="$errors->get('profile_picture')" class="mt-2" />
                        </div>
                        <div>
                            <label for="description">{{ __('Short description') }}</label>
                            <textarea
                                id="description"
                                name="description"
                                rows="3"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                placeholder="Tell us something about yourself..."
                            >{{ old('description') }}</textarea>
                            <x-input-error :messages="$errors->get('description')" class="mt-2" />
                        </div>
                        <div>
                            <label for="is_private">{{ __('Profile visibility') }}</label>
                            <select name="is_private" id="is_private"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                                <option value="0">{{ __('Public') }}</option>
                                <option value="1">{{ __('Private') }}</option>
                            </select>
                            <x-input-error :messages="$errors->get('is_private')" class="mt-2" />
                        </div>
                        <div>
                            <label for="password" >{{__('Password')}}</label>
                            <x-text-input type="password" id="password" name="password" required autocomplete="new-password" placeholder="••••••••" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required autocomplete="new-password"/>
                            <x-input-error :messages="$errors->get('password')" class="mt-2" />
                            <label for="confirm-password" >{{__('Confirm password')}}</label>
                            <x-text-input type="password" name="password_confirmation" id="password_confirmation" placeholder="••••••••" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required autocomplete="new-password"/>
                            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
                        </div>

                        <div class="flex items-start">
                            <div class="flex items-center h-5">
                                <x-text-input id="terms" aria-describedby="terms" type="checkbox" class="w-4 h-4 border border-gray-300 rounded bg-gray-50 focus:ring-3 focus:ring-primary-300 dark:bg-gray-700 dark:border-gray-600 dark:focus:ring-primary-600 dark:ring-offset-gray-800" required=""/>
                            </div>
                            <div class="ml-3 text-sm">
                                <label for="terms" class="font-light text-gray-500 dark:text-gray-300">I accept the <a class="font-medium text-purple-600 hover:underline dark:text-primary-500" href="#">{{__('Terms and Conditions')}}</a></label>
                            </div>
                        </div>
                        <x-primary-button class="ms-4">
                            {{ __('Create account') }}
                        </x-primary-button>
                        <p class="text-sm font-light text-gray-500 dark:text-gray-400">
                            {{ __('Already have an account?') }} <a href="{{ route('login') }}" class="font-medium text-purple-600 hover:underline dark:text-primary-500">{{ __('Login here') }}</a>
                        </p>
                    </form>
                </div>
            </div>
        </div>
    </section>
</x-guest-layout>


