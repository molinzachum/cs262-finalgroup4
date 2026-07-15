<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    protected $fillable = [
        'proj_name',
        'description',
        'status',
        'created_by',
        'start_date',
        'end_date'
    ];

    public function tasks()
    {
        return $this->hasMany(Task::class);
    }

    public function members()
    {
        return $this->hasMany(ProjectMember::class);
    }

    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }
}