<?php

namespace App\Models;

use App\Models\Estudiante;
use Illuminate\Database\Eloquent\Model;

class Proyectos extends Model
{
    public $table = 'proyectos';

    public $fillable = ['nombre', 'activo'];


    public function estudiantes()
    {
        return $this->belongsToMany(Estudiante::class);
    }
}
