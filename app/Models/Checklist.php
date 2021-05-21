<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;

class Checklist extends Model
{
    use HasFactory;
    protected $table='checklist';
    public function vehiculo(){
        return $this->hasOne('App\Models\Vehiculo', 'id_aux_vehiculo', 'id');
    }
    protected $guarded=['_token'];
    protected $fillable = [
        "luces_front",
        "cuarto_luces",
        "direccional_izq",
        "direccional_der",
        "espejo_der",
        "espejo_izq",
        "cristales",
        "emblema",
        "llantas",
        "tapon_ruedas",
        "molduras",
        "tapa_gasolina",
        "stopp",
        "luz_tras_izq",
        "luz_tras_der",
        "direccional_tras_izq",
        "direccional_tras_der",
        "luz_placa",
        "luz_cajuela",
        "luz_tablero",
        "instrumentos_tablero",
        "llaves",
        "limpia_parabrisas_fron",
        "limpia_parabrisas_tras",
        "estereo",
        "bocinas_fron",
        "bocinas_tras",
        "encendedor",
        "espejo_retrovisor",
        "cenicero",
        "cinturones",
        "luz_int",
        "parasol_izq",
        "parasol_der",
        "vestiduras_tela",
        "vestiduras_piel",
        "testigos_tablero",
        "refaccion",
        "dado_seguridad",
        "gato",
        "maneral",
        "herramientas",
        "triangulos",
        "botiquin",
        "extintor",
        "cables",
        "claxon",
        "tapon_aceite",
        "tapon_gasolina",
        "tapon_radiador",
        "vayoneta_aceite",
        "bateria"
    ];
}
