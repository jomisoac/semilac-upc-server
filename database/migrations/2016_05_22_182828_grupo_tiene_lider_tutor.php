<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class GrupoTieneLiderTutor extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('grupos', function (Blueprint $table) {
            $table->dropColumn('lider');
            //tutor_id, representa al tutor que sera lider del grupo de investigacion
            $table->integer('tutor_id')->after('nombre')->unsigned();
            $table->foreign('tutor_id')
                ->references('id')
                ->on('tutores')
                ->onDelete('cascade')
                ->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        $table->dropColumn('tutor_id');
        $table->string('lider');
    }
}
