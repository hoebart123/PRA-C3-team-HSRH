<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\School;
use Illuminate\Http\Request;

class AdminSchoolController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $scholen = School::with('teams')->get();

        return view('manage', compact('scholen'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(School $school)
    {
        return view('admin.scholen.edit', compact('school'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, School $school)
    {
        $school->update(
            $request->only(['naam', 'contactpersoon', 'email', 'status'])
        );

        return redirect()->route('admin.scholen.index')
            ->with('success', 'Inschrijving aangepast.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(School $school)
    {
        $school->delete();

        return redirect()->route('admin.scholen.index')
            ->with('success', 'Inschrijving verwijderd.');
    }

    /**
     * Custom action: approve a school registration.
     */
    public function approve(School $school)
    {
        $school->update(['status' => 'approved']);

        return redirect()->route('admin.scholen.index')
            ->with('success', 'Inschrijving goedgekeurd.');
    }
}
