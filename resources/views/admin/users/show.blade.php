<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
            <div>
                <p class="text-sm font-medium text-slate-600">Administration</p>
                <h1 class="text-2xl font-bold text-slate-950">User Profile: {{ $user->name }}</h1>
            </div>
            <a href="{{ route('admin.users.index') }}" class="inline-flex items-center justify-center rounded-lg border border-[#D6E5EC] bg-white px-4 py-2 text-sm font-semibold text-slate-700 hover:bg-[#EEF6FA] transition">
                Back to Users
            </a>
        </div>
    </x-slot>

    <div class="grid gap-6 lg:grid-cols-[1fr_320px]">
        <section class="rounded-lg border border-[#D6E5EC] bg-white p-6 shadow-sm">
            <h2 class="text-lg font-semibold text-slate-950 mb-5">Edit Account Details</h2>
            <form method="POST" action="{{ route('admin.users.update', $user) }}" class="space-y-4">
                @csrf
                @method('PATCH')

                <div>
                    <label for="name" class="block text-sm font-semibold text-slate-700">Name</label>
                    <input id="name" type="text" name="name" value="{{ old('name', $user->name) }}" required class="mt-1 block w-full rounded-lg border-slate-300 shadow-sm focus:border-[#7FA8BA] focus:ring-[#7FA8BA] text-sm p-2 border">
                </div>

                <div>
                    <label for="email" class="block text-sm font-semibold text-slate-700">Email Address</label>
                    <input id="email" type="email" name="email" value="{{ old('email', $user->email) }}" required class="mt-1 block w-full rounded-lg border-slate-300 shadow-sm focus:border-[#7FA8BA] focus:ring-[#7FA8BA] text-sm p-2 border">
                </div>

                <div>
                    <label for="role" class="block text-sm font-semibold text-slate-700">Role</label>
                    <select id="role" name="role" required class="mt-1 block w-full rounded-lg border-slate-300 shadow-sm focus:border-[#7FA8BA] focus:ring-[#7FA8BA] text-sm p-2 border bg-white">
                        <option value="0" @selected(old('role', $user->role) == 0)>Member</option>
                        <option value="1" @selected(old('role', $user->role) == 1)>Admin</option>
                    </select>
                </div>

                <div>
                    <label for="dob" class="block text-sm font-semibold text-slate-700">Date of Birth</label>
                    <input id="dob" type="date" name="dob" value="{{ old('dob', $user->dob ? \Carbon\Carbon::parse($user->dob)->format('Y-m-d') : '') }}" class="mt-1 block w-full rounded-lg border-slate-300 shadow-sm focus:border-[#7FA8BA] focus:ring-[#7FA8BA] text-sm p-2 border">
                </div>

                <div>
                    <label for="description" class="block text-sm font-semibold text-slate-700">Description / Biography</label>
                    <textarea id="description" name="description" rows="4" class="mt-1 block w-full rounded-lg border-slate-300 shadow-sm focus:border-[#7FA8BA] focus:ring-[#7FA8BA] text-sm p-2 border">{{ old('description', $user->description) }}</textarea>
                </div>

                <div>
                    <label for="profile_picture" class="block text-sm font-semibold text-slate-700">Profile Picture URL</label>
                    <input id="profile_picture" type="text" name="profile_picture" value="{{ old('profile_picture', $user->profile_picture) }}" class="mt-1 block w-full rounded-lg border-slate-300 shadow-sm focus:border-[#7FA8BA] focus:ring-[#7FA8BA] text-sm p-2 border">
                </div>

                <div class="pt-2">
                    <button type="submit" class="rounded-lg bg-[#2F5F73] px-4 py-2 text-sm font-semibold text-white hover:bg-[#244B5C]">Save Changes</button>
                </div>
            </form>
        </section>

        <aside class="space-y-6">
            <!-- Account Info card -->
            <div class="rounded-lg border border-[#D6E5EC] bg-white p-5 shadow-sm text-center">
                <span class="flex h-20 w-20 items-center justify-center rounded-full bg-[#C4D8E2] text-2xl font-bold text-slate-800 mx-auto">
                    {{ strtoupper(substr($user->name, 0, 1)) }}
                </span>
                <h3 class="mt-3 text-lg font-semibold text-slate-950">{{ $user->name }}</h3>
                <p class="text-sm text-slate-500">{{ $user->email }}</p>
                <div class="mt-4 border-t border-slate-100 pt-4 text-left text-xs space-y-2">
                    <p class="text-slate-500">Account ID: <span class="font-medium text-slate-900">{{ $user->id }}</span></p>
                    <p class="text-slate-500">Joined: <span class="font-medium text-slate-900">{{ $user->created_at ? $user->created_at->format('Y-m-d') : 'N/A' }}</span></p>
                </div>
            </div>

            <!-- Danger Zone -->
            <div class="rounded-lg border border-red-200 bg-red-50/50 p-5 shadow-sm">
                <h3 class="text-sm font-bold text-red-900">Danger Zone</h3>
                <p class="mt-1 text-xs text-red-700">Deleting this account is permanent and cannot be undone.</p>
                <form method="POST" action="{{ route('admin.users.destroy', $user) }}" onsubmit="return confirm('Are you sure you want to permanently delete this user account?');" class="mt-4">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="w-full rounded-lg bg-red-600 px-4 py-2 text-sm font-semibold text-white hover:bg-red-700 transition">Delete Account</button>
                </form>
            </div>
        </aside>
    </div>
</x-app-layout>