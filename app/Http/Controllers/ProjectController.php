<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Project;

class ProjectController extends Controller
{
    // Show all projects
    public function index()
    {
        $projects = Project::with('tasks')->get();

        return view('projects.index', compact('projects'));
    }
    // Create project
    public function store(Request $request)
    {
        $request->validate([
            'proj_name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'status' => 'nullable|string',
            'start_date' => 'nullable|date',
            'end_date' => 'nullable|date'
        ]);

        Project::create([
            'proj_name' => $request->proj_name,
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
            'tasks',
            'members.user'
        ]);

        return view('projects.show', compact('project'));
    }


    // Update project
    public function update(Request $request, Project $project)
    {
        $request->validate([
            'proj_name' => 'string|max:255',
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
        $project->delete();

        return redirect('/projects');
    }
}