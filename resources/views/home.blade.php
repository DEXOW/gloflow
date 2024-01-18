<x-app-layout @class(['overflow-hidden'])>
    <div class="relative h-[70vh] w-full sm:bg-top bg-left-top bg-cover" style="background-image: url({{ asset('assets/images/hero-2.jpeg') }})">
        <div class="absolute bottom-10 md:translate-x-1/2 sm:translate-x-1/4 max-w-xs m-5 p-6 max-sm:p-4 bg-gloflow-purple-500 rounded-lg shadow">
            <h5 class="mb-2 text-white text-2xl font-extrabold tracking-tight">Looking for a distributor for your business ?</h5>
            <a href="#" class="inline-flex items-center px-3 py-2 text-sm font-semibold text-center text-black bg-white rounded-lg hover:bg-gray-200 focus:ring-4 focus:outline-none focus:ring-blue-300">
                Contact Us
            </a>
        </div>
    </div>
    <div class="sticky bottom-0 bg-white h-[20vh] w-full">
        <div class="h-full flex flex-wrap items-center justify-evenly gap-x-5 px-5">
            <img src="{{ asset('assets/images/unilever_logo.svg') }}" alt="logo" class="md:h-16 h-10">
            <img src="{{ asset('assets/images/upfield_logo.svg') }}" alt="logo" class="md:h-14 h-8">
            <img src="{{ asset('assets/images/nestle_logo.svg') }}" alt="logo" class="md:h-16 h-10">
            <img src="{{ asset('assets/images/fonterra_logo.svg') }}" alt="logo" class="md:h-16 h-10">
            <img src="{{ asset('assets/images/cocacola_logo.svg') }}" alt="logo" class="md:h-16  h-10">
        </div>
    </div>
</x-app-layout>