<x-form.text-field name="name" :label="__('strings.name')" :value="$task->name" />
<x-form.textarea-field name="description" :label="__('strings.description')" :value="$task->description" />

<x-form.select-field
    name="status_id"
    :label="__('strings.status')"
    :options="$taskStatuses"
    :value="$task->status_id"
    :placeholder="__('strings.select placeholder')"
/>

<x-form.select-field
    name="assigned_to_id"
    :label="__('strings.executor')"
    :options="$users"
    :value="$task->assigned_to_id"
    :placeholder="__('strings.select placeholder')"
/>

<div>
    {{ html()->label(__('strings.labels'))->for('labels') }}
</div>
<div class="mt-2 space-y-1">
    @foreach ($labels as $id => $name)
        <div>
            <label class="inline-flex items-center gap-2">
                <input
                    type="checkbox"
                    name="labels[]"
                    value="{{ $id }}"
                    @checked(in_array($id, old('labels', $task->labels->pluck('id')->all())))
                >
                {{ $name }}
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
