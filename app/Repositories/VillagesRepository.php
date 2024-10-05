<?php

namespace App\Repositories;

use App\Enums\Buildings;
use App\Enums\CellTypes;
use App\Models\User;
use App\Models\Village;
use App\Models\VillageFields;
use App\Models\VillageResources;
use App\Models\VillageStatistic;
use App\Models\WorldCell;

class VillagesRepository
{
    public function __construct(
        private readonly WorldDataRepository $worldDataRepository,
    ) {
    }

    public function createVillage(
        User $user,
        WorldCell $cell,
        bool $isFirst,
    ): void {
        $this->worldDataRepository->occupy($cell);

        $name = match ($isFirst) {
            true => $user->username . __('messages.starting_village'),
            false => __('messages.new_village'),
        };

        $village = new Village();
        $village->world_cell_id = $cell->id;
        $village->owner = $user->id;
        $village->name = $name;
        $village->is_capital = $isFirst;
        $village->saveOrFail();

        $statistic = new VillageStatistic();
        $statistic->village_id = $village->id;
        $statistic->saveOrFail();

        $resources = new VillageResources();
        $resources->wood = 750;
        $resources->clay = 750;
        $resources->iron = 750;
        $resources->crop = 750;
        $resources->max_storage = env('STORAGE_BASE');
        $resources->max_granary = env('STORAGE_BASE');

        $this->createInitialResourceFields($village);

//        $database->initUnits($wid);
//        $database->initTech($wid);
//        $database->initABTech($wid);
    }

    private function createInitialResourceFields(Village $village): void
    {
        $types = match ($village->cell->field_type) {
            CellTypes::CROP_9 => [1 => 4,4,1,4,4,2,3,4,4,3,3,4,4,1,4,2,1,2],
            CellTypes::TYPE_3_4_5 => [1 => 3,4,1,3,2,2,3,4,4,3,3,4,4,1,4,2,1,2],
            CellTypes::NORMAL => [1 => 1,4,1,3,2,2,3,4,4,3,3,4,4,1,4,2,1,2],
            CellTypes::TYPE_4_5_3 => [1 => 1,4,1,2,2,2,3,4,4,3,3,4,4,1,4,2,1,2],
            CellTypes::TYPE_5_3_4 => [1 => 1,4,1,3,1,2,3,4,4,3,3,4,4,1,4,2,1,2],
            CellTypes::CROP_15 => [1 => 4,4,1,3,4,4,4,4,4,4,4,4,4,4,4,2,4,4],
            CellTypes::TYPE_4_4_3_7 => [1 => 1,4,4,1,2,2,3,4,4,3,3,4,4,1,4,2,1,2],
            CellTypes::TYPE_3_4_4_7 => [1 => 3,4,4,1,2,2,3,4,4,3,3,4,4,1,4,2,1,2],
            CellTypes::TYPE_4_3_4_7 => [1 => 3,4,4,1,1,2,3,4,4,3,3,4,4,1,4,2,1,2],
            CellTypes::TYPE_3_5_4 => [1 => 3,4,1,2,2,2,3,4,4,3,3,4,4,1,4,2,1,2],
            CellTypes::TYPE_4_3_5 => [1 => 3,1,1,3,1,4,4,3,3,2,2,3,1,4,4,2,4,4],
            CellTypes::TYPE_5_4_3 => [1 => 1,4,1,1,2,2,3,4,4,3,3,4,4,1,4,2,1,2],
        };
        for ($i = 1; $i <= 18; $i++) {
            VillageFields::create([
                'village_id' => $village->id,
                'position' => $i,
                'type' => $types[$i],
                'level' => 0,
            ]);
        }

        VillageFields::create([
            'village_id' => $village->id,
            'position' => 26,
            'type' => Buildings::MainBuilding->value,
            'level' => 1,
        ]);
        $village->refresh();
        $village->statistic->population += 2;
        $village->statistic->saveOrFail();
    }
}
