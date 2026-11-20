<x-guest-layout>
    <!-- Session Status -->
    <x-auth-session-status class="mb-6" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}">
        @csrf

        <!-- Email Address -->
        <div class="mb-6">
            <x-input-label for="email" :value="__('Email Address')" />
            <x-text-input id="email" class="block mt-2 w-full" type="email" name="email"
                         :value="old('email')" required autofocus autocomplete="username"
                         placeholder="you@example.com" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mb-6">
            <x-input-label for="password" :value="__('Password')" />
            <x-text-input id="password" class="block mt-2 w-full" type="password"
                         name="password" required autocomplete="current-password"
                         placeholder="••••••••" />
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Remember Me -->
        <div class="mb-6">
            <label class="inline-flex items-center">
                <input id="remember_me" type="checkbox"
                       class="rounded border-[#E8C39E] text-[#D4A574] shadow-sm focus:ring-[#D4A574]"
                       name="remember">
                <span class="ms-2 text-sm text-gray-600">{{ __('Remember me') }}</span>
            </label>
        </div>

        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
            @if (Route::has('password.request'))
                <a class="text-sm text-[#D4A574] hover:text-[#BC8A53] underline underline-offset-4 transition-colors"
                   href="{{ route('password.request') }}">
                    {{ __('Forgot your password?') }}
                </a>
            @endif

            <div class="flex items-center gap-4">
                <a class="text-sm text-gray-600 hover:text-[#2C1810] transition-colors"
                   href="{{ route('register') }}">
                    {{ __('Create account') }}
                </a>

                <x-primary-button class="px-8">
                    {{ __('Log in') }}
                </x-primary-button>
            </div>
        </div>
    </form>
</x-guest-layout>