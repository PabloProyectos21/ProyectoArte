<x-app-layout>
    @include('components.sidebar')
    <div class="p-4 sm:ml-64">
        <div class="p-4 border-2 border-gray-200 border-dashed rounded-lg dark:border-gray-700">
    <section class="px-4 sm:px-8 py-10 bg-gray-100 min-h-screen">
        <h1 class="text-3xl font-bold mb-6 text-center text-gray-800">Explora nuevas publicaciones</h1>

        <div class="columns-2 md:columns-3 lg:columns-4 gap-4 space-y-4">
            @foreach ($publications as $publication)
                <div class="break-inside-avoid">
                    <a href="{{ route('publications.show', $publication->id) }}">
                        <img src="{{  $publication->image_route}}"
                             alt="{{ $publication->title }}"
                             class="w-full rounded-lg shadow hover:scale-[1.02] transition duration-300 ease-in-out">
                    </a>
                </div>
            @endforeach
        </div>
    </section>
        </div>
    </div>
</x-app-layout>

