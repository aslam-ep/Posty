<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LogoutController extends Controller
{
    /**
     * Only logined users can logout
     */
    public function __construct()
    {
        $this->middleware(['auth']);
    }

    /* 
    * Loging out user using auth() helper
    * Redirecting back to the home
    */
    public function store()
    {
        auth()->logout();

        return redirect()->route('home');
    }
}
