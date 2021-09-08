<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Facturas extends Model
{
    use HasFactory;

    public function expedientes(){
        return $this->hasOne('App\Models\Vehiculo', 'id', 'id_vehiculo')->withDefault([
            'expediente' => 'N/A',
        ]);
    }

    public function estatusFac(){
        return $this->hasOne('App\Models\Estatusaseguradoras', 'id', 'estatus_aseguradora')->withDefault([
            'estatusFac' => 'Pendiente'
        ]);
    }

    public function tipo_servicios(){
        return $this->hasOne('App\Models\Tipo_servicio', 'id', 'tipo_servicio_id');
    }

    public function recibo_pagos(){
        return $this->hasMany('App\Models\Recibo_pagos', 'id_vehiculo', 'id_vehiculo');
    }
}
