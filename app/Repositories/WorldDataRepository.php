<?php

namespace App\Repositories;

use App\Enums\WorldSectors;
use App\Exceptions\WorldCellOccupied;
use App\Models\WorldCell;
use Illuminate\Support\Collection;

class WorldDataRepository
{
    public function bulkCreate(array $records): void
    {
        WorldCell::insert($records);
    }

    public function findClosestFreeCell(WorldSectors $sector, int $minRadius, int $fromX = 0, int $fromY = 0, int $type = 3): WorldCell
    {
        $query = WorldCell::query()
            ->where('occupied', '=', 0)
            ->whereRaw('x*x + y*y >= ' . ($sector->value ** 2));

        $query = match ($sector) {
            WorldSectors::NORTH_WEST => $query->where('x', '<', 0)->where('y', '>', 0),
            WorldSectors::NORTH_EAST => $query->where('x', '>', 0)->where('y', '>', 0),
            WorldSectors::SOUTH_WEST => $query->where('x', '<', 0)->where('y', '<', 0),
            WorldSectors::SOUTH_EAST => $query->where('x', '>', 0)->where('y', '<', 0),
        };

        return $query
            ->orderByRaw('x*x + y*y')
            ->limit(1)
            ->first();
    }

    public function findByCoords(int $x, int $y): WorldCell
    {
        if (abs($x) > (int)env('WORLD_SIZE') || abs($y) > (int)env('WORLD_SIZE')) {
            throw new \OutOfBoundsException();
        }

        return WorldCell::query()
            ->whereX($x)
            ->whereY($y)
            ->first();
    }

    public function occupy(WorldCell $cell): void
    {
        $cell->refresh();
        if ($cell->occupied) {
            throw new WorldCellOccupied('Cell with x=' . $cell->x . '|y=' . $cell->y . ' is occupied');
        }

        $cell->occupied = true;
        $cell->saveOrFail();
    }

    public function findOasises(): Collection
    {
        return WorldCell::query()
            ->where('oasis_type', '>', 0)
            ->get();
    }
}
