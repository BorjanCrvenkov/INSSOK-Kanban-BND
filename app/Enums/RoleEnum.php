<?php

namespace App\Enums;

use App\Traits\EnumTrait;

enum RoleEnum: string
{
    use EnumTrait;

    case ADMINISTRATOR = 'administrator';
    case USER = 'user';
}
