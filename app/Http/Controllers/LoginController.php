<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function showFormLogin()
    {
        return view('user.login');
    }
    public function Login(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required'],
            'password' => ['required'],
        ]);
        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            return redirect()->route('home');
        }
        return back()->withErrors([
            'email' => 'Email không đúng',
        ])->onlyInput('email');
    }

    public function Logout()
    {
        Auth::Logout();

        \request()->session()->invalidate();

        return redirect()->route('home');
    }
}
