<?php
use App\Models\Tournament;

Tournament::create([
    'naam' => 'Voetbal groep 3/4',
    'sport' => 'Voetbal',
    'doelgroep' => 'Groep 3/4',
    'speeltijd' => 15,
    'pauzetijd' => 5,
    'max_spelers' => 8,
]);

Tournament::create([
    'naam' => 'Voetbal groep 5/6',
    'sport' => 'Voetbal',
    'doelgroep' => 'Groep 5/6',
    'speeltijd' => 15,
    'pauzetijd' => 5,
    'max_spelers' => 8,
]);

Tournament::create([
    'naam' => 'Voetbal groep 7/8',
    'sport' => 'Voetbal',
    'doelgroep' => 'Groep 7/8',
    'speeltijd' => 15,
    'pauzetijd' => 5,
    'max_spelers' => 10,
]);

Tournament::create([
    'naam' => 'Voetbal 1e klas jongens/gemengd',
    'sport' => 'Voetbal',
    'doelgroep' => '1e klas VO jongens/gemengd',
    'speeltijd' => 15,
    'pauzetijd' => 5,
    'max_spelers' => 10,
]);

Tournament::create([
    'naam' => 'Voetbal 1e klas meiden',
    'sport' => 'Voetbal',
    'doelgroep' => '1e klas VO meiden',
    'speeltijd' => 15,
    'pauzetijd' => 5,
    'max_spelers' => 13,
]);

Tournament::create([
    'naam' => 'Lijnbal groep 7/8 meisjes',
    'sport' => 'Lijnbal',
    'doelgroep' => 'Groep 7/8 meisjes',
    'speeltijd' => 10,
    'pauzetijd' => 2,
    'max_spelers' => 10,
]);

Tournament::create([
    'naam' => 'Lijnbal 1e klas VO meisjes',
    'sport' => 'Lijnbal',
    'doelgroep' => '1e klas VO meisjes',
    'speeltijd' => 12,
    'pauzetijd' => 0, // geen pauze aangegeven
    'max_spelers' => 8,
]);
