<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Task extends Model
{
    use HasFactory;

    // 1. Allow mass assignment for these fields
    protected $fillable = [
        'milestone_id',
        'title',
        'status',
    ];

    // 2. A task belongs to a milestone
    public function milestone(): BelongsTo
    {
        return $this->belongsTo(Milestone::class);
    }
}
