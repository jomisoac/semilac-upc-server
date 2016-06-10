<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EstudianteSolicitaSemillero extends Model
{
    public $table = 'estudiante_solicita_semillero';

    public  $timestamps = false;

    public $fillable = ['estudiante_id','semillero_id','respuesta','activo'];

    protected $guarded = ['id'];

    public function estudiante()
    {
        return $this->belongsTo(Estudiante::class);
    }

    public function semillero()
    {
        return $this->belongsTo(Semillero::class);
    }
}