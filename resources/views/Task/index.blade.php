@extends('layouts.main')

@section('content')
    <div class="grid col-span-full">
        <h1 class="mb-5 text-4xl md:text-4xl xl:text-5xl">{{ __('strings.tasks') }}</h1>

        <div class="mb-4 flex w-full flex-wrap items-center gap-4">
            <div>
                @include('Task._filter', compact('taskStatuses', 'users', 'labels'))
            </div>

            @auth
                <a href="{{ route('tasks.create') }}" class="app-button ml-auto shrink-0">
                    {{ __('strings.create task') }}
                </a>
            @endauth
        </div>

        @include('Task._table', compact('tasks'))

        <div class="mt-4">
            {{ $tasks->links() }}
        </div>
    </div>
@endsection
