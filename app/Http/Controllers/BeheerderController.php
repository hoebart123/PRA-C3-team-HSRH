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
        $beheerders = Beheerder::orderByDesc('is_super')->orderBy('naam')->get();
        return view('beheerders.index', compact('beheerders'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'naam' => 'required|string',
            'school' => 'nullable|string',
            'email' => 'required|email|unique:beheerders,email',
            'password' => 'required|string|min:8|confirmed',
        ]);

        $beheerder = Beheerder::create([
            'naam' => $data['naam'],
            'school' => $data['school'] ?? null,
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'is_active' => false,
            'is_super' => false,
        ]);

        $active = Beheerder::where('is_active', true)->get();
        foreach ($active as $admin) {
            Mail::to($admin->email)->send(new BeheerderPendingApproval($beheerder));
        }

        return redirect()->route('beheerders.index')->with('success', 'Nieuwe beheerder aangemaakt en in afwachting van goedkeuring.');
    }

    public function approve(Beheerder $beheerder)
    {
        /** @var \App\Models\Beheerder|null $currentUser */
        $currentUser = Auth::user();

        if (! $currentUser || ! $currentUser->is_active) {
            abort(403);
        }

        $beheerder->is_active = true;
        $beheerder->save();

        Mail::to($beheerder->email)->send(new BeheerderApproved($beheerder));

        return redirect()->route('beheerders.index')->with('success', 'Beheerder goedgekeurd en geactiveerd.');
    }

    public function destroy(Beheerder $beheerder)
    {
        if (! Gate::allows('delete-beheerder')) {
            abort(403);
        }

        $active = Beheerder::where('is_active', true)->get();
        foreach ($active as $admin) {
            Mail::to($admin->email)->send(new BeheerderDeleted($beheerder));
        }

        $beheerder->delete();

        return redirect()->route('beheerders.index')->with('success', 'Beheerder verwijderd.');
    }
}
