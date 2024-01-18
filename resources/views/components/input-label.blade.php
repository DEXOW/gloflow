@props(['value'])

<label {{ $attributes->merge(['class' => 'block mb-2 text-md font-bold text-white']) }}>
    {{ $value ?? $slot }}
</label>
