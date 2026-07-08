<?php

namespace App\Models;

use Database\Factories\TaskStatusFactory;
use Illuminate\Database\Eloquent\Attributes\UsePolicy;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

#[UsePolicy(\App\Policies\TaskStatusPolicy::class)]
class TaskStatus extends Model
{
    /** @use HasFactory<TaskStatusFactory> */
    use HasFactory;

    public const DEFAULT_NAMES = [
        'новый',
        'в работе',
        'на тестировании',
        'завершен',
    ];

    protected $fillable = [
        'name',
    ];

    public function tasks(): HasMany
    {
        return $this->hasMany(Task::class, 'status_id');
    }

    public function deleteIfUnused(): bool
    {
        if ($this->tasks()->exists()) {
            return false;
        }

        return $this->delete();
    }
}
