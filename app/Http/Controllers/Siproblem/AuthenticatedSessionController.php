<?php

namespace App\Http\Controllers\Siproblem;

use App\Http\Controllers\Controller;
use App\Http\Requests\Siproblem\LoginRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthenticatedSessionController extends Controller
{
    public function login()
    {
        return view('siproblem.auth.login');
    }

    public function authenticate(LoginRequest $request)
    {
        $request->authenticate();
        $request->session()->regenerate();
        return redirect()->route('siproblem.home');
    }

    public function logout(Request $request)
    {
        Auth::guard('web')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect(route('siproblem.auth.login'));
    }
}
