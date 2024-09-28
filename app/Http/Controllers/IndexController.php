<?php

namespace App\Http\Controllers;

use Illuminate\Routing\Controller as BaseController;
use Illuminate\View\View;
use Travian\GrandRepository;

class IndexController extends BaseController
{
    public function indexPage(GrandRepository $database): View
    {
        return view('indexPage', [
            'title' => env('SERVER_NAME'),
            'registeredPlayers' => $database->getRegisteredPlayersCount(),
            'activePlayers' => $database->getActivePlayersCount(),
            'onlinePlayers' => $database->getOnlinePlayersCount(),
        ]);
    }
}
