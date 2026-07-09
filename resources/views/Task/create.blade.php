@extends('layouts.main')

@section('content')
    @include('shared.resource-form-page', [
        'title' => __('strings.create task'),
        'model' => $task,
        'method' => 'POST',
        'action' => route('tasks.store'),
        'formPartial' => 'Task._form',
        'formData' => compact('task', 'taskStatuses', 'users', 'labels'),
        'submitLabel' => __('strings.create'),
    ])
@endsection
