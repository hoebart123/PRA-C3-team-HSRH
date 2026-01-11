<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Team;
use App\Models\Tournament;
use App\Models\School;

class TeamsTableSeeder extends Seeder
{
    public function run(): void
    {
        $tournaments = Tournament::all();
        $schools = School::all();

        if ($schools->count() === 0) {
            $this->command->info('Geen scholen gevonden, maak eerst schools aan.');
            return;
        }

        foreach ($tournaments as $tournament) {
            // Bepaal aantal teams dat je wilt per toernooi
            $numTeams = 8; // kan je aanpassen per toernooi

            for ($i = 1; $i <= $numTeams; $i++) {
                Team::create([
                    'naam' => "Team $i - {$tournament->doelgroep}",
                    'school_id' => $schools->random()->id, // willekeurige school
                    'tournament_id' => $tournament->id,
                ]);
            }
        }
    }
}
