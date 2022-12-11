<?php

namespace App\Models;

class GamePlayer extends BaseModel
{
	protected $table = 'game_players';

    protected $fillable = [
        'username',
        'phone',
        'uri',
    ];
}
