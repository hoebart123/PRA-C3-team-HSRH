<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\Beheerder;

class BeheerderLoginController extends Controller
{
    public function showLoginForm()
    {
        return view('beheerders.login'); 
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        $beheerder = Beheerder::where('email', $credentials['email'])->first();

        if (!$beheerder || !Hash::check($credentials['password'], $beheerder->password)) {
            return back()->withErrors([
                'email' => 'De opgegeven gegevens komen niet overeen.',
            ]);
        }

        if (!$beheerder->is_active) {
            return back()->withErrors([
                'email' => 'Uw account wacht nog op goedkeuring door een actieve beheerder.',
            ]);
        }

        Auth::guard('beheerder')->login($beheerder);

        $request->session()->regenerate();

        return redirect()->intended(route('beheerders.index'));
    }

    public function logout(Request $request)
    {
        Auth::guard('beheerder')->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('beheerder.login');
    }
}
