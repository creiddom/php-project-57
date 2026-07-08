<?php

namespace App\Http\Requests;

use App\Models\Task;
use Illuminate\Contracts\Validation\ValidationRule;

class UpdateTaskRequest extends TaskRequest
{
    /**
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        /** @var Task $task */
        $task = $this->route('task');

        return $this->taskRules($task);
    }
}
