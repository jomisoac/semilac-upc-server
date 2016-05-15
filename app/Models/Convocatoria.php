<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Convocatoria extends Model
{
    public $table = 'convocatorias';

    public  $timestamps = false;

    public $fillable = ['fechainicial', 'fechafinal', 'asunto', 'acta', 'usuario_id'];

    public function Usuario()
    {
        return $this->belongsTo(Usuario::class);
    }
}
