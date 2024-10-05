<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Enums\Tribes;
use App\Enums\UserAccess;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Query\Builder;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

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
 * @property Carbon $protect
 * @property bool $quest
 * @property Carbon $quest_time
 * @property string $gpack
 * @property float $cp
 * @property int $rc
 * @property bool $ok
 * @property int $clp
 * @property int $oldrank
 * @property Carbon $invited
 * @property int $maxevasion
 * @property int $village_select
 * @property Carbon $created_at
 * @property Carbon $updated_at
 *
 * @method Builder whereUsername(string $username)
 */
class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $table = 'users';

    /**
     * @var array<int, string>
     */
    protected $fillable = [
        'username',
        'password',
        'tribe',
        'access',
        'sit1',
        'sit2',
        'alliance',
        'sessid',
        'act',
        'protect',
        'quest',
        'quest_time',
        'gpack',
        'cp',
        'rc',
        'ok',
        'clp',
        'oldrank',
        'invited',
        'maxevasion',
        'village_select',
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
        'tribe' => Tribes::class,
        'access' => UserAccess::class,
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
        'quest' => 'int',
        'quest_time' => 'int',
        'ok' => 'int',
        'regtime' => 'int',
        'invited' => 'int',
    ];

    public function getAuthIdentifierName(): string
    {
        return 'username';
    }

    public function profile(): HasOne
    {
        return $this->hasOne(UserProfile::class);
    }
}
