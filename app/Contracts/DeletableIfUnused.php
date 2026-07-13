<?php

namespace App\Contracts;

interface DeletableIfUnused
{
    public function isInUse(): bool;

    public function deleteIfUnused(): bool;
}
