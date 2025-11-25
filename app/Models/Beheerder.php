<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Beheerder extends Model
{
    /** @use HasFactory<\Database\Factories\BeheerderFactory> */
    use HasFactory;

    protected $fillable = [
        'naam',
        'school',
        'email',
        'wachtwoord',
    ];
}
