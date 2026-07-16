<?php

namespace App\Http\Controllers;

use App\Models\TimeLog;
use App\Models\Task;
use Illuminate\Http\Request;

class TimeLogController extends Controller
{
    public function index()
    {
        $logs = TimeLog::with(['task', 'user'])
            ->where('user_id', auth()->id())
            ->orderByDesc('log_date')
            ->get();

        $thisWeek = TimeLog::where('user_id', auth()->id())
            ->whereBetween('log_date', [now()->startOfWeek(), now()->endOfWeek()])
            ->sum('hours_spent');

        return view('timelogs.index', compact('logs', 'thisWeek'));
    }

    public function store(Request $request, Task $task)
    {
        $request->validate([
            'hours_spent' => 'required|numeric|min:0.25',
            'log_date' => 'required|date',
            'notes' => 'nullable|string',
        ]);

        TimeLog::create([
            'task_id' => $task->id,
            'user_id' => auth()->id(),
            'hours_spent' => $request->hours_spent,
            'log_date' => $request->log_date,
            'notes' => $request->notes,
        ]);

        return back()->with('success', 'Time logged.');
    }
}