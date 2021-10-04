<?php

/* 
* Controller to handle user registarion
*/

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    public function __construct()
    {
        $this->middleware(['guest']);
    }

    // To return the basic view for registration form
    public function index()
    {
        return view('auth.register');
    }

    /* 
    * Validate data
    * Insert data to users model
    * Sign in the user
    * redirect to dashboard
    */
    public function store(Request $request)
    {
        // Throw an exception when the validation fail and return back()
        $this->validate($request, [
            'name' => 'required|max:250',
            'username' => 'required|max:12|min:6',
            'email' => 'required|email',
            'password' => 'required|confirmed',
        ]);

        // 'Hash::' its not a static method its a Facade
        User::create([
            'name' => $request->name,
            'username' => $request->username,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        auth()->attempt($request->only('email', 'password'));

        return redirect()->route('dashboard');
    }
}
