@php use Illuminate\Support\Str; @endphp
<section class="mt-10">
    <h2 class="text-xl font-semibold text-gray-800 dark:text-white mb-4">{{__('Posts from ')}} {{ $user->name }}</h2>

    @if ($user->publications->isEmpty())
        <p class="text-gray-600 dark:text-gray-400">{{__("This user hasn't posted any posts yet")}}</p>
    @else
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6 ">
            @foreach ($user->publications as $publication)
                <div class="max-w-sm bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
                    @php

                        $isUrl = Str::startsWith($publication->image_route, ['http://', 'https://']);
                        $imageSrc = $isUrl
                            ? $publication->image_route
                            : asset('storage/' . $publication->image_route);
                    @endphp

                    <img class="rounded-t-lg w-full object-cover h-48" src="{{ $imageSrc }}" alt="{{ $publication->title }}" />

                    <div class="p-5">
                        <h5 class="mb-2 text-xl font-bold tracking-tight text-gray-900 dark:text-white">{{ $publication->title }}</h5>
                        <p class="mb-3 font-normal text-gray-700 dark:text-gray-400">{{ Str::limit($publication->description, 100) }}</p>
                        <a href="{{ route('publications.show', $publication->id) }}" class="inline-flex items-center px-3 py-2 text-sm font-medium text-center text-white bg-purple-600 rounded-lg hover:bg-purple-700 focus:ring-4 focus:outline-none focus:ring-purple-300 dark:bg-purple-500 dark:hover:bg-purple-600 dark:focus:ring-purple-800">
                            {{__('View post')}}
                            <svg class="rtl:rotate-180 w-3.5 h-3.5 ms-2" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 10">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 5h12m0 0L9 1m4 4L9 9"/>
                            </svg>
                        </a>
                    </div>
                </div>
            @endforeach
        </div>
    @endif
</section>
