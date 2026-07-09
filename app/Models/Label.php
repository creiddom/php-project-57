<?php

namespace App\Models;

use App\Contracts\DeletableIfUnused;
use App\Models\Concerns\DeletesIfUnused;
use App\Models\Concerns\ProvidesSelectOptions;
use Database\Factories\LabelFactory;
use Illuminate\Database\Eloquent\Attributes\UsePolicy;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

#[UsePolicy(\App\Policies\LabelPolicy::class)]
class Label extends Model implements DeletableIfUnused
{
    /** @use HasFactory<LabelFactory> */
    use HasFactory;
    use DeletesIfUnused;
    use ProvidesSelectOptions;

    public const DEFAULT_NAMES = [
        'ошибка' => 'Какая-то ошибка в коде или проблема с функциональностью',
        'документация' => 'Задача, которая касается документации',
        'дубликат' => 'Повтор другой задачи',
        'доработка' => 'Новая фича, которую нужно запилить',
    ];

    protected $fillable = [
        'name',
        'description',
    ];

    public function tasks(): BelongsToMany
    {
        return $this->belongsToMany(Task::class);
    }
}
