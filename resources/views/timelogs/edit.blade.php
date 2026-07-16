<x-app-layout>
    @php
        $timeLog = (object) [
            'project_id' => 1,
            'task_id' => 1,
            'title' => 'Project screen layout',
            'work_date' => '2026-07-16',
            'start_time' => '13:00',
            'end_time' => '15:30',
            'hours' => 2.5,
            'notes' => 'Created the list, detail, create, and edit UI states.',
        ];
    @endphp

    <x-slot name="header">
        <div>
            <p class="text-sm font-medium text-slate-600">Tracking</p>
            <h1 class="text-2xl font-bold text-slate-950">Edit Time Log</h1>
        </div>
    </x-slot>

    <form action="#" class="max-w-3xl rounded-lg border border-slate-200 bg-white p-6 shadow-sm">
        @include('timelogs.form', ['timeLog' => $timeLog])
    </form>
</x-app-layout>
