<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): View
    {
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request): RedirectResponse
    {
        $request->authenticate();
        $request->session()->regenerate();
    
        $user = Auth::user();
    
        switch ($user->role_id) {
            case 1:
                return redirect()->route('admin.dashboard');
            case 2:
                return redirect()->route('supervisor.dashboard');
            case 3:
                return redirect()->route('funcionario.dashboard');
            case 5:
                return redirect()->route('vigilante.dashboard');
            default:
                Auth::logout();
                return redirect()->route('login')->with('error', 'Rol no válido.');
        }   }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
