<?php

namespace Tests\Feature\web;

use Tests\TestCase;

class IndexControllerTest extends TestCase
{
    public function testIndexPage(): void
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }
}
