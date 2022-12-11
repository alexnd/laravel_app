<?php

namespace App\Models;

class Bid extends BaseModel
{
    protected $table = 'bids';

    protected $fillable = [
        'user_id',
        'value',
        'prize',
        'win',
        'created_at',
    ];

    public $timestamps = false;
}
