<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Http\Resources\MilestoneResource;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class MilestoneController extends Controller
{
    /**
     * Get all milestones for a specific project.
     */
    public function index(Project $project): AnonymousResourceCollection
    {
        // Leverage the Eloquent relationship directly from the project!
        $milestones = $project->milestones()
            ->withCount(['tasks', 'completedTasks'])
            ->orderBy('due_date', 'asc')
            ->get();

        return MilestoneResource::collection($milestones);
    }
}