<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\ProjectMember;
use Illuminate\Http\Request;

class ProjectMemberController extends Controller
{
    // Show all members in a project
 public function index(Request $request, Project $project = null)
{
    if (!$project || !$project->exists) {
        $project = Project::first();
    }

    $search = $request->search;

    if (!$project) {
        return view('team.index', [
            'project' => null,
            'members' => collect(),
            'search' => $search
        ]);
    }

    $members = $project->members()
        ->with([
            'user.taskAssignments.task'
        ])
        ->when($search, function ($query) use ($search) {

            $query->whereHas('user', function ($userQuery) use ($search) {

                $userQuery->where('name', 'like', "%{$search}%")
                    ->orWhere('email', 'like', "%{$search}%");

            });

        })
        ->get();


    return view('team.index', compact('project', 'members', 'search'));
}

    // Add member to project
    public function store(Request $request, Project $project)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'member_role' => 'required|string|max:255',
        ]);

        ProjectMember::create([
            'project_id' => $project->id,
            'user_id' => $request->user_id,
            'member_role' => $request->member_role,
            'joined_date' => now(),
        ]);

        return redirect()->back();
    }

    // Update member role
    public function update(Request $request, ProjectMember $member)
    {
        $request->validate([
            'member_role' => 'required|string|max:255',
        ]);

        $member->update([
            'member_role' => $request->member_role,
        ]);

        return redirect()->back();
    }

    // Remove member
    public function destroy(ProjectMember $member)
    {
        $member->delete();

        return redirect()->back();
    }
}