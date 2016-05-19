<?php
/**
 * Created by Jose Soto.
 * Date: 16/05/2016
 * Time: 11:35 AM
 */
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Estudiante extends Model
{
    public $table = 'estudiantes';

    public  $timestamps = false;

    public $fillable = ['usuario_id', 'identificacion', 'nombres', 'apellidos',
        'sexo', 'fecha_nacimiento', 'lugar_expedicion', 'lugar_nacimiento',
        'estado_civil', 'direccion', 'telefono', 'activo', 'universidad',
        'programa_id', 'n_semestre', 'fecha_expedicion' ];

    protected $guarded = ['id'];
    
    public function usuario()
    {
        return $this->belongsTo(Usuario::class);
    }

    public function programa()
    {
        return $this->belongsTo(Programa::class);
    }
}
