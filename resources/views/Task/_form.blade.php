<x-form.text-field name="name" :label="__('strings.name')" :value="$task->name" />
<x-form.textarea-field name="description" :label="__('strings.description')" :value="$task->description" />

<div>
    {{ html()->label(__('strings.status'))->for('status_id') }}
</div>
<div class="mt-2">
    {{ html()->select('status_id', $taskStatuses, old('status_id', $task->status_id))->placeholder(__('strings.select placeholder'))->class('w-1/3 rounded border border-gray-300 bg-white p-2') }}
</div>
@error('status_id')
    <div class="text-rose-600">{{ $message }}</div>
@enderror

<div>
    {{ html()->label(__('strings.executor'))->for('assigned_to_id') }}
</div>
<div class="mt-2">
    {{ html()->select('assigned_to_id', $users, old('assigned_to_id', $task->assigned_to_id))->placeholder(__('strings.select placeholder'))->class('w-1/3 rounded border border-gray-300 bg-white p-2') }}
</div>
@error('assigned_to_id')
    <div class="text-rose-600">{{ $message }}</div>
@enderror

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
