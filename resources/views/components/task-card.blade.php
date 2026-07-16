@props(['task'])

<div class="bg-white rounded-xl shadow-sm border border-slate-200 p-5 flex flex-col hover:shadow-md transition duration-150 ease-in-out gap-3">
    <a href="{{ route('tasks.show', $task) }}" class="flex-1">
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

        <div class="mt-2">
            <h3 class="font-semibold text-slate-900 leading-snug line-clamp-1">
                {{ $task->title }}
            </h3>
            <p class="mt-1 text-sm text-slate-500 line-clamp-2">
                {{ $task->desc ?? 'No description provided.' }}
            </p>
        </div>
    </a>

    <div class="flex items-center justify-between pt-3 border-t border-slate-100 text-xs">
        <span class="inline-flex items-center rounded-md px-2 py-1 font-medium ring-1 ring-inset {{
            $task->priority === 'High' ? 'bg-red-50 text-red-700 ring-red-600/10' :
            ($task->priority === 'Medium' ? 'bg-amber-50 text-amber-700 ring-amber-600/10' :
            'bg-slate-50 text-slate-700 ring-slate-600/10')
        }}">
            {{ $task->priority ?? 'Medium' }}
        </span>

        <form method="POST" action="{{ route('tasks.update', $task) }}" onclick="event.stopPropagation();">
            @csrf
            @method('PATCH')
            @if($task->status === 'To-do')
                <input type="hidden" name="status" value="In-progress">
                <button type="submit" class="inline-flex items-center rounded-md bg-blue-600 hover:bg-blue-700 px-2.5 py-1 font-semibold text-white transition text-xs">
                    Start
                </button>
            @elseif($task->status === 'In-progress')
                <input type="hidden" name="status" value="Done">
                <button type="submit" class="inline-flex items-center rounded-md bg-green-600 hover:bg-green-700 px-2.5 py-1 font-semibold text-white transition text-xs">
                    Complete
                </button>
            @elseif($task->status === 'Done')
                <input type="hidden" name="status" value="To-do">
                <button type="submit" class="inline-flex items-center rounded-md bg-slate-500 hover:bg-slate-600 px-2.5 py-1 font-semibold text-white transition text-xs">
                    Reopen
                </button>
            @endif
        </form>
    </div>
</div>
