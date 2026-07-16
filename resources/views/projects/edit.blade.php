<x-app-layout>
    <x-slot name="header">
        <div>
            <p class="text-sm font-medium text-slate-600">Projects</p>
            <h1 class="text-2xl font-bold text-slate-950">Edit Project</h1>
        </div>
    </x-slot>

    <form method="POST" action="{{ route('projects.update', $project) }}" class="max-w-3xl rounded-lg border border-slate-200 bg-white p-6 shadow-sm">
        @csrf
        @method('PATCH')
        @include('projects.form', ['project' => $project])
    </form>
</x-app-layout>
