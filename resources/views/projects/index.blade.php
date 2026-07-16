<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
            <div>
                <p class="text-sm font-medium text-slate-600">Projects</p>
                <h1 class="text-2xl font-bold text-slate-950">Project Screen</h1>
            </div>
            <a href="{{ route('projects.create') }}" class="inline-flex items-center justify-center rounded-lg bg-slate-900 px-4 py-2 text-sm font-semibold text-white transition hover:bg-slate-700">
                Create Project
            </a>
        </div>
    </x-slot>

    @if (session('status'))
        <div class="mb-4 rounded-lg border border-green-200 bg-green-50 px-4 py-3 text-sm text-green-700">{{ session('status') }}</div>
    @endif

    <div class="grid gap-4 md:grid-cols-2 xl:grid-cols-3">
        @forelse ($projects as $project)
            <article class="rounded-lg border border-slate-200 bg-white p-5 shadow-sm">
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
                    <a href="{{ route('projects.show', $project) }}" class="rounded-lg border border-slate-200 px-3 py-2 text-sm font-semibold text-slate-700 hover:bg-slate-50">View</a>
                    <a href="{{ route('projects.edit', $project) }}" class="rounded-lg border border-slate-200 px-3 py-2 text-sm font-semibold text-slate-700 hover:bg-slate-50">Edit</a>
                    <form method="POST" action="{{ route('projects.destroy', $project) }}" onsubmit="return confirm('Delete this project?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="rounded-lg border border-red-200 px-3 py-2 text-sm font-semibold text-red-600 hover:bg-red-50">Delete</button>
                    </form>
                </div>
            </article>
        @empty
            <section class="rounded-lg border border-dashed border-slate-300 bg-white p-8 text-center md:col-span-2 xl:col-span-3">
                <h2 class="text-lg font-semibold text-slate-950">No projects yet</h2>
                <p class="mt-2 text-sm text-slate-600">Create the first project to start tracking tasks and milestones.</p>
            </section>
        @endforelse
    </div>
</x-app-layout>
