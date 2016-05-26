<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CrearTablaInvitacionesSemilleros extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('invitaciones-semilleros', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('tutor_id')->unsigned();
            $table->integer('estudiante_id')->unsigned();
            $table->boolean('estado')->default('enviado', 'aceptado', 'rechazado');
            $table->foreign('tutor_id')->references('id')->on('tutores');
            $table->foreign('estudiante_id')->references('id')->on('estudiante')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('invitaciones-semilleros');
    }
}
