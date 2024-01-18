@props(['disabled' => false])

<input {{ $disabled ? 'disabled' : '' }} {!! $attributes->merge(['class' => 'text-md py-1 bg-gray-200 border-4 border-white focus:border-white focus:ring-0 rounded-md shadow-sm']) !!}>
