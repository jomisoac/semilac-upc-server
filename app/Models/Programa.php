<?php
/**
 * Created by Jose Soto.
 * Date: 16/05/2016
 * Time: 11:37 AM
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Programa extends Model
{
    public $table = 'programas';

    public  $timestamps = false;

    public $fillable = ['nombre'];
}
