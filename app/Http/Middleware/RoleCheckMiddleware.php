<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class RoleCheckMiddleware
{
    public function handle(Request $request, Closure $next, $role)
    {
        $userRole = Session::get('USERROLE');

        if ($userRole == $role) {
            return $next($request);
        } else {
            return redirect()->route('not-authorized');
        }
    }
}

