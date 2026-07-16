<x-app-layout>
    @php
        $timeLogs = [
            (object) [
                'title' => 'Project screen layout',
                'notes' => 'Created the list, detail, create, and edit UI states.',
                'project' => (object) ['name' => 'Website Redesign'],
                'task' => (object) ['title' => 'Frontend screens'],
                'work_date' => '2026-07-16',
                'hours' => 2.5,
            ],
            (object) [
                'title' => 'Milestone form review',
                'notes' => 'Checked fields for status, project, and due date.',
                'project' => (object) ['name' => 'Client Portal'],
                'task' => (object) ['title' => 'CRUD form UI'],
                'work_date' => '2026-07-17',
                'hours' => 1.25,
            ],
        ];
    @endphp

    <x-slot name="header">
        <div class="flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
            <div>
                <p class="text-sm font-medium text-slate-600">Tracking</p>
                <h1 class="text-2xl font-bold text-slate-950">Time Logs</h1>
            </div>
            <a href="#" class="inline-flex items-center justify-center rounded-lg bg-slate-900 px-4 py-2 text-sm font-semibold text-white transition hover:bg-slate-700">
                Create Time Log
            </a>
        </div>
    </x-slot>

    @if (session('status'))
        <div class="mb-4 rounded-lg border border-green-200 bg-green-50 px-4 py-3 text-sm text-green-700">{{ session('status') }}</div>
    @endif

    <section class="overflow-hidden rounded-lg border border-slate-200 bg-white shadow-sm">
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-slate-200 text-sm">
                <thead class="bg-slate-50 text-left text-xs font-semibold uppercase text-slate-500">
                    <tr>
                        <th class="px-4 py-3">Work</th>
                        <th class="px-4 py-3">Project</th>
                        <th class="px-4 py-3">Task</th>
                        <th class="px-4 py-3">Date</th>
                        <th class="px-4 py-3">Hours</th>
                        <th class="px-4 py-3 text-right">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    @foreach ($timeLogs as $timeLog)
                        <tr>
                            <td class="px-4 py-4">
                                <p class="font-semibold text-slate-950">{{ $timeLog->title }}</p>
                                <p class="mt-1 max-w-md text-slate-500">{{ $timeLog->notes ?: 'No notes.' }}</p>
                            </td>
                            <td class="px-4 py-4 text-slate-700">{{ $timeLog->project?->name ?: 'No project' }}</td>
                            <td class="px-4 py-4 text-slate-700">{{ $timeLog->task?->title ?: 'No task' }}</td>
                            <td class="px-4 py-4 text-slate-700">{{ $timeLog->work_date ?: 'Not set' }}</td>
                            <td class="px-4 py-4 font-semibold text-slate-900">{{ number_format($timeLog->hours, 2) }}</td>
                            <td class="px-4 py-4">
                                <div class="flex justify-end gap-2">
                                    <a href="#" class="rounded-lg border border-slate-200 px-3 py-2 font-semibold text-slate-700 hover:bg-slate-50">Edit</a>
                                    <button type="button" class="rounded-lg border border-red-200 px-3 py-2 font-semibold text-red-600 hover:bg-red-50">Delete</button>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </section>
</x-app-layout>
