<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableProgramas extends Migration
{
    /**
    * Run the migrations.
    *
    * @return void
    */
    public function up()
    {
        Schema::create('programas', function(Blueprint $table){
            $table->increments('id');
            $table->string('nombre');
        });
        
        DB::table('programas')->insert([
        'nombre' => 'Administración de Empresas'
        ]);
        DB::table('programas')->insert([
        'nombre' => 'Comercio Internacional'
        ]);
        DB::table('programas')->insert([
        'nombre' => 'Contaduría Pública'
        ]);
        DB::table('programas')->insert([
        'nombre' => 'Derecho'
        ]);
        DB::table('programas')->insert([
        'nombre' => 'Economía'
        ]);
        DB::table('programas')->insert([
        'nombre' => 'Enfermería Superior'
        ]);
        DB::table('programas')->insert([
        'nombre' => 'Ingeniería Agroindustrial'
        ]);
        DB::table('programas')->insert([
        'nombre' => 'Ingeniería Ambiental y Sanitaria'
        ]);
        DB::table('programas')->insert([
        'nombre' => 'Ingeniería de Sistemas'
        ]);
        DB::table('programas')->insert([
        'nombre' => 'Ingeniería Electrónica'
        ]);
        DB::table('programas')->insert([
        'nombre' => 'Instrumentación Quirúrgica'
        ]);
        DB::table('programas')->insert([
        'nombre' => 'Licenciatura en Arte, Folclor y Cultura'
        ]);
        DB::table('programas')->insert([
        'nombre' => 'Licenciatura en Ciencias Naturales y Educación Ambiental'
        ]);
        DB::table('programas')->insert([
        'nombre' => 'Licenciatura en Lengua Castellana e Inglés'
        ]);
        DB::table('programas')->insert([
        'nombre' => 'Licenciatura en Matemáticas y Física'
        ]);
        DB::table('programas')->insert([
        'nombre' => 'Microbiología'
        ]);
        DB::table('programas')->insert([
        'nombre' => 'Psicología'
        ]);
        DB::table('programas')->insert([
        'nombre' => 'Sociología'
        ]);
    }
    
    /**
    * Reverse the migrations.
    *
    * @return void
    */
    public function down()
    {
        Schema::drop('programas');
    }
}