<?php

namespace Tests\Feature;

use App\Models\Label;
use App\Models\Task;
use App\Models\TaskStatus;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class TaskTest extends TestCase
{
    use RefreshDatabase;

    private User $user;

    private User $otherUser;

    private TaskStatus $taskStatus;

    private Label $label;

    private Task $task;

    private array $taskFormData;

    protected function setUp(): void
    {
        parent::setUp();

        $this->user = User::factory()->create();
        $this->otherUser = User::factory()->create();
        $this->taskStatus = TaskStatus::factory()->create();
        $this->label = Label::factory()->create();
        $this->task = Task::factory()->create([
            'created_by_id' => $this->user->id,
            'status_id' => $this->taskStatus->id,
        ]);

        $this->taskFormData = Task::factory()->make([
            'status_id' => $this->taskStatus->id,
            'assigned_to_id' => $this->otherUser->id,
        ])->only([
            'name',
            'description',
            'status_id',
            'assigned_to_id',
        ]);
    }

    public function testIndex(): void
    {
        $response = $this->get(route('tasks.index'));

        $response->assertOk();
        $response->assertSee($this->task->name, false);
        $response->assertSee('name="filter[status_id]"', false);
        $response->assertSee('name="filter[created_by_id]"', false);
        $response->assertSee('name="filter[assigned_to_id]"', false);
        $response->assertSee('name="filter[labels.id]"', false);
        $response->assertSee(__('strings.apply'), false);
    }

    public function testIndexFilterByStatus(): void
    {
        $otherStatus = TaskStatus::factory()->create();
        $filteredTask = Task::factory()->create([
            'status_id' => $otherStatus->id,
            'created_by_id' => $this->user->id,
        ]);

        $response = $this->get(route('tasks.index', [
            'filter' => ['status_id' => $otherStatus->id],
        ]));

        $response->assertOk();
        $response->assertSee($filteredTask->name, false);
        $response->assertDontSee($this->task->name, false);
    }

    public function testIndexFilterByCreator(): void
    {
        $filteredTask = Task::factory()->create([
            'status_id' => $this->taskStatus->id,
            'created_by_id' => $this->otherUser->id,
        ]);

        $response = $this->get(route('tasks.index', [
            'filter' => ['created_by_id' => $this->otherUser->id],
        ]));

        $response->assertOk();
        $response->assertSee($filteredTask->name, false);
        $response->assertDontSee($this->task->name, false);
    }

    public function testIndexFilterByExecutor(): void
    {
        $this->task->update(['assigned_to_id' => $this->otherUser->id]);

        $response = $this->get(route('tasks.index', [
            'filter' => ['assigned_to_id' => $this->otherUser->id],
        ]));

        $response->assertOk();
        $response->assertSee($this->task->name, false);
    }

    public function testIndexFilterByLabel(): void
    {
        $this->task->labels()->attach($this->label);

        $otherTask = Task::factory()->create([
            'status_id' => $this->taskStatus->id,
            'created_by_id' => $this->user->id,
        ]);

        $response = $this->get(route('tasks.index', [
            'filter' => ['labels.id' => $this->label->id],
        ]));

        $response->assertOk();
        $response->assertSee($this->task->name, false);
        $response->assertDontSee($otherTask->name, false);
    }

    public function testCreate(): void
    {
        $response = $this->actingAs($this->user)->get(route('tasks.create'));

        $response->assertOk();
        $response->assertSee('name="name"', false);
        $response->assertSee('name="status_id"', false);
        $response->assertSee('name="assigned_to_id"', false);
        $response->assertSee('name="labels[]"', false);
    }

    public function testCreateNotAuth(): void
    {
        $response = $this->get(route('tasks.create'));

        $response->assertRedirect(route('login'));
    }

    public function testStore(): void
    {
        $response = $this
            ->actingAs($this->user)
            ->post(route('tasks.store'), [
                ...$this->taskFormData,
                'labels' => [$this->label->id],
            ]);

        $response->assertSessionHasNoErrors();
        $this->assertDatabaseHas('tasks', [
            ...$this->taskFormData,
            'created_by_id' => $this->user->id,
        ]);
        $task = Task::query()->where('name', $this->taskFormData['name'])->first();
        $this->assertNotNull($task);
        $this->assertDatabaseHas('label_task', [
            'label_id' => $this->label->id,
            'task_id' => $task->id,
        ]);
        $response->assertRedirect(route('tasks.index'));
    }

    public function testStoreNotAuth(): void
    {
        $response = $this->post(route('tasks.store'), $this->taskFormData);

        $response->assertRedirect(route('login'));
    }

    public function testStoreValidation(): void
    {
        $response = $this
            ->actingAs($this->user)
            ->from(route('tasks.create'))
            ->post(route('tasks.store'), [
                'name' => '',
                'status_id' => '',
            ]);

        $response->assertSessionHasErrors(['name', 'status_id']);
        $response->assertRedirect(route('tasks.create'));
    }

    public function testStoreDuplicateName(): void
    {
        $response = $this
            ->actingAs($this->user)
            ->from(route('tasks.create'))
            ->post(route('tasks.store'), [
                'name' => $this->task->name,
                'description' => 'Description',
                'status_id' => $this->taskStatus->id,
            ]);

        $response->assertSessionHasErrors('name');
        $response->assertRedirect(route('tasks.create'));
    }

    public function testShow(): void
    {
        $this->task->labels()->attach($this->label);

        $response = $this->get(route('tasks.show', $this->task));

        $response->assertOk();
        $response->assertSee($this->task->name, false);
        $response->assertSee($this->label->name, false);
    }

    public function testEdit(): void
    {
        $response = $this
            ->actingAs($this->user)
            ->get(route('tasks.edit', ['task' => $this->task]));

        $response->assertOk();
        $response->assertSee('name="name"', false);
    }

    public function testEditNotAuth(): void
    {
        $response = $this->get(route('tasks.edit', ['task' => $this->task]));

        $response->assertRedirect(route('login'));
    }

    public function testUpdate(): void
    {
        $response = $this
            ->actingAs($this->user)
            ->patch(route('tasks.update', ['task' => $this->task]), [
                ...$this->taskFormData,
                'labels' => [$this->label->id],
            ]);

        $response->assertSessionHasNoErrors();
        $this->assertDatabaseHas('tasks', $this->taskFormData);
        $this->assertDatabaseHas('label_task', [
            'label_id' => $this->label->id,
            'task_id' => $this->task->id,
        ]);
        $response->assertRedirect(route('tasks.index'));
    }

    public function testUpdateNotAuth(): void
    {
        $response = $this
            ->patch(route('tasks.update', ['task' => $this->task]), $this->taskFormData);

        $response->assertRedirect(route('login'));
    }

    public function testUpdateValidation(): void
    {
        $response = $this
            ->actingAs($this->user)
            ->from(route('tasks.edit', ['task' => $this->task]))
            ->patch(route('tasks.update', ['task' => $this->task]), [
                'name' => '',
                'status_id' => '',
            ]);

        $response->assertSessionHasErrors(['name', 'status_id']);
        $response->assertRedirect(route('tasks.edit', ['task' => $this->task]));
    }

    public function testUpdateDuplicateName(): void
    {
        $anotherTask = Task::factory()->create([
            'status_id' => $this->taskStatus->id,
            'created_by_id' => $this->user->id,
        ]);

        $response = $this
            ->actingAs($this->user)
            ->from(route('tasks.edit', ['task' => $this->task]))
            ->patch(route('tasks.update', ['task' => $this->task]), [
                'name' => $anotherTask->name,
                'status_id' => $this->taskStatus->id,
            ]);

        $response->assertSessionHasErrors('name');
        $response->assertRedirect(route('tasks.edit', ['task' => $this->task]));
    }

    public function testDestroy(): void
    {
        $response = $this
            ->actingAs($this->user)
            ->delete(route('tasks.destroy', ['task' => $this->task]));

        $response->assertSessionHasNoErrors();
        $this->assertDatabaseMissing('tasks', ['id' => $this->task->id]);
        $response->assertRedirect(route('tasks.index'));
    }

    public function testDestroyNotByCreator(): void
    {
        $response = $this
            ->actingAs($this->otherUser)
            ->delete(route('tasks.destroy', ['task' => $this->task]));

        $response->assertStatus(403);
        $this->assertDatabaseHas('tasks', ['id' => $this->task->id]);
    }

    public function testDestroyNotAuth(): void
    {
        $response = $this->delete(route('tasks.destroy', ['task' => $this->task]));

        $response->assertRedirect(route('login'));
    }
}
