<?php

namespace App\Policies;

use App\Models\Task;
use App\Models\User;

class TaskPolicy
{
    public function update(User $user, Task $task): bool
    {
        // Admins can always update
        if ($user->role === 1) return true;

        // Task creator can update
        if ($task->created_by === $user->id) return true;

        // Assigned users can update
        if ($task->assignees->contains('id', $user->id)) return true;

        // Project members can update
        $project = $task->milestone->project;
        if ($project->members()->where('user_id', $user->id)->exists()) return true;
        if ($project->created_by === $user->id) return true;

        return false;
    }

    public function delete(User $user, Task $task): bool
    {
        return $user->role === 1 || $task->created_by === $user->id;
    }
}