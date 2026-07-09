@props([
    'name',
    'label',
    'value' => '',
    'rows' => 10,
    'cols' => 50,
])

<div>
    {{ html()->label($label)->for($name) }}
</div>
<div class="mt-2">
    {{ html()->textarea($name, old($name, $value))->rows($rows)->cols($cols)->class('h-32 w-1/3 rounded border border-gray-300 p-2') }}
</div>
@error($name)
    <div class="text-rose-600">{{ $message }}</div>
@enderror
