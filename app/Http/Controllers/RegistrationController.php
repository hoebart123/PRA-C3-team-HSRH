<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Registration;

class RegistrationController extends Controller
{
    // Laat het inschrijfformulier zien
    public function create()
    {
        // Haal bestaande inschrijvingen van de ingelogde gebruiker
        $registrations = Registration::where('email', auth()->user()->email)->get();
        return view('inschrijven', compact('registrations'));
    }

    // Toon overzicht (optioneel, kan ook create gebruiken)
    public function index()
    {
        $registrations = Registration::where('email', auth()->user()->email)->get();
        return view('inschrijven', compact('registrations'));
    }

    // Sla de inschrijving op
    public function store(Request $request)
    {
        $data = $request->validate([
            'schoolnaam' => 'required|string|max:255',
            'contactpersoon' => 'required|string|max:255',
            'email' => 'required|email',
            'opmerking' => 'nullable|string',
            'teams.*.naam' => 'required|string|max:255',
            'teams.*.sport' => 'required|string|max:255',
            'teams.*.aantal' => 'required|integer|min:1'
        ]);

        Registration::create([
            'schoolnaam' => $data['schoolnaam'],
            'contactpersoon' => $data['contactpersoon'],
            'email' => $data['email'],
            'opmerking' => $data['opmerking'] ?? null,
            'teams' => json_encode($data['teams']),
            'approved' => false,
        ]);

        return redirect()->route('registrations.create')->with('success', 'Inschrijving ontvangen.');
    }

    // Verwijder inschrijving
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
