<x-guest-layout>
    <div class="flex items-center gap-5">
        <h3 class="mb-6 pe-5 text-4xl font-extrabold text-white border-r-4">{{'Login'}}</h3>
        <a href="{{ route('register') }}">
            <h4 class="mb-6 text-2xl font-extrabold text-gray-200">{{'Register'}}</h4>
        </a>
    </div>

    <form method="POST" action="{{ route('login') }}">
        @csrf

        <div class="grid sm:w-[300px] sm:grid-cols-1 gap-4">
            <!-- Email Address -->
            <div>
                <x-input-label for="email" :value="__('Email')" />
                <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
                <x-input-error :messages="$errors->get('email')" class="mt-2" />
            </div>

            <!-- Password -->
            <div class="mt-4">
                <x-input-label for="password" :value="__('Password')" />

                <x-text-input id="password" class="block mt-1 w-full"
                                type="password"
                                name="password"
                                required autocomplete="current-password" />

                <x-input-error :messages="$errors->get('password')" class="mt-2" />
            </div>
        </div>

        <!-- Remember Me -->
        <div class="block mt-4">
            <label for="remember_me" class="inline-flex items-center">
                <input id="remember_me" type="checkbox" class="rounded dark:bg-gray-900 border-gray-300 dark:border-gray-700 text-indigo-600 shadow-sm focus:ring-indigo-500 dark:focus:ring-indigo-600 dark:focus:ring-offset-gray-800" name="remember">
                <span class="ms-2 text-sm text-white">{{ __('Remember me') }}</span>
            </label>
        </div>

        <div class="flex flex-col items-center justify-center mt-10 gap-2">
            @if (Route::has('password.request'))
                <a class="underline text-sm text-white hover:text-gray-200 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('password.request') }}">
                    {{ __('Forgot your password?') }}
                </a>
            @endif

            <button type="submit" class="inline-flex items-center px-4 py-2 bg-white border border-transparent rounded-md font-extrabold text-md text-black hover:bg-gray-100 focus:bg-gray-100 active:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                {{ __('Log In') }}
            </button>
        </div>
    </form>
</x-guest-layout>
