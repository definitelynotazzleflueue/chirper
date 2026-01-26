<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class Login extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        //input validation
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        //login attempt
        if (Auth::attempt($credentials, $request->boolean('remember'))) {
            //Regenerate session to prevent fixation attacks
            $request->session()->regenerate();
    
            //redirect to intended page or home
            return redirect()->intended('/')->with('success','Welcome Back!');
        }
        //if login fails, return back with error message
        return back()
            ->withErrors(['email' => 'The provided credentials do not match our records.'])
            ->onlyInput('email');    
    }
}
