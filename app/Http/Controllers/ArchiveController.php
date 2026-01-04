<?php
namespace App\Http\Controllers;

use App\Models\registration;

class ArchiveController extends Controller
{
    public function index()
    {
        $archivedRegistrations = Registration::with('teams')
            ->where('is_archived', true)
            ->orderBy('updated_at', 'desc')
            ->get();

        return view('archief.index', compact('archivedRegistrations'));
    }
}
