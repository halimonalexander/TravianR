<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property int $villageId
 * @property int $position
 * @property int $type
 * @property int $level
 */
class VillageFields extends Model
{
    protected $table = 'village_fields';
    protected $fillable = [
        'village_id',
        'position',
        'type',
        'level',
    ];
}
