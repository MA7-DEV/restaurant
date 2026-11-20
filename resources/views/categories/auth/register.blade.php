<x-guest-layout>
    <form method="POST" action="{{ route('register') }}">
        @csrf

        <!-- Name -->
        <div class="mb-6">
            <x-input-label for="name" :value="__('Full Name')" />
            <x-text-input id="name" class="block mt-2 w-full" type="text" name="name"
                         :value="old('name')" required autofocus autocomplete="name"
                         placeholder="John Doe" />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <!-- Email Address -->
        <div class="mb-6">
            <x-input-label for="email" :value="__('Email Address')" />
            <x-text-input id="email" class="block mt-2 w-full" type="email" name="email"
                         :value="old('email')" required autocomplete="username"
                         placeholder="you@example.com" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mb-6">
            <x-input-label for="password" :value="__('Password')" />
            <x-text-input id="password" class="block mt-2 w-full" type="password"
                         name="password" required autocomplete="new-password"
                         placeholder="••••••••" />
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Confirm Password -->
        <div class="mb-8">
            <x-input-label for="password_confirmation" :value="__('Confirm Password')" />
            <x-text-input id="password_confirmation" class="block mt-2 w-full" type="password"
                         name="password_confirmation" required autocomplete="new-password"
                         placeholder="••••••••" />
            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
            <a class="text-sm text-gray-600 hover:text-[#2C1810] transition-colors"
               href="{{ route('login') }}">
                {{ __('Already registered?') }}
            </a>

            <x-primary-button class="px-8">
                {{ __('Register') }}
            </x-primary-button>
        </div>

        <!-- Terms & Privacy Notice -->
        <div class="mt-8 pt-6 border-t border-[#E8C39E]/20">
            <p class="text-xs text-gray-500 text-center">
                By registering, you agree to our
                <a href="#" class="text-[#D4A574] hover:text-[#BC8A53]">Terms</a>
                and
                <a href="#" class="text-[#D4A574] hover:text-[#BC8A53]">Privacy Policy</a>
            </p>
        </div>
    </form>
</x-guest-layout>