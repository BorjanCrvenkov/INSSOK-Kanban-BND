<?php

namespace App\Enums;

enum TaskPriorityEnum: string
{
    case LOWEST = 'lowest';
    case LOW = 'low';
    case MEDIUM = 'medium';
    case HIGH = 'high';
    case HIGHEST = 'highest';

    /**
     * @return string
     */
    public static function getAllValuesAsString(): string
    {
        return implode(', ', array_column(self::cases(), 'value'));
    }
}
