<?php

namespace App\Meubleo\Filters;

use Meubleo\Filters\Filter;
use Illuminate\Database\Eloquent\Builder;

class ProductNameFilter extends Filter
{
    public string $key = 'search';

    public function run(Builder $builder): Builder
    {
        return $builder->where('name', 'like', '%' . $this->value . '%');
    }
}
