<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property int $village_id
 * @property int $population
 * @property int $culture_point
 * @property int $loyalty
 * @property Carbon $updated_at
 */
class VillageStatistic extends Model
{
    const CREATED_AT = null;

    protected $table = 'village_statistic';
    protected $primaryKey = 'village_id';
    protected $fillable = [
        'village_id',
        'population',
        'culture_points',
        'loyalty',
    ];

    public $incrementing = false;

    public function village(): BelongsTo
    {
        return $this->belongsTo(Village::class, 'village_id');
    }
}
