<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class PortalController extends Controller
{
    /**
     * Show login page 2 (portal selection: two types of users).
     */
    public function index(): View
    {
        return view('auth.portal');
    }

    /**
     * Remember which portal the visitor picked (couple or vendor).
     * The real next screens will be added later.
     */
    public function choose(Request $request, string $type): RedirectResponse
    {
        $request->session()->put('portal_type', $type);

        $label = $type === 'couple' ? 'Bride / Groom' : 'Vendor';

        return redirect()
            ->route('portal.index')
            ->with('status', "You selected: {$label}. The next screen will be built soon.");
    }
}
