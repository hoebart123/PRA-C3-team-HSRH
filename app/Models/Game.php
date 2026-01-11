<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Game extends Model
{
    protected $fillable = [
        'team1_id',
        'team2_id',
        'score1',
        'score2',
        'sport',
        'poule',
        'played_at',
        'veld',           // vergeet veld niet toe te voegen als je dat wilt tonen
        'tournament_id', 
    ];

    // Cast 'played_at' naar Carbon object
    protected $casts = [
        'played_at' => 'datetime',
    ];

    public function team1()
    {
        return $this->belongsTo(Team::class, 'team1_id');
    }

    public function team2()
    {
        return $this->belongsTo(Team::class, 'team2_id');
    }

    public function tournament()
    {
        return $this->belongsTo(Tournament::class);
    }
}
