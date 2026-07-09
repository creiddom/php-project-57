@extends('layouts.main')

@section('content')
    @include('shared.resource-form-page', [
        'title' => __('strings.create status'),
        'model' => $taskStatus,
        'method' => 'POST',
        'action' => route('task_statuses.store'),
        'formPartial' => 'TaskStatus._form',
        'formData' => compact('taskStatus'),
        'submitLabel' => __('strings.create'),
    ])
@endsection
