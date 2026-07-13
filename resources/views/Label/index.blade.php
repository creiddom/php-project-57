@extends('layouts.main')

@section('content')
    @include('shared.simple-resource-index', [
        'title' => __('strings.labels'),
        'modelClass' => \App\Models\Label::class,
        'createRoute' => route('labels.create'),
        'createLabel' => __('strings.create label'),
        'items' => $labels,
        'editRouteName' => 'labels.edit',
        'destroyRouteName' => 'labels.destroy',
        'inUseHint' => __('strings.label in use'),
        'showDescription' => true,
    ])
@endsection
