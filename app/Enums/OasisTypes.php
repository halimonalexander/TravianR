<?php

namespace App\Enums;

enum OasisTypes: int
{
    case Cell = 0;
    case SmallLumber = 1;
    case HugeLumber = 2;
    case LumberWithCrop = 3;
    case SmallClay = 4;
    case HugeClay = 5;
    case ClayWithCrop = 6;
    case SmallIron = 7;
    case HugeIron = 8;
    case IronWithCrop = 9;
    case SmallCropType1 = 10;
    case SmallCropType2 = 11;
    case HugeCrop = 12;
}
