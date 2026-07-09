<?php

namespace App\Http\Controllers\Concerns;

use App\Models\Label;
use App\Models\TaskStatus;
use App\Models\User;
use Illuminate\Support\Collection;

trait ProvidesTaskFormSelectOptions
{
    /**
     * @return array{
     *     taskStatuses: Collection<int|string, mixed>,
     *     users: Collection<int|string, mixed>,
     *     labels: Collection<int|string, mixed>
     * }
     */
    protected function taskFormSelectOptions(): array
    {
        return [
            'taskStatuses' => TaskStatus::optionsForSelect(),
            'users' => User::optionsForSelect(),
            'labels' => Label::optionsForSelect(),
        ];
    }
}
