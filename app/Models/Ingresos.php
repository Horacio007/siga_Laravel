<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ingresos extends Model
{
    use HasFactory;

    public function expedientes(){
        return $this->hasOne('App\Models\Vehiculo', 'id', 'id_vehiculo')->withDefault([
            'expediente' => 'N/A',
        ]);
    }
    
    public function tipo_pago_a(){
        return $this->hasOne('App\Models\Tipo_pago', 'id', 'tipo_pago_anticipo')->withDefault([
            'tipo_anticipo' => 'No hay tipo de pago registrado']);
    }
    
    public function tipo_pago_f(){
        return $this->hasOne('App\Models\Tipo_pago', 'id', 'tipo_pago_finiquito');
    }

    public function tipo_servicios(){
        return $this->hasOne('App\Models\Tipo_servicio', 'id', 'tipo_servicio')->withDefault([
            'tipo_servicio' => '']);
    }
}
