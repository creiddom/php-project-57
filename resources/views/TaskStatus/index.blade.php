@extends('layouts.main')

@section('content')
    <div class="page-card">
        <div class="mb-6 flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
            <h1 class="text-3xl font-bold tracking-tight text-slate-900">{{ __('strings.statuses') }}</h1>

            @auth
                <a href="{{ route('task_statuses.create') }}" class="btn-primary">
                    {{ __('strings.create status') }}
                </a>
            @endauth
        </div>

        <div class="overflow-x-auto">
            <table class="w-full text-left text-sm">
                <thead class="border-b-2 border-slate-900">
                    <tr>
                        <th class="px-3 py-2 font-semibold text-slate-700">ID</th>
                        <th class="px-3 py-2 font-semibold text-slate-700">{{ __('strings.name') }}</th>
                        <th class="px-3 py-2 font-semibold text-slate-700">{{ __('strings.data created') }}</th>
                        @auth
                            <th class="px-3 py-2 font-semibold text-slate-700">{{ __('strings.actions') }}</th>
                        @endauth
                    </tr>
                </thead>
                <tbody>
                    @foreach ($taskStatuses as $taskStatus)
                        <tr class="border-b border-dashed border-slate-300">
                            <td class="px-3 py-3 text-slate-800">{{ $taskStatus->id }}</td>
                            <td class="px-3 py-3 text-slate-800">{{ $taskStatus->name }}</td>
                            <td class="px-3 py-3 text-slate-600">{{ $taskStatus->created_at->format('d.m.Y') }}</td>
                            @auth
                                <td class="space-x-3 px-3 py-3">
                                    <a
                                        data-method="delete"
                                        data-confirm="{{ __('strings.are you sure') }}"
                                        class="font-medium text-red-600 transition hover:text-red-800"
                                        href="{{ route('task_statuses.destroy', $taskStatus) }}"
                                    >{{ __('strings.delete') }}</a>
                                    <a
                                        class="font-medium text-blue-600 transition hover:text-blue-800"
                                        href="{{ route('task_statuses.edit', $taskStatus) }}"
                                    >{{ __('strings.edit') }}</a>
                                </td>
                            @endauth
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
