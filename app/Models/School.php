<?php
// app/Models/School.php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class School extends Model
{
    protected $fillable = [
        'naam', 'contactpersoon', 'email', 'status'
    ];

    public function teams()
    {
        return $this->hasMany(Team::class);
    }
}
