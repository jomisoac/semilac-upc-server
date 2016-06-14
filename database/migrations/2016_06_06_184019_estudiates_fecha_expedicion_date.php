<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class EstudiatesFechaExpedicionDate extends Migration
{
    /**
    * Run the migrations.
    *
    * @return void
    */
    public function up()
    {
        Schema::table('estudiantes', function (Blueprint $table) {
            DB::statement('ALTER TABLE estudiantes MODIFY COLUMN fecha_expedicion DATE NOT NULL');
        });
    }
    
    /**
    * Reverse the migrations.
    *
    * @return void
    */
    public function down()
    {
        Schema::table('estudiantes', function (Blueprint $table) {
            DB::statement('ALTER TABLE estudiantes MODIFY COLUMN fecha_expedicion VARCHAR(10) NOT NULL');
        });
    }
}