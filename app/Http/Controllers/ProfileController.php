<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class ProfileController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the authenticated user's profile.
     */
    public function show(Request $request)
    {
        $user = $request->user();
        $isStudent = Str::endsWith(strtolower($user->email), '@student.dmmmsu.edu.ph');

        return view('users.profile', compact('user', 'isStudent'));
    }

    /**
     * Show the edit form for the authenticated user.
     */
    public function edit(Request $request)
    {
        $user = $request->user();
        return view('users.edit', compact('user'));
    }

    /**
     * Update the authenticated user's profile (name, email, optional password).
     */
    public function update(Request $request)
    {
        $user = $request->user();

        $data = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255', Rule::unique('users')->ignore($user->id)],
            'password' => ['nullable', 'confirmed', 'min:8'],
        ]);

        $user->name = $data['name'];
        $user->email = $data['email'];

        if (!empty($data['password'])) {
            $user->password = Hash::make($data['password']);
        }

        $user->save();

        return redirect()->route('profile')->with('success', 'Profile updated.');
    }
}