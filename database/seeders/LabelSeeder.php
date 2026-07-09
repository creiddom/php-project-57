<?php

namespace Database\Seeders;

use App\Models\Label;
use Illuminate\Database\Seeder;

class LabelSeeder extends Seeder
{
    public function run(): void
    {
        foreach (Label::DEFAULT_NAMES as $name => $description) {
            Label::query()->firstOrCreate(
                ['name' => $name],
                ['description' => $description],
            );
        }
    }
}
