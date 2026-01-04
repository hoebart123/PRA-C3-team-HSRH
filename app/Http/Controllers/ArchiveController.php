<?php

namespace App\Http\Controllers;

use App\Models\Registration;

class ArchiveController extends Controller
{
    public function index()
    {
        $archivedRegistrations = Registration::where('is_archived', true)
            ->orderBy('updated_at', 'desc')
            ->get();

        return view('archief.index', compact('archivedRegistrations'));
    }
}
