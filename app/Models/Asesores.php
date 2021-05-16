<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Asesores extends Model
{
    use HasFactory;

    public function aseguradoras(){
        return $this->hasOne('App\Models\Aseguradoras', 'id', 'id_aseguradora');
    }
}
