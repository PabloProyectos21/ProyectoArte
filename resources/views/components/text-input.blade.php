@props(['disabled' => false])

<input @disabled($disabled) {{ $attributes->merge(['class' => 'block mb-2 text-sm font-medium text-gray-900 dark:text-white']) }}>
