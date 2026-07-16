<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Project;

class ProjectController extends Controller
{
    // Show all projects
    public function index()
    {
        $projects = Project::with('milestones.tasks')->get();

        return view('projects.index', compact('projects'));
    }

    // Show create project form
    public function create()
    {
        return view('projects.create');
    }

    // Create project
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'status' => 'nullable|string',
            'start_date' => 'nullable|date',
            'end_date' => 'nullable|date'
        ]);

        Project::create([
            'name' => $request->name,
            'description' => $request->description,
            'status' => $request->status ?? 'Active',
            'created_by' => auth()->id(),
            'start_date' => $request->start_date,
            'end_date' => $request->end_date
        ]);

        return redirect('/projects');
    }


    // Show one project
    public function show(Project $project)
    {
        $project->load([
            'milestones.tasks',
            'members.user'
        ]);

        return view('projects.show', compact('project'));
    }

    // Show edit project form
    public function edit(Project $project)
    {
        return view('projects.edit', compact('project'));
    }

    // Update project
    public function update(Request $request, Project $project)
    {
        $this->authorize('update', $project);

        $request->validate([
            'name' => 'string|max:255',
            'description' => 'nullable|string',
            'status' => 'string',
            'start_date' => 'nullable|date',
            'end_date' => 'nullable|date'
        ]);

        $project->update($request->all());

        return redirect('/projects');
    }


    // Delete project
    public function destroy(Project $project)
    {
        $this->authorize('delete', $project);

        $project->delete();

        return redirect('/projects');
    }
}