<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class HomeTest extends TestCase
{
    use RefreshDatabase;

    public function testHomePageShowsGreeting(): void
    {
        $response = $this->get('/');

        $response->assertStatus(200);
        $response->assertSee(__('strings.hello from Hexlet'), false);
        $response->assertSee(__('strings.push me'), false);
    }
}
