<?php

namespace App\Policies;

use App\Models\Task;
use App\Models\User;

class TaskPolicy
{
    public function update(User $user, Task $task): bool
    {
        if ($user->role === 1) return true;
        return $task->assignees->contains('id', $user->id);
    }

    public function delete(User $user, Task $task): bool
    {
        return $user->role === 1 || $task->created_by === $user->id;
    }
}