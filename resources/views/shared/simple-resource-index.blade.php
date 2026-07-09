<div class="grid col-span-full">
    <div class="mb-5 flex flex-wrap items-center justify-between gap-4">
        <h1 class="text-4xl md:text-4xl xl:text-5xl">{{ $title }}</h1>

        @auth
            <a href="{{ $createRoute }}" class="shrink-0 rounded bg-blue-500 px-4 py-2 font-bold text-white hover:bg-blue-700">
                {{ $createLabel }}
            </a>
        @endauth
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
                    @auth
                        <th class="whitespace-nowrap px-3 py-2">{{ __('strings.actions') }}</th>
                    @endauth
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
                        @auth
                            <td class="whitespace-nowrap px-3 py-3">
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
                                <a
                                    class="ml-3 text-blue-600 hover:text-blue-900"
                                    href="{{ route($editRouteName, $item) }}"
                                >{{ __('strings.edit') }}</a>
                            </td>
                        @endauth
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
