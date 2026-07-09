{{ html()->form('GET', route('tasks.index'))->open() }}
    <div class="flex flex-wrap items-center gap-2">
        <x-form.select-field
            name="filter[status_id]"
            :options="$taskStatuses"
            :value="request('filter.status_id')"
            :placeholder="__('strings.status')"
            input-class="filter-select filter-select--status"
            :show-errors="false"
        />
        <x-form.select-field
            name="filter[created_by_id]"
            :options="$users"
            :value="request('filter.created_by_id')"
            :placeholder="__('strings.author')"
            input-class="filter-select filter-select--author"
            :show-errors="false"
        />
        <x-form.select-field
            name="filter[assigned_to_id]"
            :options="$users"
            :value="request('filter.assigned_to_id')"
            :placeholder="__('strings.executor')"
            input-class="filter-select filter-select--executor"
            :show-errors="false"
        />
        <x-form.select-field
            name="filter[labels.id]"
            :options="$labels"
            :value="request('filter.labels.id')"
            :placeholder="__('strings.labels')"
            input-class="filter-select filter-select--label"
            :show-errors="false"
        />
        {{ html()->submit(__('strings.apply'))->class('app-button') }}
    </div>
{{ html()->form()->close() }}
