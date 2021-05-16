<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Submarcav extends Model
{
    use HasFactory;
    protected $table='submarcav';
    //esta va hacia modelosv
    public function marca(){
        return $this->hasOne('App\Models\Modelosv','id', 'id_marca');
    }

    /*
    public function vehiculo(){
        return $this->hasOne('App\Models\Vehiculo','id', 'linea_id');
    }
    */
}
