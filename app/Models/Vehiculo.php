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

    public function estatus(){
        return $this->hasOne('App\Models\Estatus', 'id', 'estatus_id');
    }

    public function estatusRefacciones(){
        return $this->hasOne('App\Models\Estatusrefacciones', 'id', 'refacciones_id');
    }

    public function nivelDano(){
        return $this->hasOne('App\Models\nivel_dano', 'id', 'n_dano')->withDefault([
            'n_dano' => 'Sin nivel de daño',
        ]);
    }

    public function formaArribo(){
        return $this->hasOne('App\Models\forma_aribo', 'id', 'f_arribo')->withDefault([
            'f_arribo' => 'Sin forma de arribo',
        ]);
    }

    public function personalHojalateria(){
        return $this->hasOne('App\Models\Personal', 'id', 'asignado_hojalateria');
    }
}
