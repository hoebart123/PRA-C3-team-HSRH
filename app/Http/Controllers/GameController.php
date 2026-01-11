<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Game;
use App\Models\Tournament;
use App\Models\Team;

class GameController extends Controller
{
    public function index()
    {
        $tournaments = Tournament::with([
            'games.team1.school',
            'games.team2.school'
        ])->get();

        return view('admin.games.index', compact('tournaments'));
    }

    public function edit($id)
    {
        $game = Game::with([
            'team1.school',
            'team2.school'
        ])->findOrFail($id);

        // Haal alle teams op van dit toernooi zodat je kan wijzigen
        $teams = Team::where('tournament_id', $game->tournament_id)->get();

        return view('admin.games.edit', compact('game', 'teams'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'team1_id'       => 'required|different:team2_id',
            'team2_id'       => 'required',
            'poule'          => 'required|string',
            'veld'           => 'nullable|string',
            'played_at'      => 'required|date',
            'scheidsrechter' => 'nullable|string',
            'score1'         => 'nullable|integer|min:0',
            'score2'         => 'nullable|integer|min:0',
        ]);

        $game = Game::findOrFail($id);

        $game->team1_id       = $request->team1_id;
        $game->team2_id       = $request->team2_id;
        $game->poule          = $request->poule;
        $game->veld           = $request->veld;
        $game->played_at      = $request->played_at;
        $game->scheidsrechter = $request->scheidsrechter;
        $game->score1         = $request->score1;
        $game->score2         = $request->score2;

        if($game->save()){
            return redirect()->route('games.index')->with('success', 'Wedstrijd succesvol aangepast!');
        }

        return back()->with('error', 'Er is iets misgegaan bij het opslaan.');
    }

    public function destroy($id)
    {
        $game = Game::findOrFail($id);
        $game->delete();

        return redirect()->route('games.index')->with('success', 'Wedstrijd verwijderd!');
    }
}
