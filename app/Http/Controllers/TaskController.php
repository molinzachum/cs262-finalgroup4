<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;
use App\Models\Milestone;

class TaskController extends Controller
{
    // Display all tasks
    public function index()
    {
        $tasks = Task::whereHas('milestone.project', function ($query) {
            $query->where('created_by', auth()->id())
                ->orWhereHas('members', function ($q) {
                    $q->where('user_id', auth()->id());
                });
        })->with([
            'assignments.user',
            'creator'
        ])->get();

        return view('tasks.index', compact('tasks'));
    }


    // Create task
    public function store(Request $request)
    {
        $request->validate([
            'milestone_id' => 'required|exists:milestones,id',
            'title' => 'required|string|max:255',
            'desc' => 'nullable|string',
            'priority' => 'nullable|string',
            'due_date' => 'nullable|date',
        ]);

        Task::create([
            'milestone_id' => $request->milestone_id,
            'title' => $request->title,
            'desc' => $request->desc,
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
        $this->authorize('update', $task);

        $request->validate([
            'title' => 'sometimes|string|max:255',
            'desc' => 'nullable|string',
            'status' => 'sometimes|in:To-do,In-progress,Done',
            'priority' => 'sometimes|string',
            'due_date' => 'nullable|date',
        ]);


        $task->update([
            'title' => $request->title,
            'desc' => $request->desc,
            'status' => $request->status,
            'priority' => $request->priority,
            'due_date' => $request->due_date,
        ]);

        return redirect('/tasks');
    }


    // Delete task
    public function destroy(Task $task)
    {
        $this->authorize('delete', $task);

        $task->delete();

        return redirect('/tasks');
    }

    public function create()
    {
        $milestones = Milestone::whereHas('project', function ($query) {
            $query->where('created_by', auth()->id())
                ->orWhereHas('members', function ($q) {
                    $q->where('user_id', auth()->id());
                });
        })->get();

        return view('tasks.create', compact('milestones'));
    }

    public function edit(Task $task)
    {
        $this->authorize('update', $task);
        $milestones = Milestone::whereHas('project', function ($query) {
            $query->where('created_by', auth()->id())
                ->orWhereHas('members', function ($q) {
                    $q->where('user_id', auth()->id());
                });
        })->get();

        return view('tasks.edit', compact('task', 'milestones'));
    }
    
}