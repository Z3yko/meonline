<x-guest-layout>
    <x-auth-card >
        <x-slot name="logo">
            <a href="/">
                <x-application-logo />
            </a>
        </x-slot>

        <!-- Session Status -->
        <x-auth-session-status class="mb-4" :status="session('status')" />

        <!-- Validation Errors -->
        <x-auth-validation-errors class="mb-4" :errors="$errors" />

        <form method="POST" action="{{ route('login') }}">
            @csrf

            <!-- Email Address -->
            <div>
                <x-label for="email" :value="__('Email')" />

                <x-input id="email" class="block mt-1 w-full bg-green-100" type="email" name="email" :value="old('email')" required autofocus />
            </div>

            <!-- Password -->
            <div class="mt-4">
                <x-label for="password" :value="__('Password')" />

                <x-input id="password" class="block mt-1 w-full"
                                type="password"
                                name="password"
                                required autocomplete="current-password" />
            </div>

            <!-- Remember Me -->
            <div class="block mt-4">
                <label for="remember_me" class="inline-flex items-center">
                    <input id="remember_me" type="checkbox" class="rounded-full border-mygreenSDark text-mygreenDark shadow-sm focus:border-mygreenSDark focus:ring focus:ring-mygreenDark focus:ring-opacity-50" name="remember">
                    <span class="ml-2 text-sm text-gray-600">{{ __('Remember me') }}</span>
                </label>
            </div>

            <div class="flex items-center justify-end mt-4">
                @if (Route::has('password.request'))
                    <a class="underline text-sm text-gray-600 hover:text-gray-900" href="{{ route('password.request') }}">
                        {{ __('Forgot your password?') }}
                    </a>
                @endif

                <x-button class="ml-3 bg-mygreenDark hover:bg-mygreenSDark">
                    {{ __('Log in') }}
                </x-button>
            </div>
        </form>
        <div class=" w-full mx-auto mt-5 flex border-t-1 border-gray-300 pt-5 sm:justify-between md:justify-center items-baseline">
            <x-label > Don't have an account ?</x-label>
            <a href="/register">
        <input type="button" class="button is-primary md:ml-6" value="Create Now">
            </a>
        </div>
    </x-auth-card>
</x-guest-layout>
