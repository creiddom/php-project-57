<?php

namespace Tests\Feature;

use App\Models\Task;
use App\Models\TaskStatus;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class TaskStatusTest extends TestCase
{
    use RefreshDatabase;

    private User $user;

    private TaskStatus $taskStatus;

    private string $fakeNameForTaskStatus;

    private string $fakeNameForTaskStatusUpdate;

    protected function setUp(): void
    {
        parent::setUp();
        $this->user = User::factory()->create();
        $this->taskStatus = TaskStatus::factory()->create();
        $this->fakeNameForTaskStatus = fake()->unique()->word();
        $this->fakeNameForTaskStatusUpdate = fake()->unique()->word();
    }

    public function testSeederCreatesDefaultStatuses(): void
    {
        TaskStatus::query()->delete();

        $this->artisan('db:seed');

        foreach (TaskStatus::DEFAULT_NAMES as $name) {
            $this->assertDatabaseHas('task_statuses', ['name' => $name]);
        }

        $this->assertDatabaseCount('task_statuses', count(TaskStatus::DEFAULT_NAMES));
    }

    public function testSeederIsIdempotent(): void
    {
        TaskStatus::query()->delete();

        $this->artisan('db:seed');
        $this->artisan('db:seed');

        $this->assertDatabaseCount('task_statuses', count(TaskStatus::DEFAULT_NAMES));
    }

    public function testIndex(): void
    {
        $response = $this->get(route('task_statuses.index'));

        $response->assertStatus(200);
    }

    public function testCreate(): void
    {
        $response = $this->actingAs($this->user)->get(route('task_statuses.create'));

        $response->assertOk();
        $response->assertSee('name="name"', false);
    }

    public function testCreateNotAuth(): void
    {
        $response = $this->get(route('task_statuses.create'));

        $response->assertRedirect(route('login'));
    }

    public function testStore(): void
    {
        $response = $this
            ->actingAs($this->user)
            ->post(route('task_statuses.store'), [
                'name' => $this->fakeNameForTaskStatus,
            ]);

        $response->assertSessionHasNoErrors();
        $this->assertDatabaseHas('task_statuses', ['name' => $this->fakeNameForTaskStatus]);
        $response->assertRedirect(route('task_statuses.index'));
    }

    public function testStoreNotAuth(): void
    {
        $response = $this
            ->post(route('task_statuses.store'), [
                'name' => 'newTestStatus',
            ]);

        $response->assertRedirect(route('login'));
    }

    public function testStoreValidation(): void
    {
        $response = $this
            ->actingAs($this->user)
            ->from(route('task_statuses.create'))
            ->post(route('task_statuses.store'), [
                'name' => '',
            ]);

        $response->assertSessionHasErrors('name');
        $response->assertRedirect(route('task_statuses.create'));
    }

    public function testStoreDuplicateName(): void
    {
        $response = $this
            ->actingAs($this->user)
            ->from(route('task_statuses.create'))
            ->post(route('task_statuses.store'), [
                'name' => $this->taskStatus->name,
            ]);

        $response->assertSessionHasErrors('name');
        $response->assertRedirect(route('task_statuses.create'));
    }

    public function testEdit(): void
    {
        $response = $this
            ->actingAs($this->user)
            ->get(route('task_statuses.edit', ['task_status' => $this->taskStatus]));

        $response->assertOk();
        $response->assertSee('name="name"', false);
    }

    public function testEditNotAuth(): void
    {
        $response = $this->get(route('task_statuses.edit', ['task_status' => $this->taskStatus]));

        $response->assertRedirect(route('login'));
    }

    public function testUpdate(): void
    {
        $response = $this
            ->actingAs($this->user)
            ->patch(route('task_statuses.update', ['task_status' => $this->taskStatus]), [
                'name' => $this->fakeNameForTaskStatusUpdate,
            ]);

        $response->assertSessionHasNoErrors();
        $this->assertDatabaseHas('task_statuses', ['name' => $this->fakeNameForTaskStatusUpdate]);
        $response->assertRedirect(route('task_statuses.index'));
    }

    public function testUpdateDuplicateName(): void
    {
        $anotherStatus = TaskStatus::factory()->create();

        $response = $this
            ->actingAs($this->user)
            ->from(route('task_statuses.edit', ['task_status' => $this->taskStatus]))
            ->patch(route('task_statuses.update', ['task_status' => $this->taskStatus]), [
                'name' => $anotherStatus->name,
            ]);

        $response->assertSessionHasErrors('name');
        $response->assertRedirect(route('task_statuses.edit', ['task_status' => $this->taskStatus]));
    }

    public function testUpdateValidation(): void
    {
        $response = $this
            ->actingAs($this->user)
            ->from(route('task_statuses.edit', ['task_status' => $this->taskStatus]))
            ->patch(route('task_statuses.update', ['task_status' => $this->taskStatus]), [
                'name' => '',
            ]);

        $response->assertSessionHasErrors('name');
        $response->assertRedirect(route('task_statuses.edit', ['task_status' => $this->taskStatus]));
    }

    public function testUpdateNotAuth(): void
    {
        $response = $this
            ->patch(route('task_statuses.update', ['task_status' => $this->taskStatus]), [
                'name' => 'test',
            ]);

        $response->assertRedirect(route('login'));
    }

    public function testDestroyNotAuth(): void
    {
        $response = $this
            ->delete(route('task_statuses.destroy', ['task_status' => $this->taskStatus]));

        $response->assertRedirect(route('login'));
    }

    public function testDestroy(): void
    {
        $response = $this
            ->actingAs($this->user)
            ->delete(route('task_statuses.destroy', ['task_status' => $this->taskStatus]));

        $response->assertSessionHasNoErrors();
        $this->assertDatabaseMissing('task_statuses', ['id' => $this->taskStatus->id]);
        $response->assertRedirect(route('task_statuses.index'));
    }

    public function testDestroyWhenStatusHasTasks(): void
    {
        Task::factory()->create([
            'status_id' => $this->taskStatus->id,
            'created_by_id' => $this->user->id,
        ]);

        $response = $this
            ->actingAs($this->user)
            ->delete(route('task_statuses.destroy', ['task_status' => $this->taskStatus]));

        $response->assertRedirect(route('task_statuses.index'));
        $response->assertSessionHas('flash_notification');
        $this->assertDatabaseHas('task_statuses', ['id' => $this->taskStatus->id]);
    }
}
