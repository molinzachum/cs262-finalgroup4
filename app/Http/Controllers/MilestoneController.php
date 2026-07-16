<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Http\Resources\MilestoneResource;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use App\Http\Requests\StoreMilestoneRequest;
use App\Models\Milestone;   

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

    /**
     * Store a newly created milestone in storage.
     */
    public function store(StoreMilestoneRequest $request, Project $project)
    {
        // 1. Retrieve only the validated input data (strips out any malicious/unwanted fields)
        $validated = $request->validated();
        
        // 2. Automatically link this milestone to the parent project from the URL
        $validated['project_id'] = $project->id;
        
        // 3. Create the milestone in MySQL
        $milestone = Milestone::create($validated);
        
        // 4. Load relationship counts so our MilestoneResource doesn't default to 0 tasks incorrectly
        $milestone->loadCount(['tasks', 'completedTasks']);

        // 5. Return the formatted resource with an HTTP 201 Created status code!
        return (new MilestoneResource($milestone))
            ->response()
            ->setStatusCode(201);
    }
}