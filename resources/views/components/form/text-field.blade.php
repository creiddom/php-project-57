@props([
    'name',
    'label',
    'value' => '',
])

<div>
    {{ html()->label($label)->for($name) }}
</div>
<div class="mt-2">
    {{ html()->input('text', $name, old($name, $value))->class('w-1/3 rounded border border-gray-300 p-2') }}
</div>
@error($name)
    <div class="text-rose-600">{{ $message }}</div>
@enderror
