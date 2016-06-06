<?php
/**
* Created by Jose Soto.
* Date: 16/05/2016
* Time: 11:35 AM
*/
namespace App\Models;

use App\Models\Proyectos;
use Illuminate\Database\Eloquent\Model;

class Estudiante extends Model
{
    public $table = 'estudiantes';
    
    public $timestamps = false;
    
    public $fillable = ['usuario_id', 'tipo_documento', 'identificacion', 'nombres', 'apellidos',
    'sexo', 'fecha_nacimiento', 'lugar_expedicion', 'lugar_nacimiento',
    'estado_civil', 'direccion', 'telefono', 'activo', 'universidad',
    'programa_id', 'n_semestre', 'fecha_expedicion'];
    
    protected $guarded = ['id'];
    
    public function usuario()
    {
        return $this->belongsTo(Usuario::class);
    }
    
    public function programa()
    {
        return $this->belongsTo(Programa::class);
    }

    public function invitaciones_de_semilleros()
    {
        return $this->hasMany(SemilleroSolicitaEstudiante::class);
    }
    
    public function proyectos()
    {
        return $this->belongsToMany(Proyectos::class);
    }
    
    public function proyectoActivo()
    {
        return $this->belongsToMany(Proyectos::class)->where('activo', 1);
    }
}