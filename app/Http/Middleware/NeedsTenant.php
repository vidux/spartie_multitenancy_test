<?php

namespace App\Http\Middleware;

use Closure;
use Spatie\Multitenancy\Exceptions\NoCurrentTenant;
use Spatie\Multitenancy\Http\Middleware\NeedsTenant as BaseNeedsTenant;

class NeedsTenant extends BaseNeedsTenant
{
   
    public function handle($request, Closure $next)
    {
        if (! $this->getTenantModel()::checkCurrent()) {
            return $this->handleInvalidRequest();
        }

        return $next($request);
    }

    public function handleInvalidRequest()
    {
        abort(404);
        //throw NoCurrentTenant::make();
    }
}
