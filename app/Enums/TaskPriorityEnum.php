<?php

namespace App\Enums;

use App\Traits\EnumTrait;

enum TaskPriorityEnum: string
{
    use EnumTrait;

    case LOWEST = 'lowest';
    case LOW = 'low';
    case MEDIUM = 'medium';
    case HIGH = 'high';
    case HIGHEST = 'highest';

}
