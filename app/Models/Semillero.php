<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Semillero extends Model
{
    public $table = 'semilleros';
    public  $timestamps = false;
    public $fillable = ['programa_id','grupo_id','nombre','mision','vision',
        'objetivo_general','objetivo_uno','objetivo_dos','objetivo_tres',
        'estrategia_uno','estrategia_dos','estrategia_tres','tutor_id','activo'];

    public function tutor()
    {
        return $this->belongsTo(Tutor::class);
    }
    
     public function programa()
    {
        return $this->belongsTo(Programa::class);
    }
     public function grupo()
    {
        return $this->belongsTo(Grupo::class);
    }

    public function semilleroSolicitaEstudiante()
    {
        return $this->hasOne(SemilleroSolicitaEstudiante::class);
    }

}
