<div class="space-y-5">
    <div>
        <label for="name" class="block text-sm font-semibold text-slate-700">Project name</label>
        <input id="name" name="name" type="text" value="{{ old('name', $project?->name) }}" required class="mt-1 block w-full rounded-lg border-slate-300 shadow-sm focus:border-[#7FA8BA] focus:ring-[#7FA8BA] text-sm p-2 border">
        <x-input-error :messages="$errors->get('name')" class="mt-2" />
    </div>

    <div>
        <label for="description" class="block text-sm font-semibold text-slate-700">Description</label>
        <textarea id="description" name="description" rows="4" class="mt-1 block w-full rounded-lg border-slate-300 shadow-sm focus:border-[#7FA8BA] focus:ring-[#7FA8BA] text-sm p-2 border">{{ old('description', $project?->description) }}</textarea>
        <x-input-error :messages="$errors->get('description')" class="mt-2" />
    </div>

    <div class="grid gap-4 sm:grid-cols-3">
        <div>
            <label for="status" class="block text-sm font-semibold text-slate-700">Status</label>
            <select id="status" name="status" required class="mt-1 block w-full rounded-lg border-slate-300 shadow-sm focus:border-[#7FA8BA] focus:ring-[#7FA8BA] text-sm p-2 border">
                @foreach (['Planning', 'In progress', 'On hold', 'Completed'] as $status)
                    <option value="{{ $status }}" @selected(old('status', $project?->status ?? 'Planning') === $status)>{{ $status }}</option>
                @endforeach
            </select>
            <x-input-error :messages="$errors->get('status')" class="mt-2" />
        </div>
        <div>
            <label for="start_date" class="block text-sm font-semibold text-slate-700">Start date</label>
            <input id="start_date" name="start_date" type="date" value="{{ old('start_date', $project?->start_date ? \Carbon\Carbon::parse($project->start_date)->format('Y-m-d') : '') }}" class="mt-1 block w-full rounded-lg border-slate-300 shadow-sm focus:border-[#7FA8BA] focus:ring-[#7FA8BA] text-sm p-2 border">
            <x-input-error :messages="$errors->get('start_date')" class="mt-2" />
        </div>
        <div>
            <label for="end_date" class="block text-sm font-semibold text-slate-700">Due date</label>
            <input id="end_date" name="end_date" type="date" value="{{ old('end_date', $project?->end_date ? \Carbon\Carbon::parse($project->end_date)->format('Y-m-d') : '') }}" class="mt-1 block w-full rounded-lg border-slate-300 shadow-sm focus:border-[#7FA8BA] focus:ring-[#7FA8BA] text-sm p-2 border">
            <x-input-error :messages="$errors->get('end_date')" class="mt-2" />
        </div>
    </div>

    <div class="flex items-center gap-3 pt-2">
        <button type="submit" class="rounded-lg bg-[#2F5F73] px-4 py-2 text-sm font-semibold text-white hover:bg-[#244B5C]">Save Project</button>
        <a href="{{ route('projects.index') }}" class="rounded-lg border border-[#D6E5EC] px-4 py-2 text-sm font-semibold text-slate-700 hover:bg-[#EEF6FA]">Cancel</a>
    </div>
</div>
