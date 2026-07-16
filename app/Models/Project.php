<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;

    // 1. Allow mass assignment for name
    protected $fillable = ['name'];

    // 2. A project has many milestones
    public function milestones(): HasMany
    {
        return $this->hasMany(Milestone::class);
    }
}
