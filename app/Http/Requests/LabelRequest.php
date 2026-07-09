<?php

namespace App\Http\Requests;

use App\Models\Label;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

abstract class LabelRequest extends FormRequest
{
    /**
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    protected function labelRules(?Label $ignore = null): array
    {
        $unique = Rule::unique(Label::class);

        if ($ignore !== null) {
            $unique->ignore($ignore);
        }

        return [
            'name' => ['required', 'string', 'max:255', $unique],
            'description' => ['nullable', 'string'],
        ];
    }

    /**
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'name.unique' => __('strings.label exists'),
        ];
    }
}
