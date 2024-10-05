<?php

namespace App\Models;

use App\Enums\Tribes;
use App\Enums\WorldSectors;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property string $username
 * @property string $password
 * @property string $email
 * @property Tribes $tribe
 * @property WorldSectors $location
 * @property int $invited
 * @property string $act
 * @property string $act2
 * @property Carbon $created_at
 * @property Carbon $updated_at
 */
class UserReservation extends Model
{
    protected $table = 'user_reservations';
    protected $fillable = [
        'username',
        'password',
        'email',
        'tribe',
        'location',
        'invited',
        'act',
        'act2',
    ];
    protected $hidden = [
        'password',
    ];
    protected $casts = [
        'location' => WorldSectors::class,
        'tribe' => Tribes::class,
    ];
}
