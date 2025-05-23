<x-app-layout>
@include('components.sidebar')

<div class="p-4 sm:ml-64 mt-10 overflow-hidden ">

    <div class="p-4 rounded-lg overflow-hidden">
        @include('components.bg-premium')

        <div class=" relative z-10 max-w-2xl mx-auto mt-10 p-6 bg-white  rounded-lg shadow text-align-center place-items-center">

            <h1 class="text-2xl font-bold text-gray-900 dark:text-white mb-4">Upgrade to Premium</h1>

            @if (Auth::user()->is_premium)
                <p class="text-green-600 dark:text-green-400 font-medium mb-4">You are already a premium user 🎉</p>

                <form method="POST" action="{{ route('premium.cancel') }}">
                    @csrf
                    <button type="submit"
                            class="px-6 py-3 bg-red-600 text-white font-medium rounded-lg hover:bg-red-700 transition">
                        Cancel Premium
                    </button>
                </form>
            @else
                <p class="text-gray-700 dark:text-gray-300 mb-6">
                    Get access to exclusive features by becoming a premium user.
                </p>
                <form method="POST" action="{{ route('premium.subscribe') }}">
                    @csrf
                    <button type="submit"
                            class="px-6 py-3 text-gray-900 bg-gradient-to-r from-red-200 via-red-300 to-yellow-200 hover:bg-gradient-to-bl focus:ring-4 focus:outline-none focus:ring-red-100 dark:focus:ring-red-400 font-medium rounded-lg text-sm text-center me-2 mb-2 transition">
                        Become Premium
                    </button>
                </form>
            @endif
        </div>

        <div class="relative z-10 bg-white  mt-10">
            <table class="w-full text-left text-sm text-gray-700  border rounded-lg">
                <thead class="bg-white text-center">
                <tr>
                    <th class="px-4 py-2">{{__('Advantages')}}</th>
                    <th class="px-4 py-2">{{__('Free')}}</th>
                    <th class="px-4 py-2">{{__('Premium')}}</th>
                </tr>
                </thead>
                <tbody>
                <tr class="bg-white text-center">
                    <td class="px-4 py-2">{{__('Unlimited posts')}}</td>
                    <td class="px-4 py-2 text-center">✔️</td>
                    <td class="px-4 py-2 text-center">✔️</td>
                </tr>
                <tr class="bg-white  dark:bg-gray-700 text-center">
                    <td class="px-4 py-2">{{__('Featured profile')}}</td>
                    <td class="px-4 py-2 text-center">❌</td>
                    <td class="px-4 py-2 text-center">✔️</td>
                </tr>
                <tr class="bg-white  dark:bg-gray-700 text-center">
                    <td class="px-4 py-2">{{__("No advertising's")}}</td>
                    <td class="px-4 py-2 text-center">❌</td>
                    <td class="px-4 py-2 text-center">✔️</td>
                </tr>
                <tr class="bg-white  dark:bg-gray-700 text-center">
                    <td class="px-4 py-2">{{__('Instant support')}}</td>
                    <td class="px-4 py-2 text-center">❌</td>
                    <td class="px-4 py-2 text-center">✔️</td>
                </tr>
                </tbody>
            </table>
        </div>

<div class="relative z-10 bg-white  shadow-lg rounded-lg p-4 mt-16 overflow-y-hidden">
        <article class="md:gap-8 md:grid md:grid-cols-3">
            <div>
                <div class="flex items-center mb-6">
                    <img class="w-10 h-10 rounded-full" src="{{secure_asset('images/logo2.png')}}" alt="">
                    <div class="ms-4 font-medium dark:text-white">
                        <p>FlowArt</p>
                        <div class="flex items-center text-sm text-gray-500 dark:text-gray-400">
                            <img src="{{secure_asset('images/spain-flag.png')}}" class="w-5 h-auto mr-1.5" alt="">
                               Spain
                        </div>
                    </div>
                </div>
                <ul class="space-y-4 text-sm text-gray-500 dark:text-gray-400">
                    <li class="flex items-center"><svg class="w-3 h-3 me-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 15V9m4 6V9m4 6V9m4 6V9M2 16h16M1 19h18M2 7v1h16V7l-8-6-8 6Z"/>
                        </svg>
                        {{__('Post here at FlowArt')}}</li>
                    <li class="flex items-center"><svg class="w-3 h-3 me-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M20 4a2 2 0 0 0-2-2h-2V1a1 1 0 0 0-2 0v1h-3V1a1 1 0 0 0-2 0v1H6V1a1 1 0 0 0-2 0v1H2a2 2 0 0 0-2 2v2h20V4ZM0 18a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V8H0v10Zm5-8h10a1 1 0 0 1 0 2H5a1 1 0 0 1 0-2Z"/>
                        </svg>
                        {{__('Get Known')}}</li>
                    <li class="flex items-center"><svg class="w-3 h-3 me-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 19">
                            <path d="M14.5 0A3.987 3.987 0 0 0 11 2.1a4.977 4.977 0 0 1 3.9 5.858A3.989 3.989 0 0 0 14.5 0ZM9 13h2a4 4 0 0 1 4 4v2H5v-2a4 4 0 0 1 4-4Z"/>
                            <path d="M5 19h10v-2a4 4 0 0 0-4-4H9a4 4 0 0 0-4 4v2ZM5 7a5.008 5.008 0 0 1 4-4.9 3.988 3.988 0 1 0-3.9 5.859A4.974 4.974 0 0 1 5 7Zm5 3a3 3 0 1 0 0-6 3 3 0 0 0 0 6Zm5-1h-.424a5.016 5.016 0 0 1-1.942 2.232A6.007 6.007 0 0 1 17 17h2a1 1 0 0 0 1-1v-2a5.006 5.006 0 0 0-5-5ZM5.424 9H5a5.006 5.006 0 0 0-5 5v2a1 1 0 0 0 1 1h2a6.007 6.007 0 0 1 4.366-5.768A5.016 5.016 0 0 1 5.424 9Z"/>
                        </svg>
                        {{__('Meet other creators')}}</li>
                </ul>
            </div>
            <div class="relative z-10 col-span-2 mt-6 md:mt-0">
                <div class="flex items-start mb-5">
                    <div class="pe-4">
                        <footer>
                            <p class="mb-2 text-sm text-gray-500 dark:text-gray-400">Reviewed: <time datetime="2022-01-20 19:00">January 20, 2022</time></p>
                        </footer>
                        <h4 class="text-xl font-bold text-gray-900 dark:text-white">
                            Innovative, inspiring, and incredibly user-friendly — FlowArt sets a new standard.
                        </h4>

                    </div>
                    <p class="bg-blue-700 text-white text-sm font-semibold inline-flex items-center p-1.5 rounded-sm">8.7</p>
                </div>
                <p class="mb-2 text-gray-500 dark:text-gray-400">
                    FlowArt has completely transformed how we connect with art and creativity online. Its sleek design and seamless interface make showcasing digital works feel intuitive and professional. Whether you're an artist or an enthusiast, the experience is unmatched.
                </p>
                <p class="mb-5 text-gray-500 dark:text-gray-400">
                    What truly sets FlowArt apart is their dedication to community and innovation. The team listens, improves constantly, and makes you feel part of something bigger. It's more than a platform — it's a creative movement. I would absolutely recommend it to anyone passionate about visual expression.
                </p>

            </div>
        </article>
</div>
    </div>

</div>

</x-app-layout>
