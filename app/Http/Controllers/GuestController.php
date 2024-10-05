<?php

namespace App\Http\Controllers;

use App\Enums\Tribes;
use App\Enums\WorldSectors;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegistrationRequest;
use App\Models\User;
use App\Models\UserReservation;
use App\Repositories\UsersRepository;
use App\Services\RegistrationService;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;
use Illuminate\View\View;
use Travian\GrandRepository;
use Travian\MyGenerator;

class GuestController extends BaseController
{
    use ValidatesRequests;

    public function showIndexPage(UsersRepository $userRepository): View
    {
        return view('indexPage', [
            'title' => env('SERVER_NAME'),
            'registeredPlayers' => $userRepository->getRegisteredPlayersCount(),
            'activePlayers' => $userRepository->getActivePlayersCount(),
            'onlinePlayers' => $userRepository->getOnlinePlayersCount(),
        ]);
    }

    public function showLoginPage(): View
    {
        return view('loginPage', [
            'gpack' => 'gpack/travian_default/',
            // forgetpass           $database->getUserField($form->getValue('user'), 'id', 1)
            'title' => env('SERVER_NAME'),
            'serverName' => env('SERVER_NAME'),
            'isOpen' => ((int)env('COMMENCE')) < time(),
            'startTs' => (int)env('COMMENCE'),
        ]);
    }

    public function login(LoginRequest $request): RedirectResponse
    {
        if (Auth::attempt($request->only(['username', 'password']))) {
            $request->session()->regenerate();

            return redirect()->route('mainPage');
        }

        throw ValidationException::withMessages([
            'credentials' => [__('messages.incorrect_credentials')],
        ]);
    }

    public function showRegistrationPage(Request $request): View
    {
        return view('registrationPage', [
            'gpack' => 'gpack/travian_default/',
            'title' => env('SERVER_NAME'),
            'serverName' => env('SERVER_NAME'),
            'isOpen' => ((int)env('COMMENCE')) < time(),
            'invited' => $request->query('ref', 0),
        ]);
    }

    public function registration(RegistrationRequest $request, RegistrationService $service): RedirectResponse
    {
        if (env('AUTH_EMAIL')) {
            $result = $service->addActivationRequest(
                $request->post('username'),
                $request->post('password'),
                $request->post('email'),
                $request->post('tribe'),
                $request->post('location'),
                $request->post('invited'),
            );

            return redirect()->route('activationPage', ['uid' => $result->id, 'act' => $result->act]);
        } else {
            try {
                $user = $service->registration(
                    $request->post('username'),
                    Hash::make($request->post('password')),
                    $request->post('email'),
                    Tribes::from((int)$request->post('tribe')),
                    WorldSectors::from(
                        (int)$request->post('location', 0) !== 0 ?
                            (int)$request->post('location') :
                            random_int(1, 4)
                    ),
                    $request->post('invited'),
                );

                Auth::login($user);

                return redirect()->route('mainPage');
            } catch (\Throwable $exception) {
                DB::rollBack();

                Log::error('Unable to registrate', [
                    'message' => $exception->getMessage(),
                ]);

                return redirect()->back()->with('error', 'Registration failed. Please try again.')->withInput();
            }
        }
    }

    public function activationPage(Request $request): View
    {
        $error = null;
        /** @var ?UserReservation $user */
        $user = UserReservation::whereId((int)$request->get('uid'))->first();
        if ($user === null) {
            if (User::whereAct($request->get('act'))->exists()) {
                $error = 'activated';
            } else {
                $error = 'not_found';
            }
        } elseif ($user->act !== $request->get('act')) {
            $error = 'not_found';
        } elseif (session()->has('error')) {
            $error = session()->get('error');
        }

        return view('activationPage', [
            'uid' => $request->get('uid'),
            'act' => $request->get('act'),
            'error' => $error,
            'user' => $user,
            'gpack' => 'gpack/travian_default/',
            'title' => env('SERVER_NAME'),
            'serverName' => env('SERVER_NAME'),
            'isOpen' => ((int)env('COMMENCE')) < time(),
        ]);
    }

    public function activation(Request $request, RegistrationService $service): RedirectResponse
    {
        try {
            $service->activate(
                (int)$request->post('uid'),
                $request->post('act'),
                $request->post('code'),
            );
        } catch (\LogicException $exception) {
            return redirect()->back()->with(['error' => $exception->getMessage()]);
        }

        return redirect()->route('loginPage');
    }
}
