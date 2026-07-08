<?php

namespace App\Http\Requests;

use App\Models\TaskStatus;
use Illuminate\Contracts\Validation\ValidationRule;

class UpdateTaskStatusRequest extends TaskStatusRequest
{
    /**
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        /** @var TaskStatus $taskStatus */
        $taskStatus = $this->route('task_status');

        return $this->nameRules($taskStatus);
    }
}
