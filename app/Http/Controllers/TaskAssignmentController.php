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
        $this->authorize('update', $task);

        $request->validate([
            'user_id' => 'required|exists:users,id',
        ]);

        // Prevent duplicate assignments
        $alreadyAssigned = TaskAssignment::where('task_id', $task->id)
            ->where('user_id', $request->user_id)
            ->exists();

        if (!$alreadyAssigned) {
            TaskAssignment::create([
                'task_id' => $task->id,
                'user_id' => $request->user_id,
                'assigned_at' => now(),
            ]);
        }

        return redirect()->back();
    }

    // Remove user from task
    public function destroy(TaskAssignment $assignment)
    {
        $this->authorize('update', $assignment->task);

        $assignment->delete();

        return redirect()->back();
    }
}