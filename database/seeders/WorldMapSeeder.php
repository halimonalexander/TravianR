<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Enums\CellTypes;
use App\Enums\OasisTypes;
use App\Models\WorldCell;
use App\Repositories\UsersRepository;
use App\Repositories\VillagesRepository;
use App\Repositories\WorldDataRepository;
use App\Services\OasisService;
use Illuminate\Console\View\Components\TwoColumnDetail;
use Illuminate\Database\Seeder;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

class WorldMapSeeder extends Seeder
{
    public function __construct(
        private readonly UsersRepository $usersRepository,
        private readonly VillagesRepository $villagesRepository,
        private readonly WorldDataRepository $worldDataRepository,
        private readonly OasisService $oasisService,
    ) {
    }

    public function run(): void
    {
        $this->process('Generate map', fn() => $this->fillMap((int)env('WORLD_SIZE')));
        $this->process('Create village from multihunter', fn() => $this->createMultihunterVillage());
        $this->process('Create oasises', fn() => $this->initOasises());
    }

    private function process(string $title, callable $action): void
    {
        (new TwoColumnDetail($this->command->getOutput()))
            ->render($title, '<fg=yellow;options=bold>RUNNING</>');

        $startTime = microtime(true);
        $action();
        $runTime = number_format((microtime(true) - $startTime) * 1000);

        (new TwoColumnDetail($this->command->getOutput()))
            ->render($title, "<fg=gray>$runTime ms</> <fg=green;options=bold>DONE</>");

        $this->command->getOutput()->writeln('');
    }

    private function fillMap(int $worldSize): void
    {
        $cells = [];
        $axiasSize = 2 * $worldSize + 1;
        for ($i = 0; $i < $axiasSize; $i++) {
            $y = $worldSize - $i;

            for ($j = 0; $j < $axiasSize; $j++) {
                $x = -1 * $worldSize + $j;

                $cells[] = $this->generateCell($x, $y, $worldSize);
            }
        }

        $this->worldDataRepository->bulkCreate($cells);
    }

    private function generateCell(int $x, int $y, int $worldSize): array
    {
        // choose a field type
        if (($x === 0 && $y === 0) || ($x === $worldSize && $y === $worldSize)) {
            $cellType = 3;
            $oasisType = 0;
            $image = 't' . random_int(0, 9);
        } else {
            $rand = random_int(1, 1000);
            $cellType = $this->getFieldType($rand)->value;
            $oasisType = $this->getOasisType($rand)->value;
            $image = 'o' . $oasisType;
        }

        return [
            'x' => $x,
            'y' => $y,
            'field_type' => $cellType,
            'oasis_type' => $oasisType,
            'image' => $image,
        ];
    }

    private function getFieldType(int $rand): CellTypes|int
    {
        return match (true) {
            $rand <= 10 => CellTypes::CROP_9,
            $rand <= 90 => CellTypes::TYPE_3_4_5,
            $rand <= 400 => CellTypes::NORMAL,
            $rand <= 480 => CellTypes::TYPE_4_5_3,
            $rand <= 560 => CellTypes::TYPE_5_3_4,
            $rand <= 570 => CellTypes::CROP_15,
            $rand <= 600 => CellTypes::TYPE_4_4_3_7,
            $rand <= 630 => CellTypes::TYPE_3_4_4_7,
            $rand <= 660 => CellTypes::TYPE_4_3_4_7,
            $rand <= 740 => CellTypes::TYPE_3_5_4,
            $rand <= 820 => CellTypes::TYPE_4_3_5,
            $rand <= 900 => CellTypes::TYPE_5_4_3,
            default => CellTypes::Oasis,
        };
    }

    private function getOasisType(int $rand): OasisTypes|int
    {
        return match (true) {
            $rand <= 900 => OasisTypes::Cell,
            $rand <= 908 => OasisTypes::SmallLumber,
            $rand <= 916 => OasisTypes::HugeLumber,
            $rand <= 924 => OasisTypes::LumberWithCrop,
            $rand <= 932 => OasisTypes::SmallClay,
            $rand <= 940 => OasisTypes::HugeClay,
            $rand <= 948 => OasisTypes::ClayWithCrop,
            $rand <= 956 => OasisTypes::SmallIron,
            $rand <= 964 => OasisTypes::HugeIron,
            $rand <= 972 => OasisTypes::IronWithCrop,
            $rand <= 980 => OasisTypes::SmallCropType1,
            $rand <= 988 => OasisTypes::SmallCropType2,
            default => OasisTypes::HugeCrop,
        };
    }

    private function createMultihunterVillage(): void
    {
        $user = $this->usersRepository->findByName('Multihunter');

        $cell = $this->worldDataRepository->findByCoords(0, 0);
        $this->villagesRepository->createVillage($user, $cell, true);
    }

    private function initOasises(): void
    {
        $oasises = $this->worldDataRepository->findOasises();

        $bar = $this->command->getOutput()->createProgressBar($oasises->count());
        $bar->start();

        DB::beginTransaction();

        $oasises
            ->each(function (WorldCell $cell) use ($bar): void {
                $oasis = $this->oasisService->create($cell);
                $this->oasisService->incrementArmy($oasis);

                $bar->advance();
            });

        DB::commit();
        $bar->finish();
        $this->command->getOutput()->writeln('');
    }
}
