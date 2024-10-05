<?php

namespace App\Models;

use App\Enums\OasisTypes;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property int $world_cell_id
 * @property OasisTypes $type
 * @property int $high
 * @property float $loyalty
 * @property int $conqueror
 * @property string $name
 * @property Carbon $created_at
 * @property Carbon $updated_at
 */
class Oasis extends Model
{
    protected $table = 'oasises';
    protected $fillable = [
        'world_cell_id',
        'type',
        'high',
        'loyalty',
        'conqueror',
        'name',
    ];
    protected $casts = [
        'type' => OasisTypes::class,
    ];
}
