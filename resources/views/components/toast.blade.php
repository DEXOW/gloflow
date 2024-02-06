<div {{ $attributes->merge(['class'=>'w-full p-4 text-gray-500 bg-white rounded-lg shadow-md border border-gray-200 dark:bg-gray-800 dark:text-gray-400', 'role'=>'alert']) }}>
    <div class="flex sm:items-center">
        {{ $slot }}
    </div>
</div>