<?php

namespace App\Http\Controllers\admin\auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Carbon\Carbon;
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

        $user = User::where($field, $loginInput)->first();

        if (!$user) {
            return back()
                ->withErrors([
                    'login' => 'Username/email atau password salah.',
                ])
                ->withInput();
        }

        if (is_null($user->email_verified_at)) {
            return back()
                ->withErrors([
                    'login' => 'Email belum diverifikasi.',
                ])
                ->withInput();
        }

        if (!Auth::attempt([
            $field => $loginInput,
            'password' => $request->password,
        ])) {

            return back()
                ->withErrors([
                    'login' => 'Username/email atau password salah.',
                ])
                ->withInput();
        }

        $request->session()->regenerate();

        return redirect()
            ->route('admin::school-settings.index');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('admin::login');
    }

    public function verify(string $id)
    {
        $user = User::findOrFail($id);

        // sudah verified
        if ($user->email_verified_at) {
            return redirect()
                ->route('login')
                ->with('success', 'Email sudah diverifikasi sebelumnya.');
        }

        $user->update([
            'email_verified_at' => Carbon::now(),
        ]);

        return redirect()
            ->route('login')
            ->with('success', 'Email berhasil diverifikasi.');
    }
}
