<?php

namespace App\Http\Requests;

use App\Models\Task;
use App\Models\TaskStatus;
use App\Models\User;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

abstract class TaskRequest extends FormRequest
{
    /**
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    protected function taskRules(?Task $ignore = null): array
    {
        $unique = Rule::unique(Task::class);

        if ($ignore !== null) {
            $unique->ignore($ignore);
        }

        return [
            'name' => ['required', 'string', 'max:255', $unique],
            'description' => ['nullable', 'string'],
            'status_id' => ['required', Rule::exists(TaskStatus::class, 'id')],
            'assigned_to_id' => ['nullable', Rule::exists(User::class, 'id')],
        ];
    }

    /**
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'name.unique' => __('strings.task exists'),
        ];
    }
}
