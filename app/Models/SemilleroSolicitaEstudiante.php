<?php

namespace App\Models;

use App\Models\Estudiante;
use App\Models\Semillero;
use Illuminate\Database\Eloquent\Model;

class SemilleroSolicitaEstudiante extends Model
{
    public $table = 'semillero_solicita_estudiante';

    public  $timestamps = false;

    public $fillable = ['estudiante_id','semillero_id','respuesta','activo'];

    protected $guarded = ['id'];

    public function estudiante()
    {
        return $this->hasOne(Estudiante::class);
    }

    public function semillero()
    {
        return $this->hasOne(Semillero::class);
    }

}
