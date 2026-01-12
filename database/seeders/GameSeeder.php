<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\School;
use App\Models\Team;
use App\Models\Game;

class GameSeeder extends Seeder
{
    public function run(): void
    {
        /*
         |--------------------------------------------------------------------------
         | Schools
         |--------------------------------------------------------------------------
         */
        $school1 = School::firstOrCreate(
            ['naam' => 'School A'],
            [
                'contactpersoon' => 'Jan',
                'email' => 'jan@schoola.nl',
                'status' => 'approved',
            ]
        );

        $school2 = School::firstOrCreate(
            ['naam' => 'School B'],
            [
                'contactpersoon' => 'Piet',
                'email' => 'piet@schoolb.nl',
                'status' => 'approved',
            ]
        );

        /*
         |--------------------------------------------------------------------------
         | Teams
         |--------------------------------------------------------------------------
         */
        $toernooi = 'Schooltoernooi 2026';

        $team1 = Team::firstOrCreate(
            ['naam' => 'Team A1', 'school_id' => $school1->id],
            [
                'toernooi' => $toernooi,
                'aantal' => 11,
            ]
        );

        $team2 = Team::firstOrCreate(
            ['naam' => 'Team A2', 'school_id' => $school1->id],
            [
                'toernooi' => $toernooi,
                'aantal' => 11,
            ]
        );

        $team3 = Team::firstOrCreate(
            ['naam' => 'Team B1', 'school_id' => $school2->id],
            [
                'toernooi' => $toernooi,
                'aantal' => 11,
            ]
        );

        $team4 = Team::firstOrCreate(
            ['naam' => 'Team B2', 'school_id' => $school2->id],
            [
                'toernooi' => $toernooi,
                'aantal' => 11,
            ]
        );

        /*
         |--------------------------------------------------------------------------
         | Games
         |--------------------------------------------------------------------------
         */
        Game::firstOrCreate(
            [
                'team1_id' => $team1->id,
                'team2_id' => $team3->id,
                'sport' => 'Voetbal',
                'poule' => 'A',
                'played_at' => now()->subDay(),
            ],
            [
                'score1' => 2,
                'score2' => 1,
            ]
        );

        Game::firstOrCreate(
            [
                'team1_id' => $team2->id,
                'team2_id' => $team4->id,
                'sport' => 'Voetbal',
                'poule' => 'A',
                'played_at' => now()->subDay(),
            ],
            [
                'score1' => 1,
                'score2' => 1,
            ]
        );

        Game::firstOrCreate(
            [
                'team1_id' => $team1->id,
                'team2_id' => $team2->id,
                'sport' => 'Voetbal',
                'poule' => 'A',
                'played_at' => now(),
            ],
            [
                'score1' => null,
                'score2' => null,
            ]
        );
    }
}
