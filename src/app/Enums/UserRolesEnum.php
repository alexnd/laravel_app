<?php

namespace App\Enums;

class UserRolesEnum
{
    const GUEST = 0;
    const USER = 1;
    const ADMIN = 2;

    public static function getDictionary()
    {
        return [
            self::GUEST => 'GUEST',
            self::USER => 'USER',
            self::ADMIN => 'ADMIN',
        ];
    }

    public static function getMapIds()
    {
        return [
            'GUEST' => self::GUEST,
            'USER' => self::USER,
            'ADMIN' => self::ADMIN,
        ];
    }
}
