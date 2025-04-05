<?php

namespace App\Http\QueryFilters;

use Spatie\QueryBuilder\Filters\Filter;
use Illuminate\Database\Eloquent\Builder;

class TopicQueryFilter implements Filter
{
    public function __invoke(Builder $query, $value, string $property)
    {
        $query->whereHas('topic', function($query) use ($value) {
            $query->where('slug', $value);
        });
    }
}