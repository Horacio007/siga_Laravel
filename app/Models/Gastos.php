<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Gastos extends Model
{
    use HasFactory;

    public function forma_pagos(){
        return $this->hasOne('App\Models\Forma_pago', 'id', 'forma_pago');
    }

    public function facturas(){
        return $this->hasOne('App\Models\si_no', 'id', 'factura');
    }

    public function concepto_pagos(){
        return $this->hasOne('App\Models\Conceptos_pagos', 'id', 'tipo');
    }

    public function expedientes(){
        return $this->hasOne('App\Models\Vehiculo', 'id', 'expediente')->withDefault([
            'expediente' => 'N/A',
        ]);
    }
}
