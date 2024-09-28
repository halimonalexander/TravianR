<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Travian\Enums\Tribes;
use Travian\Enums\UserAccess;

/**
 * @property int $id
 * @property string $username
 * @property string $password
 * @property Tribes $tribe
 * @property UserAccess $access
 * @property int $sit1
 * @property int $sit2
 * @property int $alliance
 * @property string $sessid
 * @property string $act
 * @property int $protect
 * @property bool $quest
 * @property \Carbon\Carbon $quest_time
 * @property string $gpack
 * @property float $cp
 * @property int $rc
 * @property bool $ok
 * @property int $clp
 * @property int $oldrank
 * @property \Carbon\Carbon $regtime
 * @property \Carbon\Carbon $invited
 * @property int $maxevasion
 * @property int $village_select
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 */
class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $table = 'users';

    /**
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
        'quest' => 'int',
        'quest_time' => 'int',
        'ok' => 'int',
        'regtime' => 'int',
        'invited' => 'int',
    ];

    public function profile(): HasOne
    {
        return $this->hasOne(UserProfile::class);
    }
}
