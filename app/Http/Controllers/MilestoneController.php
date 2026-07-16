<?php

namespace App\Http\Controllers;

use App\Models\Milestone;
use App\Models\Project;
use Illuminate\Http\Request;

class MilestoneController extends Controller
{
    public function index()
    {
        $milestones = Milestone::with('project')->latest()->get();

        return view('milestones.index', compact('milestones'));
    }

    public function create()
    {
        $projects = Project::orderBy('name')->get();

        return view('milestones.create', compact('projects'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'project_id' => 'nullable|exists:projects,id',
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'status' => 'required|string|max:255',
            'due_date' => 'nullable|date',
        ]);

        Milestone::create($data);

        return redirect()->route('milestones.index')->with('status', 'Milestone created.');
    }

    public function edit(Milestone $milestone)
    {
        $projects = Project::orderBy('name')->get();

        return view('milestones.edit', compact('milestone', 'projects'));
    }

    public function update(Request $request, Milestone $milestone)
    {
        $data = $request->validate([
            'project_id' => 'nullable|exists:projects,id',
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'status' => 'required|string|max:255',
            'due_date' => 'nullable|date',
        ]);

        $milestone->update($data);

        return redirect()->route('milestones.index')->with('status', 'Milestone updated.');
    }

    public function destroy(Milestone $milestone)
    {
        $milestone->delete();

        return redirect()->route('milestones.index')->with('status', 'Milestone deleted.');
    }
}
