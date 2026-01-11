<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\School;

class SchoolsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Voeg enkele voorbeeldscholen toe
        $schools = [
            'Basisschool De Horizon',
            'Basisschool Het Kompas',
            'Basisschool De Regenboog',
            'Basisschool De Schatkist',
        ];

        foreach ($schools as $naam) {
            School::create(['naam' => $naam]);
        }
    }
}
