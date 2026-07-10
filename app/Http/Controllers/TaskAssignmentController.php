<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Models\TaskAssignment;
use Illuminate\Http\Request;

class TaskAssignmentController extends Controller
{
    // Assign user to task
    public function store(Request $request, Task $task)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
        ]);

        TaskAssignment::create([
            'task_id' => $task->id,
            'user_id' => $request->user_id,
            'assigned_at' => now(),
        ]);

        return redirect('/tasks');
    }


    // Remove user from task
    public function destroy(TaskAssignment $assignment)
    {
        $assignment->delete();

        return redirect('/tasks');
    }
}