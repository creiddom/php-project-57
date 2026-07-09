@extends('layouts.main')

@section('content')
    <div class="grid col-span-full">
        <div class="mb-5 flex flex-wrap items-center justify-between gap-4">
            <h1 class="text-4xl md:text-4xl xl:text-5xl">{{ __('strings.tasks') }}</h1>

            @auth
                <a href="{{ route('tasks.create') }}" class="shrink-0 rounded bg-blue-500 px-4 py-2 font-bold text-white hover:bg-blue-700">
                    {{ __('strings.create task') }}
                </a>
            @endauth
        </div>

        <div class="page-card overflow-x-auto">
        <table class="w-full min-w-[56rem]">
            <thead class="border-b-2 border-solid border-black text-left">
                <tr>
                    <th class="whitespace-nowrap px-3 py-2">ID</th>
                    <th class="whitespace-nowrap px-3 py-2">{{ __('strings.status') }}</th>
                    <th class="px-3 py-2">{{ __('strings.name') }}</th>
                    <th class="whitespace-nowrap px-3 py-2">{{ __('strings.author') }}</th>
                    <th class="whitespace-nowrap px-3 py-2">{{ __('strings.executor') }}</th>
                    <th class="whitespace-nowrap px-3 py-2">{{ __('strings.data created') }}</th>
                    @auth
                        <th class="whitespace-nowrap px-3 py-2">{{ __('strings.actions') }}</th>
                    @endauth
                </tr>
            </thead>
            <tbody>
                @foreach ($tasks as $task)
                    <tr class="border-b border-dashed text-left">
                        <td class="whitespace-nowrap px-3 py-3">{{ $task->id }}</td>
                        <td class="whitespace-nowrap px-3 py-3">{{ $task->status->name }}</td>
                        <td class="px-3 py-3">
                            <a class="text-blue-600 hover:text-blue-900" href="{{ route('tasks.show', $task) }}">
                                {{ $task->name }}
                            </a>
                        </td>
                        <td class="whitespace-nowrap px-3 py-3">{{ $task->createdBy->name }}</td>
                        <td class="whitespace-nowrap px-3 py-3">{{ $task->assignedTo?->name }}</td>
                        <td class="whitespace-nowrap px-3 py-3">{{ $task->created_at->format('d.m.Y') }}</td>
                        @auth
                            <td class="whitespace-nowrap px-3 py-3">
                                @can('delete', $task)
                                    <a
                                        data-method="delete"
                                        data-confirm="{{ __('strings.are you sure') }}"
                                        class="text-red-600 hover:text-red-900"
                                        href="{{ route('tasks.destroy', $task) }}"
                                    >{{ __('strings.delete') }}</a>
                                @endcan
                                <a
                                    class="ml-3 text-blue-600 hover:text-blue-900"
                                    href="{{ route('tasks.edit', $task) }}"
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
