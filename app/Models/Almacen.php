<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Almacen extends Model
{
    use HasFactory;
    protected $table='almacen';

    public function vehiculo(){
        return $this->hasOne('App\Models\Vehiculo', 'id', 'id_vehiculo');
    }

    public function estatusA(){
        return $this->hasOne('App\Models\Estatusalmacen', 'id', 'estatus_id');
    }

    public function aseguradora(){
        return $this->hasOne('App\Models\Aseguradoras', 'id', 'aseguradora_id');
    }
    
}
