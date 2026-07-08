@extends('layouts.main')

@section('content')
    <div class="grid col-span-full">
        <h1 class="mb-5 max-w-2xl text-4xl md:text-4xl xl:text-5xl">
            {{ __('strings.view task') }}: {{ $task->name }}
        </h1>

        <div class="space-y-2">
            <div>{{ __('strings.name') }}: {{ $task->name }}</div>
            <div>{{ __('strings.status') }}: {{ $task->status->name }}</div>
            <div>{{ __('strings.description') }}: {{ $task->description }}</div>
            <div>{{ __('strings.author') }}: {{ $task->createdBy->name }}</div>
            <div>{{ __('strings.executor') }}: {{ $task->assignedTo?->name }}</div>
        </div>
    </div>
@endsection
