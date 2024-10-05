<?php

namespace App\Models;

use App\Enums\UnitTypes;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property ?int $village_id
 * @property ?int $oasis_id
 * @property UnitTypes $type
 * @property int $amount
 * @property Carbon $created_at
 * @property Carbon $updated_at
 */
class Unit extends Model
{
    protected $table = 'units';
    protected $fillable = [
        'village_id',
        'oasis_id',
        'type',
        'amount',
    ];
    protected $casts = [
        'type' => UnitTypes::class,
    ];
}
