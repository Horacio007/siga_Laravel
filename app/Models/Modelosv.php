<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Modelosv extends Model
{
    use HasFactory;
    protected $table='modelosv';

    //esta relacion se dirige a submarcav
    public function submarca(){
        return $this->hasMany('App\Models\Submarcav', 'id_marca', 'id');
    }
     /*
    //esta relacion se dirige a vehiculo
    public function vehiculo(){
        return $this->hasOne('App\Models\Vehiculo', 'id', 'marca_id');
    }
    */
}
