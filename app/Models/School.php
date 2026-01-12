<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use App\Models\Team;
class School extends Model
{
    protected $fillable = [
        'naam',
        'contactpersoon',
        'email',
        'referee_name',
        'referee_email',
        'status',
        'is_archived',
    ];

    protected $casts = [
        'is_archived' => 'boolean',
    ];

    public function teams()
    {
        return $this->hasMany(Team::class);
    }
}
?>