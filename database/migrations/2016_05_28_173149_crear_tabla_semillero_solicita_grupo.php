<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CrearTablaSemilleroSolicitaGrupo extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('semilleros_solicitan_grupos', function(Blueprint $table) {
            $table->increments('id');
            $table->integer('semillero_id')->unsigned();
            $table->integer('grupo_id')->unsigned()->nullable();
            $table->enum('respuesta',['en espera','rechazada','aceptada'])->default('en espera');
            $table->boolean('activo')->default('1');
            $table->foreign('semillero_id')->references('id')->on('semilleros')->onDelete('cascade')->onUpdate('cascade');;
            $table->foreign('grupo_id')->references('id')->on('grupos');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('semilleros_solicitan_grupos');
    }
}
