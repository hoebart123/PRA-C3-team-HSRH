<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Registration; // Zorg dat dit model klopt met je archiefregistraties

class ClearArchive extends Command
{
    protected $signature = 'archive:clear';
    protected $description = 'Leeg het archief elke juni';

    public function handle()
    {
        // Check of het juni is
        if (now()->month === 6 && now()->day === 1) {
            // Verwijder alle geregistreerde archieven
            Registration::where('archived', true)->delete();

            $this->info('Archief succesvol geleegd.');
        } else {
            $this->info('Het is niet juni, archief niet geleegd.');
        }
    }
}
