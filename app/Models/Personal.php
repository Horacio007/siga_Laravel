<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Personal extends Model
{
    use HasFactory;
    protected $table='personal';

    public function area(){
        return $this->hasOne('App\Models\Areas','id', 'id_area');
    }
}
