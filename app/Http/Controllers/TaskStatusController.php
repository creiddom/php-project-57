<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Concerns\DestroysUnusedResource;
use App\Http\Requests\StoreTaskStatusRequest;
use App\Http\Requests\UpdateTaskStatusRequest;
use App\Models\TaskStatus;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class TaskStatusController extends Controller
{
    use DestroysUnusedResource;

    public function __construct()
    {
        $this->authorizeResource(TaskStatus::class, 'task_status', [
            'except' => ['index'],
        ]);
    }

    public function index(): View
    {
        $taskStatuses = TaskStatus::query()
            ->withCount('tasks')
            ->orderBy('name')
            ->get();

        return view('TaskStatus.index', compact('taskStatuses'));
    }

    public function create(): View
    {
        $taskStatus = new TaskStatus();

        return view('TaskStatus.create', compact('taskStatus'));
    }

    public function store(StoreTaskStatusRequest $request): RedirectResponse
    {
        TaskStatus::query()->create($request->validated());

        flash(__('messages.status.created'))->success();

        return redirect()->route('task_statuses.index');
    }

    public function edit(TaskStatus $taskStatus): View
    {
        return view('TaskStatus.edit', compact('taskStatus'));
    }

    public function update(UpdateTaskStatusRequest $request, TaskStatus $taskStatus): RedirectResponse
    {
        $taskStatus->update($request->validated());

        flash(__('messages.status.modified'))->success();

        return redirect()->route('task_statuses.index');
    }

    public function destroy(TaskStatus $taskStatus): RedirectResponse
    {
        return $this->destroyUnusedAndRedirect(
            $taskStatus,
            __('messages.status.deleted'),
            __('messages.status.deleted.error'),
            'task_statuses.index',
        );
    }
}
