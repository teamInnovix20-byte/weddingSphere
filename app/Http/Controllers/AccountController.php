<?php

namespace App\Http\Controllers;

use Illuminate\View\View;

class AccountController extends Controller
{
    /**
     * Profile & Identity Overview page.
     * Frontend only for now - every value on the page is sample data written in the Blade file.
     */
    public function profile(): View
    {
        return view('profile.show');
    }

    /**
     * Settings pages: security | notifications | connected | billing | sessions
     * (the allowed names are checked in routes/web.php).
     */
    public function settings(string $section): View
    {
        return view('settings.index', ['section' => $section]);
    }
}
