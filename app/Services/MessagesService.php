<?php

namespace App\Services;

use App\Models\User;
use App\Repositories\AlliancesRepository;
use App\Repositories\MessagesRepository;
use App\Repositories\UsersRepository;
use Illuminate\Support\Facades\View;

class MessagesService
{
    public function __construct(
        private readonly AlliancesRepository $alliancesRepository,
        private readonly MessagesRepository  $messagesRepository,
        private readonly UsersRepository     $usersRepository,
    ) {
    }

    public function sendWelcome(User $user): void
    {
        $message = View::make('MessageTemplates.welcome', [
            'username' => $user->username,
            'date' => date('d.m.Y', env('COMMENCE')),
            'time' => date('H:i', env('COMMENCE')),
            'players' => $this->usersRepository->getRegisteredPlayersCount(),
            'alliances' => $this->alliancesRepository->getCount(),
            'protection' => env('PROTECTION'),
            'server' => env('SERVER_NAME'),
        ])->render();

        $this->messagesRepository
            ->sendMessage(
                1,
                $user,
                __('messages.WEL_TOPIC'),
                $message,
            );
    }
}
