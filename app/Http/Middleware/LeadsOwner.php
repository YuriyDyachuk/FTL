<?php

namespace App\Http\Middleware;

use Auth;
use Closure;


class LeadsOwner
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
        $user = Auth::getUser();
        if(!$user->hasRole(['lead_manager', 'chief', 'client'])){
            return abort(403);
        }
        return $next($request);
    }
}
