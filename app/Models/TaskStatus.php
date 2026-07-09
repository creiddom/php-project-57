<?php

namespace App\Models;

use App\Contracts\DeletableIfUnused;
use App\Models\Concerns\DeletesIfUnused;
use App\Models\Concerns\ProvidesSelectOptions;
use Database\Factories\TaskStatusFactory;
use Illuminate\Database\Eloquent\Attributes\UsePolicy;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

#[UsePolicy(\App\Policies\TaskStatusPolicy::class)]
class TaskStatus extends Model implements DeletableIfUnused
{
    /** @use HasFactory<TaskStatusFactory> */
    use HasFactory;
    use DeletesIfUnused;
    use ProvidesSelectOptions;

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
}
