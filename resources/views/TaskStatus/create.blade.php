@extends('layouts.main')

@section('content')
    <div class="page-card max-w-xl">
        <div class="mb-6">
            <h1 class="text-3xl font-bold tracking-tight text-slate-900">{{ __('strings.create status') }}</h1>
            <p class="mt-2 text-sm text-slate-500">{{ __('strings.statuses') }}</p>
        </div>

        {{ html()->modelForm($taskStatus, 'POST', route('task_statuses.store'))->class('space-y-5')->open() }}
            @include('TaskStatus._form', ['name' => old('name')])

            <div class="flex flex-col gap-4 pt-2 sm:flex-row sm:items-center sm:justify-between">
                <a class="btn-secondary underline-offset-2 hover:underline" href="{{ route('task_statuses.index') }}">
                    {{ __('strings.statuses') }}
                </a>
                {{ html()->submit(__('strings.create'))->class('btn-primary sm:ml-auto') }}
            </div>
        {{ html()->closeModelForm() }}
    </div>
@endsection
