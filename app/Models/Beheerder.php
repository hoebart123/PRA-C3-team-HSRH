<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Beheerder extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $table = 'beheerders';

    protected $fillable = [
        'naam',
        'school',
        'email',
        'password',
        'is_active',
        'is_super',
    ];

    protected $hidden = [
        'password',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'is_super' => 'boolean',
    ];
}
