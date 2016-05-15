<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tutor extends Model
{
    public $table = 'tutores';

    public  $timestamps = false;

    public $fillable = ['identificacion', 'nombres', 'apellidos', 'tipo_identificacion', 'fecha_expedicion', 'fecha_nacimiento', 'usuario_id'];
    
    public function usuario()
    {
        return $this->belongsTo(Usuario::class);
    }
}
