<?php

namespace App\Http\Middleware;

use App\Helpers\RoleHelper;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class AuthorizeMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next,$permission=null): Response
    {
        if (!Auth::check()){

            return redirect()->route('login');

        }

        if (!empty($permission)){

            $isAuthotized= RoleHelper::isAuthorized($permission);

            if(!$isAuthotized){

                abort(403,'No hay autorización');

            }

        }

        return $next($request);
    }
}
