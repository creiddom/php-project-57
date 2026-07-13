<?php

namespace App\Services;

use App\Models\Label;
use App\Models\TaskStatus;
use App\Models\User;
use Illuminate\Support\Collection;

class TaskFormOptionsService
{
    /** @var array<string, list<string>> */
    private const VIEW_OPTIONS = [
        'Task.index' => ['taskStatuses', 'users', 'labels'],
        'Task.create' => ['taskStatuses', 'users', 'labels'],
        'Task.edit' => ['taskStatuses', 'users', 'labels'],
    ];

    /**
     * @return array<string, Collection<int|string, mixed>>
     */
    public function forView(string $viewName): array
    {
        return $this->only(self::VIEW_OPTIONS[$viewName] ?? []);
    }

    /**
     * @param list<string> $keys
     * @return array<string, Collection<int|string, mixed>>
     */
    public function only(array $keys): array
    {
        $options = [];

        foreach ($keys as $key) {
            $resolver = $this->resolvers()[$key] ?? null;

            if ($resolver === null) {
                continue;
            }

            $options[$key] = $resolver();
        }

        return $options;
    }

    /**
     * @return array<string, callable(): Collection<int|string, mixed>>
     */
    private function resolvers(): array
    {
        return [
            'taskStatuses' => fn () => TaskStatus::query()->orderBy('name')->pluck('name', 'id'),
            'users' => fn () => User::query()->orderBy('name')->pluck('name', 'id'),
            'labels' => fn () => Label::query()->orderBy('name')->pluck('name', 'id'),
        ];
    }
}
