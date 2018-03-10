<?php

namespace App\Http\Middleware;

use App\Models\Organization;
use Closure;

class HasOrganization
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (Organization::count() === 0) {
            return redirect()->route('organization.create');
        }
        return $next($request);
    }
}
