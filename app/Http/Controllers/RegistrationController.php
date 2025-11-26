<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\SchoolRegistrationConfirmed;
use App\Models\Registration;

class RegistrationController extends Controller
{
    public function store(Request $request)
    {
        $data = $request->validate([
            'schoolnaam' => 'required|string|max:255',
            'contactpersoon' => 'required|string|max:255',
            'email' => 'required|email',
            'opmerking' => 'nullable|string',
            'teams' => 'nullable', 
        ]);

        $registration = Registration::create([
            'schoolnaam' => $data['schoolnaam'],
            'contactpersoon' => $data['contactpersoon'],
            'email' => $data['email'],
            'opmerking' => $data['opmerking'] ?? null,
            'teams' => $data['teams'] ?? null,
            'approved' => false,
        ]);

        Mail::to($data['email'])->send(new SchoolRegistrationConfirmed($data));
        Mail::to(config('mail.from.address', 'organisatie@example.com'))->send(new SchoolRegistrationConfirmed($data));

        return redirect()->back()->with('success', 'Inschrijving ontvangen. Je ontvangt een bevestiging per e-mail.');
    }
}