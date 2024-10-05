<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

/**
 * @property int $id
 * @property int $world_cell_id
 * @property WorldCell $cell
 * @property int $owner
 * @property int $type
 * @property string $name
 * @property bool $is_capital
 * @property bool $is_natar
 * @property bool $evasion
 * @property bool $has_celebration
 * @property Carbon $created_at
 * @property Carbon $updated_at
 *
 * @property VillageStatistic $statistic
 */
class Village extends Model
{
    protected $table = 'villages';
    protected $fillable = [
        'world_cell_id',
        'owner',
        'type',
        'name',
        'is_capital',
        'is_natar',
        'evasion',
        'has_celebration',
    ];

    /**
     * @return BelongsTo<User>
     */
    public function owner(): BelongsTo
    {
        return $this->belongsTo(User::class, 'owner');
    }

    /**
     * @return BelongsTo<WorldCell>
     */
    public function cell(): BelongsTo
    {
        return $this->belongsTo(WorldCell::class, 'world_cell_id');
    }

    public function statistic(): HasOne
    {
        return $this->hasOne(VillageStatistic::class);
    }
}
