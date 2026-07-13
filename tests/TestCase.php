<?php

namespace Tests;

use Illuminate\Foundation\Testing\TestCase as BaseTestCase;
use Tests\Concerns\AssertsCrudRedirects;
use Tests\Concerns\AssertsGuestForbidden;

abstract class TestCase extends BaseTestCase
{
    use AssertsCrudRedirects;
    use AssertsGuestForbidden;
}
