<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\Project;
use App\Models\Milestone;
use App\Models\Task;

class MilestoneApiTest extends TestCase
{
    use RefreshDatabase;

    public function test_milestone_endpoint_returns_correct_progress_calculations(): void
    {
        // 1. Arrange: Create test data
        $user = \App\Models\User::factory()->create();
        $project = Project::create([
            'name' => 'Test Project',
            'created_by' => $user->id,
        ]);
        $milestone = Milestone::create([
            'project_id' => $project->id,
            'title' => 'Initial Research',
            'status' => 'Completed',
        ]);

        // Add 2 completed tasks and 3 pending tasks (5 total -> 40% completion)
        Task::factory()->count(2)->create(['milestone_id' => $milestone->id, 'status' => 'Completed', 'created_by' => $user->id]);
        Task::factory()->count(3)->create(['milestone_id' => $milestone->id, 'status' => 'Pending', 'created_by' => $user->id]);

        // 2. Act: Hit the API endpoint
        $response = $this->getJson("/api/projects/{$project->id}/milestones");

        // 3. Assert: Verify HTTP 200 OK and correct JSON structure/math
        $response->assertStatus(200)
                 ->assertJsonPath('data.0.title', 'Initial Research')
                 ->assertJsonPath('data.0.progress.total_tasks', 5)
                 ->assertJsonPath('data.0.progress.completed_tasks', 2)
                 ->assertJsonPath('data.0.progress.percentage', 40)
                 ->assertJsonPath('data.0.progress.progress_string', '2/5 tasks done');
    }
}