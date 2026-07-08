<div>
    {{ html()->label(__('strings.name'))->for('name') }}
</div>
<div class="mt-2">
    {{ html()->input('text', 'name', old('name', $task->name))->class('w-1/3 rounded border border-gray-300 p-2') }}
</div>
@error('name')
    <div class="text-rose-600">{{ $message }}</div>
@enderror

<div>
    {{ html()->label(__('strings.description'))->for('description') }}
</div>
<div class="mt-2">
    {{ html()->textarea('description', old('description', $task->description))->rows(10)->cols(50)->class('h-32 w-1/3 rounded border border-gray-300 p-2') }}
</div>
@error('description')
    <div class="text-rose-600">{{ $message }}</div>
@enderror

<div>
    {!! html()->label(__('strings.status'))->for('status_id') !!}
</div>
<div class="mt-2">
    {{ html()->select('status_id', $taskStatuses, old('status_id', $task->status_id))->placeholder(__('strings.select placeholder'))->class('w-1/3 rounded border border-gray-300 bg-white p-2') }}
</div>
@error('status_id')
    <div class="text-rose-600">{{ $message }}</div>
@enderror

<div>
    {!! html()->label(__('strings.executor'))->for('assigned_to_id') !!}
</div>
<div class="mt-2">
    {{ html()->select('assigned_to_id', $users, old('assigned_to_id', $task->assigned_to_id))->placeholder(__('strings.select placeholder'))->class('w-1/3 rounded border border-gray-300 bg-white p-2') }}
</div>
@error('assigned_to_id')
    <div class="text-rose-600">{{ $message }}</div>
@enderror
