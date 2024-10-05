<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * @property int $oasis_id
 * @property float $wood
 * @property float $clay
 * @property float $iron
 * @property float $crop
 * @property int $max_storage
 * @property int $max_granary
 * @property Carbon $updated_at
 */
class OasisResources extends Model
{
    public const CREATED_AT = null;

    protected $table = 'oasis_resources';
    protected $primaryKey = 'oasis_id';
    protected $fillable = [
        'oasis_id',
        'wood',
        'clay',
        'iron',
        'crop',
        'max_storage',
        'max_granary',
    ];

    public $incrementing = false;
}
