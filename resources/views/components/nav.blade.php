@props(['active'])

@php
$classes = ($active ?? false)
            ? 'block py-2 px-3 text-white font-semibold bg-gloflow-purple-500 rounded md:bg-transparent md:text-gloflow-purple-500 md:p-0 dark:text-white md:dark:text-gloflow-purple-500'
            : 'block py-2 px-3 text-gray-900 font-semibold rounded hover:bg-gray-100 md:hover:bg-transparent md:border-0 md:hover:text-gloflow-purple-500 md:p-0 dark:text-white md:dark:hover:text-gloflow-purple-500 dark:hover:bg-gray-700 dark:hover:text-white md:dark:hover:bg-transparent';
@endphp

<a {{ $attributes->merge(['class' => $classes])}}>
    {{ $slot }}
</a>
