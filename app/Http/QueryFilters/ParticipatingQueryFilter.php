<?php

namespace App\Http\QueryFilters;

use Spatie\QueryBuilder\Filters\Filter;
use Illuminate\Database\Eloquent\Builder;

class ParticipatingQueryFilter implements Filter
{
    public function __invoke(Builder $query, $value, string $property)
    {
        if (!auth()->user()) {
            return;
        }

        $query
            ->where('user_id', '<>', auth()->id())
            ->whereHas('posts', function ($query){
              $query->whereBelongsto(auth()->user());
        });
    }
}
