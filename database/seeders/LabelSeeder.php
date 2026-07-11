<?php

namespace Database\Seeders;

use App\Models\Label;
use Illuminate\Database\Seeder;

class LabelSeeder extends Seeder
{
    private const DEFAULT_LABELS = [
        'ошибка' => 'Какая-то ошибка в коде или проблема с функциональностью',
        'документация' => 'Задача, которая касается документации',
        'дубликат' => 'Повтор другой задачи',
        'доработка' => 'Новая фича, которую нужно запилить',
    ];

    public function run(): void
    {
        foreach (self::DEFAULT_LABELS as $name => $description) {
            Label::query()->firstOrCreate(
                ['name' => $name],
                ['description' => $description],
            );
        }
    }
}
