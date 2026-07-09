<?php

namespace App\Contracts;

interface DeletableIfUnused
{
    public function deleteIfUnused(): bool;
}
