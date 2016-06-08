<?php

namespace App\Models;

use App\Models\Convocatoria;
use App\Models\Semillero;
use Illuminate\Database\Eloquent\Model;

class SolicitudAvalConvocatoria extends Model
{
    public $table = 'solicitudes_aval_convocatorias';

    public  $timestamps = false;

    public $fillable = ['convocatoria_id','semillero_id','respuesta','tutor_id','activo'];

    protected $guarded = ['id'];

    public function convocatoria()
    {
        return $this->hasOne(Convocatoria::class);
    }

    public function semillero()
    {
        return $this->hasOne(Semillero::class);
    }

}




