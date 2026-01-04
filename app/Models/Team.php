<?php
// app/Models/Team.php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Team extends Model
{
    protected $fillable = ['school_id', 'naam', 'leden'];

    public function school()
    {
        return $this->belongsTo(School::class);
    }
}
