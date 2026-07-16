<x-app-layout>
    @php
        $users = \App\Models\User::all();
    @endphp

    <x-slot name="header">
        <div class="flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
            <div>
                <p class="text-sm font-medium text-slate-600">Tasks</p>
                <h1 class="text-2xl font-bold text-slate-950">{{ $task->title }}</h1>
            </div>
            <div class="flex items-center gap-2">
                <a href="{{ route('tasks.index') }}" class="inline-flex items-center justify-center rounded-lg border border-[#D6E5EC] bg-white px-4 py-2 text-sm font-semibold text-slate-700 hover:bg-[#EEF6FA] transition">
                    Back to Tasks
                </a>
                @can('update', $task)
                    <form method="POST" action="{{ route('tasks.update', $task) }}" class="inline">
                        @csrf
                        @method('PATCH')
                        @if($task->status === 'To-do')
                            <input type="hidden" name="status" value="In-progress">
                            <button type="submit" class="inline-flex items-center justify-center rounded-lg bg-blue-600 hover:bg-blue-700 px-4 py-2 text-sm font-semibold text-white transition">Start Task</button>
                        @elseif($task->status === 'In-progress')
                            <input type="hidden" name="status" value="Done">
                            <button type="submit" class="inline-flex items-center justify-center rounded-lg bg-green-600 hover:bg-green-700 px-4 py-2 text-sm font-semibold text-white transition">Complete Task</button>
                        @elseif($task->status === 'Done')
                            <input type="hidden" name="status" value="To-do">
                            <button type="submit" class="inline-flex items-center justify-center rounded-lg bg-slate-600 hover:bg-slate-700 px-4 py-2 text-sm font-semibold text-white transition">Reopen Task</button>
                        @endif
                    </form>

                    <a href="{{ route('tasks.edit', $task) }}" class="inline-flex items-center justify-center rounded-lg bg-[#2F5F73] px-4 py-2 text-sm font-semibold text-white hover:bg-[#244B5C] transition flex-shrink-0">
                        Edit Task
                    </a>
                @endcan
            </div>
        </div>
    </x-slot>

    <div class="grid gap-6 lg:grid-cols-[1fr_320px]">
        <main class="space-y-6">
            <!-- Details Card -->
            <section class="rounded-lg border border-[#D6E5EC] bg-white p-6 shadow-sm">
                <div class="flex flex-wrap items-center gap-3 mb-6">
                    <span class="rounded-full px-2.5 py-0.5 text-xs font-semibold ring-1 ring-inset {{
                        $task->status === 'Done' ? 'bg-green-50 text-green-700 ring-green-600/20' : 
                        ($task->status === 'In-progress' ? 'bg-blue-50 text-blue-700 ring-blue-600/20' : 'bg-slate-50 text-slate-700 ring-slate-600/20')
                    }}">
                        {{ $task->status }}
                    </span>
                    <span class="rounded-full px-2.5 py-0.5 text-xs font-semibold ring-1 ring-inset {{
                        $task->priority === 'High' ? 'bg-red-50 text-red-700 ring-red-600/20' : 
                        ($task->priority === 'Medium' ? 'bg-amber-50 text-amber-700 ring-amber-600/20' : 'bg-slate-50 text-slate-700 ring-slate-600/20')
                    }}">
                        {{ $task->priority }} Priority
                    </span>
                </div>

                <h2 class="text-lg font-semibold text-slate-950 mb-3">Description</h2>
                <div class="text-sm leading-6 text-slate-600 whitespace-pre-line">
                    {{ $task->desc ?: 'No description provided.' }}
                </div>

                <div class="mt-6 border-t border-slate-100 pt-6 grid grid-cols-2 gap-4 text-sm">
                    <div>
                        <p class="text-slate-500">Milestone</p>
                        <p class="mt-1 font-semibold text-slate-900">{{ $task->milestone->title }}</p>
                    </div>
                    <div>
                        <p class="text-slate-500">Due Date</p>
                        <p class="mt-1 font-semibold text-slate-900">{{ $task->due_date ? \Carbon\Carbon::parse($task->due_date)->format('Y-m-d') : 'Not set' }}</p>
                    </div>
                </div>
            </section>
        </main>

        <aside class="space-y-6">
            <!-- Creator Info -->
            <div class="rounded-lg border border-[#D6E5EC] bg-white p-5 shadow-sm">
                <h3 class="text-sm font-semibold text-slate-500">Created By</h3>
                <div class="flex items-center gap-3 mt-3">
                    <span class="flex h-8 w-8 items-center justify-center rounded-lg bg-[#C4D8E2] text-xs font-bold text-slate-800">
                        {{ strtoupper(substr($task->creator->name, 0, 1)) }}
                    </span>
                    <div>
                        <p class="text-sm font-semibold text-slate-900">{{ $task->creator->name }}</p>
                        <p class="text-xs text-slate-500">{{ $task->creator->email }}</p>
                    </div>
                </div>
            </div>

            <!-- Assignees -->
            <div class="rounded-lg border border-[#D6E5EC] bg-white p-5 shadow-sm">
                <h3 class="text-sm font-bold text-slate-950">Assignees</h3>
                <div class="mt-4 space-y-3">
                    @forelse ($task->assignments as $assignment)
                        <div class="flex items-center justify-between gap-3 text-sm">
                            <div class="flex items-center gap-2">
                                <span class="flex h-7 w-7 items-center justify-center rounded-lg bg-slate-100 text-xs font-semibold text-slate-700">
                                    {{ strtoupper(substr($assignment->user->name, 0, 1)) }}
                                </span>
                                <span class="font-medium text-slate-900">{{ $assignment->user->name }}</span>
                            </div>
                            <form method="POST" action="/task-assignment/{{ $assignment->id }}" onsubmit="return confirm('Remove user from task?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-xs font-semibold text-red-600 hover:text-red-800 transition">Remove</button>
                            </form>
                        </div>
                    @empty
                        <p class="text-xs text-slate-400">No users assigned to this task.</p>
                    @endforelse
                </div>

                <!-- Assign User Form -->
                <div class="mt-5 pt-4 border-t border-slate-100">
                    <h4 class="text-xs font-bold text-slate-700 uppercase tracking-wider mb-2">Assign User</h4>
                    <form method="POST" action="/tasks/{{ $task->id }}/assign" class="flex gap-2">
                        @csrf
                        <select name="user_id" required class="block w-full rounded-lg border-slate-300 shadow-sm focus:border-[#7FA8BA] focus:ring-[#7FA8BA] text-xs p-1.5 border bg-white">
                            <option value="">-- Select User --</option>
                            @foreach($users as $user)
                                <option value="{{ $user->id }}">{{ $user->name }}</option>
                            @endforeach
                        </select>
                        <button type="submit" class="rounded-lg bg-slate-900 text-white px-3 py-1.5 text-xs font-semibold hover:bg-slate-800 transition">
                            Add
                        </button>
                    </form>
                </div>
            </div>

            <!-- Danger Zone -->
            @can('delete', $task)
                <div class="rounded-lg border border-red-200 bg-red-50/50 p-5 shadow-sm">
                    <h3 class="text-sm font-bold text-red-900">Danger Zone</h3>
                    <p class="mt-1 text-xs text-red-700">Permanently delete this task.</p>
                    <form method="POST" action="{{ route('tasks.destroy', $task) }}" onsubmit="return confirm('Are you sure you want to permanently delete this task?');" class="mt-4">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="w-full rounded-lg bg-red-600 px-4 py-2 text-sm font-semibold text-white hover:bg-red-700 transition">
                            Delete Task
                        </button>
                    </form>
                </div>
            @endcan
        </aside>
    </div>
</x-app-layout>