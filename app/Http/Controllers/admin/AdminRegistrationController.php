<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\School;
use Illuminate\Http\Request;
use App\Models\Registration;

class AdminRegistrationController extends Controller
{

public function index()
{
    $registrations = Registration::latest()->get();

    return view('beheerders.manage', compact('registrations'));
}


        public function approve(Registration $registration)
    {
        $registration->update(['status' => 1]); // 1 = approved

        return back()->with('success', 'Inschrijving goedgekeurd');
    }

    public function edit(Registration $registration)
    {
        return view('beheerders.edit', compact('registration'));
    }

public function update(Request $request, Registration $registration)
{
    // Validatie
    $request->validate([
        'schoolnaam' => 'required|string|max:255',
        'contactpersoon' => 'required|string|max:255',
        'email' => 'required|email|max:255',
        'referee_name' => 'required|string|max:255',
        'referee_email' => 'required|email|max:255',
        'teams' => 'required|array|min:1',
        'teams.*.naam' => 'required|string|max:255',
        'teams.*.toernooi' => 'required|string|max:255',
        'teams.*.aantal' => 'required|integer|min:1',
        'status' => 'nullable|in:0,1,2', // 0=pending,1=approved,2=rejected
    ]);

    // Teams opslaan als JSON
    $teams = collect($request->teams)->map(function($team){
        return [
            'naam' => $team['naam'],
            'toernooi' => $team['toernooi'],
            'aantal' => (int)$team['aantal'],
        ];
    });

    // Update registratie
    $registration->update([
        'schoolnaam' => $request->schoolnaam,
        'contactpersoon' => $request->contactpersoon,
        'email' => $request->email,
        'referee_name' => $request->referee_name,
        'referee_email' => $request->referee_email,
        'teams' => $teams->toJson(), // teams als JSON opslaan
        // Alleen status updaten als deze meegegeven is (anders behouden)
        'status' => $request->status ?? $registration->status,
    ]);

    return redirect()
        ->route('admin.registrations.index')
        ->with('success', 'Inschrijving bijgewerkt');
}



    public function destroy(Registration $registration)
    {
        $registration->delete();

        return back()->with('success', 'Inschrijving verwijderd');
    }
    public function archive(Registration $registration)
    {
        $registration->update(['is_archived' => true]);

        return back()->with('success', 'Inschrijving gearchiveerd.');
    }
}
