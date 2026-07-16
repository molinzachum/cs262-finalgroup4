@php
    $milestone = $milestone ?? null;
    $projects = $projects ?? [
        (object) ['id' => 1, 'name' => 'Website Redesign'],
        (object) ['id' => 2, 'name' => 'Client Portal'],
    ];
@endphp

<div class="space-y-5">
    <div>
        <label for="project_id" class="block text-sm font-semibold text-slate-700">Project</label>
        <select id="project_id" name="project_id" class="mt-1 block w-full rounded-lg border-slate-300 shadow-sm focus:border-slate-500 focus:ring-slate-500">
            <option value="">No project</option>
            @foreach ($projects as $project)
                <option value="{{ $project->id }}" @selected((string) old('project_id', $milestone?->project_id) === (string) $project->id)>{{ $project->name }}</option>
            @endforeach
        </select>
        <x-input-error :messages="$errors->get('project_id')" class="mt-2" />
    </div>

    <div>
        <label for="title" class="block text-sm font-semibold text-slate-700">Milestone title</label>
        <input id="title" name="title" type="text" value="{{ old('title', $milestone?->title) }}" required class="mt-1 block w-full rounded-lg border-slate-300 shadow-sm focus:border-slate-500 focus:ring-slate-500">
        <x-input-error :messages="$errors->get('title')" class="mt-2" />
    </div>

    <div>
        <label for="description" class="block text-sm font-semibold text-slate-700">Description</label>
        <textarea id="description" name="description" rows="4" class="mt-1 block w-full rounded-lg border-slate-300 shadow-sm focus:border-slate-500 focus:ring-slate-500">{{ old('description', $milestone?->description) }}</textarea>
    </div>

    <div class="grid gap-4 sm:grid-cols-2">
        <div>
            <label for="status" class="block text-sm font-semibold text-slate-700">Status</label>
            <select id="status" name="status" class="mt-1 block w-full rounded-lg border-slate-300 shadow-sm focus:border-slate-500 focus:ring-slate-500">
                @foreach (['Not started', 'In progress', 'Completed'] as $status)
                    <option value="{{ $status }}" @selected(old('status', $milestone?->status ?? 'Not started') === $status)>{{ $status }}</option>
                @endforeach
            </select>
        </div>
        <div>
            <label for="due_date" class="block text-sm font-semibold text-slate-700">Due date</label>
            <input id="due_date" name="due_date" type="date" value="{{ old('due_date', $milestone?->due_date) }}" class="mt-1 block w-full rounded-lg border-slate-300 shadow-sm focus:border-slate-500 focus:ring-slate-500">
        </div>
    </div>

    <div class="flex items-center gap-3 pt-2">
        <button type="button" class="rounded-lg bg-slate-900 px-4 py-2 text-sm font-semibold text-white hover:bg-slate-700">Save Milestone</button>
        <a href="{{ route('milestones.index') }}" class="rounded-lg border border-slate-200 px-4 py-2 text-sm font-semibold text-slate-700 hover:bg-slate-50">Cancel</a>
    </div>
</div>
