<?php

namespace App\Http\Middleware\Siproblem;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;

class AuthMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        Config::set('database.default', 'sqlite');
        auth()->setDefaultDriver('siproblem');
        if (!Auth::check()) {
            return redirect(route('siproblem.auth.login'));
        }
        return $next($request);
    }
}
