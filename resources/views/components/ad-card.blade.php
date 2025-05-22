<div id="toast-message-cta" class="fixed bottom-6 right-6 z-50 bg-white dark:bg-gray-800 p-4 rounded-lg shadow-lg w-80 border border-gray-300 dark:border-gray-700">
<div class="flex">
    <a href="{{ $commercial->media_url }}">
        @php
            $isUrl = Str::startsWith($commercial->image, ['http://', 'https://']);
            $imageSrc = $isUrl ? $commercial->image : secure_asset('storage/'. $commercial->image);
        @endphp

        <img class="w-14 h-14 rounded-lg object-cover" src="{{ $imageSrc }}" alt="Ad image">
    </a>
        <div class="ms-3 text-sm font-normal w-full">
            <span class="block text-base font-semibold text-gray-900 dark:text-white">
                {{ $commercial->company->company_name }}
            </span>
            <div class="text-sm mb-2 text-gray-600 dark:text-gray-400">
                {{ $commercial->ad_text }}
            </div>
            <a href="{{ $commercial->media_url }}"
               target="_blank"
               class="inline-flex items-center px-3 py-1.5 text-xs font-medium text-white bg-blue-600 rounded hover:bg-blue-700 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-500 dark:hover:bg-blue-600 dark:focus:ring-blue-800">
                Visit Site
            </a>
        </div>

    <button type="button" class="ms-auto -mx-1.5 -my-1.5 bg-white justify-center items-center shrink-0 text-gray-400 hover:text-gray-900 rounded-lg focus:ring-2 focus:ring-gray-300 p-1.5 hover:bg-gray-100 inline-flex h-8 w-8 dark:text-gray-500 dark:hover:text-white dark:bg-gray-800 dark:hover:bg-gray-700" data-dismiss-target="#toast-message-cta" aria-label="Close">
        <span class="sr-only">Close</span>
        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
        </svg>
    </button>
    </div>
</div>
