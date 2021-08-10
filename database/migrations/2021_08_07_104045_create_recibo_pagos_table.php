<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReciboPagosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('recibo_pagos', function (Blueprint $table) {
            $table->id();
            $table->date('fecha')->nullable();
            $table->bigInteger('id_vehiculo')->nullable();
            $table->integer('folio')->nullable();
            $table->string('recibi')->nullable();
            $table->integer('cantidad')->nullable();
            $table->string('concepto')->nullable();
            $table->integer('forma_pago')->nullable();
            $table->string('recibi_conformidad')->nullable();
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
        Schema::dropIfExists('recibo_pagos');
    }
}
