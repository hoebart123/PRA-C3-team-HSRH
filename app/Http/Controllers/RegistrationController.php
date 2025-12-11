<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Registration;

class RegistrationController extends Controller
{
    public function create()
    {
        $registrations = Registration::where('email', auth()->user()->email)->get();
        return view('inschrijven', compact('registrations'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'schoolnaam' => 'required|string|max:255',
            'contactpersoon' => 'required|string|max:255',
            'email' => 'nullable|email', 
            'opmerking' => 'nullable|string',
            'referee_name' => 'required|string|max:255',  
            'referee_email' => 'required|email|max:255',   
            'teams.*.naam' => 'required|string|max:255',
            'teams.*.toernooi' => 'required|string|max:255',
            'teams.*.aantal' => 'required|integer|min:1'
        ]);

        Registration::create([
            'schoolnaam' => $data['schoolnaam'],
            'contactpersoon' => $data['contactpersoon'],
            'email' => auth()->user()->email,
            'opmerking' => $data['opmerking'] ?? null,
            'referee_name' => $data['referee_name'],       
            'referee_email' => $data['referee_email'],     
            'teams' => json_encode($data['teams']),
            'approved' => false,
        ]);

        return redirect()->route('registrations.create')->with('success', 'Inschrijving ontvangen.');
    }

    public function uitschrijven($id)
    {
        $registration = Registration::findOrFail($id);
        if ($registration->email === auth()->user()->email) {
            $registration->delete();
            return redirect()->route('registrations.create')->with('success', 'Inschrijving verwijderd.');
        }
        return redirect()->route('registrations.create')->with('error', 'Je mag deze inschrijving niet verwijderen.');
    }
}
