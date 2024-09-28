<?php

namespace Tests\Feature\web;

use Tests\TestCase;

/**
 * @coversDefaultClass \App\Http\Controllers\IndexController
 */
class IndexControllerTest extends TestCase
{
    /**
     * @covers ::indexPage
     */
    public function testIndexPage(): void
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }
}
