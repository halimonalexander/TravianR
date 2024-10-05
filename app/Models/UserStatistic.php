<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property int $user_id
 */
class UserStatistic extends Model
{
    use HasFactory;

    const CREATED_AT = null;

    protected $table = 'user_statistic';
    protected $primaryKey = 'user_id';

    public $incrementing = false;

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
