<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property int $user_id
 */
class UserPremium extends Model
{
    use HasFactory;

    const CREATED_AT = null;

    protected $table = 'user_premium';
    protected $primaryKey = 'user_id';

    public $incrementing = false;
}
