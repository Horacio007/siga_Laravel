<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Aseguradoras extends Model
{
    use HasFactory;

    public function asesores(){
        return $this->hasMany('App\Models\Asesores', 'id_aseguradora', 'id');
    }
}
