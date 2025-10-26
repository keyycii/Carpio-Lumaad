<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    // show login form (optional if you already have a route/view)
    public function showLogin()
    {
        return view('auth.login');
    }

    // handle login form from resources/views/auth/login.blade.php
    public function login(Request $request)
    {
        $data = $request->validate([
            'name'  => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255'],
        ]);

        // find or create user by email
        $user = User::firstOrCreate(
            ['email' => $data['email']],
            [
                'name'     => $data['name'],
                // ensure password column filled (random secure password)
                'password' => Hash::make(Str::random(24)),
            ]
        );

        // keep name up to date
        if ($user->name !== $data['name']) {
            $user->name = $data['name'];
            $user->save();
        }

        // log the user in
        Auth::login($user);

        // redirect by domain
        if (Str::endsWith(strtolower($user->email), '@student.dmmmsu.edu.ph')) {
            // management system (adjust route if you use another)
            return redirect()->intended(route('users.index'));
        }

        // everyone else goes to shop
        return redirect()->intended(url('/shop'));
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('homepage');
    }
}