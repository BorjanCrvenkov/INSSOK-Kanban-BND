<?php

namespace App\Enums;

use App\Traits\EnumTrait;

enum UserWorkspaceAccessTypeEnum: string
{
    use EnumTrait;

    case ADMIN = 'admin';
    case MANAGER = 'manager';
    case USER = 'user';
}
