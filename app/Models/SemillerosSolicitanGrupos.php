<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class SemillerosSolicitanGrupos extends Model
{
    public $table = 'semilleros_solicitan_grupos';
    public  $timestamps = false;
    public $fillable = ['semillero_id','grupo_id','respuesta','activo'];
}

