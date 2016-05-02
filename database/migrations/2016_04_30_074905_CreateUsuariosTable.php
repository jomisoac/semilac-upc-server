<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsuariosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('usuarios', function (Blueprint $table) {
            $table->increments('id');
            $table->string('email')->unique();
            $table->string('password');
            $table->integer('rol_id')->unsigned();
            $table->foreign('rol_id')->references('id')->on('roles');
            $table->integer('estado');
            $table->timestamps();
        });

        DB::table('usuarios')->insert([
            'email' => 'semilac-upc@unicesar.edu.co',
            'password' => password_hash('1234', PASSWORD_DEFAULT),
            'rol_id' => '1',
            'estado' => '1'
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('usuarios');
    }
}
