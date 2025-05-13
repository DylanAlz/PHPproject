<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Requests\Auth\LoginRequest;

class AcoountController extends Controller
{
    public function login()
    {
        return view('auth/login');
    }

    public function loginPost(Request $request) : RedirectResponse
    {
        $request->aunthentcate();
        $request->session()->regenerate();
        return redirect()->intended(route('home.index', absolute: false));
    }

    public function logout(Request $request) : RedirectResponse
    {
        Auth::guard('web')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return Redirect(route('login'));
    }
}
