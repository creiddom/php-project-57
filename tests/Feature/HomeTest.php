<?php

namespace Tests\Feature;

use Tests\TestCase;

class HomeTest extends TestCase
{
    public function testHomePageShowsGreeting(): void
    {
        $response = $this->get('/');

        $response->assertStatus(200);
        $response->assertSee('Привет от Хекслета!', false);
    }
}
