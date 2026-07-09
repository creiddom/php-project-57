@extends('layouts.main')

@section('content')
    <div class="grid col-span-full">
        <h1 class="mb-5 max-w-2xl text-4xl md:text-4xl xl:text-5xl">{{ __('strings.create task') }}</h1>

        <div>
            {{ html()->modelForm($task, 'POST', route('tasks.store'))->open() }}
                @include('Task._form', compact('task', 'taskStatuses', 'users', 'labels'))

                <div class="mt-2">
                    {{ html()->submit(__('strings.create'))->class('rounded bg-blue-500 px-4 py-2 font-bold text-white hover:bg-blue-700') }}
                </div>
            {{ html()->closeModelForm() }}
        </div>
    </div>
@endsection
