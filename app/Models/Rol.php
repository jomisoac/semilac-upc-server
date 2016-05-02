<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Rol extends Model
{
    protected $table = 'roles';

    protected $guarded = ['id'];

    public $timestamps = false;
}