<?php

namespace App\Enums;

use App\Traits\EnumTrait;

enum TaskTypeEnum: string
{
    use EnumTrait;

    case STORY = 'story';
    case TASK = 'task';
    case BUG = 'bug';
}
