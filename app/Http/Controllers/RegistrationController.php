<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Registration;
use App\Models\School;
use App\Models\Team;

class RegistrationController extends Controller
{
    public function create()
    {
        $registrations = Registration::where('email', auth()->user()->email)->get();
        return view('inschrijven', compact('registrations'));
    }

    public function store(Request $request)
{
    $request->validate([
        'schoolnaam' => 'required',
        'contactpersoon' => 'required',
        'email' => 'required|email',
        'teams' => 'required|array|min:1',
    ]);

    // 1) SCHOOL aanmaken
    $school = School::create([
        'naam'            => $request->schoolnaam,
        'contactpersoon'  => $request->contactpersoon,
        'email'           => $request->email,
        'opmerking'       => $request->opmerking,
        'status'          => 'pending', // belangrijke stap!
    ]);

    // 2) TEAMS opslaan
    foreach ($request->teams as $team) {
        Team::create([
            'school_id' => $school->id,
            'naam'      => $team['naam'],
            'sport'     => $team['sport'],
            'aantal'    => $team['aantal'],
        ]);
    }

    return back()->with('success', 'Je inschrijving is verstuurd!');
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
