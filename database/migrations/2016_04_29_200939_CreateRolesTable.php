<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRolesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('roles', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nombre');
            $table->timestamps();
        });
        DB::table('roles')->insert([
            'nombre' => 'SUPER_ADMIN',
        ]);
        DB::table('roles')->insert([
            'nombre' => 'TUTOR',
        ]);
        DB::table('roles')->insert([
            'nombre' => 'DIRECTOR',
        ]);
        DB::table('roles')->insert([
            'nombre' => 'ESTUDIANTE',
        ]);
        DB::table('roles')->insert([
            'nombre' => 'LIDER',
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('roles');
    }
}
