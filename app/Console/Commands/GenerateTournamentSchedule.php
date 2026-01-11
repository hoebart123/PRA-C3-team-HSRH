<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tournament;
use App\Models\Game;
use App\Models\Team;

class TournamentScheduleController extends Controller
{
    public function generate($tournamentId)
    {
        $tournament = Tournament::findOrFail($tournamentId);

        // Haal alle ingeschreven teams op
        $teams = $tournament->teams()->get();

        if ($teams->count() < 2) {
            return redirect()->back()->with('error', 'Te weinig teams om een schema te genereren.');
        }

        // Voorbeeld: simpele round-robin verdeling
        $games = [];
        for ($i = 0; $i < $teams->count(); $i++) {
            for ($j = $i + 1; $j < $teams->count(); $j++) {
                $games[] = Game::create([
                    'tournament_id' => $tournament->id,
                    'team1_id' => $teams[$i]->id,
                    'team2_id' => $teams[$j]->id,
                    'sport' => $tournament->sport,
                    'poule' => null,   // later poule verdeling toevoegen
                    'score1' => null,
                    'score2' => null,
                ]);
            }
        }

        return redirect()->back()->with('success', 'Wedstrijden schema gegenereerd!');
    }

    public function show($tournamentId)
    {
        $tournament = Tournament::findOrFail($tournamentId);
        $games = $tournament->games()->with('team1', 'team2')->get();

        return view('tournaments.schedule', compact('tournament', 'games'));
    }
}
