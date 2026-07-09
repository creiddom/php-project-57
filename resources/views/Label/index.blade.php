@extends('layouts.main')

@section('content')
    @include('shared.simple-resource-index', [
        'title' => __('strings.labels'),
        'createRoute' => route('labels.create'),
        'createLabel' => __('strings.create label'),
        'items' => $labels,
        'editRouteName' => 'labels.edit',
        'destroyRouteName' => 'labels.destroy',
        'inUseHint' => __('strings.label in use'),
    ])
@endsection
