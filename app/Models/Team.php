<?php
// app/Models/Team.php
class Team extends Model
{
    protected $fillable = ['school_id', 'team_naam', 'approved'];

    public function schools()
    {
        return $this->belongsTo(School::class);
    }
}
