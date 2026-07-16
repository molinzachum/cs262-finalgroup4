<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Project;
use App\Models\Milestone;
use App\Models\Task;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Create a default User (so created_by has a valid ID to point to)
        $user = User::factory()->create([
            'name' => 'Admin User',
            'email' => 'admin@enterprise.com',
        ]);

        // 2. Create Project #1
        $project = Project::create([
            'name' => 'Enterprise Suite',
            'description' => 'Core internal management dashboard build.',
            'status' => 'In Progress',
            'created_by' => $user->id,
            'start_date' => now()->subDays(10),
            'end_date' => now()->addDays(60),
        ]);

        // 3. Create Milestone 1 (Completed: 100% progress)
        $m1 = Milestone::create([
            'project_id' => $project->id,
            'title' => 'Initial Research & Tech Stack',
            'description' => 'Gathering requirements and database schema design.',
            'status' => 'Completed',
            'due_date' => now()->subDays(2),
        ]);
        
        for ($i = 1; $i <= 3; $i++) {
            Task::create([
                'milestone_id' => $m1->id,
                'created_by' => $user->id,
                'title' => "Research Task #{$i}",
                'status' => 'Completed',
            ]);
        }

        // 4. Create Milestone 2 (In Progress: ~50% progress)
        $m2 = Milestone::create([
            'project_id' => $project->id,
            'title' => 'Beta Launch & API Setup',
            'description' => 'Deploying backend routes and Eloquent models.',
            'status' => 'In Progress',
            'due_date' => now()->addDays(14),
        ]);

        Task::create(['milestone_id' => $m2->id, 'created_by' => $user->id, 'title' => 'Set up MySQL database', 'status' => 'Completed']);
        Task::create(['milestone_id' => $m2->id, 'created_by' => $user->id, 'title' => 'Build MilestoneResource', 'status' => 'Completed']);
        Task::create(['milestone_id' => $m2->id, 'created_by' => $user->id, 'title' => 'Connect frontend fetch API', 'status' => 'Pending']);
        Task::create(['milestone_id' => $m2->id, 'created_by' => $user->id, 'title' => 'Write automated feature tests', 'status' => 'Pending']);

        // 5. Create Milestone 3 (Pending: 0% progress)
        Milestone::create([
            'project_id' => $project->id,
            'title' => 'Security Audit & Final Polish',
            'description' => 'Penetration testing and production deployment.',
            'status' => 'Pending',
            'due_date' => now()->addDays(45),
        ]);
    }
}
