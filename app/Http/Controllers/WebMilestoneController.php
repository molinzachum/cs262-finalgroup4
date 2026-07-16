<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Milestone;
use App\Models\Project;

class WebMilestoneController extends Controller
{
    public function index()
    {
        $milestones = Milestone::with('project')->get();
        return view('milestones.index', compact('milestones'));
    }

    public function create()
    {
        $projects = Project::all();
        return view('milestones.create', compact('projects'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'project_id' => 'required|exists:projects,id',
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'status' => 'required|string|in:Not started,In progress,Completed',
            'due_date' => 'nullable|date',
        ]);

        Milestone::create([
            'project_id' => $request->project_id,
            'title' => $request->title,
            'description' => $request->description,
            'status' => $request->status,
            'due_date' => $request->due_date,
        ]);

        return redirect()->route('milestones.index')->with('status', 'Milestone created successfully!');
    }

    public function edit(Milestone $milestone)
    {
        $projects = Project::all();
        return view('milestones.edit', compact('milestone', 'projects'));
    }

    public function update(Request $request, Milestone $milestone)
    {
        $request->validate([
            'project_id' => 'required|exists:projects,id',
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'status' => 'required|string|in:Not started,In progress,Completed',
            'due_date' => 'nullable|date',
        ]);

        $milestone->update([
            'project_id' => $request->project_id,
            'title' => $request->title,
            'description' => $request->description,
            'status' => $request->status,
            'due_date' => $request->due_date,
        ]);

        return redirect()->route('milestones.index')->with('status', 'Milestone updated successfully!');
    }

    public function destroy(Milestone $milestone)
    {
        $milestone->delete();
        return redirect()->route('milestones.index')->with('status', 'Milestone deleted successfully!');
    }
}
