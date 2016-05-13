<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Requisito extends Model
{
    protected $table = 'requisitos';
    protected $guarded = ['id'];
    public $timestamps = false;
}

