<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class TablaGruposTutorSoloTieneUnGrupo extends Migration
{
    /**
    * Run the migrations.
    *
    * @return void
    */
    public function up()
    {
        Schema::table('grupos', function (Blueprint $table) {
            $table->unique('tutor_id');
        });
    }
    
    /**
    * Reverse the migrations.
    *
    * @return void
    */
    public function down()
    {
        Schema::table('grupos', function (Blueprint $table) {
            $table->dropUnique('grupos_tutor_id_unique');
        });
    }
}