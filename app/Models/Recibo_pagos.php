<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Recibo_pagos extends Model
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

    public function cliente(){
        return $this->hasOne('App\Models\Clientes', 'id', 'recibi');
    }
}
