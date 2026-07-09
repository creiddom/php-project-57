@props([
    'name',
    'options',
    'label' => null,
    'value' => null,
    'placeholder' => null,
    'inputClass' => 'w-1/3 rounded border border-gray-300 bg-white p-2',
    'showErrors' => true,
])

@php
    $select = html()->select($name, $options, old($name, $value))->class($inputClass);

    if ($placeholder !== null) {
        $select = $select->placeholder($placeholder);
    }
@endphp

@if ($label)
    <div>
        {{ html()->label($label)->for($name) }}
    </div>
    <div class="mt-2">
        {{ $select }}
    </div>
    @if ($showErrors)
        @error($name)
            <div class="text-rose-600">{{ $message }}</div>
        @enderror
    @endif
@else
    {{ $select }}
@endif
