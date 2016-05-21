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
            'nombre' => 'Ingeniería de sistemas'
        ]);
        DB::table('programas')->insert([
            'nombre' => 'Ingeniería electronica'
        ]);
        DB::table('programas')->insert([
            'nombre' => 'Ingeniería ambiental y sanitaria'
        ]);
        DB::table('programas')->insert([
            'nombre' => 'Ingeniería agroindustrial'
        ]);
        DB::table('programas')->insert([
            'nombre' => 'DERECHO'
        ]);
        DB::table('programas')->insert([
            'nombre' => 'Licenciatura en ciencias naturales'
        ]);
        DB::table('programas')->insert([
            'nombre' => 'LICENCIATURA en matematicas y fisica'
        ]);
        DB::table('programas')->insert([
            'nombre' => 'Licenciatura en idiomas'
        ]);
        DB::table('programas')->insert([
            'nombre' => 'Administración de empresas'
        ]);
        DB::table('programas')->insert([
            'nombre' => 'Contaduría'
        ]);
        DB::table('programas')->insert([
            'nombre' => 'Economía'
        ]);
        DB::table('programas')->insert([
            'nombre' => 'Enfermería superior'
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
