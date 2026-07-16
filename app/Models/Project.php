<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    protected $fillable = [
        'name',
        'description',
        'status',
        'start_date',
        'due_date',
        'created_by',
    ];

    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function milestones()
    {
        return $this->hasMany(Milestone::class);
    }

    public function tasks()
    {
        return $this->hasMany(Task::class);
    }
}
