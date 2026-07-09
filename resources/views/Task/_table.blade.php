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
                            @can('update', $task)
                                <a
                                    class="ml-3 text-blue-600 hover:text-blue-900"
                                    href="{{ route('tasks.edit', $task) }}"
                                >{{ __('strings.edit') }}</a>
                            @endcan
                        </td>
                    @endauth
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
