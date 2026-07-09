@extends('layouts.main')

@section('content')
    @include('shared.resource-form-page', [
        'title' => __('strings.edit status'),
        'model' => $taskStatus,
        'method' => 'PATCH',
        'action' => route('task_statuses.update', $taskStatus),
        'formPartial' => 'TaskStatus._form',
        'formData' => compact('taskStatus'),
        'submitLabel' => __('strings.update'),
    ])
@endsection
