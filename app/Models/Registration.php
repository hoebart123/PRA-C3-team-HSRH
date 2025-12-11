<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Registration extends Model
{
    use HasFactory;

    protected $table = 'registrations';

    protected $fillable = [
        'schoolnaam',
        'contactpersoon',
        'email',
        'opmerking',
        'teams',    
        'referee_name',   // toegevoegd
        'referee_email',  // toegevoegd
        'approved',
    ];

    protected $casts = [
        'teams' => 'array',
        'approved' => 'boolean',
    ];
}
