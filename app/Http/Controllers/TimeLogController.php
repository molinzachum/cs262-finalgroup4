<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\Task;
use App\Models\TimeLog;
use Illuminate\Http\Request;

class TimeLogController extends Controller
{
    public function index()
    {
        $timeLogs = TimeLog::with(['project', 'task'])->latest('work_date')->latest()->get();

        return view('timelogs.index', compact('timeLogs'));
    }

    public function create()
    {
        return view('timelogs.create', $this->formData());
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'project_id' => 'nullable|exists:projects,id',
            'task_id' => 'nullable|exists:tasks,id',
            'title' => 'required|string|max:255',
            'work_date' => 'nullable|date',
            'start_time' => 'nullable',
            'end_time' => 'nullable',
            'hours' => 'required|numeric|min:0|max:999.99',
            'notes' => 'nullable|string',
        ]);

        $data['created_by'] = auth()->id();

        TimeLog::create($data);

        return redirect()->route('timelogs.index')->with('status', 'Time log created.');
    }

    public function edit(TimeLog $timelog)
    {
        return view('timelogs.edit', array_merge(
            ['timeLog' => $timelog],
            $this->formData()
        ));
    }

    public function update(Request $request, TimeLog $timelog)
    {
        $data = $request->validate([
            'project_id' => 'nullable|exists:projects,id',
            'task_id' => 'nullable|exists:tasks,id',
            'title' => 'required|string|max:255',
            'work_date' => 'nullable|date',
            'start_time' => 'nullable',
            'end_time' => 'nullable',
            'hours' => 'required|numeric|min:0|max:999.99',
            'notes' => 'nullable|string',
        ]);

        $timelog->update($data);

        return redirect()->route('timelogs.index')->with('status', 'Time log updated.');
    }

    public function destroy(TimeLog $timelog)
    {
        $timelog->delete();

        return redirect()->route('timelogs.index')->with('status', 'Time log deleted.');
    }

    private function formData(): array
    {
        return [
            'projects' => Project::orderBy('name')->get(),
            'tasks' => Task::orderBy('title')->get(),
        ];
    }
}
