<?php

namespace Database\Seeders;

use App\Models\TaskStatus;
use Illuminate\Database\Seeder;

class TaskStatusSeeder extends Seeder
{
    public function run(): void
    {
        foreach (TaskStatus::DEFAULT_NAMES as $name) {
            TaskStatus::query()->firstOrCreate(['name' => $name]);
        }
    }
}
