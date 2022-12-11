<?php

namespace App\Enums;

class BidStatusEnum
{
    const WIN_ID = 0;
    const LOSE_ID = 1;

    public static function getDictionary()
    {
        return [
            self::WIN_ID => 'WIN',
            self::LOSE_ID => 'LOSE'
        ];
    }

    public static function getMapIds()
    {
        return [
            'WIN' => self::WIN_ID,
            'LOSE' => self::LOSE_ID
        ];
    }
}
