<?php
namespace App\QueryFilters;
use Closure;

class Priority{
    public function handle($queryBuilder, Closure $next){
        if (!request()->filled('priority')) {
            // skip adding adding filter to the query builder.
            return $next($queryBuilder);
        }

        return $next($queryBuilder->where('priority', request('priority')));
    }
}
