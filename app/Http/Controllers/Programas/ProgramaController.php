<?php
/**
 * Created by Jose Soto.
 * Date: 16/05/2016
 * Time: 12:58 PM
 */
namespace App\Http\Controllers\Programas;

use App\Models\Programa;
use App\Http\Controllers\Controller;
use App\Http\Requests;

class ProgramaController extends Controller
{
    public function getAll(){
        return Programa::all()->toJson();
    }

    public function get($id){
        return Programa::find($id);
    }
}
