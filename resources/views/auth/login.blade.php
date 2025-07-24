<x-front.layout title="Login">

    <form method="POST" action="{{ route('login') }}">
        @csrf
        <div class="flex flex-col items-center px-6 py-10 min-h-dvh">
            <img src="{{ asset('assets/svgs/logo.svg') }}" class="mb-[53px]" alt="">
            <form action="" method="" class="mx-auto max-w-[345px] w-full p-6 bg-white rounded-3xl mt-auto"
                id="deliveryForm">
                <div class="flex flex-col gap-5">
                    <p class="text-[22px] font-bold">
                        Sign In
                    </p>
                    <!-- Email Address -->
                    <div class="flex flex-col gap-2.5">
                        <label for="email" class="text-base font-semibold">Email Address</label>
                        <input style="background-image: url('{{ asset('assets/svgs/ic-email.svg') }}')" type="email"
                            name="email" id="email__" class="form-input" placeholder="Your email address">
                    </div>
                    <!-- Password -->
                    <div class="flex flex-col gap-2.5">
                        <label for="password" class="text-base font-semibold">Password</label>
                        <input style="background-image: url({{ asset('assets/svgs/ic-lock.svg') }})" type="password"
                            name="password" id="password__" class="form-input" placeholder="Protect your password">
                    </div>
                    <button type="submit"
                        class="inline-flex text-white font-bold text-base bg-primary rounded-full whitespace-nowrap px-[30px] py-3 justify-center items-center"
                        onclick="window.location.href='/public/pages/index.html'">
                        Sign In
                    </button>
                </div>
            </form>
            <a href="{{ route('register') }}" class="font-semibold text-base mt-[30px] underline">
                Create New Account
            </a>
        </div>
    </form>

</x-front.layout>

{{-- <x-guest-layout>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}">
        @csrf

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

        <!-- Remember Me -->
        <div class="block mt-4">
            <label for="remember_me" class="inline-flex items-center">
                <input id="remember_me" type="checkbox" class="rounded dark:bg-gray-900 border-gray-300 dark:border-gray-700 text-indigo-600 shadow-sm focus:ring-indigo-500 dark:focus:ring-indigo-600 dark:focus:ring-offset-gray-800" name="remember">
                <span class="ms-2 text-sm text-gray-600 dark:text-gray-400">{{ __('Remember me') }}</span>
            </label>
        </div>

        <div class="flex items-center justify-end mt-4">
            @if (Route::has('password.request'))
                <a class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800" href="{{ route('password.request') }}">
                    {{ __('Forgot your password?') }}
                </a>
            @endif

            <x-primary-button class="ms-3">
                {{ __('Log in') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout> --}}
