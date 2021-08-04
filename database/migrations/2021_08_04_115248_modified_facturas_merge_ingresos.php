<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ModifiedFacturasMergeIngresos extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('facturas', function (Blueprint $table) {
            $table->integer('folio')->nullable();
            $table->integer('tipo_servicio_id')->nullable();
            $table->date('fecha_anticipo')->nullable();
            $table->integer('tipo_pago_anticipo_id')->nullable();
            $table->decimal('anticipo', 65, 2)->nullable();
            $table->integer('tipo_pago_id')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
