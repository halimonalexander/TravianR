<?php

namespace App\Enums;

enum WorldSectors: int
{
    /** x- y+ */
    case NORTH_WEST = 1;

    /** x+ y+ */
    case NORTH_EAST = 2;

    /** x- y- */
    case SOUTH_WEST = 3;

    /** x+ y- */
    case SOUTH_EAST = 4;
}
