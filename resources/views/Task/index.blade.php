@extends('layouts.main')

@section('content')
    <div class="grid col-span-full">
        <div class="mb-5 flex flex-wrap items-center justify-between gap-4">
            <h1 class="max-w-2xl text-4xl md:text-4xl xl:text-5xl">{{ __('strings.tasks') }}</h1>

            @auth
                <a href="{{ route('tasks.create') }}" class="bg-blue-500 hover:bg-blue-700 rounded px-4 py-2 font-bold text-white">
                    {{ __('strings.create task') }}
                </a>
            @endauth
        </div>

        <table class="mt-4 w-full">
            <thead class="border-b-2 border-solid border-black text-left">
                <tr>
                    <th class="px-3 py-2">ID</th>
                    <th class="px-3 py-2">{{ __('strings.status') }}</th>
                    <th class="px-3 py-2">{{ __('strings.name') }}</th>
                    <th class="px-3 py-2">{{ __('strings.author') }}</th>
                    <th class="px-3 py-2">{{ __('strings.executor') }}</th>
                    <th class="px-3 py-2">{{ __('strings.data created') }}</th>
                    @auth
                        <th class="px-3 py-2">{{ __('strings.actions') }}</th>
                    @endauth
                </tr>
            </thead>
            <tbody>
                @foreach ($tasks as $task)
                    <tr class="border-b border-dashed text-left">
                        <td class="px-3 py-3">{{ $task->id }}</td>
                        <td class="px-3 py-3">{{ $task->status->name }}</td>
                        <td class="px-3 py-3">
                            <a class="text-blue-600 hover:text-blue-900" href="{{ route('tasks.show', $task) }}">
                                {{ $task->name }}
                            </a>
                        </td>
                        <td class="px-3 py-3">{{ $task->createdBy->name }}</td>
                        <td class="px-3 py-3">{{ $task->assignedTo?->name }}</td>
                        <td class="px-3 py-3">{{ $task->created_at->format('d.m.Y') }}</td>
                        @auth
                            <td class="space-x-3 px-3 py-3">
                                @if ($task->created_by_id === Auth::id())
                                    <a
                                        data-method="delete"
                                        data-confirm="{{ __('strings.are you sure') }}"
                                        class="text-red-600 hover:text-red-900"
                                        href="{{ route('tasks.destroy', $task) }}"
                                    >{{ __('strings.delete') }}</a>
                                @endif
                                <a
                                    class="text-blue-600 hover:text-blue-900"
                                    href="{{ route('tasks.edit', $task) }}"
                                >{{ __('strings.edit') }}</a>
                            </td>
                        @endauth
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
