<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EstatusEstado extends Model
{
    use HasFactory;

    public function ubicacionEstado(){
        return $this->hasOne('App\Models\Estatus', 'id', 'ubicacion_id');
    }
}
