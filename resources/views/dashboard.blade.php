<x-app-layout>

@include('components.sidebar')
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
            <div class="relative z-20 flex flex-col items-center justify-center text-center px-4 sm:px-6 md:px-8 py-20 sm:py-28 lg:py-40">
                <h1 class="text-3xl sm:text-4xl md:text-5xl lg:text-6xl font-bold mb-4 sm:mb-6">
                    {{ __('Inspire. Create. Share.') }}
                </h1>
                <p class="text-base sm:text-lg md:text-xl mb-6 sm:mb-8 max-w-2xl mx-auto px-2">
                    {{ __('A space where artists and art fans come together to share and explore talent in all kinds of formats.') }}
                </p>
                <a href="{{ route('register') }}" class="inline-block px-5 sm:px-6 py-3 text-base sm:text-lg font-medium bg-purple-600 hover:bg-purple-700 rounded-lg transition">
                    {{ __('Join now') }}
                </a>
            </div>
        @endguest

    </section>


</x-app-layout>


