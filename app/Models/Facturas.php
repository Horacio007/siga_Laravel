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
}
