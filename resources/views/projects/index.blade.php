<x-app-layout>
    @php
        $projects = [
            (object) [
                'name' => 'Website Redesign',
                'status' => 'In progress',
                'description' => 'Refresh the dashboard, navigation, and project management screens.',
                'start_date' => '2026-07-12',
                'due_date' => '2026-07-28',
            ],
            (object) [
                'name' => 'Client Portal',
                'status' => 'Planning',
                'description' => 'Prepare the project area, milestone tracking, and time log forms.',
                'start_date' => '2026-07-16',
                'due_date' => '2026-08-02',
            ],
        ];
    @endphp

    <x-slot name="header">
        <div class="flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
            <div>
                <p class="text-sm font-medium text-slate-600">Projects</p>
                <h1 class="text-2xl font-bold text-slate-950">Project Screen</h1>
            </div>
            <a href="{{ route('projects.create') }}" class="inline-flex items-center justify-center rounded-lg bg-[#2F5F73] px-4 py-2 text-sm font-semibold text-white transition hover:bg-[#244B5C]">
                Create Project
            </a>
        </div>
    </x-slot>

    @if (session('status'))
        <div class="mb-4 rounded-lg border border-green-200 bg-green-50 px-4 py-3 text-sm text-green-700">{{ session('status') }}</div>
    @endif

    <div class="grid gap-4 md:grid-cols-2 xl:grid-cols-3">
        @foreach ($projects as $project)
            <article class="rounded-lg border border-[#D6E5EC] bg-white p-5 shadow-sm">
                <div class="flex items-start justify-between gap-4">
                    <div>
                        <h2 class="text-lg font-semibold text-slate-950">{{ $project->name }}</h2>
                        <p class="mt-1 text-sm text-slate-500">{{ $project->status }}</p>
                    </div>
                    <span class="rounded-full bg-[#C4D8E2] px-3 py-1 text-xs font-semibold text-slate-800">Project</span>
                </div>
                <p class="mt-4 min-h-12 text-sm leading-6 text-slate-600">{{ $project->description ?: 'No description yet.' }}</p>
                <dl class="mt-4 grid grid-cols-2 gap-3 text-sm">
                    <div>
                        <dt class="text-slate-500">Start</dt>
                        <dd class="font-medium text-slate-900">{{ $project->start_date ?: 'Not set' }}</dd>
                    </div>
                    <div>
                        <dt class="text-slate-500">Due</dt>
                        <dd class="font-medium text-slate-900">{{ $project->due_date ?: 'Not set' }}</dd>
                    </div>
                </dl>
                <div class="mt-5 flex items-center gap-2">
                    <a href="#" class="rounded-lg border border-[#D6E5EC] px-3 py-2 text-sm font-semibold text-slate-700 hover:bg-[#EEF6FA]">View</a>
                    <a href="#" class="rounded-lg border border-[#D6E5EC] px-3 py-2 text-sm font-semibold text-slate-700 hover:bg-[#EEF6FA]">Edit</a>
                    <button type="button" class="rounded-lg border border-red-200 px-3 py-2 text-sm font-semibold text-red-600 hover:bg-red-50">Delete</button>
                </div>
            </article>
        @endforeach
    </div>
</x-app-layout>
