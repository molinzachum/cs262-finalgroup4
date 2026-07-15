<x-guest-layout>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />
    <div class="grid grid-cols-2 gap-4 min-h-screen">
        <div class="flex items-center justify-center">
            <div class="w-full max-w-md">
                <h2 class="text-4xl font-bold">Welcome Back!</h2>
                <div class="pt-8 pb-[70px]">No account yet? <a href="{{ route('register') }}" class="underline text-indigo-500">Register Here</a></div>
                <form method="POST" action="{{ route('login') }}">
                    @csrf

                    <!-- Email Address -->
                    <div>
                        <x-input-label for="email" :value="__('Email')" />
                        <x-text-input id="email" class="block mt-1 w-full" type="email" name="email"
                            :value="old('email')" required autofocus autocomplete="username" />
                        <x-input-error :messages="$errors->get('email')" class="mt-2" />
                    </div>

                    <!-- Password -->
                    <div class="mt-4">
                        <x-input-label for="password" :value="__('Password')" />

                        <x-text-input id="password" class="block mt-1 w-full" type="password" name="password" required
                            autocomplete="current-password" />

                        <x-input-error :messages="$errors->get('password')" class="mt-2" />
                    </div>

                    <!-- Remember Me -->
                    <div class="block mt-4">
                        <label for="remember_me" class="inline-flex items-center">
                            <input id="remember_me" type="checkbox"
                                class="rounded bg-white border-gray-300 dark:border-gray-700 text-indigo-600 shadow-sm focus:ring-indigo-500 dark:focus:ring-indigo-600 dark:focus:ring-offset-gray-800"
                                name="remember">
                            <span class="ms-2 text-sm text-gray-600 dark:text-gray-900">{{ __('Remember me') }}</span>
                        </label>
                    </div>

                    <div class="flex items-center justify-end mt-4">
                        @if (Route::has('password.request'))
                            <a class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-blue-500 rounded-md focus:outline-none focus:text-blue-500"
                                href="{{ route('password.request') }}">
                                {{ __('Forgot your password?') }}
                            </a>
                        @endif

                        <x-primary-button class="ms-3">
                            {{ __('Log in') }}
                        </x-primary-button>
                    </div>
                </form>
            </div>
        </div>
        <div class="flex items-center justify-start bg-blue-100 relative min-h-screen">
            <div class="absolute top-2 left-2">
                <a href="/">
                    <x-application-logo class="fill-current text-gray-500" />
                </a>
            </div>
            <div class="pl-[120px] max-w-2xl">
                <h1 class="text-5xl font-bold">Manage Every Project. Track Every Task.</h1>
                <p class="text-2xl py-5">One system for your entire project lifecycle — from
                    kickoff to delivery. Experience productivity in its purest
                    form.</p>
            </div>
        </div>
    </div>
</x-guest-layout>