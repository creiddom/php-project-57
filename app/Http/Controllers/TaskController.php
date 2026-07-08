<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTaskRequest;
use App\Http\Requests\UpdateTaskRequest;
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
        ['taskStatuses' => $taskStatuses, 'users' => $users] = $this->formSelectOptions();

        return view('Task.create', compact('task', 'taskStatuses', 'users'));
    }

    public function store(StoreTaskRequest $request): RedirectResponse
    {
        Task::query()->create([
            ...$request->validated(),
            'created_by_id' => $request->user()->id,
        ]);

        flash(__('messages.task.created'))->success();

        return redirect()->route('tasks.index');
    }

    public function show(Task $task): View
    {
        $task->load(['status', 'createdBy', 'assignedTo']);

        return view('Task.show', compact('task'));
    }

    public function edit(Task $task): View
    {
        ['taskStatuses' => $taskStatuses, 'users' => $users] = $this->formSelectOptions();

        return view('Task.edit', compact('task', 'taskStatuses', 'users'));
    }

    public function update(UpdateTaskRequest $request, Task $task): RedirectResponse
    {
        $task->update($request->validated());

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
     * @return array{taskStatuses: Collection<int|string, mixed>, users: Collection<int|string, mixed>}
     */
    private function formSelectOptions(): array
    {
        return [
            'taskStatuses' => TaskStatus::query()->orderBy('name')->pluck('name', 'id'),
            'users' => User::query()->orderBy('name')->pluck('name', 'id'),
        ];
    }
}
