<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class AuthController extends Controller
{
    /**
     * Show the login form.
     *
     * @return View
     */
    public function showLogin()
    {
        return view('auth.login');
    }

    /**
     * Handle login request.
     *
     * @return RedirectResponse
     */
    public function login(LoginRequest $request)
    {
        $credentials = $request->validated();

        // Attempt to login
        if (Auth::attempt($credentials, remember: $request->boolean('remember'))) {
            // Regenerate session ID for security
            $request->session()->regenerate();

            return redirect()->intended(route('home'))->with('success', 'Berhasil login!');
        }

        // If login fails, show error message (generic for security)
        return back()->with('error', 'Email atau password salah.');
    }

    /**
     * Handle logout.
     *
     * @return RedirectResponse
     */
    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/')->with('success', 'Berhasil logout!');
    }
}
