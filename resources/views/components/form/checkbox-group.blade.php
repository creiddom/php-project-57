@props([
    'name' => 'labels[]',
    'label',
    'options',
    'selected' => [],
    'inputId' => 'labels',
])

<div>
    {{ html()->label($label)->for($inputId) }}
</div>
<div class="mt-2 space-y-1">
    @foreach ($options as $id => $optionLabel)
        <div>
            <label class="inline-flex items-center gap-2">
                <input
                    type="checkbox"
                    name="{{ $name }}"
                    value="{{ $id }}"
                    @checked(in_array($id, old('labels', $selected)))
                >
                {{ $optionLabel }}
            </label>
        </div>
    @endforeach
</div>
@error('labels')
    <div class="text-rose-600">{{ $message }}</div>
@enderror
@error('labels.*')
    <div class="text-rose-600">{{ $message }}</div>
@enderror
