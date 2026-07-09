@extends('layouts.main')

@section('content')
    @include('shared.simple-resource-index', [
        'title' => __('strings.statuses'),
        'createRoute' => route('task_statuses.create'),
        'createLabel' => __('strings.create status'),
        'items' => $taskStatuses,
        'editRouteName' => 'task_statuses.edit',
        'destroyRouteName' => 'task_statuses.destroy',
        'inUseHint' => __('strings.status in use'),
    ])
@endsection
