<x-guest-layout>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />
    <div class="grid grid-cols-2 gap-4 min-h-screen">
        <div class="flex items-center justify-center">
            <div class="w-full max-w-md">
                <h2 class="text-4xl font-bold pb-8">Create Account</h2>
                <form method="POST" action="{{ route('register') }}">
                    @csrf

                    <!-- Name -->
                    <div>
                        <x-input-label for="name" :value="__('Name')" />
                        <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')"
                            required autofocus autocomplete="name" />
                        <x-input-error :messages="$errors->get('name')" class="mt-2" />
                    </div>

                    <!-- Email Address -->
                    <div class="mt-4">
                        <x-input-label for="email" :value="__('Email')" />
                        <x-text-input id="email" class="block mt-1 w-full" type="email" name="email"
                            :value="old('email')" required autocomplete="username" />
                        <x-input-error :messages="$errors->get('email')" class="mt-2" />
                    </div>

                    <!-- Password -->
                    <div class="mt-4">
                        <x-input-label for="password" :value="__('Password')" />

                        <x-text-input id="password" class="block mt-1 w-full" type="password" name="password" required
                            autocomplete="new-password" />

                        <x-input-error :messages="$errors->get('password')" class="mt-2" />
                    </div>

                    <!-- Confirm Password -->
                    <div class="mt-4">
                        <x-input-label for="password_confirmation" :value="__('Confirm Password')" />

                        <x-text-input id="password_confirmation" class="block mt-1 w-full" type="password"
                            name="password_confirmation" required autocomplete="new-password" />

                        <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
                    </div>

                    <div class="flex items-center justify-end mt-4">
                        <a class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-blue-500 rounded-md focus:outline-none focus:text-blue-500"
                            href="{{ route('login') }}">
                            {{ __('Already registered?') }}
                        </a>

                        <x-primary-button class="ms-4">
                            {{ __('Register') }}
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