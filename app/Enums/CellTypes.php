<?php

namespace App\Enums;

enum CellTypes: int
{
    case Oasis = 0;
    case CROP_9 = 1;
    case TYPE_3_4_5 = 2;
    case NORMAL = 3;
    case TYPE_4_5_3 = 4;
    case TYPE_5_3_4 = 5;
    case CROP_15 = 6;
    case TYPE_4_4_3_7 = 7;
    case TYPE_3_4_4_7 = 8;
    case TYPE_4_3_4_7 = 9;
    case TYPE_3_5_4 = 10;
    case TYPE_4_3_5 = 11;
    case TYPE_5_4_3 = 12;
}
