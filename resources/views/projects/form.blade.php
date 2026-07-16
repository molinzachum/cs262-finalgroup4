@php
    $project = $project ?? null;
@endphp

<div class="space-y-5">
    <div>
        <label for="name" class="block text-sm font-semibold text-slate-700">Project name</label>
        <input id="name" name="name" type="text" value="{{ old('name', $project?->name) }}" required class="mt-1 block w-full rounded-lg border-slate-300 shadow-sm focus:border-slate-500 focus:ring-slate-500">
        <x-input-error :messages="$errors->get('name')" class="mt-2" />
    </div>

    <div>
        <label for="description" class="block text-sm font-semibold text-slate-700">Description</label>
        <textarea id="description" name="description" rows="4" class="mt-1 block w-full rounded-lg border-slate-300 shadow-sm focus:border-slate-500 focus:ring-slate-500">{{ old('description', $project?->description) }}</textarea>
        <x-input-error :messages="$errors->get('description')" class="mt-2" />
    </div>

    <div class="grid gap-4 sm:grid-cols-3">
        <div>
            <label for="status" class="block text-sm font-semibold text-slate-700">Status</label>
            <select id="status" name="status" class="mt-1 block w-full rounded-lg border-slate-300 shadow-sm focus:border-slate-500 focus:ring-slate-500">
                @foreach (['Planning', 'In progress', 'On hold', 'Completed'] as $status)
                    <option value="{{ $status }}" @selected(old('status', $project?->status ?? 'Planning') === $status)>{{ $status }}</option>
                @endforeach
            </select>
        </div>
        <div>
            <label for="start_date" class="block text-sm font-semibold text-slate-700">Start date</label>
            <input id="start_date" name="start_date" type="date" value="{{ old('start_date', $project?->start_date) }}" class="mt-1 block w-full rounded-lg border-slate-300 shadow-sm focus:border-slate-500 focus:ring-slate-500">
        </div>
        <div>
            <label for="due_date" class="block text-sm font-semibold text-slate-700">Due date</label>
            <input id="due_date" name="due_date" type="date" value="{{ old('due_date', $project?->due_date) }}" class="mt-1 block w-full rounded-lg border-slate-300 shadow-sm focus:border-slate-500 focus:ring-slate-500">
        </div>
    </div>

    <div class="flex items-center gap-3 pt-2">
        <button type="button" class="rounded-lg bg-slate-900 px-4 py-2 text-sm font-semibold text-white hover:bg-slate-700">Save Project</button>
        <a href="{{ route('projects.index') }}" class="rounded-lg border border-slate-200 px-4 py-2 text-sm font-semibold text-slate-700 hover:bg-slate-50">Cancel</a>
    </div>
</div>
