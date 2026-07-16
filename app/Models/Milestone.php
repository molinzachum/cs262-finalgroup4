<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;


class Milestone extends Model
{
    use HasFactory;

    protected $fillable = [
        'project_id',
        'title',
        'desc',
        'status',
        'start_date',
        'due_date',
        'end_date',
    ];

    protected $casts = [
        'start_date' => 'datetime',
        'due_date' => 'datetime',
        'end_date' => 'datetime',
    ];

    // Relationship back to the Project
    public function project(): BelongsTo
    {
        return $this->belongsTo(Project::class);
    }

    // Relationship to tasks belonging to this milestone
    public function tasks(): HasMany
    {
        return $this->hasMany(Task::class);
    }

    // Filter for completed tasks specifically
    public function completedTasks(): HasMany
    {
        return $this->hasMany(Task::class)->where('status', 'Completed');
    }
}
