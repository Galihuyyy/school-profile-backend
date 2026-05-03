<?php

namespace App\Http\Controllers\admin\auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function loginProcess(Request $request)
    {
        $request->validate([
            'login' => 'required|string',
            'password' => 'required|string',
        ]);

        $loginInput = $request->input('login');

        $field = filter_var($loginInput, FILTER_VALIDATE_EMAIL)
            ? 'email'
            : 'username';

        if (Auth::attempt([$field => $loginInput, 'password' => $request->password])) {
            $request->session()->regenerate();
            return redirect()->route('admin::school-settings.index');
        }

        return back()->withErrors([
            'login' => 'These credentials do not match our records.',
        ])->withInput();
    }
}
