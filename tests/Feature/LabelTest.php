<?php

namespace Tests\Feature;

use App\Models\Label;
use App\Models\Task;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class LabelTest extends TestCase
{
    use RefreshDatabase;

    private User $user;

    private Label $label;

    private string $fakeNameForLabel;

    private string $fakeNameForLabelUpdate;

    protected function setUp(): void
    {
        parent::setUp();
        $this->user = User::factory()->create();
        $this->label = Label::factory()->create();
        $this->fakeNameForLabel = fake()->unique()->word();
        $this->fakeNameForLabelUpdate = fake()->unique()->word();
    }

    public function testSeederCreatesDefaultLabels(): void
    {
        Label::query()->delete();

        $this->artisan('db:seed');

        foreach (['ошибка', 'документация', 'дубликат', 'доработка'] as $name) {
            $this->assertDatabaseHas('labels', ['name' => $name]);
        }

        $this->assertDatabaseCount('labels', 4);
    }

    public function testIndex(): void
    {
        $response = $this->get(route('labels.index'));

        $response->assertStatus(200);
        $response->assertSee($this->label->description, false);
    }

    public function testCreate(): void
    {
        $response = $this->actingAs($this->user)->get(route('labels.create'));

        $response->assertOk();
        $response->assertSee('name="name"', false);
        $response->assertSee('name="description"', false);
    }

    public function testCreateNotAuth(): void
    {
        $this->assertGuestGetForbidden(route('labels.create'));
    }

    public function testStore(): void
    {
        $response = $this
            ->actingAs($this->user)
            ->post(route('labels.store'), [
                'name' => $this->fakeNameForLabel,
                'description' => 'Test description',
            ]);

        $response->assertSessionHasNoErrors();
        $this->assertDatabaseHas('labels', [
            'name' => $this->fakeNameForLabel,
            'description' => 'Test description',
        ]);
        $this->assertRedirectToRouteWithSuccess($response, 'labels.index');
    }

    public function testStoreNotAuth(): void
    {
        $this->assertGuestPostForbidden(route('labels.store'), [
            'name' => 'newTestLabel',
        ]);
    }

    public function testStoreValidation(): void
    {
        $response = $this
            ->actingAs($this->user)
            ->from(route('labels.create'))
            ->post(route('labels.store'), [
                'name' => '',
            ]);

        $response->assertSessionHasErrors('name');
        $response->assertRedirectToRoute('labels.create');
    }

    public function testStoreDuplicateName(): void
    {
        $response = $this
            ->actingAs($this->user)
            ->from(route('labels.create'))
            ->post(route('labels.store'), [
                'name' => $this->label->name,
                'description' => 'Duplicate',
            ]);

        $response->assertSessionHasErrors('name');
        $response->assertRedirectToRoute('labels.create');
    }

    public function testEdit(): void
    {
        $response = $this
            ->actingAs($this->user)
            ->get(route('labels.edit', ['label' => $this->label]));

        $response->assertOk();
        $response->assertSee('name="name"', false);
    }

    public function testEditNotAuth(): void
    {
        $this->assertGuestGetForbidden(route('labels.edit', ['label' => $this->label]));
    }

    public function testUpdate(): void
    {
        $response = $this
            ->actingAs($this->user)
            ->patch(route('labels.update', ['label' => $this->label]), [
                'name' => $this->fakeNameForLabelUpdate,
                'description' => 'Updated description',
            ]);

        $response->assertSessionHasNoErrors();
        $this->assertDatabaseHas('labels', [
            'name' => $this->fakeNameForLabelUpdate,
            'description' => 'Updated description',
        ]);
        $this->assertRedirectToRouteWithSuccess($response, 'labels.index');
    }

    public function testUpdateValidation(): void
    {
        $response = $this
            ->actingAs($this->user)
            ->from(route('labels.edit', ['label' => $this->label]))
            ->patch(route('labels.update', ['label' => $this->label]), [
                'name' => '',
            ]);

        $response->assertSessionHasErrors('name');
        $response->assertRedirectToRoute('labels.edit', ['label' => $this->label]);
    }

    public function testUpdateDuplicateName(): void
    {
        $anotherLabel = Label::factory()->create();

        $response = $this
            ->actingAs($this->user)
            ->from(route('labels.edit', ['label' => $this->label]))
            ->patch(route('labels.update', ['label' => $this->label]), [
                'name' => $anotherLabel->name,
                'description' => 'Duplicate',
            ]);

        $response->assertSessionHasErrors('name');
        $response->assertRedirectToRoute('labels.edit', ['label' => $this->label]);
    }

    public function testUpdateNotAuth(): void
    {
        $this->assertGuestPatchForbidden(route('labels.update', ['label' => $this->label]), [
            'name' => 'test',
        ]);
    }

    public function testDestroyNotAuth(): void
    {
        $this->assertGuestDeleteForbidden(route('labels.destroy', ['label' => $this->label]));
    }

    public function testDestroy(): void
    {
        $response = $this
            ->actingAs($this->user)
            ->delete(route('labels.destroy', ['label' => $this->label]));

        $response->assertSessionHasNoErrors();
        $this->assertDatabaseMissing('labels', ['id' => $this->label->id]);
        $this->assertRedirectToRouteWithSuccess($response, 'labels.index');
    }

    public function testDestroyWhenLabelHasTasks(): void
    {
        $task = Task::factory()->create([
            'created_by_id' => $this->user->id,
        ]);
        $task->labels()->attach($this->label);

        $response = $this
            ->actingAs($this->user)
            ->delete(route('labels.destroy', ['label' => $this->label]));

        $this->assertRedirectToRouteWithError($response, 'labels.index');
        $this->assertDatabaseHas('labels', ['id' => $this->label->id]);
    }
}
