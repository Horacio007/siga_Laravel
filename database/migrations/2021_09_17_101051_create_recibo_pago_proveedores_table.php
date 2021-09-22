<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReciboPagoProveedoresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('recibo_pago_proveedores', function (Blueprint $table) {
            $table->id();
            $table->date('fecha')->nullable();
            $table->bigInteger('id_vehiculo')->nullable();
            $table->integer('folio')->nullable();
            $table->integer('aplica_factura')->nullable();
            $table->string('page')->nullable();
            $table->decimal('cantidad', 65, 2)->nullable();
            $table->string('concepto')->nullable();
            $table->string('proveedor')->nullable();
            $table->integer('tipo_gasto_id')->nullable();
            $table->integer('forma_pago')->nullable();
            $table->string('recibio_conformidad')->nullable();
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
        Schema::dropIfExists('recibo_pago_proveedores');
    }
}
