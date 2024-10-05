<?php

namespace App\Services;

use App\Enums\OasisTypes;
use App\Enums\UnitTypes;
use App\Models\Oasis;
use App\Models\Unit;
use App\Models\WorldCell;
use App\Repositories\OasisesRepository;
use App\Repositories\UnitsRepository;
use Illuminate\Support\Facades\DB;

class OasisService
{
    public function __construct(
        private readonly OasisesRepository $oasisesRepository,
        private readonly UnitsRepository $unitsRepository,
    ) {
    }

    public function create(WorldCell $cell): Oasis
    {
        $oasis = $this->oasisesRepository->create($cell);

        $availableUnitTypes = range(UnitTypes::UNIT_31->value, UnitTypes::UNIT_40->value);
        $unitsData = array_map(fn (int $type) => [
            'oasis_id' => $oasis->id,
            'type' => $type,
            'amount' => 0,
        ], $availableUnitTypes);
        Unit::insert($unitsData);

        return $oasis;
    }

    public function incrementArmy(Oasis $oasis): void
    {
        $increment = $this->getPopulationIncrement($oasis->type);

        DB::beginTransaction();
        foreach ($increment as $unitTypeId => $amount) {
            $this->unitsRepository->increment($oasis, $unitTypeId, $amount);
        }
        DB::commit();
    }

    private function getPopulationIncrement(OasisTypes $oasisType): array
    {
        $beasts = [];

        switch ($oasisType) {
            case OasisTypes::SmallLumber:
                $beasts[UnitTypes::UNIT_35->value] = random_int(1, 5);
                $beasts[UnitTypes::UNIT_36->value] = random_int(0, 3);
                $beasts[UnitTypes::UNIT_37->value] = random_int(0, 1);
                break;
            case OasisTypes::HugeLumber:
                $beasts[UnitTypes::UNIT_35->value] = random_int(3, 5);
                $beasts[UnitTypes::UNIT_36->value] = random_int(1, 3);
                $beasts[UnitTypes::UNIT_37->value] = random_int(1, 2);
                break;
            case OasisTypes::LumberWithCrop:
                $beasts[UnitTypes::UNIT_35->value] = random_int(3, 7);
                $beasts[UnitTypes::UNIT_36->value] = random_int(2, 5);
                $beasts[UnitTypes::UNIT_37->value] = random_int(1, 3);
                break;
            case OasisTypes::SmallClay:
                $beasts[UnitTypes::UNIT_31->value] = random_int(2, 5);
                $beasts[UnitTypes::UNIT_32->value] = random_int(1, 3);
                $beasts[UnitTypes::UNIT_35->value] = random_int(0, 3);
                break;
            case OasisTypes::HugeClay:
                $beasts[UnitTypes::UNIT_31->value] = random_int(5, 10);
                $beasts[UnitTypes::UNIT_32->value] = random_int(3, 5);
                $beasts[UnitTypes::UNIT_35->value] = random_int(1, 5);
                break;
            case OasisTypes::ClayWithCrop:
                $beasts[UnitTypes::UNIT_31->value] = random_int(7, 15);
                $beasts[UnitTypes::UNIT_32->value] = random_int(5, 10);
                $beasts[UnitTypes::UNIT_35->value] = random_int(3, 5);
                break;
            case OasisTypes::SmallIron:
                $beasts[UnitTypes::UNIT_31->value] = random_int(2, 5);
                $beasts[UnitTypes::UNIT_32->value] = random_int(1, 3);
                $beasts[UnitTypes::UNIT_34->value] = random_int(0, 3);
                break;
            case OasisTypes::HugeIron:
                $beasts[UnitTypes::UNIT_31->value] = random_int(5, 10);
                $beasts[UnitTypes::UNIT_32->value] = random_int(3, 5);
                $beasts[UnitTypes::UNIT_34->value] = random_int(1, 5);
                break;
            case OasisTypes::IronWithCrop:
                $beasts[UnitTypes::UNIT_31->value] = random_int(7, 15);
                $beasts[UnitTypes::UNIT_32->value] = random_int(5, 10);
                $beasts[UnitTypes::UNIT_34->value] = random_int(3, 5);
                break;
            case OasisTypes::SmallCropType1:
            case OasisTypes::SmallCropType2:
                $beasts[UnitTypes::UNIT_31->value] = random_int(1, 5);
                $beasts[UnitTypes::UNIT_33->value] = random_int(1, 3);
                $beasts[UnitTypes::UNIT_37->value] = random_int(0, 1);
                break;
            case OasisTypes::HugeCrop:
                $beasts[UnitTypes::UNIT_31->value] = random_int(7, 15);
                $beasts[UnitTypes::UNIT_33->value] = random_int(3, 7);
                $beasts[UnitTypes::UNIT_38->value] = random_int(0, 1);
                $beasts[UnitTypes::UNIT_39->value] = random_int(1, 100) > 80 ? 1 : 0;
                break;
        }

        return $beasts;
    }
}
