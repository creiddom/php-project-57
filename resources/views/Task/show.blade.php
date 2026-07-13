@extends('layouts.main')

@section('content')
    <div class="grid col-span-full">
        <h1 class="mb-5 text-4xl md:text-4xl xl:text-5xl">
            {{ __('strings.view task') }}: {{ $task->name }}
            @can('update', $task)
                <a href="{{ route('tasks.edit', $task) }}" class="text-2xl" title="{{ __('strings.edit') }}">⚙</a>
            @endcan
        </h1>

        <div class="space-y-2">
            <div>{{ __('strings.name') }}: {{ $task->name }}</div>
            <div>{{ __('strings.status') }}: {{ $task->status->name }}</div>
            <div>{{ __('strings.description') }}: {{ $task->description }}</div>
            <div>{{ __('strings.author') }}: {{ $task->createdBy->name }}</div>
            <div>{{ __('strings.executor') }}: {{ $task->assignedTo?->name }}</div>
            <div>
                {{ __('strings.labels') }}:
                <div class="mt-2 flex flex-wrap gap-2">
                    @foreach ($task->labels as $label)
                        <x-label-badge :label="$label" />
                    @endforeach
                </div>
            </div>
        </div>
    </div>
@endsection
