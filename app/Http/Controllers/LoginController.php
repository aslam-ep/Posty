<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LoginController extends Controller
{
    /**
     * only guest users has access to this page
     */
    public function __construct()
    {
        $this->middleware(['guest']);
    }

    public function index()
    {
        return view('auth.login');
    }

    /* 
    * Validate form data
    * Signin user using auth() helper
    * Redirect to dashboard
    */
    public function store(Request $request)
    {
        $this->validate($request, [
            'email' => 'required|email',
            'password' => 'required',
        ]);

        /* 
        * Rememeber value passed as second argument for attempt
        * To remember username and password beyond session
        */
        if (!auth()->attempt($request->only('email', 'password'), $request->remember)) {
            return back()->with('status', 'Invalid username or password');
        }

        return redirect()->route('dashboard');
    }
}
