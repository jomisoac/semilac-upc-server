<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Grupo extends Model
{
    public $table = 'grupos';
    
    public $timestamps = false;
    
    public $fillable = ['codigo', 'nombre', 'tutor_id', 'clasificacion', 'usuario_id', 'gruplac'];
    
}