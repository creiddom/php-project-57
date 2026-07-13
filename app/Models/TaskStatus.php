<?php

namespace App\Models;

use App\Contracts\DeletableIfUnused;
use App\Models\Concerns\DeletesIfUnused;
use Database\Factories\TaskStatusFactory;
use Illuminate\Database\Eloquent\Attributes\UsePolicy;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

#[UsePolicy(\App\Policies\TaskStatusPolicy::class)]
class TaskStatus extends Model implements DeletableIfUnused
{
    use DeletesIfUnused;

    /** @use HasFactory<TaskStatusFactory> */
    use HasFactory;

    protected $fillable = [
        'name',
    ];

    public function tasks(): HasMany
    {
        return $this->hasMany(Task::class, 'status_id');
    }

    public function isInUse(): bool
    {
        return $this->tasks()->exists();
    }
}
