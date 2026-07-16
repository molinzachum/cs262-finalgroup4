<?php

namespace App\Policies;

use App\Models\Project;
use App\Models\User;

class ProjectPolicy
{
    public function update(User $user, Project $project): bool
    {
        return $user->role === 1 || $project->created_by === $user->id;
    }

    public function delete(User $user, Project $project): bool
    {
        return $user->role === 1;
    }
}