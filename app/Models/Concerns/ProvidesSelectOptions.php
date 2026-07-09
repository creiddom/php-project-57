<?php

namespace App\Models\Concerns;

use Illuminate\Support\Collection;

trait ProvidesSelectOptions
{
    /**
     * @return Collection<int|string, mixed>
     */
    public static function optionsForSelect(): Collection
    {
        return static::query()->orderBy('name')->pluck('name', 'id');
    }
}
