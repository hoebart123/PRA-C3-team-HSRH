<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Beheerder;
use Illuminate\Support\Facades\Hash;

class BeheerderSeeder extends Seeder
{
    public function run(): void
    {
        Beheerder::updateOrCreate(
            ['email' => 'admin@example.com'],
            [
                'naam' => 'Superbeheerder',
                'school' => 'Organisatie',
                'password' => Hash::make('password123'),
                'is_active' => true,
                'is_super' => true,
            ]
        );
    }
}
