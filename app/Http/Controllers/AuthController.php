<?php

namespace App\Http\Controllers;

use App\Models\SavsoftUsersModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function showLogin(Request $request)
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        // Validate inputs
        $request->validate([
            'email' => 'required|string',
            'password' => 'required|string',
        ]);

        // Find user by username
        $user = SavsoftUsersModel::where('email', $request->email)->first();

        // Check if user exists and password is correct

        if ($user && $user->password === $request->password) {

            // Store user info in session
            session([
                'uid' => $user->uid,
                'first_name' => $user->first_name,
                'last_name' => $user->last_name,
            ]);

            return redirect()->route('dashboard')->with('success_login', 'Login successfull! Welcome back...');
        } else {
            return redirect()->back()->with('error', 'Invalid username or password');
        }
    }

    public function showRegister(Request $request)
    {
        return view('auth.register');
    }
}
