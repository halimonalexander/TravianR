<?php

declare(strict_types=1);

namespace App\Services;

use App\Enums\Tribes;
use App\Enums\WorldSectors;
use App\Models\User;
use App\Models\UserReservation;
use App\Repositories\UsersRepository;
use App\Repositories\VillagesRepository;
use App\Repositories\WorldDataRepository;
use App\Services\Mails\ActivationMail;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class RegistrationService
{
    public function __construct(
        private readonly MessagesService $messagesService,
        private readonly UsersRepository $usersRepository,
        private readonly VillagesRepository $villagesRepository,
        private readonly WorldDataRepository $worldDataRepository,
    ) {
    }

    public function addActivationRequest(
        string $username,
        string $password,
        string $email,
        int    $tribeId,
        int    $location,
        int    $invited,
    ): UserReservation {
        $reserve = new UserReservation();
        $reserve->username = $username;
        $reserve->password = $password;
        $reserve->email = $email;
        $reserve->tribe = $tribeId;
        $reserve->location = $location;
        $reserve->invited = $invited;
        $reserve->act = Str::random(10);
        $reserve->act2 = Str::random(5);

        $reserve->saveOrFail();

        try {
            Mail::to($reserve->email)->send(new ActivationMail($reserve));
        } catch (\Throwable $exception) {
            Log::error('Unable to send mail', [
                'mail' => 'activation',
                'message' => $exception->getMessage(),
            ]);
        }

        return $reserve;
    }

    public function registration(
        string $username,
        string $passwordHash,
        string $email,
        Tribes $tribe,
        WorldSectors $sector,
        int    $invited,
    ): User {
        DB::beginTransaction();

        $user = $this->usersRepository
            ->create($username, $passwordHash, $email, $tribe, $invited, '', $this->getProtectionTime());

        $cell = $this->worldDataRepository->findClosestFreeCell($sector, 5);
        $this->villagesRepository->createVillage($user, $cell, true);

        $this->messagesService->sendWelcome($user);

        DB::commit();

        return $user;
    }

    public function activate(
        int $uid,
        string $act,
        string $code,
    ): User {
        /** @var ?UserReservation $user */
        $user = UserReservation::whereId($uid)->first();
        if ($user === null) {
            if (User::whereAct($act)->exists()) {
                throw new \LogicException('activated');
            }
            throw new \LogicException('not_found');
        }
        if ($act !== $user->act) {
            Log::error('Hack attempt detected');

            throw new \LogicException('hack_attempt');
        }
        if ($code !== $user->act2) {
            throw new \LogicException('code_missmatch');
        }

        try {
            return $this->doActivate($user);
        } catch (\Throwable $exception) {
            Log::error('Unable to activate account', [
                'message' => $exception->getMessage(),
                'exception' => json_encode($exception),
            ]);
            DB::rollBack();

            throw new \LogicException('try_later');
        }
    }

    private function doActivate(UserReservation $reservation): User
    {
        DB::beginTransaction();

        $user = $this->usersRepository
            ->create(
                $reservation->username,
                $reservation->password,
                $reservation->email,
                $reservation->tribe,
                $reservation->invited,
                $reservation->act,
                $this->getProtectionTime(),
            );

        $cell = $this->worldDataRepository->findClosestFreeCell($reservation->location, 5);
        $this->villagesRepository->createVillage($user, $cell, true);

        $this->messagesService->sendWelcome($user);

        $reservation->delete();

        DB::commit();

        return $user;
    }

    private function getProtectionTime(): Carbon
    {
        return Carbon::createFromTimestamp(time() + env('PROTECTION'));
    }
}
