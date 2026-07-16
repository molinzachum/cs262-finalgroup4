<x-app-layout>
    @php
        $members = [
            ['name' => 'Reaksa Chor', 'role' => 'Frontend', 'email' => 'reaksa@example.com', 'status' => 'Active'],
            ['name' => 'Tra', 'role' => 'Projects and milestones', 'email' => 'tra@example.com', 'status' => 'Active'],
            ['name' => 'Sopheaktra Ngo', 'role' => 'Reviewer', 'email' => 'sopheaktra@example.com', 'status' => 'Pending'],
        ];
    @endphp

    <x-slot name="header">
        <div class="flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
            <div>
                <p class="text-sm font-medium text-slate-600">Workspace</p>
                <h1 class="text-2xl font-bold text-slate-950">Teams</h1>
            </div>
            <button type="button" class="inline-flex items-center justify-center rounded-lg bg-slate-900 px-4 py-2 text-sm font-semibold text-white transition hover:bg-slate-700">
                Invite Member
            </button>
        </div>
    </x-slot>

    <div class="grid gap-6 xl:grid-cols-[1fr_360px]">
        <section class="overflow-hidden rounded-lg border border-slate-200 bg-white shadow-sm">
            <div class="border-b border-slate-200 px-5 py-4">
                <h2 class="text-lg font-semibold text-slate-950">Team Members</h2>
                <p class="mt-1 text-sm text-slate-500">Frontend-only view for managing team access and roles.</p>
            </div>

            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-slate-200 text-sm">
                    <thead class="bg-slate-50 text-left text-xs font-semibold uppercase text-slate-500">
                        <tr>
                            <th class="px-5 py-3">Member</th>
                            <th class="px-5 py-3">Role</th>
                            <th class="px-5 py-3">Status</th>
                            <th class="px-5 py-3 text-right">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100">
                        @foreach ($members as $member)
                            <tr>
                                <td class="px-5 py-4">
                                    <div class="flex items-center gap-3">
                                        <span class="flex h-10 w-10 items-center justify-center rounded-lg bg-[#C4D8E2] text-sm font-bold text-slate-800">
                                            {{ strtoupper(substr($member['name'], 0, 1)) }}
                                        </span>
                                        <div>
                                            <p class="font-semibold text-slate-950">{{ $member['name'] }}</p>
                                            <p class="text-slate-500">{{ $member['email'] }}</p>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-5 py-4 text-slate-700">{{ $member['role'] }}</td>
                                <td class="px-5 py-4">
                                    <span class="rounded-full bg-[#C4D8E2] px-3 py-1 text-xs font-semibold text-slate-800">{{ $member['status'] }}</span>
                                </td>
                                <td class="px-5 py-4">
                                    <div class="flex justify-end gap-2">
                                        <button type="button" class="rounded-lg border border-slate-200 px-3 py-2 font-semibold text-slate-700 hover:bg-slate-50">Edit</button>
                                        <button type="button" class="rounded-lg border border-red-200 px-3 py-2 font-semibold text-red-600 hover:bg-red-50">Remove</button>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </section>

        <aside class="rounded-lg border border-slate-200 bg-white p-5 shadow-sm">
            <h2 class="text-lg font-semibold text-slate-950">Invite Form</h2>
            <div class="mt-5 space-y-4">
                <div>
                    <label for="invite_email" class="block text-sm font-semibold text-slate-700">Email</label>
                    <input id="invite_email" type="email" placeholder="member@example.com" class="mt-1 block w-full rounded-lg border-slate-300 shadow-sm focus:border-slate-500 focus:ring-slate-500">
                </div>
                <div>
                    <label for="invite_role" class="block text-sm font-semibold text-slate-700">Role</label>
                    <select id="invite_role" class="mt-1 block w-full rounded-lg border-slate-300 shadow-sm focus:border-slate-500 focus:ring-slate-500">
                        <option>Frontend</option>
                        <option>Backend</option>
                        <option>Reviewer</option>
                        <option>Admin</option>
                    </select>
                </div>
                <button type="button" class="w-full rounded-lg bg-slate-900 px-4 py-2 text-sm font-semibold text-white hover:bg-slate-700">Send Invite</button>
            </div>
        </aside>
    </div>
</x-app-layout>
