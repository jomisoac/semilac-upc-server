<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CrearTablaSolicitudesAvalConvocatoria extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('solicitudes_aval_convocatorias', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('convocatoria_id')->unsigned();
            $table->integer('semillero_id')->unsigned();
            $table->enum('respuesta',['en espera','avalado','negado'])->default('en espera');
            $table->integer('tutor_id')->unsigned();
            $table->boolean('activo')->default(1);
            $table->foreign('convocatoria_id')->references('id')->on('convocatorias');
            $table->foreign('semillero_id')->references('id')->on('semilleros');
            $table->foreign('tutor_id')->references('id')->on('tutores');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('solicitudes_aval_convocatorias');
    }
}
