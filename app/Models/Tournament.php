<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tournament extends Model
{
    use HasFactory;

    protected $fillable = [
        'naam',
        'sport',
        'doelgroep',
        'speeltijd',
        'pauzetijd',
        'max_spelers',
    ];

    public function games()
    {
        return $this->hasMany(Game::class);
    }
}
