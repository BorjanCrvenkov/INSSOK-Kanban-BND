<?php

namespace App\Enums;

enum UserWorkspaceAccessTypeEnum: string
{
    case ADMIN = 'admin';
    case MANAGER = 'manager';
    case USER = 'user';

    /**
     * @return string
     */
    public static function getAllValuesAsString(): string
    {
        return implode(', ', array_column(self::cases(), 'value'));
    }
}
