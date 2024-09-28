<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory
{
    protected static ?int $tribe;
    protected static ?int $access;

    public function definition(): array
    {
        return [
            'username' => fake()->name(),
            'password' => Hash::make('password'),
            'tribe' => static::$tribe ??= random_int(1, 3),
            'access' => static::$access ??= random_int(1, 9),
        ];
    }

    public function unverified(): static
    {
        return $this->state(fn (array $attributes) => [
            'email_verified_at' => null,
        ]);
    }
}
