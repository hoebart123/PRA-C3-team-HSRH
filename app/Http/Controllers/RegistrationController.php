<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Registration;

class RegistrationController extends Controller
{
    public function create()
    {
        // Controleer eerst of een gebruiker is ingelogd
        $registrations = collect(); // lege collectie als niemand ingelogd is

        if (auth()->check()) {
            $registrations = Registration::where('email', auth()->user()->email)->get();
        }

        return view('inschrijven', compact('registrations'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'schoolnaam' => 'required|string|max:255',
            'contactpersoon' => 'required|string|max:255',
            'email' => 'required|email',
            'opmerking' => 'nullable|string',
            'referee_name' => 'nullable|string|max:255',
            'referee_email' => 'nullable|email|max:255',
            'teams.*.naam' => 'required|string|max:255',
            'teams.*.toernooi' => 'required|string|max:255',
            'teams.*.aantal' => 'required|integer|min:1'
        ]);

        Registration::create([
            'schoolnaam'     => $data['schoolnaam'],
            'contactpersoon' => $data['contactpersoon'],
            'email'          => $data['email'],
            'opmerking'      => $data['opmerking'] ?? null,
            'referee_name'   => $data['referee_name'] ?? null,
            'referee_email'  => $data['referee_email'] ?? null,
            'teams'          => json_encode($data['teams']),
            'approved'       => false,
        ]);

        return redirect()->route('registrations.create')->with('success', 'Inschrijving ontvangen.');
    }

    public function uitschrijven($id)
    {
        $registration = Registration::findOrFail($id);

        // Alleen verwijderen als de gebruiker ingelogd is en eigenaar is
        if (auth()->check() && $registration->email === auth()->user()->email) {
            $registration->delete();
            return redirect()->route('registrations.create')->with('success', 'Inschrijving verwijderd.');
        }

        return redirect()->route('registrations.create')->with('error', 'Je mag deze inschrijving niet verwijderen.');
    }
}
