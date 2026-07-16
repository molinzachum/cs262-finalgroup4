<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
            <div>
                <p class="text-sm font-medium text-slate-600">Tracking</p>
                <h1 class="text-2xl font-bold text-slate-950">Time Logs</h1>
            </div>
            <a href="{{ route('timelogs.create') }}" class="inline-flex items-center justify-center rounded-lg bg-slate-900 px-4 py-2 text-sm font-semibold text-white transition hover:bg-slate-700">
                Create Time Log
            </a>
        </div>
    </x-slot>

    @if (session('status'))
        <div class="mb-4 rounded-lg border border-green-200 bg-green-50 px-4 py-3 text-sm text-green-700">{{ session('status') }}</div>
    @endif

    <section class="overflow-hidden rounded-lg border border-slate-200 bg-white shadow-sm">
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-slate-200 text-sm">
                <thead class="bg-slate-50 text-left text-xs font-semibold uppercase text-slate-500">
                    <tr>
                        <th class="px-4 py-3">Work</th>
                        <th class="px-4 py-3">Project</th>
                        <th class="px-4 py-3">Task</th>
                        <th class="px-4 py-3">Date</th>
                        <th class="px-4 py-3">Hours</th>
                        <th class="px-4 py-3 text-right">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    @forelse ($timeLogs as $timeLog)
                        <tr>
                            <td class="px-4 py-4">
                                <p class="font-semibold text-slate-950">{{ $timeLog->title }}</p>
                                <p class="mt-1 max-w-md text-slate-500">{{ $timeLog->notes ?: 'No notes.' }}</p>
                            </td>
                            <td class="px-4 py-4 text-slate-700">{{ $timeLog->project?->name ?: 'No project' }}</td>
                            <td class="px-4 py-4 text-slate-700">{{ $timeLog->task?->title ?: 'No task' }}</td>
                            <td class="px-4 py-4 text-slate-700">{{ $timeLog->work_date ?: 'Not set' }}</td>
                            <td class="px-4 py-4 font-semibold text-slate-900">{{ number_format($timeLog->hours, 2) }}</td>
                            <td class="px-4 py-4">
                                <div class="flex justify-end gap-2">
                                    <a href="{{ route('timelogs.edit', $timeLog) }}" class="rounded-lg border border-slate-200 px-3 py-2 font-semibold text-slate-700 hover:bg-slate-50">Edit</a>
                                    <form method="POST" action="{{ route('timelogs.destroy', $timeLog) }}" onsubmit="return confirm('Delete this time log?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="rounded-lg border border-red-200 px-3 py-2 font-semibold text-red-600 hover:bg-red-50">Delete</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="px-4 py-10 text-center text-slate-500">No time logs yet.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </section>
</x-app-layout>
