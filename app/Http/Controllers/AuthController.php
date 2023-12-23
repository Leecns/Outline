<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'password' => 'required|max:128',
        ]);

        $credentials = [
            'username' => 'admin',
            'password' => $request->password
        ];

        if (auth()->attempt($credentials, remember: true)) {
            return redirect()->route('servers.index');
        }

        return redirect()->back()->withErrors([
            'password' => __('Provided password is incorrect :(')
        ]);
    }

    public function logout()
    {
        auth()->logout();

        return redirect()->route('auth.login.show');
    }
}
