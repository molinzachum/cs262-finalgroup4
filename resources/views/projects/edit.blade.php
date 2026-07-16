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
        <div>
            <p class="text-sm font-medium text-slate-600">Projects</p>
            <h1 class="text-2xl font-bold text-slate-950">Edit Project</h1>
        </div>
    </x-slot>

    <form action="#" class="max-w-3xl rounded-lg border border-[#D6E5EC] bg-white p-6 shadow-sm">
        @include('projects.form', ['project' => $project])
    </form>
</x-app-layout>