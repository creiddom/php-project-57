@extends('layouts.main')

@section('content')
    @include('shared.resource-form-page', [
        'title' => __('strings.edit label'),
        'model' => $label,
        'method' => 'PATCH',
        'action' => route('labels.update', $label),
        'formPartial' => 'Label._form',
        'formData' => compact('label'),
        'submitLabel' => __('strings.update'),
    ])
@endsection
