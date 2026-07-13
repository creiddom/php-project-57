<?php

namespace Tests\Concerns;

trait AssertsGuestForbidden
{
    protected function assertGuestGetForbidden(string $uri): void
    {
        $this->get($uri)->assertForbidden();
    }

    /**
     * @param array<string, mixed> $data
     */
    protected function assertGuestPostForbidden(string $uri, array $data = []): void
    {
        $this->post($uri, $data)->assertForbidden();
    }

    /**
     * @param array<string, mixed> $data
     */
    protected function assertGuestPatchForbidden(string $uri, array $data = []): void
    {
        $this->patch($uri, $data)->assertForbidden();
    }

    protected function assertGuestDeleteForbidden(string $uri): void
    {
        $this->delete($uri)->assertForbidden();
    }
}
