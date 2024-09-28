<?php

namespace App\Repositories;

use App\Models\User;
use Carbon\Carbon;

class UserRepository
{
    public function getRegisteredPlayersCount(): int
    {
        return User::query()
            ->whereNotIn('tribe', [0, 4, 5])
            ->count();
    }

    public function getActivePlayersCount(): int
    {
        return User::query()
            ->whereNotIn('tribe', [0, 4, 5])
            ->where('updated_at', '>', Carbon::now()->subHours(24)->toDateTimeString())
            ->count();
    }

    public function getOnlinePlayersCount(): int
    {
        return User::query()
            ->whereNotIn('tribe', [0, 4, 5])
            ->where('updated_at', '>', Carbon::now()->subMinutes(10)->toDateTimeString())
            ->count();
    }
}
