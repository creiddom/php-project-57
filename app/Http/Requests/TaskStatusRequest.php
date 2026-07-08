<?php

namespace App\Http\Requests;

use App\Models\TaskStatus;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

abstract class TaskStatusRequest extends FormRequest
{
    /**
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    protected function nameRules(?TaskStatus $ignore = null): array
    {
        $unique = Rule::unique(TaskStatus::class);

        if ($ignore !== null) {
            $unique->ignore($ignore);
        }

        return [
            'name' => ['required', 'string', 'max:255', $unique],
        ];
    }
}
