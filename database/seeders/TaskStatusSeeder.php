<?php

namespace Database\Seeders;

use App\Models\TaskStatus;
use Illuminate\Database\Seeder;

class TaskStatusSeeder extends Seeder
{
    private const DEFAULT_NAMES = [
        'новый',
        'в работе',
        'на тестировании',
        'завершен',
    ];

    public function run(): void
    {
        foreach (self::DEFAULT_NAMES as $name) {
            TaskStatus::query()->firstOrCreate(['name' => $name]);
        }
    }
}
