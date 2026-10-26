<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class LoginController extends Controller
{
    /**
     * Show login page 1 (Unified Sign-In).
     */
    public function show(): View
    {
        return view('auth.login');
    }

    /**
     * Handle the "Sign In to Workspace" button.
     * For now it only validates the form and redirects to login page 2.
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'email'    => ['required', 'email'],
            'password' => ['required', 'string'],
        ], [
            'email.required'    => 'Please enter your account email.',
            'email.email'       => 'Please enter a valid email address.',
            'password.required' => 'Please enter your master password.',
        ]);

        // TODO (Member 1, after the users table is merged):
        // if (! Auth::attempt($request->only('email', 'password'), $request->boolean('remember'))) {
        //     return back()->withErrors(['email' => 'These credentials do not match our records.'])->onlyInput('email');
        // }
        // $request->session()->regenerate();

        return redirect()->route('portal.index');
    }
}
