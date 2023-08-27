<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Models\User;


class AuthController extends Controller
{
    function index() 
    {
        $user = User::all();
        return view('layouts.master',['users' => $user]);
    }
    function login() 
    {
        return view('admin.auth.login');
    }
    function postLogin(Request $request) 
    {

        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
 
            return redirect()->intended('/');
        }

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ])->onlyInput('email');
    }
    function logout(Request $request) {
        Auth::guard('web')->logout();
        // Auth::logout();
 
        $request->session()->invalidate();
    
        $request->session()->regenerateToken();
    
        return redirect('/login');
    }
}
