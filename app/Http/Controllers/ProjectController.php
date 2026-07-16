<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Project;

class ProjectController extends Controller
{
    // Show all projects
    public function index()
    {
        $query = Project::query();
        if (auth()->user()->role === 1) {
            $query->where('created_by', auth()->id());
        } else {
            $query->whereHas('members', function ($q) {
                $q->where('user_id', auth()->id());
            });
        }
        $projects = $query->with('milestones.tasks')->get();

        return view('projects.index', compact('projects'));
    }

    // Show create project form
    public function create()
    {
        if (auth()->user()->role !== 1) {
            abort(403, 'Unauthorized action.');
        }

        return view('projects.create');
    }

    // Create project
    public function store(Request $request)
    {
        if (auth()->user()->role !== 1) {
            abort(403, 'Unauthorized action.');
        }

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
        // Scope project access: members can only see projects they belong to.
        if (auth()->user()->role !== 1) {
            $isMember = $project->members()->where('user_id', auth()->id())->exists();
            if (!$isMember) {
                abort(403, 'Unauthorized action.');
            }
        }

        $project->load([
            'milestones.tasks',
            'members.user'
        ]);

        return view('projects.show', compact('project'));
    }

    // Show edit project form
    public function edit(Project $project)
    {
        if (auth()->user()->role !== 1) {
            abort(403, 'Unauthorized action.');
        }

        return view('projects.edit', compact('project'));
    }

    // Update project
    public function update(Request $request, Project $project)
    {
        if (auth()->user()->role !== 1) {
            abort(403, 'Unauthorized action.');
        }

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
        if (auth()->user()->role !== 1) {
            abort(403, 'Unauthorized action.');
        }

        $project->delete();

        return redirect('/projects');
    }
}