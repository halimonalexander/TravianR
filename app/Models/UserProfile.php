<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property int $user_id
 * @property string $email
 * @property int $gender
 * @property Carbon $birthday
 * @property string $location
 * @property string $desc1
 * @property string $desc2
 */
class UserProfile extends Model
{
    use HasFactory;

    protected $table = 'user_profile';
    protected $primaryKey = 'user_id';

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
