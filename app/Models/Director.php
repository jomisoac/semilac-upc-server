<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Director extends Model
{
    public $table = 'directores';

    public  $timestamps = false;

    public $fillable = ['identificacion', 'nombres', 'apellidos', 'fechaIngreso', 'usuario_id'];
    
    public function usuario()
    {
        return $this->belongsTo(Usuario::class);
    }
}
