<?php

namespace Tests\Feature\web;

use Tests\TestCase;

/**
 * @coversDefaultClass \App\Http\Controllers\GuestController
 */
class GuestControllerTest extends TestCase
{
    /**
     * @covers ::showIndexPage
     */
    public function testIndexPage(): void
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }
}
