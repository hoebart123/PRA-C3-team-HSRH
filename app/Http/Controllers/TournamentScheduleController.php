<?php

namespace App\Http\Controllers;

use App\Models\Tournament;
use App\Models\Game;
use App\Models\Team;
use Illuminate\Http\Request;
use Carbon\Carbon;

class TournamentScheduleController extends Controller
{
    public function showGenerateForm()
    {
        return view('admin.games.generate', [
            'tournaments' => Tournament::all(),
        ]);
    }

    public function generate(Request $request)
    {
        $request->validate([
            'default_start_time' => 'required',
            'default_end_time'   => 'required',
            'default_velden'     => 'required|integer|min:1',
        ]);

        $defaultStart  = Carbon::parse($request->default_start_time);
        $defaultEnd    = Carbon::parse($request->default_end_time);
        $defaultVelden = (int) $request->default_velden;

        foreach ($request->tournaments ?? [] as $tournamentId => $data) {
            if (!isset($data['active'])) {
                continue;
            }

            $tournament = Tournament::findOrFail($tournamentId);

            $startTime = isset($data['custom_time']) && $data['start_time']
                ? Carbon::parse($data['start_time'])
                : $defaultStart->copy();

            $endTime = isset($data['custom_time']) && $data['end_time']
                ? Carbon::parse($data['end_time'])
                : $defaultEnd->copy();

            $velden = isset($data['custom_time']) && $data['velden']
                ? (int) $data['velden']
                : $defaultVelden;

            $this->generateSchedule($tournament, $startTime, $endTime, $velden);
        }

        return redirect()
            ->route('games.index')
            ->with('success', 'Speelschema succesvol gegenereerd');
    }

    protected function generateSchedule(
        Tournament $tournament,
        Carbon $startTime,
        Carbon $endTime,
        int $veldCount
    ): void {
        Game::where('tournament_id', $tournament->id)->delete();

        $teams = Team::where('tournament_id', $tournament->id)
            ->inRandomOrder()
            ->get();

        if ($teams->count() < 2) {
            return;
        }

        $wedstrijdTijd = $tournament->speeltijd;
        $pauzeTijd     = $tournament->pauzetijd;
        $minRustSlots  = 2;
        $pouleSize     = 4;

        $poules = [];
        foreach ($teams as $team) {
            $placed = false;
            foreach ($poules as &$poule) {
                if (
                    count($poule) < $pouleSize &&
                    !in_array($team->school_id, array_column($poule, 'school_id'))
                ) {
                    $poule[] = $team;
                    $placed = true;
                    break;
                }
            }
            if (!$placed) {
                $poules[] = [$team];
            }
        }

        $matches = [];
        foreach ($poules as $pouleIndex => $pouleTeams) {
            for ($i = 0; $i < count($pouleTeams); $i++) {
                for ($j = $i + 1; $j < count($pouleTeams); $j++) {
                    $matches[] = [
                        'team1' => $pouleTeams[$i],
                        'team2' => $pouleTeams[$j],
                        'poule' => 'Poule ' . ($pouleIndex + 1),
                    ];
                }
            }
        }

        $lastPlayed = [];
        $currentTime = $startTime->copy();

        while ($currentTime->lessThan($endTime) && count($matches)) {
            $usedTeams = [];

            for ($veld = 1; $veld <= $veldCount; $veld++) {
                foreach ($matches as $index => $match) {
                    $t1 = $match['team1'];
                    $t2 = $match['team2'];

                    if (
                        in_array($t1->id, $usedTeams) ||
                        in_array($t2->id, $usedTeams)
                    ) {
                        continue;
                    }

                    if (
                        isset($lastPlayed[$t1->id]) &&
                        $lastPlayed[$t1->id]
                            ->copy()
                            ->addMinutes(($wedstrijdTijd + $pauzeTijd) * $minRustSlots)
                            ->greaterThan($currentTime)
                    ) {
                        continue;
                    }

                    if (
                        isset($lastPlayed[$t2->id]) &&
                        $lastPlayed[$t2->id]
                            ->copy()
                            ->addMinutes(($wedstrijdTijd + $pauzeTijd) * $minRustSlots)
                            ->greaterThan($currentTime)
                    ) {
                        continue;
                    }

                    Game::create([
                        'tournament_id' => $tournament->id,
                        'team1_id'      => $t1->id,
                        'team2_id'      => $t2->id,
                        'sport'         => $tournament->sport,
                        'poule'         => $match['poule'],
                        'played_at'     => $currentTime,
                        'veld'          => 'Veld ' . $veld,
                        'scheidsrechter'=> null,
                    ]);

                    $lastPlayed[$t1->id] = $currentTime->copy();
                    $lastPlayed[$t2->id] = $currentTime->copy();

                    $usedTeams[] = $t1->id;
                    $usedTeams[] = $t2->id;

                    unset($matches[$index]);
                    $matches = array_values($matches);
                    break;
                }
            }

            $currentTime->addMinutes($wedstrijdTijd + $pauzeTijd);
        }
    }
}
