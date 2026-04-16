<?php

declare(strict_types=1);

namespace Meubleo\Filters;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

abstract class Filter
{
    public string $key = '';
    protected mixed $value = null;

    public function __construct(protected Request $request)
    {
        $this->value = $request->get($this->key);
    }

    abstract public function run(Builder $builder): Builder;

    public function isActive(): bool
    {
        return $this->value !== null && $this->value !== '';
    }

    /**
     * Apply multiple filters to a query.
     *
     * @param  Filter[]  $filters
     */
    public static function applyAll(Builder $builder, array $filters): Builder
    {
        foreach ($filters as $filter) {
            if ($filter->isActive()) {
                $builder = $filter->run($builder);
            }
        }

        return $builder;
    }
}
