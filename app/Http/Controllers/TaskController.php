<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTaskRequest;
use App\Http\Requests\UpdateTaskRequest;
use App\Models\Label;
use App\Models\Task;
use App\Models\TaskStatus;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Collection;
use Illuminate\View\View;

class TaskController extends Controller
{
    public function __construct()
    {
        $this->authorizeResource(Task::class, 'task', [
            'except' => ['index', 'show'],
        ]);
    }

    public function index(): View
    {
        $tasks = Task::query()
            ->with(['status', 'createdBy', 'assignedTo'])
            ->orderBy('id')
            ->get();

        return view('Task.index', compact('tasks'));
    }

    public function create(): View
    {
        $task = new Task();
        ['taskStatuses' => $taskStatuses, 'users' => $users, 'labels' => $labels] = $this->formSelectOptions();

        return view('Task.create', compact('task', 'taskStatuses', 'users', 'labels'));
    }

    public function store(StoreTaskRequest $request): RedirectResponse
    {
        [$attributes, $labelIds] = $this->splitValidatedLabels($request->validated());

        $task = Task::query()->create([
            ...$attributes,
            'created_by_id' => $request->user()->id,
        ]);

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
        ['taskStatuses' => $taskStatuses, 'users' => $users, 'labels' => $labels] = $this->formSelectOptions();

        return view('Task.edit', compact('task', 'taskStatuses', 'users', 'labels'));
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
     * @return array{
     *     taskStatuses: Collection<int|string, mixed>,
     *     users: Collection<int|string, mixed>,
     *     labels: Collection<int|string, mixed>
     * }
     */
    private function formSelectOptions(): array
    {
        return [
            'taskStatuses' => TaskStatus::query()->orderBy('name')->pluck('name', 'id'),
            'users' => User::query()->orderBy('name')->pluck('name', 'id'),
            'labels' => Label::query()->orderBy('name')->pluck('name', 'id'),
        ];
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
