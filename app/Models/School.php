<?// app/Models/School.php
class School extends Model
{
    protected $fillable = ['naam', 'stad'];

    public function teams()
    {
        return $this->hasMany(Team::class);
    }
}
?>