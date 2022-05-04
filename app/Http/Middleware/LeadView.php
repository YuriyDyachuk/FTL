<?php

namespace App\Http\Middleware;

use Closure;

class LeadView
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
        if(!\Auth::user()->can('lead_view')){
            return abort(403);
        }
        return $next($request);
    }
}
