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
        'referee_name',
        'referee_email',
        'teams',
        'status',
        'is_archived',
    ];

    protected $casts = [
        'teams' => 'array',
        'is_approved' => 'boolean',
        'is_archived' => 'boolean',
    ];
}
