<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\School;
use Illuminate\Http\Request;
use App\Models\Registration;

class AdminSchoolController extends Controller
{

public function index()
{
    $registrations = Registration::latest()->get();

    return view('beheerders.manage', compact('registrations'));
}


    public function approve(School $school)
    {
        $school->update(['status' => 'approved']);

        return back()->with('success', 'School goedgekeurd.');
    }

    public function edit(School $school)
    {
        return view('admin.schools.edit', compact('school'));
    }

    public function update(Request $request, School $school)
    {
        $school->update(
            $request->only([
                'naam',
                'contactpersoon',
                'email',
                'referee_name',
                'referee_email'
            ])
        );

        return redirect()
            ->route('beheerders.manage')
            ->with('success', 'Inschrijving aangepast.');
    }

    public function destroy(School $school)
    {
        $school->delete();

        return back()->with('success', 'Inschrijving verwijderd.');
    }

    public function archive(School $school)
    {
        $school->update(['is_archived' => true]);

        return back()->with('success', 'Inschrijving gearchiveerd.');
    }
}
