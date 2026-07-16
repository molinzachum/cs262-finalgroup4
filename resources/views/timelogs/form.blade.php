<div class="space-y-5">
    <div>
        <label for="title" class="block text-sm font-semibold text-slate-700">Work title</label>
        <input id="title" name="title" type="text" value="{{ old('title', $timeLog?->title) }}" required class="mt-1 block w-full rounded-lg border-slate-300 shadow-sm focus:border-[#7FA8BA] focus:ring-[#7FA8BA]">
        <x-input-error :messages="$errors->get('title')" class="mt-2" />
    </div>

    <div class="grid gap-4 sm:grid-cols-2">
        <div>
            <label for="project_id" class="block text-sm font-semibold text-slate-700">Project</label>
            <select id="project_id" name="project_id" class="mt-1 block w-full rounded-lg border-slate-300 shadow-sm focus:border-[#7FA8BA] focus:ring-[#7FA8BA]">
                <option value="">No project</option>
                @foreach ($projects as $project)
                    <option value="{{ $project->id }}" @selected((string) old('project_id', $timeLog?->project_id) === (string) $project->id)>{{ $project->name }}</option>
                @endforeach
            </select>
        </div>
        <div>
            <label for="task_id" class="block text-sm font-semibold text-slate-700">Task</label>
            <select id="task_id" name="task_id" class="mt-1 block w-full rounded-lg border-slate-300 shadow-sm focus:border-[#7FA8BA] focus:ring-[#7FA8BA]">
                <option value="">No task</option>
                @foreach ($tasks as $task)
                    <option value="{{ $task->id }}" @selected((string) old('task_id', $timeLog?->task_id) === (string) $task->id)>{{ $task->title }}</option>
                @endforeach
            </select>
        </div>
    </div>

    <div class="grid gap-4 sm:grid-cols-4">
        <div>
            <label for="work_date" class="block text-sm font-semibold text-slate-700">Work date</label>
            <input id="work_date" name="work_date" type="date" value="{{ old('work_date', $timeLog?->work_date) }}" class="mt-1 block w-full rounded-lg border-slate-300 shadow-sm focus:border-[#7FA8BA] focus:ring-[#7FA8BA]">
        </div>
        <div>
            <label for="start_time" class="block text-sm font-semibold text-slate-700">Start</label>
            <input id="start_time" name="start_time" type="time" value="{{ old('start_time', $timeLog?->start_time) }}" class="mt-1 block w-full rounded-lg border-slate-300 shadow-sm focus:border-[#7FA8BA] focus:ring-[#7FA8BA]">
        </div>
        <div>
            <label for="end_time" class="block text-sm font-semibold text-slate-700">End</label>
            <input id="end_time" name="end_time" type="time" value="{{ old('end_time', $timeLog?->end_time) }}" class="mt-1 block w-full rounded-lg border-slate-300 shadow-sm focus:border-[#7FA8BA] focus:ring-[#7FA8BA]">
        </div>
        <div>
            <label for="hours" class="block text-sm font-semibold text-slate-700">Hours</label>
            <input id="hours" name="hours" type="number" min="0" step="0.25" value="{{ old('hours', $timeLog?->hours ?? 0) }}" required class="mt-1 block w-full rounded-lg border-slate-300 shadow-sm focus:border-[#7FA8BA] focus:ring-[#7FA8BA]">
            <x-input-error :messages="$errors->get('hours')" class="mt-2" />
        </div>
    </div>

    <div>
        <label for="notes" class="block text-sm font-semibold text-slate-700">Notes</label>
        <textarea id="notes" name="notes" rows="4" class="mt-1 block w-full rounded-lg border-slate-300 shadow-sm focus:border-[#7FA8BA] focus:ring-[#7FA8BA]">{{ old('notes', $timeLog?->notes) }}</textarea>
    </div>

    <div class="flex items-center gap-3 pt-2">
        <button type="button" class="rounded-lg bg-[#2F5F73] px-4 py-2 text-sm font-semibold text-white hover:bg-[#244B5C]">Save Time Log</button>
        <a href="#" class="rounded-lg border border-[#D6E5EC] px-4 py-2 text-sm font-semibold text-slate-700 hover:bg-[#EEF6FA]">Cancel</a>
    </div>
</div>
@php
    $timeLog = $timeLog ?? null;
    $projects = $projects ?? [
        (object) ['id' => 1, 'name' => 'Website Redesign'],
        (object) ['id' => 2, 'name' => 'Client Portal'],
    ];
    $tasks = $tasks ?? [
        (object) ['id' => 1, 'title' => 'Frontend screens'],
        (object) ['id' => 2, 'title' => 'CRUD form UI'],
    ];
@endphp
