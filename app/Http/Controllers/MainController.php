<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;

class MainController extends Controller
{
    use AuthorizesRequests, ValidatesRequests;

    public function showMainPage()
    {
        return view('mainPage', [
            'gpack' => 'gpack/travian_default/',
            // forgetpass           $database->getUserField($form->getValue('user'), 'id', 1)
            'title' => env('SERVER_NAME'),
            'serverName' => env('SERVER_NAME'),
        ]);
    }

    public function logout()
    {
        Auth::logout();

        return redirect()->route('loginPage');
    }
}
