<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tutor extends Model
{
    public $table = 'tutores';
    
    public  $timestamps = false;
    
    public $fillable = ['identificacion', 'nombres', 'apellidos', 'tipo_documento','sexo', 'fecha_expedicion', 'fecha_nacimiento', 'cvlac','direccion','celular','email_personal','email','pass', 'usuario_id'];
    
    public function usuario()
    {
        return $this->belongsTo(Usuario::class);
    }
    
    public function grupo()
    {
        return $this->hasOne(Grupo::class);
    }
}