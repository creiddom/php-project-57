<?php

namespace App\Policies;

use App\Models\Task;
use App\Models\User;

class TaskPolicy
{
    public function viewAny(?User $user): bool
    {
        return true;
    }

    public function view(?User $user, Task $task): bool
    {
        return true;
    }

    public function create(User $user): bool
    {
        return true;
    }

    public function update(User $user, Task $task): bool
    {
        return $this->isCreator($user, $task);
    }

    public function delete(User $user, Task $task): bool
    {
        return $this->isCreator($user, $task);
    }

    private function isCreator(User $user, Task $task): bool
    {
        return $task->createdBy()->whereKey($user->getKey())->exists();
    }
}
