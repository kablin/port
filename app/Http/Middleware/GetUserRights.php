<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class GetUserRights
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
     public function handle(Request $request, Closure $next): Response
     {
       if (Auth::check()) {
         $user =  Auth::user();
         if (config('app.products.role')=='admin')
         $user->givePermissionTo('edit articles');
         else $user->revokePermissionTo('edit articles');

       }

       return $next($request);
     }
}