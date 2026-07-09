<x-form.text-field name="name" :label="__('strings.name')" :value="$task->name" />
<x-form.textarea-field name="description" :label="__('strings.description')" :value="$task->description" />

<x-form.select-field
    name="status_id"
    :label="__('strings.status')"
    :options="$taskStatuses"
    :value="$task->status_id"
    :placeholder="__('strings.select placeholder')"
/>

<x-form.select-field
    name="assigned_to_id"
    :label="__('strings.executor')"
    :options="$users"
    :value="$task->assigned_to_id"
    :placeholder="__('strings.select placeholder')"
/>

<x-form.checkbox-group
    :label="__('strings.labels')"
    :options="$labels"
    :selected="$task->labels->pluck('id')->all()"
/>
