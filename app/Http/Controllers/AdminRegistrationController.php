<?php
class AdminRegistrationController extends Controller
{
    public function index()
    {
        $schools = School::with('teams')->get();
        return view('admin.registrations.index', compact('schools'));
    }

    public function edit(Team $registration)
    {
        $schools = School::all();
        return view('admin.registrations.edit', [
            'team' => $registration,
            'schools' => $schools
        ]);
    }

    public function update(Request $request, Team $registration)
    {
        $request->validate([
            'team_name' => 'required',
            'school_id' => 'required|exists:schools,id',
        ]);

        $registration->update($request->only('team_name', 'school_id'));

        return redirect()->route('admin.registrations.index')
            ->with('success', 'Team aangepast.');
    }

    public function destroy(Team $registration)
    {
        $registration->delete();

        return back()->with('success', 'Team verwijderd.');
    }

    public function approve(Team $registration)
    {
        $registration->update(['approved' => true]);
        return back()->with('success', 'Team goedgekeurd.');
    }
}
