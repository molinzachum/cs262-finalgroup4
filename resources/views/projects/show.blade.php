<x-app-layout>
    @php
        $project = (object) [
            'name' => 'Website Redesign',
            'description' => 'Refresh the dashboard, navigation, and project management screens.',
            'status' => 'In progress',
            'start_date' => '2026-07-12',
            'due_date' => '2026-07-28',
        ];
    @endphp

    <x-slot name="header">
        <div class="flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
            <div>
                <p class="text-sm font-medium text-slate-600">Project Details</p>
                <h1 class="text-2xl font-bold text-slate-950">{{ $project->name }}</h1>
            </div>
            <a href="{{ route('projects.edit') }}" class="inline-flex items-center justify-center rounded-lg bg-slate-900 px-4 py-2 text-sm font-semibold text-white transition hover:bg-slate-700">Edit Project</a>
        </div>
    </x-slot>

    <div class="grid gap-6 lg:grid-cols-3">
        <section class="rounded-lg border border-slate-200 bg-white p-6 shadow-sm lg:col-span-2">
            <h2 class="text-lg font-semibold text-slate-950">Overview</h2>
            <p class="mt-3 text-sm leading-6 text-slate-600">{{ $project->description ?: 'No description yet.' }}</p>
        </section>
        <aside class="rounded-lg border border-slate-200 bg-white p-6 shadow-sm">
            <dl class="space-y-4 text-sm">
                <div>
                    <dt class="text-slate-500">Status</dt>
                    <dd class="font-semibold text-slate-900">{{ $project->status }}</dd>
                </div>
                <div>
                    <dt class="text-slate-500">Start date</dt>
                    <dd class="font-semibold text-slate-900">{{ $project->start_date ?: 'Not set' }}</dd>
                </div>
                <div>
                    <dt class="text-slate-500">Due date</dt>
                    <dd class="font-semibold text-slate-900">{{ $project->due_date ?: 'Not set' }}</dd>
                </div>
            </dl>
        </aside>
    </div>
</x-app-layout>
