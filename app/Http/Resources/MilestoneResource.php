<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class MilestoneResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        // Get counts loaded via withCount() in the controller
        $totalTasks = $this->tasks_count ?? 0;
        $completedTasks = $this->completed_tasks_count ?? 0;
        
        // Calculate percentage safely
        $progressPercentage = $totalTasks > 0 
            ? round(($completedTasks / $totalTasks) * 100) 
            : 0;

        return [
            'id' => $this->id,
            'project_id' => $this->project_id,
            'title' => $this->title,
            'description' => $this->desc,
            'status' => $this->status, // "Completed" or "Pending"
            'formatted_date' => $this->due_date ? $this->due_date->format('M d, Y') : null,
            'raw_dates' => [
                'start_date' => $this->start_date,
                'due_date' => $this->due_date,
                'end_date' => $this->end_date,
            ],
            'progress' => [
                'total_tasks' => $totalTasks,
                'completed_tasks' => $completedTasks,
                'progress_string' => "{$completedTasks}/{$totalTasks} tasks done",
                'percentage' => $progressPercentage,
            ],
        ];
    }
}
