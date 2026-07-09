<?php

namespace App\Models\Concerns;

trait DeletesIfUnused
{
    public function deleteIfUnused(): bool
    {
        if ($this->tasks()->exists()) {
            return false;
        }

        return $this->delete();
    }
}
