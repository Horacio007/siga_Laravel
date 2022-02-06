<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEstatusEstadosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('estatus_estados', function (Blueprint $table) {
            $table->id();
            $table->string('ubicacion_id');
            $table->string('estatus');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        chema::table('estatus_estados', function (Blueprint $table) {
            $table->dropColumn('updated_at');
            $table->dropColumn('created_at');
            $table->dropColumn('deleted_at');
        });
    }
}
