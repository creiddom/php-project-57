<div class="grid col-span-full">
    <div class="mb-5 flex flex-wrap items-center justify-between gap-4">
        <h1 class="text-4xl md:text-4xl xl:text-5xl">{{ $title }}</h1>

        @can('create', $modelClass)
            <a href="{{ $createRoute }}" class="app-button shrink-0">
                {{ $createLabel }}
            </a>
        @endcan
    </div>

    <div class="page-card overflow-x-auto">
        <table class="w-full min-w-[48rem]">
            <thead class="border-b-2 border-solid border-black text-left">
                <tr>
                    <th class="whitespace-nowrap px-3 py-2">ID</th>
                    <th class="whitespace-nowrap px-3 py-2">{{ __('strings.name') }}</th>
                    @if (! empty($showDescription))
                        <th class="px-3 py-2">{{ __('strings.description') }}</th>
                    @endif
                    <th class="whitespace-nowrap px-3 py-2">{{ __('strings.data created') }}</th>
                    @can('create', $modelClass)
                        <th class="whitespace-nowrap px-3 py-2">{{ __('strings.actions') }}</th>
                    @endcan
                </tr>
            </thead>
            <tbody>
                @foreach ($items as $item)
                    <tr class="border-b border-dashed text-left">
                        <td class="whitespace-nowrap px-3 py-3">{{ $item->id }}</td>
                        <td class="whitespace-nowrap px-3 py-3">{{ $item->name }}</td>
                        @if (! empty($showDescription))
                            <td class="px-3 py-3">{{ $item->description }}</td>
                        @endif
                        <td class="whitespace-nowrap px-3 py-3">{{ $item->created_at->format('d.m.Y') }}</td>
                        @can('create', $modelClass)
                            <td class="whitespace-nowrap px-3 py-3">
                                @can('delete', $item)
                                    @if ($item->tasks_count === 0)
                                        <a
                                            data-method="delete"
                                            data-confirm="{{ __('strings.are you sure') }}"
                                            class="text-red-600 hover:text-red-900"
                                            href="{{ route($destroyRouteName, $item) }}"
                                        >{{ __('strings.delete') }}</a>
                                    @elseif (! empty($inUseHint))
                                        <span class="text-sm text-slate-500">{{ $inUseHint }}</span>
                                    @endif
                                @endcan
                                @can('update', $item)
                                    <a
                                        class="ml-3 text-blue-600 hover:text-blue-900"
                                        href="{{ route($editRouteName, $item) }}"
                                    >{{ __('strings.edit') }}</a>
                                @endcan
                            </td>
                        @endcan
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
