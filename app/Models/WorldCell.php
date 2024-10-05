<?php

namespace App\Models;

use App\Enums\CellTypes;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property CellTypes $field_type
 * @property int $oasis_type
 * @property int $x
 * @property int $y
 * @property bool $occupied
 * @property string $image
 * @property Carbon $updated_at
 */
class WorldCell extends Model
{
    protected $table = 'world_cell';
    protected $fillable = [
        'occupied',
    ];
    protected $casts = [
        'field_type' => CellTypes::class,
    ];
}
