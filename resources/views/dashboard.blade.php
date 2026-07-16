<x-app-layout>
    @php
        $stats = [
            ['label' => 'Active Projects', 'value' => '6', 'helper' => '2 due this week'],
            ['label' => 'Open Tasks', 'value' => '24', 'helper' => '8 high priority'],
            ['label' => 'Milestones', 'value' => '9', 'helper' => '3 in progress'],
            ['label' => 'Hours Logged', 'value' => '42.5', 'helper' => 'This sprint'],
        ];

        $activities = [
            ['title' => 'Website Redesign updated', 'meta' => 'Project status moved to In progress'],
            ['title' => 'Wireframe Approval created', 'meta' => 'Milestone due July 20'],
            ['title' => 'Project screen layout logged', 'meta' => '2.5 hours added to Time Logs'],
        ];
    @endphp

    <x-slot name="header">
        <div class="flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
            <div>
                <p class="text-sm font-medium text-slate-600">Overview</p>
                <h1 class="text-2xl font-bold text-slate-950">Dashboard</h1>
            </div>
            <a href="#" class="inline-flex items-center justify-center rounded-lg bg-slate-900 px-4 py-2 text-sm font-semibold text-white transition hover:bg-slate-700">
                New Project
            </a>
        </div>
    </x-slot>

    <div class="grid gap-4 md:grid-cols-2 xl:grid-cols-4">
        @foreach ($stats as $stat)
            <section class="rounded-lg border border-slate-200 bg-white p-5 shadow-sm">
                <p class="text-sm font-medium text-slate-500">{{ $stat['label'] }}</p>
                <p class="mt-3 text-3xl font-bold text-slate-950">{{ $stat['value'] }}</p>
                <p class="mt-2 text-sm text-slate-500">{{ $stat['helper'] }}</p>
            </section>
        @endforeach
    </div>

    <div class="mt-6 grid gap-6 xl:grid-cols-[1fr_360px]">
        <section class="rounded-lg border border-slate-200 bg-white p-5 shadow-sm">
            <div class="flex items-center justify-between gap-4">
                <div>
                    <h2 class="text-lg font-semibold text-slate-950">Quick Access</h2>
                    <p class="mt-1 text-sm text-slate-500">Jump into the main project management screens.</p>
                </div>
            </div>

            <div class="mt-5 grid gap-3 sm:grid-cols-2">
                <a href="#" class="rounded-lg border border-slate-200 p-4 transition hover:border-slate-300 hover:bg-slate-50">
                    <p class="font-semibold text-slate-950">Projects</p>
                    <p class="mt-1 text-sm text-slate-500">View, create, edit, and delete projects.</p>
                </a>
                <a href="#" class="rounded-lg border border-slate-200 p-4 transition hover:border-slate-300 hover:bg-slate-50">
                    <p class="font-semibold text-slate-950">Milestones</p>
                    <p class="mt-1 text-sm text-slate-500">Track project checkpoints and due dates.</p>
                </a>
                <a href="{{ route('timelogs.index') }}" class="rounded-lg border border-slate-200 p-4 transition hover:border-slate-300 hover:bg-slate-50">
                    <p class="font-semibold text-slate-950">Time Logs</p>
                    <p class="mt-1 text-sm text-slate-500">Review and add work hours.</p>
                </a>
                <a href="{{ route('team.index') }}" class="rounded-lg border border-slate-200 p-4 transition hover:border-slate-300 hover:bg-slate-50">
                    <p class="font-semibold text-slate-950">Teams</p>
                    <p class="mt-1 text-sm text-slate-500">Manage members and roles.</p>
                </a>
            </div>
        </section>

        <aside class="rounded-lg border border-slate-200 bg-white p-5 shadow-sm">
            <h2 class="text-lg font-semibold text-slate-950">Recent Activity</h2>
            <div class="mt-4 space-y-4">
                @foreach ($activities as $activity)
                    <div class="border-l-4 border-[#C4D8E2] pl-4">
                        <p class="font-semibold text-slate-950">{{ $activity['title'] }}</p>
                        <p class="mt-1 text-sm text-slate-500">{{ $activity['meta'] }}</p>
                    </div>
                @endforeach
            </div>
        </aside>
    </div>
</x-app-layout>
