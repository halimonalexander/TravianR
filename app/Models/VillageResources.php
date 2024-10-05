<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * @property int $village_id
 * @property float $wood
 * @property float $clay
 * @property float $iron
 * @property float $crop
 * @property int $max_storage
 * @property int $max_granary
 * @property int $starvation
 * @property Carbon $starvation_updated_at
 * @property Carbon $updated_at
 */
class VillageResources extends Model
{
    const CREATED_AT = null;

    protected $table = 'village_resources';
    protected $primaryKey = 'village_id';
    protected $fillable = [
        'village_id',
        'wood',
        'clay',
        'iron',
        'crop',
        'max_storage',
        'max_granary',
        'starvation',
        'starvation_updated_at',
    ];

    public $incrementing = false;
}
