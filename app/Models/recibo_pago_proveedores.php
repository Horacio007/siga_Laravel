<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class recibo_pago_proveedores extends Model
{
    use HasFactory;

    public function expedientes(){
        return $this->hasOne('App\Models\Vehiculo', 'id', 'id_vehiculo')->withDefault([
            'expediente' => 'N/A',
        ]);
    }

    public function tipo_pagos(){
        return $this->hasOne('App\Models\Tipo_pago', 'id', 'forma_pago')->withDefault([
            'tipo_anticipo' => 'No hay tipo de pago registrado']);
    }

    public function forma_pagos(){
        return $this->hasOne('App\Models\Forma_pago', 'id', 'forma_pago');
    }

    public function facturas(){
        return $this->hasOne('App\Models\si_no', 'id', 'factura');
    }

    public function concepto_pagos(){
        return $this->hasOne('App\Models\Conceptos_pagos', 'id', 'tipo');
    }
    
    public function requiere_factura(){
        return $this->hasOne('App\Models\si_no', 'id', 'aplica_factura');
    }

}
