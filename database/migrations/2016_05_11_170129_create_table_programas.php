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
            'nombre' => 'INGENIERIA DE SISTEMAS'
        ]);
        DB::table('programas')->insert([
            'nombre' => 'INGENIERIA ELECTRONICA'
        ]);
        DB::table('programas')->insert([
            'nombre' => 'INGENIERIA AMBIENTAL Y SANITARIA'
        ]);
        DB::table('programas')->insert([
            'nombre' => 'INGENIERIA AGROINDUSTRIAL'
        ]);
        DB::table('programas')->insert([
            'nombre' => 'DERECHO'
        ]);
        DB::table('programas')->insert([
            'nombre' => 'LICENTIATURA EN CIENTAS NATURALES'
        ]);
        DB::table('programas')->insert([
            'nombre' => 'LICENCIATURA EN MATEMATICAS Y FISICA'
        ]);
        DB::table('programas')->insert([
            'nombre' => 'LICENTIATURA EN IDIOMAS'
        ]);
        DB::table('programas')->insert([
            'nombre' => 'ADMINISTRACION DE EMPRESAS'
        ]);
        DB::table('programas')->insert([
            'nombre' => 'CONTADURIA'
        ]);
        DB::table('programas')->insert([
            'nombre' => 'ECONOMIA'
        ]);
        DB::table('programas')->insert([
            'nombre' => 'ENFERMERIA'
        ]);
        DB::table('programas')->insert([
            'nombre' => 'PSICOLOGIA'
        ]);
        DB::table('programas')->insert([
            'nombre' => 'SOCIOLOGIA'
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
