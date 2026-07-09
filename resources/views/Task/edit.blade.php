@extends('layouts.main')

@section('content')
    @include('shared.resource-form-page', [
        'title' => __('strings.edit task'),
        'model' => $task,
        'method' => 'PATCH',
        'action' => route('tasks.update', $task),
        'formPartial' => 'Task._form',
        'formData' => compact('task', 'taskStatuses', 'users', 'labels'),
        'submitLabel' => __('strings.update'),
    ])
@endsection
