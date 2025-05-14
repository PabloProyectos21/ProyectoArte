<x-app-layout>

    @include('components.sidebar')
    <div class=" sm:ml-64">
        <section class="relative min-h-screen bg-gray-900 text-white overflow-hidden">


            <!-- 🎥 VIDEO DE FONDO desde URL -->
            <video autoplay muted loop playsinline class="absolute inset-0 w-full h-full object-cover z-0">
                <source src="https://cdn.pixabay.com/video/2023/10/20/185787-876545918_large.mp4" type="video/mp4">
                Tu navegador no soporta video HTML5.
            </video>


            <!-- 🔲 Capa oscura encima del video -->
            <div class="absolute inset-0 bg-black bg-opacity-60 z-10"></div>


            <!-- 🧾 Contenido principal -->
            @guest
                <div
                    class="relative z-20 flex flex-col items-center justify-center text-center px-4 sm:px-6 md:px-8 py-20 sm:py-28 ">
                    <h1 class="text-3xl sm:text-4xl md:text-5xl lg:text-6xl font-bold mb-4 sm:mb-6">
                        {{ __('Inspire. Create. Share.') }}
                    </h1>
                    <p class="text-base sm:text-lg md:text-xl mb-6 sm:mb-8 max-w-2xl mx-auto px-2">
                        {{ __('A space where artists and art fans come together to share and explore talent in all kinds of formats.') }}
                    </p>
                    <a href="{{ route('register') }}"
                       class="inline-block px-5 sm:px-6 py-3 text-base sm:text-lg font-medium bg-purple-600 hover:bg-purple-700 rounded-lg transition">
                        {{ __('Join now') }}
                    </a>
                </div>


                <div id="text-carousel" class=" w-full" data-carousel="slide">
                    <!-- Contenedor del carrusel -->
                    <div class="overflow-hidden relative h-56 mt-24 rounded-lg sm:h-64 xl:h-80 2xl:h-96">
                        <!-- Slide 1 -->
                        <div class="hidden z-40 duration-700 bg-blue-400 ease-in-out" style="height: 170px"
                             data-carousel-item>
                            <div class="flex  items-center justify-center h-full  dark:">
                                <h1 class="text-3xl sm:text-4xl md:text-5xl lg:text-6xl font-bold mb-4 sm:mb-6">
                                    {{ __('Talk with other artists.') }}
                                </h1>
                            </div>
                        </div>
                        <!-- Slide 2 -->
                        <div class="hidden z-30 duration-700 bg-red-400 ease-in-out" style="height: 170px"
                             data-carousel-item>
                            <div class="flex  items-center justify-center h-full ">
                                <h1 class="text-3xl sm:text-4xl md:text-5xl lg:text-6xl font-bold mb-4 sm:mb-6">
                                    {{ __('Subscribe to your favourites artists.') }}
                                </h1>
                            </div>
                        </div>
                        <!-- Slide 3 -->
                        <div class="hidden z-10 duration-700 bg-purple-500 ease-in-out" style="height: 170px"
                             data-carousel-item>
                            <div class="flex items-center justify-center h-full  dark:">
                                <h1 class="text-3xl sm:text-4xl md:text-5xl lg:text-6xl font-bold mb-4 sm:mb-6">
                                    {{ __('Share your pictures with your followers') }}
                                </h1>
                            </div>
                        </div>
                    </div>


                </div>
            @endguest
            @if(Auth::user()->is_premium)
            @isset($commercial)
                <x-ad-card :commercial="$commercial" />
            @endisset
            @endif
            @auth
                <div
                    class="relative z-20 flex flex-col items-center justify-center text-center px-4 sm:px-6 md:px-8 py-20 sm:py-28 ">
                    <h1 class="text-3xl sm:text-4xl md:text-5xl lg:text-6xl font-bold mb-4 sm:mb-6">
                        {{ __('Inspire. Create. Share.') }}
                    </h1>
                    <p class="text-base sm:text-lg md:text-xl mb-6 sm:mb-8 max-w-2xl mx-auto px-2">
                        {{ __('A space where artists and art fans come together to share and explore talent in all kinds of formats.') }}
                    </p>
                    <a href="{{route('users.explore')}}"
                       class="inline-block px-5 sm:px-6 py-3 text-base sm:text-lg font-medium text-white bg-gradient-to-r from-purple-500 to-pink-500 hover:bg-gradient-to-l focus:ring-4 focus:outline-none focus:ring-purple-200 dark:focus:ring-purple-800  rounded-lg  text-center me-2 mb-2">
                        {{ __('Explore users') }}
                    </a>
                </div>


                <div id="text-carousel" class=" w-full" data-carousel="slide">
                    <!-- Contenedor del carrusel -->
                    <div class="overflow-hidden relative h-56 mt-24 rounded-lg sm:h-64 xl:h-80 2xl:h-96">
                        <!-- Slide 1 -->
                        <div class="hidden z-40 duration-700 bg-blue-400 ease-in-out" style="height: 170px"
                             data-carousel-item>
                            <div class="flex  items-center justify-center h-full  dark:">
                                <h1 class="text-3xl sm:text-4xl md:text-5xl lg:text-6xl font-bold mb-4 sm:mb-6">
                                    {{ __('Talk with other artists.') }}
                                </h1>
                            </div>
                        </div>
                        <!-- Slide 2 -->
                        <div class="hidden z-30 duration-700 bg-red-400 ease-in-out" style="height: 170px"
                             data-carousel-item>
                            <div class="flex  items-center justify-center h-full ">
                                <h1 class="text-3xl sm:text-4xl md:text-5xl lg:text-6xl font-bold mb-4 sm:mb-6">
                                    {{ __('Subscribe to your favourites artists.') }}
                                </h1>
                            </div>
                        </div>
                        <!-- Slide 3 -->
                        <div class="hidden z-10 duration-700 bg-purple-500 ease-in-out" style="height: 170px"
                             data-carousel-item>
                            <div class="flex items-center justify-center h-full  dark:">
                                <h1 class="text-3xl sm:text-4xl md:text-5xl lg:text-6xl font-bold mb-4 sm:mb-6">
                                    {{ __('Share your pictures with your followers') }}
                                </h1>
                            </div>
                        </div>
                    </div>


                </div>
            @endauth

        </section>
    </div>

</x-app-layout>


