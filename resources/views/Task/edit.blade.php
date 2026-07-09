@extends('layouts.main')

@section('content')
    <div class="grid col-span-full">
        <h1 class="mb-5 text-4xl md:text-4xl xl:text-5xl">{{ __('strings.edit task') }}</h1>

        <div>
            {{ html()->modelForm($task, 'PATCH', route('tasks.update', $task))->open() }}
                @include('Task._form', compact('task', 'taskStatuses', 'users', 'labels'))

                <div class="mt-2">
                    {{ html()->submit(__('strings.update'))->class('rounded bg-blue-500 px-4 py-2 font-bold text-white hover:bg-blue-700') }}
                </div>
            {{ html()->closeModelForm() }}
        </div>
    </div>
@endsection
