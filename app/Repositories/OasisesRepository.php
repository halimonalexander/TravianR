<?php

namespace App\Repositories;

use App\Enums\OasisTypes;
use App\Models\Oasis;
use App\Models\OasisResources;
use App\Models\WorldCell;

class OasisesRepository
{
    public function create(WorldCell $cell): Oasis
    {
        $oasis = new Oasis();
        $oasis->type = $cell->oasis_type;
        $oasis->high = match (true) {
            $cell->oasis_type <= OasisTypes::LumberWithCrop->value => 1,
            $cell->oasis_type <= OasisTypes::IronWithCrop => 2,
            default => 0,
        };
        $oasis->world_cell_id = $cell->id;
        $oasis->name = __('messages.UNOCCUOASIS');
        $oasis->saveOrFail();

        $resources = new OasisResources();
        $resources->oasis_id = $oasis->id;
        $resources->wood = 0;
        $resources->clay = 0;
        $resources->iron = 0;
        $resources->crop = 0;
        $resources->max_storage = match ($oasis->type) {
            default => 800,
        };
        $resources->max_granary = match ($oasis->type) {
            default => 800,
        };
        $resources->saveOrFail();

        return $oasis;
    }

    public function find(WorldCell $cell): Oasis
    {
        return Oasis::whereWorldCellId($cell->id)->first();
    }
}
