<?php

namespace App\Builders;

use Illuminate\Database\Eloquent\Builder;

class BaseBuilder extends Builder
{
    public function firstOrDefault()
    {
        return $this->first() ?? $this->getModel();
    }

    public function findOrDefault(int $id)
    {
        return $this->find($id) ?? $this->getModel();
    }

    public function firstWhereOrDefault(string $param, string $paramTwo, string $paramThere = null)
    {
        if ($paramThere) {
            $model = $this->where($param, $paramTwo, $paramThere)->first();
        } else {
            $model = $this->where($param, $paramTwo)->first();
        }
        return $model ?? $this->getModel();
    }
}
