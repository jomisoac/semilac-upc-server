<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Linea extends Model
{
    public $table = 'lineas_de_investigacion';
    
    public $timestamps = false;
    
    public $fillable = ['grupo_id', 'nombre', 'objetivo', 'logro', 'efecto','activo'];
    
     public function grupo()
    {
        return $this->belongsTo(Grupo::class);
    }
}

