@extends('layouts.main')

@section('content')
    <div class="page-card max-w-xl">
        <div class="mb-6">
            <h1 class="text-3xl font-bold tracking-tight text-slate-900">{{ __('strings.edit status') }}</h1>
            <p class="mt-2 text-sm text-slate-500">{{ $taskStatus->name }}</p>
        </div>

        {{ html()->modelForm($taskStatus, 'PATCH', route('task_statuses.update', $taskStatus))->class('space-y-5')->open() }}
            @include('TaskStatus._form', ['name' => old('name', $taskStatus->name)])

            <div class="flex flex-col gap-4 pt-2 sm:flex-row sm:items-center sm:justify-between">
                <a class="btn-secondary underline-offset-2 hover:underline" href="{{ route('task_statuses.index') }}">
                    {{ __('strings.statuses') }}
                </a>
                {{ html()->submit(__('strings.update'))->class('btn-primary sm:ml-auto') }}
            </div>
        {{ html()->closeModelForm() }}
    </div>
@endsection
