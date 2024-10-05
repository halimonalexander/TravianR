<?php

namespace App\Repositories;

use App\Models\Oasis;
use App\Models\Unit;
use App\Models\Village;

class UnitsRepository
{
    public function increment(Oasis|Village $location, int $typeId, $value): void
    {
        $query = $location instanceof Oasis ?
            Unit::query()->where('oasis_id', '=', $location->id) :
            Unit::query()->where('village_id', '=', $location->id);
        $query
            ->where('type', '=', $typeId)
            ->increment('amount', $value);
    }
}
