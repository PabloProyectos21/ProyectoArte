@props(['messages'])

@if ($messages)
    <div {{ $attributes->merge(['class' => 'flex items-center p-2 text-sm text-red-800 border border-red-300 rounded-lg bg-red-50 dark:bg-gray-800 dark:text-red-400 dark:border-red-800']) }} role="alert">
        <svg class="flex-shrink-0 w-5 h-5 me-2" fill="currentColor" viewBox="0 0 20 20">
            <path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.451 9.714c.745 1.328-.196 2.987-1.742 2.987H4.548c-1.546 0-2.487-1.659-1.742-2.987l5.451-9.714zM11 13a1 1 0 10-2 0 1 1 0 002 0zm-1-2a1 1 0 01-1-1V7a1 1 0 112 0v3a1 1 0 01-1 1z" clip-rule="evenodd"/>
        </svg>
        <ul>
            @foreach ((array) $messages as $message)
                <li>{{ $message }}</li>
            @endforeach
        </ul>
    </div>
@endif

