<?php

namespace Tests\Concerns;

use Illuminate\Testing\TestResponse;

trait AssertsCrudRedirects
{
    use AssertsFlashMessages;

    /**
     * @param array<string, mixed> $parameters
     */
    protected function assertRedirectToRouteWithSuccess(
        TestResponse $response,
        string $route,
        array $parameters = [],
    ): void {
        $response->assertRedirectToRoute($route, $parameters);
        $this->assertFlashSuccess($response);
    }

    /**
     * @param array<string, mixed> $parameters
     */
    protected function assertRedirectToRouteWithError(
        TestResponse $response,
        string $route,
        array $parameters = [],
    ): void {
        $response->assertRedirectToRoute($route, $parameters);
        $this->assertFlashError($response);
    }
}
