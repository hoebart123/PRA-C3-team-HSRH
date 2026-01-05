<?php

namespace App\Http\Controllers;

use App\Models\Beheerder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Auth;
use App\Mail\BeheerderPendingApproval;
use App\Mail\BeheerderApproved;
use App\Mail\BeheerderDeleted;
use Illuminate\Support\Facades\Gate;

class BeheerderController extends Controller
{
    public function index()
    {
        $beheerders = Beheerder::orderByDesc('is_super')
            ->orderBy('naam')
            ->get();

        return view('beheerders.index', ['beheerders' => $beheerders]);
    }
    
    public function showRegistrationForm()
    {
        if (auth('beheerder')->check()) {
        return redirect()->route('beheerders.index');
        }

        return view('beheerders.register');
    }

    public function store(Request $request)
{
    $validated = $request->validate([
        'naam' => 'required|string',
        'school' => 'nullable|string',
        'email' => 'required|email|unique:beheerders,email',
        'password' => 'required|string|min:8|confirmed',
    ]);

    $beheerder = Beheerder::create([
        'naam' => $validated['naam'],
        'school' => $validated['school'] ?? null,
        'email' => $validated['email'],
        'password' => Hash::make($validated['password']),
        'is_active' => false, 
        'is_super' => false,
    ]);

    $actieveBeheerders = Beheerder::where('is_active', true)->get();
    foreach ($actieveBeheerders as $admin) {
        Mail::to($admin->email)->send(new BeheerderPendingApproval($beheerder));
    }

    return redirect()->route('beheerder.login')
        ->with('success', 'Nieuwe beheerder is aangemaakt en wacht op goedkeuring.');
}

    public function approve(Beheerder $beheerder)
    {
        $gebruiker = Auth::user();

        if (! $gebruiker || ! $gebruiker->is_active) {
            abort(403, 'Toegang geweigerd.');
        }

        $beheerder->update(['is_active' => true]);

        Mail::to($beheerder->email)->send(new BeheerderApproved($beheerder));

        return redirect()->route('beheerders.index')
            ->with('success', 'Beheerder is goedgekeurd en geactiveerd.');
    }

    public function destroy(Beheerder $beheerder)
    {
        $current = Auth::guard('beheerder')->user() ?? Auth::user();

        if (! $current || ! ($current->is_super ?? false)) {
            abort(403, 'Toegang geweigerd.');
        }

        $actieveBeheerders = Beheerder::where('is_active', true)->get();
        foreach ($actieveBeheerders as $admin) {
            Mail::to($admin->email)->send(new BeheerderDeleted($beheerder));
        }

        $beheerder->delete();

        return redirect()->route('beheerders.index')
            ->with('success', 'Beheerder succesvol verwijderd.');
    }
    public function editProfile()
{
    return view('beheerders.profile', [
        'beheerder' => auth('beheerder')->user(),
    ]);
}

    public function updateProfile(Request $request)
    {
        $beheerder = auth('beheerder')->user();

        $validated = $request->validate([
            'naam' => 'required|string',
            'school' => 'required|string',
            'email' => 'required|email|unique:beheerders,email,' . $beheerder->id,
            'password' => 'nullable|min:8|confirmed',
        ]);

        if (!empty($validated['password'])) {
            $validated['password'] = Hash::make($validated['password']);
        } else {
            unset($validated['password']);
        }

        $beheerder->update($validated);

        return back()->with('success', 'Gegevens succesvol bijgewerkt.');
    }
}
