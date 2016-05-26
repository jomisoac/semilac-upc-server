<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Invitacion extends Model
{
    public $table = 'invitaciones-semilleros';

    public  $timestamps = false;

    public $fillable = ['tutor_id','estudiante_id','estado'];

    public function usuario()
    {
        return $this->belongsTo(Usuario::class);
    }
}
