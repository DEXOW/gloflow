<x-guest-layout>
    <div class="flex items-center gap-5">
        <h3 class="mt-2 mb-6 pe-5 text-4xl font-extrabold text-white border-r-4">{{'Register'}}</h3>
        <a href="{{ route('login') }}">
            <h4 class="mt-2 mb-6 text-2xl font-extrabold text-gray-200">{{'Login'}}</h4>
        </a>
    </div>
    <form method="POST" action="{{ route('register') }}">
        @csrf
        <div class="grid sm:grid-cols-2 gap-4">
            <!-- Name -->
            <div>
                <x-input-label for="name" :value="__('Name')" />
                <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
                <x-input-error :messages="$errors->get('name')" class="mt-2" />
            </div>

            <!-- Email Address -->
            <div>
                <x-input-label for="email" :value="__('Email')" />
                <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autocomplete="username" />
                <x-input-error :messages="$errors->get('email')" class="mt-2" />
            </div>

            <!-- Password -->
            <div>
                <x-input-label for="password" :value="__('Password')" />

                <x-text-input id="password" class="block mt-1 w-full" type="password" name="password" :value="old('password')" required autocomplete="new-password" />

                <x-input-error :messages="$errors->get('password')" class="mt-2" />
            </div>

            <!-- Confirm Password -->
            <div>
                <x-input-label for="password_confirmation" :value="__('Confirm Password')" />

                <x-text-input id="password_confirmation" class="block mt-1 w-full"
                                type="password"
                                name="password_confirmation" required autocomplete="new-password" />

                <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
            </div>

            <!-- Phone Number -->
            <div>
                <x-input-label for="phone_number" :value="__('Phone Number')" />
                <x-text-input id="phone_number" class="block mt-1 w-full" type="text" name="phone_number" :value="old('phone_number')" required/>
                <x-input-error :messages="$errors->get('phone_number')" class="mt-2" />
            </div>
        </div>

        <div class="flex flex-col items-center justify-center mt-10 gap-2">
            <button type="submit" class="inline-flex items-center px-4 py-2 bg-white border border-transparent rounded-md font-extrabold text-md text-black hover:bg-gray-100 focus:bg-gray-100 active:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                {{ __('Register') }}
            </button>

            <a class="underline text-sm text-white hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('login') }}">
                {{ __('Already registered?') }}
            </a>
        </div>
    </form>
</x-guest-layout>
