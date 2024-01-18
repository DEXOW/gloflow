<x-app-layout>
    <div class="flex flex-col justify-center items-center mt-10 mb-3">
        <h1 class="mb-4 text-4xl font-semibold tracking-tight text-gray-900 md:text-5xl dark:text-white">Our Products</h1>
        <div class="max-md:mx-10 max-sm:px-5 flex justify-center w-full">
            <p class="text-justify sm:text-center text-gray-600 w-full md:w-1/2">High-quality consumer products for distribution agents. We offer a wide range of products, competitive pricing, fast shipping, and support services to help you succeed.</p>
        </div>
    </div>
    <div class="flex flex-wrap mt-10 sm:mx-20 mx-5 pb-10">
        @foreach ($products as $product)
            <div class="w-full sm:w-1/2 md:w-1/3 lg:w-1/4 p-4">
                <div class="bg-white dark:bg-gray-800 rounded-lg overflow-hidden shadow-xl transform transition-all hover:scale-105">
                    <img src="{{ $product->image }}" alt="{{ $product->name }}" class="w-full">
                    <div class="p-4">
                        <h3 class="text-gray-500 dark:text-gray-400 text-xs tracking-widest title-font mb-1">{{ $product->category }}</h3>
                        <h2 class="text-gray-900 dark:text-white title-font text-lg font-medium">{{ $product->name }}</h2>
                        <p class="mt-1 text-sm text-gray-500">{{ implode(' ', array_slice(explode(' ', $product->description), 0, 5)).'...' }}</p>
                        <div class="flex flex-wrap gap-2 mt-4">
                            @foreach (explode(',', $product->tags) as $tag)
                                <span class="inline-block py-1 px-2 text-xs font-semibold text-gray-600 bg-gray-200 rounded-lg dark:bg-gray-700 dark:text-gray-200">{{ $tag }}</span>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</x-app-layout>