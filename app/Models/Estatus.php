<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Estatus extends Model
{
    use HasFactory;
    protected $table='estatus';

    public function estadoUbicacion(){
        return $this->hasOne('App\Models\EstatusEstado', 'ubicacion_id', 'id');
    }
}
