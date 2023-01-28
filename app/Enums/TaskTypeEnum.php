<?php

namespace App\Enums;

enum TaskTypeEnum: string
{
    case STORY = 'story';
    case TASK = 'task';
    case BUG = 'bug';

    /**
     * @return string
     */
    public static function getAllValuesAsString(): string
    {
        return implode(', ', array_column(self::cases(), 'value'));
    }
}
