<?php

namespace Tests\Unit\Repositories;

use App\Models\User;
use App\Repositories\UserRepository;
use Tests\Unit\UnitTestCase;

/**
 * @coversDefault \App\Repositories\UserRepository
 */
class UserRepositoryTest extends UnitTestCase
{
    /**
     * @covers ::getRegisteredPlayersCount
     */
    public function testGetRegisteredPlayersCount(): void
    {
        User::factory(1, ['tribe' => 0])->create();
        User::factory(1, ['tribe' => 4])->create();
        User::factory(1, ['tribe' => 5])->create();
        User::factory(5)->create();

        /** @var UserRepository $repository */
        $repository = $this->app->make(UserRepository::class);

        $this->assertEquals(5, $repository->getRegisteredPlayersCount());
    }

    /**
     * @covers ::getActivePlayersCount
     */
    public function testGetActivePlayersCount(): void
    {
        User::factory(1, ['tribe' => 0])->create();
        User::factory(1, ['tribe' => 4])->create();
        User::factory(1, ['tribe' => 5])->create();
        User::factory(1, ['updated_at' => now()->sub('2 days')])->create();
        User::factory(1, ['updated_at' => now()->sub('1 days')])->create();
        User::factory(3, ['updated_at' => now()->sub('12 hours')])->create();

        /** @var UserRepository $repository */
        $repository = $this->app->make(UserRepository::class);

        $this->assertEquals(3, $repository->getActivePlayersCount());
    }

    /**
     * @covers ::getOnlinePlayersCount
     */
    public function testGetOnlinePlayersCount(): void
    {
        User::factory(1, ['tribe' => 0])->create();
        User::factory(1, ['tribe' => 4])->create();
        User::factory(1, ['tribe' => 5])->create();
        User::factory(1, ['updated_at' => now()->sub('1 days')])->create();
        User::factory(1, ['updated_at' => now()->sub('1 hour')])->create();
        User::factory(3, ['updated_at' => now()->sub('5 minutes')])->create();

        /** @var UserRepository $repository */
        $repository = $this->app->make(UserRepository::class);

        $this->assertEquals(3, $repository->getOnlinePlayersCount());
    }
}
