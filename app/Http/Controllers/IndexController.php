<?php

namespace App\Http\Controllers;

use App\Repositories\UserRepository;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\View\View;

class IndexController extends BaseController
{
    public function indexPage(UserRepository $userRepository): View
    {
        return view('indexPage', [
            'title' => env('SERVER_NAME'),
            'registeredPlayers' => $userRepository->getRegisteredPlayersCount(),
            'activePlayers' => $userRepository->getActivePlayersCount(),
            'onlinePlayers' => $userRepository->getOnlinePlayersCount(),
        ]);
    }
}
