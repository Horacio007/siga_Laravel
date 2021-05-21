<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vehiculo extends Model
{
    use HasFactory;
    protected $table='vehiculo';

    public function marcas(){
        return $this->hasOne('App\Models\Modelosv', 'id', 'marca_id');
    }

    public function submarcas(){
        return $this->hasOne('App\Models\Submarcav', 'id', 'linea_id');
    }

    public function clientes(){
        return $this->hasOne('App\Models\Aseguradoras', 'id', 'cliente_id');
    }

    public function asesores(){
        return $this->hasOne('App\Models\Asesores', 'id', 'id_asesor');
    }
}
