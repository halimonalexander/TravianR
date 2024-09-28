<?php

namespace App\Repositories;

use App\Models\User;

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
            ->where('updated_at', '>', time() - 24*60*60)
            ->count();
    }

    public function getOnlinePlayersCount(): int
    {
        return User::query()
            ->whereNotIn('tribe', [0, 4, 5])
            ->where('updated_at', '>', time() - 10*60)
            ->count();
    }
}
