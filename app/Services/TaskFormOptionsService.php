<?php

namespace App\Services;

use App\Models\Label;
use App\Models\TaskStatus;
use App\Models\User;
use Illuminate\Support\Collection;

class TaskFormOptionsService
{
    /**
     * @return array{
     *     taskStatuses: Collection<int|string, mixed>,
     *     users: Collection<int|string, mixed>,
     *     labels: Collection<int|string, mixed>
     * }
     */
    public function get(): array
    {
        return [
            'taskStatuses' => TaskStatus::query()->orderBy('name')->pluck('name', 'id'),
            'users' => User::query()->orderBy('name')->pluck('name', 'id'),
            'labels' => Label::query()->orderBy('name')->pluck('name', 'id'),
        ];
    }
}
