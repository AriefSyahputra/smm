<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function login()
    {
        return view('pages.auth.login');
    }

    public function authenticate(Request $request)
    {
        $validation = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required|min:8|max:50',
        ]);

        if ($validation->fails()) {
            return back()->withErrors($validation->getMessageBag());
        }

        $remember_me = $request->has('remember') ? true : false;

        $credentials = ['email' => $request->email, 'password' => $request->password, 'status' => 'active'];

        if (Auth::attempt($credentials, $remember_me)) {
            $request->session()->regenerate();
            return redirect()->intended('/');
        }

        return back()->withErrors([
            'error' => 'The provided credentials do not match our records.',
        ]);
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login');
    }
}
