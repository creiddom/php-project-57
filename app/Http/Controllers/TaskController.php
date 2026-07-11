<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTaskRequest;
use App\Http\Requests\UpdateTaskRequest;
use App\Models\Task;
use App\Services\TaskFormOptionsService;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\QueryBuilder;

class TaskController extends Controller
{
    public function __construct(
        private readonly TaskFormOptionsService $taskFormOptions,
    ) {
        $this->authorizeResource(Task::class, 'task');
    }

    public function index(): View
    {
        $tasks = QueryBuilder::for(Task::class)
            ->allowedFilters([
                AllowedFilter::exact('status_id'),
                AllowedFilter::exact('created_by_id'),
                AllowedFilter::exact('assigned_to_id'),
                AllowedFilter::exact('labels.id'),
            ])
            ->with(['status', 'createdBy', 'assignedTo'])
            ->orderBy('id')
            ->paginate(15)
            ->appends(request()->query());

        return view('Task.index', [
            'tasks' => $tasks,
            ...$this->taskFormOptions->get(),
        ]);
    }

    public function create(): View
    {
        return view('Task.create', [
            'task' => new Task(),
            ...$this->taskFormOptions->get(),
        ]);
    }

    public function store(StoreTaskRequest $request): RedirectResponse
    {
        [$attributes, $labelIds] = $this->splitValidatedLabels($request->validated());

        $task = $request->user()->createdTasks()->create($attributes);
        $task->labels()->sync($labelIds);

        flash(__('messages.task.created'))->success();

        return redirect()->route('tasks.index');
    }

    public function show(Task $task): View
    {
        $task->load(['status', 'createdBy', 'assignedTo', 'labels']);

        return view('Task.show', compact('task'));
    }

    public function edit(Task $task): View
    {
        $task->load('labels');

        return view('Task.edit', [
            'task' => $task,
            ...$this->taskFormOptions->get(),
        ]);
    }

    public function update(UpdateTaskRequest $request, Task $task): RedirectResponse
    {
        [$attributes, $labelIds] = $this->splitValidatedLabels($request->validated());

        $task->update($attributes);
        $task->labels()->sync($labelIds);

        flash(__('messages.task.modified'))->success();

        return redirect()->route('tasks.index');
    }

    public function destroy(Task $task): RedirectResponse
    {
        $task->delete();

        flash(__('messages.task.deleted'))->success();

        return redirect()->route('tasks.index');
    }

    /**
     * @param array<string, mixed> $validated
     * @return array{0: array<string, mixed>, 1: list<mixed>}
     */
    private function splitValidatedLabels(array $validated): array
    {
        $labelIds = $validated['labels'] ?? [];
        unset($validated['labels']);

        return [$validated, $labelIds];
    }
}
