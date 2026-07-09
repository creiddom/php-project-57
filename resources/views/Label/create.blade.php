@extends('layouts.main')

@section('content')
    @include('shared.resource-form-page', [
        'title' => __('strings.create label'),
        'model' => $label,
        'method' => 'POST',
        'action' => route('labels.store'),
        'formPartial' => 'Label._form',
        'formData' => compact('label'),
        'submitLabel' => __('strings.create'),
    ])
@endsection
