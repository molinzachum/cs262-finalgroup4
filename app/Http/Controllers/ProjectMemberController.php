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
        // 1. Get all projects accessible by the authenticated user
        $projectsQuery = Project::query();
        if (auth()->user()->role === 1) {
            $projectsQuery->where('created_by', auth()->id());
        } else {
            $projectsQuery->whereHas('members', function ($q) {
                $q->where('user_id', auth()->id());
            });
        }
        $projects = $projectsQuery->get();

        // 2. Determine which project to load
        $projectId = $request->query('project_id');
        if ($projectId) {
            $project = Project::find($projectId);
        }

        if (!$project || !$project->exists) {
            $project = $projects->first();
        }

        // 3. Security check: non-admins can only view their own projects
        if ($project && auth()->user()->role !== 1) {
            $isMember = $project->members()->where('user_id', auth()->id())->exists();
            if (!$isMember) {
                abort(403, 'Unauthorized action.');
            }
        }

        $search = $request->search;

        if (!$project) {
            return view('team.index', [
                'project' => null,
                'members' => collect(),
                'search' => $search,
                'projects' => $projects
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

        $users = \App\Models\User::all();

        return view('team.index', compact('project', 'members', 'search', 'users', 'projects'));
    }

    // Add member to project
    public function store(Request $request, Project $project)
    {
        if (auth()->user()->role !== 1) {
            abort(403, 'Unauthorized action.');
        }

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
        if (auth()->user()->role !== 1) {
            abort(403, 'Unauthorized action.');
        }

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
        if (auth()->user()->role !== 1) {
            abort(403, 'Unauthorized action.');
        }

        $member->delete();

        return redirect()->back();
    }
}