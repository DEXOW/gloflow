@php
    $dashboard = false;
    if (request()->routeIs('home') || request()->routeIs('products') || request()->routeIs('about')) {
        $dashboard = false;
    } else {
        $dashboard = true;
    }
@endphp

<nav class="bg-white border-gray-200 sticky w-full z-20 top-0 start-0 dark:bg-gray-800">
    <div class="max-w-screen-xl flex flex-wrap items-center justify-between mx-auto p-4">
        <a href="{{ route('home') }}" class="flex items-center space-x-3 rtl:space-x-reverse">
            <x-application-logo class="w-10 h-10 text-gray-800 dark:text-gray-200" />
        </a>
        <button data-collapse-toggle="navbar-default" type="button" class="inline-flex items-center p-2 w-10 h-10 justify-center text-sm text-gray-500 rounded-lg md:hidden hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200 dark:text-gray-400 dark:hover:bg-gray-700 dark:focus:ring-gray-600" aria-controls="navbar-default" aria-expanded="false">
            <span class="sr-only">Open main menu</span>
            <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 17 14">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 1h15M1 7h15M1 13h15" />
            </svg>
        </button>
        <div class="hidden w-full md:block md:w-auto" id="navbar-default">
            <ul class="font-medium flex flex-col md:items-center p-4 md:p-0 mt-4 border border-gray-100 rounded-lg bg-gray-50 md:flex-row md:space-x-8 rtl:space-x-reverse md:mt-0 md:border-0 md:bg-white dark:bg-gray-800 md:dark:bg-gray-800 dark:border-gray-700">
                @if (!$dashboard)
                    <x-nav :href="route('home')" :active="request()->routeIs('home')">
                        {{ __('Home') }}
                    </x-nav>
                    <x-nav :href="route('products')" :active="request()->routeIs('products')">
                        {{ __('Products') }}
                    </x-nav>
                    <x-nav :href="route('about')" :active="request()->routeIs('about')">
                        {{ __('About Us') }}
                    </x-nav>
                
                @else
                    @php
                        $userRole = Auth::user()->role_id;
                        $perms = DB::table('roles')->where('id', $userRole)->get()->first();
                    @endphp
                    <x-nav :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                        {{ __('Dashboard') }}
                    </x-nav>
                    @if ($perms->manage_products == 1 || $perms->manage_users == 1)
                        <button id="dropdownNavbarLink" data-dropdown-toggle="dropdownNavbar" class="flex items-center justify-between w-full py-2 px-3 text-gray-900 font-semibold rounded hover:bg-gray-100 md:hover:bg-transparent md:border-0 md:hover:text-gloflow-purple-500 md:p-0 md:w-auto dark:text-white md:dark:hover:text-blue-500 dark:focus:text-white dark:border-gray-700 dark:hover:bg-gray-700 md:dark:hover:bg-transparent">
                            Managers
                            <svg class="w-2.5 h-2.5 ms-2.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 4 4 4-4"/>
                            </svg>
                        </button>
                        <!-- Dropdown menu -->
                        <div id="dropdownNavbar" class="z-10 hidden font-normal bg-white divide-y divide-gray-100 rounded-lg shadow w-44 dark:bg-gray-700 dark:divide-gray-600">
                            <ul class="px-4 py-2 text-sm text-gray-700 dark:text-gray-400 space-y-2" aria-labelledby="dropdownLargeButton">
                                <li>
                                    @if ($perms->manage_products == 1)
                                        <x-nav :href="route('dashboard.products_manager')" :active="request()->routeIs('dashboard.products_manager')">
                                            {{ __('Products Manager') }}
                                        </x-nav>
                                    @endif
                                </li>
                                <li>
                                    @if ($perms->manage_users == 1)
                                        <x-nav :href="route('dashboard.users_manager')" :active="request()->routeIs('dashboard.users_manager')">
                                            {{ __('Users Manager') }}
                                        </x-nav>
                                    @endif
                                </li>
                            </ul>
                        </div>
                    @endif
                @endif
                
                @auth
                    <button type="button" class="flex text-sm bg-gray-800 rounded-full md:me-0 focus:ring-4 focus:ring-gray-300 dark:focus:ring-gray-600" id="user-menu-button" aria-expanded="false" data-dropdown-toggle="user-dropdown" data-dropdown-placement="bottom">
                        <span class="sr-only">Open user menu</span>
                        <div class="flex items-center justify-center w-8 h-8 overflow-hidden rounded-full">
                            <img src="/assets/images/person.jpg" alt="user photo">
                        </div>
                    </button>

                    <!-- Dropdown menu -->
                    <div class="z-50 hidden my-4 text-base list-none bg-white divide-y divide-gray-100 rounded-lg shadow dark:bg-gray-700 dark:divide-gray-600" id="user-dropdown">
                        <div class="px-4 py-3">
                            <span class="block text-sm text-gray-900 dark:text-white">{{ Auth::user()->name }}</span>
                            <span class="block text-sm  text-gray-500 truncate dark:text-gray-400">{{ Auth::user()->email }}</span>
                        </div>
                        <ul class="py-2" aria-labelledby="user-menu-button">
                            <li>
                                @if ($dashboard)
                                    <a href="{{ route('home') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:hover:bg-gray-600 dark:text-gray-200 dark:hover:text-white">Home</a>
                                @else
                                    <a href="{{ route('dashboard') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:hover:bg-gray-600 dark:text-gray-200 dark:hover:text-white">Dashboard</a>
                                @endif
                            </li>
                            <li>
                                <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:hover:bg-gray-600 dark:text-gray-200 dark:hover:text-white">Settings</a>
                            </li>
                            <li>
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <a onclick="event.preventDefault();this.closest('form').submit();" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:hover:bg-gray-600 dark:text-gray-200 dark:hover:text-white">Sign out</a>
                                </form>
                            </li>
                        </ul>
                    </div>
                @else
                    @if (Route::has('login'))
                        <div class="space-x-1">
                            @if (Route::has('register'))
                                <a href="{{ route('register') }}" class="text-white bg-gloflow-purple-500 hover:bg-gloflow-purple-600 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-4 py-2 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Register</a>
                            @endif
                            <a href="{{ route('login') }}"  class="text-black bg-gray-100 hover:bg-gray-200 focus:outline-none focus:ring-4 focus:ring-gray-300 font-medium rounded-lg text-sm px-5 py-2 me-2 mb-2 dark:text-white dark:bg-gray-800 dark:hover:bg-gray-700 dark:focus:ring-gray-700 dark:border-gray-700">Login</a>
                        </div>
                    @endif
                @endauth
            </ul>
        </div>
    </div>
</nav>
