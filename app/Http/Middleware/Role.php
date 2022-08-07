<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class Role
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, ...$roles)
    {
        if (Auth::user()) {
            if (in_array(Auth::user()->role, $roles)) {//cek apaka role ssuai dengan route
                return $next($request);
            }
        } 
        return redirect('/404');
    }
}
