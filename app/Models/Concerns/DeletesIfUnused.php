<?php

namespace App\Models\Concerns;

use Illuminate\Support\Facades\DB;

trait DeletesIfUnused
{
    public function deleteIfUnused(): bool
    {
        return DB::transaction(function (): bool {
            if ($this->isInUse()) {
                return false;
            }

            return (bool) $this->delete();
        });
    }
}
