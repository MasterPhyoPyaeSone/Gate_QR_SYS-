<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;


class LoginController extends Controller
{
    public function loginView()
    {
        if (!auth()->check()) {
            return view('Login.loginForm');
        } else {
            return redirect('/')->with('info', 'You are already logged in!');
        }
    }

    public function loginStore(Request $request)
    {


        // $credentials = User::where('username',$request->username)
        //             ->orWhere('password',$request->password)
        //             ->exists();


        // if ($credentials) {   
        //     dd('gg');        
        //     return redirect('/')->with('success');
        // } else {
        //     // Authentication failed
        //     return back()->with('error', 'Invalid email or password');
        // }

        $credentials = [
            'username' => $request['username'],
            'password' => $request['password'],
        ];

        if (Auth::attempt($credentials)) {
            $user = Auth::user();
            
            if ($user->role == 'admin') {
                return redirect('/')->with('success', 'Logged in successfully!');
            } else {
                Auth::logout();
                return back()->with('error', 'You are not an admin.');
            }
        } else {
            return back()->with('error', 'Invalid username or password');
        } 
    }

    public function Logout()
    {
        auth()->logout();
        return redirect('/')->with('success');
    }
}
