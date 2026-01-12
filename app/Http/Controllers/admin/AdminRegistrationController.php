<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\School;
use Illuminate\Http\Request;
use App\Models\Registration;
use App\Mail\WijzigingNotificatie;
use Illuminate\Support\Facades\Mail;

class AdminRegistrationController extends Controller
{

public function index()
{
    $registrations = Registration::latest()->get();

    return view('beheerders.manage', compact('registrations'));
}


        public function approve(Registration $registration)
    {
        $registration->update(['approved' => '1']);

        return back()->with('success', 'Inschrijving goedgekeurd');
    }

    public function edit(Registration $registration)
    {
        return view('beheerders.edit', compact('registration'));
    }

public function update(Request $request, Registration $registration)
{
    $request->validate([
        'schoolnaam' => 'required|string|max:255',
        'status' => 'required|in:pending,approved,rejected',
    ]);

    $registration->update([
        'schoolnaam' => $request->schoolnaam,
        'status' => $request->status,
    ]);
    Mail::to($registration->email)->send(new WijzigingNotificatie($registration, 'bijgewerkt'));

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
