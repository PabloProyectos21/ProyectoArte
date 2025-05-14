<div id="ad-popup" class="fixed bottom-6 right-6 z-50 bg-white dark:bg-gray-800 p-4 rounded-lg shadow-lg w-80 border border-gray-300 dark:border-gray-700">
<div class="flex">
        @php
            $isUrl = Str::startsWith($commercial->image, ['http://', 'https://']);
            $imageSrc = $isUrl ? $commercial->image : asset('storage/' . $commercial->image);
        @endphp

        <img class="w-14 h-14 rounded-lg object-cover" src="{{ $imageSrc }}" alt="Ad image">

        <div class="ms-3 text-sm font-normal w-full">
            <span class="block text-base font-semibold text-gray-900 dark:text-white">
                {{ $commercial->company->company_name }}
            </span>
            <div class="text-sm mb-2 text-gray-600 dark:text-gray-400">
                Published on {{ \Carbon\Carbon::parse($commercial->publication_date)->format('M d, Y') }}
            </div>
            <a href="{{ $commercial->media_url }}"
               target="_blank"
               class="inline-flex items-center px-3 py-1.5 text-xs font-medium text-white bg-blue-600 rounded hover:bg-blue-700 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-500 dark:hover:bg-blue-600 dark:focus:ring-blue-800">
                Visit Site
            </a>
        </div>

        <form method="POST"  class="ms-auto">
            @csrf
            <button type="submit"
                    class="ml-2 text-gray-400 hover:text-gray-600 dark:hover:text-white rounded focus:outline-none">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 14 14">
                    <path stroke-linecap="round" stroke-linejoin="round" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                </svg>
                <span class="sr-only">Close</span>
            </button>
        </form>
    </div>
</div>
