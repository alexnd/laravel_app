<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Builders\BaseBuilder;

abstract class BaseModel extends Model
{
    public function newEloquentBuilder($query)
    {
        return new BaseBuilder($query);
    }
}
