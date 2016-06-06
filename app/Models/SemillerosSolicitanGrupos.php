<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class SemillerosSolicitanGrupos extends Model
{
    public $table = 'semilleros_solicitan_grupos';
    public  $timestamps = false;
    public $fillable = ['semillero_id','grupo_id','respuesta','activo'];
    
    public function semillero() {
        return $this->belongsTo(Semillero::class);
    }
    
    public function grupo() {
        return $this->belongsTo(Grupo::class);
    }
}