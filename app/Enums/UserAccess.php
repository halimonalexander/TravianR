<?php

declare(strict_types=1);

namespace App\Enums;

enum UserAccess: int
{
    case Banned = 0;
    case Auth = 1;
    case User = 2;
    case A3 = 3;
    case A4 = 4;
    case A5 = 5;
    case A6 = 6;
    case A7 = 7;
    case Multihunter = 8;
    case Admin = 9;
}
