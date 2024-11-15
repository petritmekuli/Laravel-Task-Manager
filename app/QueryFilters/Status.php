<?php
namespace App\QueryFilters;
use Closure;

class Status{
    public function handle($queryBuilder, Closure $next){
        if(!request()->filled('status')){
            // skip adding adding filter to the query builder.
            return $next($queryBuilder);
        }

        return $next($queryBuilder->where(
            'status', request()->status == 1 ? true : false)
        );
    }
}
