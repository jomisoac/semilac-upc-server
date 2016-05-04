<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;

class Usuario extends Authenticatable
{
    protected $table = 'usuarios';

    protected $fillable = ['email', 'password', 'estado'];

    protected $hidden = ['password'];

    public function roles()
    {
        return $this->belongsToMany(Rol::class)->select('nombre');
    }

    public static function nuevo($nombre, $contrasena, $estado = -1)
    {
        return parent::create([
            'email' => $nombre,
            'password' => password_hash($contrasena, PASSWORD_DEFAULT),
            'estado' => $estado
        ]);
    }
}
