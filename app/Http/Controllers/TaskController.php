<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    // Display all tasks
    public function index()
    {
        $tasks = Task::with([
            'assignments.user',
            'creator'
        ])->get();

        return view('tasks.index', compact('tasks'));
    }


    // Create task
    public function store(Request $request)
    {
        $request->validate([
            'project_id' => 'required|exists:projects,id',
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'priority' => 'nullable|string',
            'due_date' => 'nullable|date',
        ]);

        Task::create([
            'project_id' => $request->project_id,
            'title' => $request->title,
            'description' => $request->description,
            'status' => 'To-do',
            'priority' => $request->priority ?? 'Medium',
            'due_date' => $request->due_date,
            'created_by' => auth()->id(),
        ]);

        return redirect('/tasks');
    }


    // Show single task
    public function show(Task $task)
    {
        $task->load([
            'assignments.user',
            'creator'
        ]);

        return view('tasks.show', compact('task'));
    }


    // Update task
    public function update(Request $request, Task $task)
    {
        $request->validate([
            'title' => 'sometimes|string|max:255',
            'description' => 'nullable|string',
            'status' => 'sometimes|in:To-do,In-progress,Done',
            'priority' => 'sometimes|string',
            'due_date' => 'nullable|date',
        ]);


        $task->update([
            'title' => $request->title,
            'description' => $request->description,
            'status' => $request->status,
            'priority' => $request->priority,
            'due_date' => $request->due_date,
        ]);

        return redirect('/tasks');
    }


    // Delete task
    public function destroy(Task $task)
    {
        $task->delete();

        return redirect('/tasks');
    }
}