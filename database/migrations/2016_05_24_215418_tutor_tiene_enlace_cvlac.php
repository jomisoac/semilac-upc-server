<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class TutorTieneEnlaceCvlac extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('tutores', function (Blueprint $table) {
            $table->string('cvlac')->after('fecha_nacimiento');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('tutores', function (Blueprint $table) {
            $table->dropColumn('cvlac');
        });
    }
}
