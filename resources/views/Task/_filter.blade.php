{{ html()->modelForm($tasks, 'GET', route('tasks.index'))->open() }}
    <div class="flex flex-wrap items-center gap-2">
        <x-form.select-field
            name="filter[status_id]"
            :options="$taskStatuses"
            :value="$filter['status_id'] ?? null"
            :placeholder="__('strings.status')"
            input-class="filter-select filter-select--status"
            :show-errors="false"
        />
        <x-form.select-field
            name="filter[created_by_id]"
            :options="$users"
            :value="$filter['created_by_id'] ?? null"
            :placeholder="__('strings.author')"
            input-class="filter-select filter-select--author"
            :show-errors="false"
        />
        <x-form.select-field
            name="filter[assigned_to_id]"
            :options="$users"
            :value="$filter['assigned_to_id'] ?? null"
            :placeholder="__('strings.executor')"
            input-class="filter-select filter-select--executor"
            :show-errors="false"
        />
        <x-form.select-field
            name="filter[labels.id]"
            :options="$labels"
            :value="$filter['labels.id'] ?? null"
            :placeholder="__('strings.labels')"
            input-class="filter-select filter-select--label"
            :show-errors="false"
        />
        {{ html()->submit(__('strings.apply'))->class('rounded bg-blue-500 px-4 py-2 text-sm font-bold text-white hover:bg-blue-700') }}
    </div>
{{ html()->closeModelForm() }}
