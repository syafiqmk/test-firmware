<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    // Login page
    public function login() {
        return view('auth.login');
    }

    // Login Attempt Process
    public function attempt(Request $request) {
        $validate = $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        if(Auth::attempt($validate)) {
            $request->session()->regenerate();
            return redirect()->route('web.firmware');
        } else {
            return redirect()->route('auth.login')->with('danger', 'Fail to Login check your Email & Password!');
        }
    }

    // Logout Process
    public function logout(Request $request) {
        auth()->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('/');
    }
}
