<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AuthController extends Controller
{
    // admin login
    public function adminLogin()
    {
        return view('login', ['role' => 'admin']);
    }

    // student login
    public function studentLogin()
    {
        return view('login', ['role' => 'student']);
    }

    // organization login
    public function organizationLogin()
    {
        return view('login', ['role' => 'organization']);
    }

    // authenticate user
    public function authenticate(Request $request)
    {
        // validate request
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        // check user
        $credentials = $request->only('email', 'password');
        if (!auth()->attempt($credentials)) {
            return back()->withErrors(['error' => 'Invalid credentials']);
        }

        // redirect user
        $user = auth()->user();

        if ($user->role === 'admin') {
            return redirect()->route('admin.dashboard');
        } elseif ($user->role === 'student') {
            return redirect()->route('student.dashboard');
        } elseif ($user->role === 'organization') {
            return redirect()->route('organization.dashboard');
        } else {
            return back()->withErrors(['error' => 'Invalid credentials']);
        }
    }

    // student signup
    public function studentSignup()
    {
        return view('signup');
    }

    // register student
    public function registerStudent(Request $request)
    {
        // validate request


        // create student


        // login student


        // redirect student

    }


    // logout


}
