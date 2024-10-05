<?php

namespace App\Repositories;

use App\Enums\Tribes;
use App\Enums\UserAccess;
use App\Models\User;
use App\Models\UserPremium;
use App\Models\UserProfile;
use App\Models\UserStatistic;
use Carbon\Carbon;

class UsersRepository
{
    public function create(
        string $username,
        string $passwordHash,
        string $email,
        Tribes $tribe,
        int    $invited,
        string $act,
        Carbon $protectionTime,
    ): User {
        $user = new User();
        $user->username = $username;
        $user->password = $passwordHash;
        $user->access = UserAccess::User;
        $user->tribe = $tribe;
        $user->act = $act;
        $user->protect = $protectionTime;
        $user->invited = $invited;
        $user->saveOrFail();

        $userProfile = new UserProfile();
        $userProfile->user_id = $user->id;
        $userProfile->email = $email;
        $userProfile->saveOrFail();

        $userStatistic = new UserStatistic();
        $userStatistic->user_id = $user->id;
        $userStatistic->saveOrFail();

        $userPremium = new UserPremium();
        $userPremium->user_id = $user->id;
        $userPremium->saveOrFail();

        return $user;
    }

    public function findByName(string $username): ?User
    {
        return User::whereUsername($username)->first();
    }

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
