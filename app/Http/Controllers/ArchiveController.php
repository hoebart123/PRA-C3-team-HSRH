<?php
namespace App\Http\Controllers;

use App\Models\School;

class ArchiveController extends Controller
{
    public function index()
    {
        $archivedSchools = School::with('teams')
            ->where('is_archived', true)
            ->orderBy('updated_at', 'desc')
            ->get();

        return view('archief.index', compact('archivedSchools'));
    }
}
