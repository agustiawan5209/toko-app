<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next, string $role)
    {
        if($role == 'Admin' && Auth::user()->role_id !=0){
            abort(403);
        }
        if($role == 'Gudang' && Auth::user()->role_id !=1){
            abort(403);
        }
        if($role == 'Supplier' && Auth::user()->role_id !=2){
            abort(403);
        }
        return $next($request);
    }
}
