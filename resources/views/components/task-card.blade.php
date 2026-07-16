@props(['task'])

<a href="{{ route('tasks.show', $task) }}" class="bg-white rounded-xl shadow-sm border border-slate-200 p-5 flex flex-col hover:shadow-md transition duration-150 ease-in-out gap-3">
    <div class="flex items-start justify-between gap-2">
        <span class="text-xs font-semibold text-emerald-600 uppercase tracking-wide">
            {{ $task->project ? $task->project->name : 'No Project' }}
        </span>
        @if($task->due_date)
            <span class="text-xs text-slate-500">
                Due {{ \Carbon\Carbon::parse($task->due_date)->format('M d') }}
            </span>
        @endif
    </div>

    <div class="flex-1">
        <h3 class="font-semibold text-slate-900 leading-snug line-clamp-1">
            {{ $task->title }}
        </h3>
        <p class="mt-1 text-sm text-slate-500 line-clamp-2">
            {{ $task->description ?? 'No description provided.' }}
        </p>
    </div>

    <div class="flex items-center justify-between pt-3 border-t border-slate-100 text-xs">
        <span class="inline-flex items-center rounded-md px-2 py-1 font-medium ring-1 ring-inset {{
            $task->priority === 'High' ? 'bg-red-50 text-red-700 ring-red-600/10' :
            ($task->priority === 'Medium' ? 'bg-amber-50 text-amber-700 ring-amber-600/10' :
            'bg-slate-50 text-slate-700 ring-slate-600/10')
        }}">
            {{ $task->priority ?? 'Medium' }}
        </span>
        <span class="inline-flex items-center rounded-md px-2 py-1 font-medium ring-1 ring-inset {{
            $task->status === 'Done' || $task->status === 'Completed' ? 'bg-green-50 text-green-700 ring-green-600/20' :
            ($task->status === 'In-progress' || $task->status === 'In Progress' ? 'bg-blue-50 text-blue-700 ring-blue-600/20' :
            'bg-slate-50 text-slate-700 ring-slate-600/20')
        }}">
            {{ $task->status ?? 'To-do' }}
        </span>
    </div>
</a>
