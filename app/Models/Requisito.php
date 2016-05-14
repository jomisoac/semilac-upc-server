<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class Requisito extends Model
{
    public $table = 'requisitos';
    protected $guarded = ['id'];
    public  $timestamps = false;
    public $fillable = ['nombre_requisito'];
}
