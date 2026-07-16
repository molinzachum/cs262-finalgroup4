<x-guest-layout>
    <div class="flex min-h-screen flex-col lg:flex-row">
        <!-- Left Side: Form -->
        <main class="w-full lg:w-[55%] flex flex-col justify-between bg-white p-8 sm:p-12 md:p-16 lg:p-24 min-h-screen">
            <!-- Top branding for mobile/small screens -->
            <div class="flex items-center gap-2 lg:hidden mb-8">
                <span class="flex h-6 w-6 items-center justify-center rounded-md bg-[#2F5F73] text-xs font-bold text-white">+</span>
                <span class="text-sm font-bold tracking-tight text-slate-900">Milestone</span>
            </div>

            <!-- Form Wrapper -->
            <div class="my-auto py-10 max-w-sm w-full mx-auto space-y-6">
                <div>
                    <h1 class="text-3xl font-extrabold tracking-tight text-slate-950">Create Account</h1>
                    <p class="mt-2 text-sm text-slate-500">
                        Start your 14-day free trial today.
                    </p>
                </div>

                <form method="POST" action="{{ route('register') }}" class="space-y-4">
                    @csrf

                    <!-- Name -->
                    <div>
                        <label for="name" class="block text-xs font-semibold uppercase tracking-wider text-slate-500">Full Name</label>
                        <div class="relative mt-1">
                            <input id="name" type="text" name="name" value="{{ old('name') }}" required autofocus placeholder="Alex Rivera" class="block w-full rounded-lg border-slate-200 py-3 pl-10 text-sm shadow-sm focus:border-[#7FA8BA] focus:ring-[#7FA8BA] border">
                            <span class="absolute inset-y-0 left-3 flex items-center text-slate-400">
                                <svg class="h-4 w-4" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0ZM4.501 20.118a7.5 7.5 0 0 1 14.998 0A17.933 17.933 0 0 1 12 21.75c-2.676 0-5.216-.584-7.499-1.632Z" />
                                </svg>
                            </span>
                        </div>
                        <x-input-error :messages="$errors->get('name')" class="mt-1" />
                    </div>

                    <!-- Work Email -->
                    <div>
                        <label for="email" class="block text-xs font-semibold uppercase tracking-wider text-slate-500">Work Email</label>
                        <div class="relative mt-1">
                            <input id="email" type="email" name="email" value="{{ old('email') }}" required placeholder="alex@company.com" class="block w-full rounded-lg border-slate-200 py-3 pl-10 text-sm shadow-sm focus:border-[#7FA8BA] focus:ring-[#7FA8BA] border">
                            <span class="absolute inset-y-0 left-3 flex items-center text-slate-400">
                                <svg class="h-4 w-4" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" d="M21.75 6.75v10.5a2.25 2.25 0 0 1-2.25 2.25h-15a2.25 2.25 0 0 1-2.25-2.25V6.75m19.5 0A2.25 2.25 0 0 0 19.5 4.5h-15a2.25 2.25 0 0 0-2.25 2.25m19.5 0v.243a2.25 2.25 0 0 1-1.07 1.916l-7.5 4.615a2.25 2.25 0 0 1-2.36 0L3.32 8.91a2.25 2.25 0 0 1-1.07-1.916V6.75" />
                                </svg>
                            </span>
                        </div>
                        <x-input-error :messages="$errors->get('email')" class="mt-1" />
                    </div>

                    <!-- Password -->
                    <div>
                        <label for="password" class="block text-xs font-semibold uppercase tracking-wider text-slate-500">Password</label>
                        <div class="relative mt-1">
                            <input id="password" type="password" name="password" required placeholder="••••••" class="block w-full rounded-lg border-slate-200 py-3 pl-10 pr-10 text-sm shadow-sm focus:border-[#7FA8BA] focus:ring-[#7FA8BA] border">
                            <span class="absolute inset-y-0 left-3 flex items-center text-slate-400">
                                <svg class="h-4 w-4" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M16.5 10.5V6.75a4.5 4.5 0 1 0-9 0v3.75m-.75 11.25h10.5a2.25 2.25 0 0 0 2.25-2.25v-6.75a2.25 2.25 0 0 0-2.25-2.25H6.75a2.25 2.25 0 0 0-2.25 2.25v6.75a2.25 2.25 0 0 0 2.25 2.25Z" />
                                </svg>
                            </span>
                            <button type="button" onclick="togglePasswordVisibility('password')" class="absolute inset-y-0 right-3 flex items-center text-slate-400 hover:text-slate-600">
                                <svg class="h-4 w-4" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 0 1 0-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178Z" />
                                    <circle cx="12" cy="12" r="3" />
                                </svg>
                            </button>
                        </div>
                        <x-input-error :messages="$errors->get('password')" class="mt-1" />
                    </div>

                    <!-- Confirm Password -->
                    <div>
                        <label for="password_confirmation" class="block text-xs font-semibold uppercase tracking-wider text-slate-500">Confirm Password</label>
                        <div class="relative mt-1">
                            <input id="password_confirmation" type="password" name="password_confirmation" required placeholder="••••••" class="block w-full rounded-lg border-slate-200 py-3 pl-10 pr-10 text-sm shadow-sm focus:border-[#7FA8BA] focus:ring-[#7FA8BA] border">
                            <span class="absolute inset-y-0 left-3 flex items-center text-slate-400">
                                <svg class="h-4 w-4" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M16.5 10.5V6.75a4.5 4.5 0 1 0-9 0v3.75m-.75 11.25h10.5a2.25 2.25 0 0 0 2.25-2.25v-6.75a2.25 2.25 0 0 0-2.25-2.25H6.75a2.25 2.25 0 0 0-2.25 2.25v6.75a2.25 2.25 0 0 0 2.25 2.25Z" />
                                </svg>
                            </span>
                            <button type="button" onclick="togglePasswordVisibility('password_confirmation')" class="absolute inset-y-0 right-3 flex items-center text-slate-400 hover:text-slate-600">
                                <svg class="h-4 w-4" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 0 1 0-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178Z" />
                                    <circle cx="12" cy="12" r="3" />
                                </svg>
                            </button>
                        </div>
                        <x-input-error :messages="$errors->get('password_confirmation')" class="mt-1" />
                    </div>

                    <!-- Terms -->
                    <div class="pt-1">
                        <label for="terms" class="flex items-center gap-2 cursor-pointer">
                            <input id="terms" type="checkbox" name="terms" required class="rounded border-slate-300 text-[#2F5F73] focus:ring-[#7FA8BA]">
                            <span class="text-xs text-slate-500 font-medium">I agree to the Terms of Service and Privacy Policy.</span>
                        </label>
                    </div>

                    <!-- Submit -->
                    <div class="pt-2">
                        <button type="submit" class="w-full inline-flex items-center justify-center gap-2 rounded-lg bg-[#C4D8E2] hover:bg-[#B4CDDA] py-3 text-sm font-bold text-slate-900 transition">
                            Create Account
                            <svg class="h-4 w-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5 21 12m0 0-7.5 7.5M21 12H3" />
                            </svg>
                        </button>
                    </div>

                    <p class="text-center text-xs text-slate-400 pt-1">New users join as Member by default.</p>

                    <p class="text-center text-xs text-slate-500 font-medium pt-2">
                        Already have an account? <a href="{{ route('login') }}" class="font-semibold text-[#2F5F73] hover:underline">Sign in</a>
                    </p>
                </form>
            </div>

            <!-- Footer -->
            <footer class="mt-auto pt-8 flex items-center justify-between text-[11px] text-slate-400 border-t border-slate-100">
                <div class="flex gap-4">
                    <a href="#" class="hover:text-slate-600 transition">Privacy Policy</a>
                    <a href="#" class="hover:text-slate-600 transition">Terms of Service</a>
                </div>
                <span>© 2026 Milestone Productivity Corp</span>
            </footer>
        </main>

        <!-- Right Side: Marketing Pane -->
        <section class="hidden lg:flex lg:w-[45%] bg-[#EEF6FA] flex-col justify-between p-16 min-h-screen">
            <!-- Logo -->
            <div class="flex items-center gap-2 text-slate-900">
                <span class="flex h-6 w-6 items-center justify-center rounded-md bg-[#2F5F73] text-xs font-bold text-white">+</span>
                <span class="text-sm font-bold tracking-tight">Milestone</span>
            </div>

            <!-- Copy -->
            <div class="space-y-4 my-auto max-w-sm">
                <h2 class="text-4xl font-extrabold tracking-tight text-slate-950 leading-tight">
                    Manage every project.<br>Track every task.
                </h2>
                <p class="text-sm leading-6 text-slate-600">
                    One system for your entire project lifecycle — from kickoff to delivery. Experience productivity in its purest form.
                </p>
            </div>

            <!-- Footer -->
            <div class="flex items-center gap-2">
                <div class="flex -space-x-2">
                    <span class="flex h-6 w-6 items-center justify-center rounded-full bg-slate-300 text-[10px] font-bold text-slate-700 ring-2 ring-[#EEF6FA]">A</span>
                    <span class="flex h-6 w-6 items-center justify-center rounded-full bg-[#2F5F73] text-[10px] font-bold text-white ring-2 ring-[#EEF6FA]">B</span>
                </div>
                <span class="text-xs text-slate-500 font-semibold">Join 1,200+ teams worldwide</span>
            </div>
        </section>
    </div>

    <script>
        function togglePasswordVisibility(id) {
            const input = document.getElementById(id);
            if (input.type === 'password') {
                input.type = 'text';
            } else {
                input.type = 'password';
            }
        }
    </script>
</x-guest-layout>
