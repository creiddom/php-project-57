<?php

namespace Tests\Concerns;

use Illuminate\Testing\TestResponse;

trait AssertsFlashMessages
{
    protected function assertFlashSuccess(TestResponse $response): void
    {
        $response->assertSessionHas('flash_notification');

        $messages = collect(session('flash_notification'));

        $this->assertTrue(
            $messages->contains(fn ($message) => $this->flashLevel($message) === 'success'),
            'Expected a success flash message.',
        );
    }

    protected function assertFlashError(TestResponse $response): void
    {
        $response->assertSessionHas('flash_notification');

        $messages = collect(session('flash_notification'));

        $this->assertTrue(
            $messages->contains(fn ($message) => $this->flashLevel($message) === 'danger'),
            'Expected an error flash message.',
        );
    }

    /**
     * @param array<string, mixed>|object $message
     */
    private function flashLevel(array|object $message): ?string
    {
        if (is_array($message)) {
            return $message['level'] ?? null;
        }

        return $message->level ?? null;
    }
}
