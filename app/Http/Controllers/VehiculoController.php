<?php

namespace App\Http\Controllers;

use App\Models\Vehiculo;
use App\Models\Clientes;
use App\Models\Estatus;
use App\Models\Personal;
use Facade\FlareClient\Http\Response;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class VehiculoController extends Controller
{
    use SoftDeletes;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function indexV()
    {
        $valuaciones = Vehiculo::with(['marcas:id,marca', 'submarcas:id,submarca', 'clientes:id,nombre', 'asesores:id,nombre,a_paterno,a_materno', 'estatus:id,status', 'nivelDano:id,nivel', 'formaArribo:id,forma_arribo'])
                                ->select('id_aux','id','estatus_id','modelo', 'color', 'marca_id', 'linea_id', 'cliente_id', 'placas', 'id_asesor', 'no_siniestro', 'n_dano', 'f_arribo', 'fecha_llegada', 'fecha_llegada_taller', 'fecha_valuacion', 'diferencia_tres_dias', 'cantidad_inicial', 'piezas_cambiadas_inicial', 'piezas_reparacion_inicial', 'fecha_autorizacion', 'cantidad_final', 'piezas_cambiadas_final', 'piezas_reparacion_final', 'piezas_vendidas', 'importe_piezas_vendidas', 'piezas_vendidas', 'porcentaje_aprobacion', 'fecha_promesa')
                                ->where('estatus_id','5')
                                //->where('id_aux', 433)
                                ->orWhere('estatus_id','6')
                                ->orderBy('id_aux')
                                ->get();

        //dd($valuaciones[0]->formaArribo->forma_arribo);

        return view('administracion.valuaciones.l_valuaciones', compact('valuaciones'));
    }

    public function indexR()
    {
        $refacciones = Vehiculo::with(['marcas:id,marca', 'submarcas:id,submarca', 'clientes:id,nombre', 'asesores:id,nombre,a_paterno,a_materno', 'estatus:id,status', 'nivelDano:id,nivel', 'formaArribo:id,forma_arribo', 'estatusRefacciones:id,estatus'])
                                ->select('id_aux','id','estatus_id','modelo', 'color', 'marca_id', 'linea_id', 'cliente_id', 'placas', 'id_asesor', 'no_siniestro', 'n_dano', 'f_arribo', 'fecha_llegada', 'fecha_llegada_taller', 'refacciones_id','fecha_promesa')
                                ->where('estatus_id','5')
                                //->where('id', '1203112020')
                                ->orWhere('estatus_id', '7')
                                ->orWhere('estatus_id','6')
                                ->orderBy('id_aux')
                                ->get();

        //dd($valuaciones[0]->formaArribo->forma_arribo);
        //dd($refacciones[0]->estatusRefacciones->estatus);
        return view('administracion.refacciones.l_refaccionesAdmon', compact('refacciones'));
    }

    public function indexAP()
    {
        $asignacion_personal = Vehiculo::with(['marcas:id,marca', 'submarcas:id,submarca', 'clientes:id,nombre', 'asesores:id,nombre,a_paterno,a_materno', 'estatus:id,status'])
                                ->select('id_aux','id','estatus_id','modelo', 'color', 'marca_id', 'linea_id', 'cliente_id', 'placas', 'id_asesor', 'no_siniestro', 'fecha_llegada_taller', 'aplica_lavado')
                                ->where('estatus_id','5')
                                //->orWhere('estatus_id', '7')
                                ->orWhere('estatus_id','6')
                                ->orderBy('id_aux')
                                ->get();

        //dd($asignacion_personal);
        return view('administracion.asignacionPersonal.l_asignacionPersonal', compact('asignacion_personal'));
    }

    public function indexPA()
    {
        $proceso_administrativo = Vehiculo::with(['marcas:id,marca', 'submarcas:id,submarca', 'clientes:id,nombre', 'asesores:id,nombre,a_paterno,a_materno', 'estatus:id,status', 'nivelDano:id,nivel', 'formaArribo:id,forma_arribo'])
                                ->select('id_aux','id','estatus_id','modelo', 'color', 'marca_id', 'linea_id', 'cliente_id', 'placas', 'id_asesor', 'no_siniestro', 'n_dano', 'f_arribo', 'fecha_llegada', 'fecha_valuacion', 'fecha_autorizacion', 'p_asignados', 'r_disponibles')
                                ->where('estatus_id','5')
                                //->where('id_aux', 433)
                                ->orWhere('estatus_id','6')
                                ->orderBy('id_aux')
                                ->get();

        return view('administracion.procesoAdmistrativo.l_procesoAdministrativo', compact('proceso_administrativo'));
    }

    public function indexPT()
    {
        $proceso_taller = Vehiculo::with(['marcas:id,marca', 'submarcas:id,submarca', 'clientes:id,nombre', 'asesores:id,nombre,a_paterno,a_materno', 'estatus:id,status', 'nivelDano:id,nivel', 'formaArribo:id,forma_arribo'])
                                ->select('id_aux','id','estatus_id','modelo', 'color', 'marca_id', 'linea_id', 'cliente_id', 'placas', 'id_asesor', 'no_siniestro', 'n_dano', 'f_arribo', 'aplica_hojalateria', 'fecha_hojalateria', 'aplica_preparacion', 'fecha_preparacion', 'aplica_pintura', 'fecha_pintura', 'aplica_armado', 'fecha_armado', 'aplica_detallado', 'fecha_detallado', 'aplica_mecanica', 'fecha_mecanica', 'aplica_lavado', 'fecha_lavado', 'fecha_entrega_interna', 'asignado_hojalateria', 'asignado_preparacion', 'asignado_pintura', 'asignado_armado', 'asignado_detallado', 'asignado_mecanica', 'asignado_lavado')
                                ->where('estatus_id','5')
                                //->where('id_aux', 433)
                                ->orWhere('estatus_id','6')
                                ->orderBy('id_aux')
                                ->get();

        return view('administracion.procesoTaller.l_procesoTaller', compact('proceso_taller'));
    }

    public function i_vehiculo(){
        return view('recepcion.vehiculo.i_vehiculo');
    }

    public function ultimo_vehiculo_nuevo(Request $request){

        if ($request['noexpediente'] == true) {
            $ultimo = Vehiculo::select('id')
                            ->orderBy('id_aux', 'DESC')
                            ->limit(1)
                            ->get();
                            
            $ultimov = $ultimo[0]['id'];
            switch ($ultimov) {
                case strlen($ultimov) == 9:
                    $hoy = date("dmY");
                    $ultimov += 100000000;
                    settype($ultimov, 'string');
                    settype($hoy, 'string');
                    $expediente = $ultimov[0];
                    $expediente .=$hoy;
                    settype($expediente, 'integer');
                    return response()->json(['nuevo' => $expediente]);
                    break;

                case strlen($ultimov) == 10:
                    $hoy = date("dmY");
                    $ultimov += 100000000;
                    settype($ultimov, 'string');
                    settype($hoy, 'string');
                    $expediente = $ultimov[0];
                    $expediente .= $ultimov[1];
                    $expediente .=$hoy;
                    settype($expediente, 'integer');
                    return response()->json(['nuevo' => $expediente]);
                    break;

                case strlen($ultimov) == 11:
                    $hoy = date("dmY");
                    $ultimov += 100000000;
                    settype($ultimov, 'string');
                    settype($hoy, 'string');
                    $expediente = $ultimov[0];
                    $expediente .= $ultimov[1];
                    $expediente .= $ultimov[2];
                    $expediente .=$hoy;
                    settype($expediente, 'integer');
                    return response()->json(['nuevo' => $expediente]);
                    break;
                
                default:
                    echo "No hay vehiculos registrados";
                    break;
                }
        } else {
            return response()->json(['nuevo' => 'Hubo un problema!!!']);
        }
    }

    public function ultimo_vehiculo(Request $request){

        if ($request['nouexpediente'] == true) {
            $ultimov = Vehiculo::select('id')
                            ->orderBy('id_aux', 'DESC')
                            ->limit(1)
                            ->get();
        
            return response()->json(['ultimo' => $ultimov]);
        } else {
            return response()->json(['ultimo' => 'Hubo un problema!!!']);
        }
        
        
    }

    /**$vehiculos = Vehiculo::with(['marcas:id,marca', 'submarcas:id,submarca', 'clientes:id,nombre', 'asesores:id,nombre,a_paterno,a_materno', 'estatus:id,status'])
                            ->select('id_aux','id','estatus_id','modelo', 'color', 'marca_id', 'linea_id', 'cliente_id', 'placas', 'id_asesor', 'no_siniestro')
                            ->where('estatus_id','5')
                            ->orWhere('estatus_id','6')
                            ->orWhere('estatus_id','7')
                            ->orderBy('id_aux')
                            ->get();\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //dd($request);
        $r = Vehiculo::where('id', $request['expediente'])
                        ->select('id')
                        ->get();

        if ($r->isEmpty()) {

            $c = new Clientes();
            $c->nombre = $request->nombre;
            $c->telefono = $request->telefono;
            $c->correo = $request->correo;
            
            if ($c->save()) {
                $uc = Clientes::select('id')
                                ->orderBy('id', 'DESC')
                                ->limit(1)
                                ->get();

                $vehiculo = new Vehiculo();
                $vehiculo->id = $request->expediente;
                $vehiculo->id_cliente = $uc[0]['id'];
                $vehiculo->id_asesor = $request->asesor;
                $vehiculo->estatus_id = $request->estatus;
                $vehiculo->fecha_llegada = date("Ymd");;
                $vehiculo->marca_id = $request->marca;
                $vehiculo->linea_id = $request->submarca;
                $vehiculo->color = $request->color;
                $vehiculo->modelo = $request->modelo;
                $vehiculo->placas = $request->placas;
                $vehiculo->cliente_id = $request->aseguradora;
                $vehiculo->no_siniestro = $request->siniestro;
                $vehiculo->n_dano = $request->nivel;
                $vehiculo->f_arribo = $request->arribo;

                if ($vehiculo->save()) {
                    return redirect()->route('i_vehiculos')->with('success','Vehiculo Registrado.');
                } else {
                    return redirect()->route('i_vehiculos')->with('error','Vehiculo no Registrado.');
                }

            } else {
                return redirect()->route('i_vehiculos')->with('error','Cliente no Registrado.');
            }
            
        } else {
            
            $r = Vehiculo::with(['marcas:id,marca', 'submarcas:id,submarca', 'clientes:id,nombre'])
                        ->where('id', $request['expediente'])
                        ->select('id', 'marca_id', 'linea_id', 'color', 'modelo', 'placas', 'cliente_id', 'no_siniestro')
                        ->get();

            return back()->with('warning','Expediente ya registrado con el vehiculo "'. $r[0]['marcas']['marca'] . ' ' . $r[0]['submarcas']['submarca'] . ' ' . $r[0]['color'] . 
                                ' ' .$r[0]['modelo'] . ' ' . $r[0]['placas'] . ' ' . $r[0]['clientes']['nombre'] . ' ' . $r[0]['no_siniestro'] .'" .');             
        }


    }
    
    public function mlmca(Request $request){
        $vehiculo = Vehiculo::with(['marcas:id,marca', 'submarcas:id,submarca', 'clientes:id,nombre', 'asesores:id,nombre,a_paterno,a_materno', 'estatus:id,status'])
                            ->where('id', $request['id'])
                            ->select('modelo', 'color', 'marca_id', 'linea_id', 'cliente_id', 'placas', 'id_asesor', 'estatus_id')
                            ->first();

        $r = Vehiculo::select('id_aux')
        ->where('id', $request['id'])
        ->first();

        $c = Clientes::select('id','nombre', 'telefono', 'correo')
                    ->where('id',$r['id_aux'])
                    ->first();

        //dd($vehiculo);
        return response()->json([$vehiculo, $c]);
    }

    public function indexDocs(){
        $vehiculos = Vehiculo::with(['marcas:id,marca', 'submarcas:id,submarca', 'clientes:id,nombre', 'asesores:id,nombre,a_paterno,a_materno', 'estatus:id,status'])
                            ->select('id_aux','id','estatus_id','modelo', 'color', 'marca_id', 'linea_id', 'cliente_id', 'placas', 'id_asesor', 'no_siniestro')
                            ->where('estatus_id','5')
                            ->orWhere('estatus_id','6')
                            ->orWhere('estatus_id','7')
                            ->orderBy('id_aux')
                            ->get();
        //dd($vehiculos);
        return view('entrega.documentacion.l_documentacion', compact('vehiculos'));
    }

    public function create_pdfentrega(Request $request){
        $vehiculo = Vehiculo::with(['marcas:id,marca', 'submarcas:id,submarca', 'clientes:id,nombre', 'asesores:id,nombre,a_paterno,a_materno','estatus:id,status'])
                            ->where('id_aux', $request->exp)
                            ->select('modelo', 'color', 'marca_id', 'linea_id', 'cliente_id', 'placas', 'id_asesor', 'estatus_id', 'no_siniestro', 'id', 'fecha_llegada', 'fecha_valuacion')
                            ->first();

        $cliente = Clientes::select('*')->where('id', $request->exp)->first();

        $dia = date('d');
        $mes = date('m');
        $ano = date('y');
        $anooo = date('Y');
        $hoy = date('d/m/Y');

        switch ($vehiculo->clientes->id) {
            case 1:
                //primero creo el finiquito
                $pdf = app('dompdf.wrapper');   
                $pdf->loadHTML('<!DOCTYPE html>
                <html lang="en">
                <head>
                    <meta charset="UTF-8">
                    <meta name="viewport" content="width=device-width, initial-scale=1.0">
                    <meta http-equiv="X-UA-Compatible" content="ie=edge">
                    <title>Documentacion GNP</title>
                    <style>
                        body {
                            background: url(img/encuesta_gnp.jpg); 
                            background-size: cover;
                            background-repeat: no-repeat;
                            /* Arriba | Derecha | Abajo | Izquierda */
                            background-size: 100% 100%;
                            /* Arriba | Derecha | Abajo | Izquierda */
                            margin: -50px -38px -60px -39px;
                        }

                        img {
                            width: 780px; height: 1150px;
                        }

                        #img2 {
                            width: 780px; height: 1110px;
                        }

                        #img3 {
                            transform: rotate(-90deg);
                            width: 1130px; height: 800px;
                            position: absolute; 
                            top: 166px; 
                            left: -170px
                            transform: rotate(-90deg);
                        }

                        #vertical {
                            transform: rotate(-90deg);
                        }
                    </style>
                </head>
                <body>
                    <p style="position: absolute; top: 905px; left: 120px;">'.$cliente['nombre'].'</p>
                    <p style="position: absolute; top: 985px; left: 123px;">'.$cliente['telefono'].'</p>
                    <p style="position: absolute; top: 940px; left: 590px;">'.$vehiculo['no_siniestro'].'</p>
                    <p style="position: absolute; top: 963px; left: 590px;">'.$cliente['nombre'].'</p>
                    <p style="position: absolute; top: 985px; left: 590px;">'.$cliente['telefono'].'</p>
                    <p style="position: absolute; top: 1033px; left: 550px;">'.$dia.'</p>
                    <p style="position: absolute; top: 1033px; left: 580px;">'.$mes.'</p>
                    <p style="position: absolute; top: 1033px; left: 610px;">'.$ano.'</p>
                    <hr> <!-- Salto de página -->
                    <img src="img/carta_garantia_gnp.jpg">
                    <p style="position: absolute; top: 130px; left: 610px;">'.$vehiculo['no_siniestro'].'</p>
                    <p style="position: absolute; top: 185px; left: 475px;">'.$vehiculo['no_siniestro'].'</p>
                    <p style="position: absolute; top: 205px; left: 117px;">'.$vehiculo['marcas']['marca'].'</p>
                    <p style="position: absolute; top: 205px; left: 243px;">'.$vehiculo['modelo'].'</p>
                    <p style="position: absolute; top: 205px; left: 462px;">'.$vehiculo['placas'].'</p>
                    <p style="position: absolute; top: 223px; left: 0px;">'.$cliente['nombre'].'</p>
                    <hr> <!-- Salto de página -->
                    <img id="img2" src="img/finiquito_gnp.jpg">
                    <p style="position: absolute; top: 498px; left: 150px;">'.$cliente['nombre'].'</p>
                    <p style="position: absolute; top: 530px; left: 590px;">'.$cliente['telefono'].'</p>
                    <hr> <!-- Salto de página -->
                    <img id="img3" src="img/Boleta_de_salida.jpg">
                    <p id="vertical" style="position: absolute; top: 125px; left: 85px;">'.$vehiculo['id'].'</p>
                    <p id="vertical" style="position: absolute; top: 400px; left: 85px;">'.$hoy.'</p>
                    <p id="vertical" style="position: absolute; top: 880px; left: 120px;">'.$cliente['nombre'].'</p>
                    <p id="vertical" style="position: absolute; top: 180px; left: 163px;">'.$cliente['telefono'].'</p>
                    <p id="vertical" style="position: absolute; top: 925px; left: 240px;">'.$vehiculo['marcas']['marca'].' '.$vehiculo['submarcas']['submarca'].'</p>
                    <p id="vertical" style="position: absolute; top: 470px; left: 257px;">'.$vehiculo['modelo'].'</p>
                    <p id="vertical" style="position: absolute; top: 110px; left: 253px;">'.$vehiculo['color'].'</p>
                    <p id="vertical" style="position: absolute; top: 660px; left: 377px;">'.$cliente['correo'].'</p>
                    <p id="vertical" style="position: absolute; top: 270px; left: 407px;">'.$vehiculo['asesores']['nombre'].' '.$vehiculo['asesores']['a_paterno'].' '.$vehiculo['asesores']['a_materno'].'</p>
                </body>
                </html>');
                
                return $pdf->stream($request['exp'].'_docs_gnp');
                break;
            
            case 2:
                //primero creo el finiquito
                $pdf = app('dompdf.wrapper');   
                $pdf->loadHTML('<!DOCTYPE html>
                <html lang="en">
                <head>
                    <meta charset="UTF-8">
                    <meta name="viewport" content="width=device-width, initial-scale=1.0">
                    <meta http-equiv="X-UA-Compatible" content="ie=edge">
                    <title>Documentacion HDI</title>
                    <style>
                        body {
                            background: url(img/encuesta_gnp.jpg); 
                            background-size: cover;
                            background-repeat: no-repeat;
                            /* Arriba | Derecha | Abajo | Izquierda */
                            background-size: 100% 100%;
                            /* Arriba | Derecha | Abajo | Izquierda */
                            margin: -50px -38px -60px -39px;
                        }

                        img {
                            width: 780px; height: 1150px;
                        }

                        #img2 {
                            width: 780px; height: 1110px;
                        }

                        #img3 {
                            transform: rotate(-90deg);
                            width: 1130px; height: 800px;
                            position: absolute; 
                            top: 166px; 
                            left: -170px
                            transform: rotate(-90deg);
                        }

                        #vertical {
                            transform: rotate(-90deg);
                        }
                    </style>
                </head>
                <body>
                    <img id="img3" src="img/Boleta_de_salida.jpg">
                    <p id="vertical" style="position: absolute; top: 125px; left: 85px;">'.$vehiculo['id'].'</p>
                    <p id="vertical" style="position: absolute; top: 400px; left: 85px;">'.$hoy.'</p>
                    <p id="vertical" style="position: absolute; top: 925px; left: 155px;">'.$cliente['nombre'].'</p>
                    <p id="vertical" style="position: absolute; top: 180px; left: 163px;">'.$cliente['telefono'].'</p>
                    <p id="vertical" style="position: absolute; top: 925px; left: 230px;">'.$vehiculo['marcas']['marca'].' '.$vehiculo['submarcas']['submarca'].'</p>
                    <p id="vertical" style="position: absolute; top: 470px; left: 257px;">'.$vehiculo['modelo'].'</p>
                    <p id="vertical" style="position: absolute; top: 108px; left: 245px;">'.$vehiculo['color'].'</p>
                    <p id="vertical" style="position: absolute; top: 660px; left: 377px;">'.$cliente['correo'].'</p>
                    <p id="vertical" style="position: absolute; top: 270px; left: 395px;">'.$vehiculo['asesores']['nombre'].' '.$vehiculo['asesores']['a_paterno'].' '.$vehiculo['asesores']['a_materno'].'</p>
                </body>
                </html>');
                
                return $pdf->stream($request['exp'].'_docs_hdi');
                break;

            case 3:
                //primero creo el finiquito
                $pdf = app('dompdf.wrapper');   
                $pdf->loadHTML('<!DOCTYPE html>
                <html lang="en">
                <head>
                    <meta charset="UTF-8">
                    <meta name="viewport" content="width=device-width, initial-scale=1.0">
                    <meta http-equiv="X-UA-Compatible" content="ie=edge">
                    <title>Documentacion Particular</title>
                    <style>
                        body {
                            background: url(img/Boleta_de_salida.jpg); 
                            background-size: cover;
                            background-repeat: no-repeat;
                            /* Arriba | Derecha | Abajo | Izquierda */
                            background-size: 100% 100%;
                            /* Arriba | Derecha | Abajo | Izquierda */
                            margin: -50px -38px -60px -39px;
                        }
                    </style>
                </head>
                <body>
                    <p style="position: absolute; top: 105px; left: 930px;">'.$vehiculo['id'].'</p>
                    <p style="position: absolute; top: 105px; left: 660px;">'.$hoy.'</p>
                    <p style="position: absolute; top: 183px; left: 150px;">'.$cliente['nombre'].'</p>
                    <p style="position: absolute; top: 187px; left: 870px;">'.$cliente['telefono'].'</p>
                    <p style="position: absolute; top: 257px; left: 150px;">'.$vehiculo['marcas']['marca'].' '.$vehiculo['submarcas']['submarca'].'</p>
                    <p style="position: absolute; top: 260px; left: 610px;">'.$vehiculo['modelo'].'</p>
                    <p style="position: absolute; top: 260px; left: 960px;">'.$vehiculo['color'].'</p>
                    <p style="position: absolute; top: 457px; left: 345px;">'.$cliente['correo'].'</p>
                    <p style="position: absolute; top: 460px; left: 760px;">'.$vehiculo['asesores']['nombre'].' '.$vehiculo['asesores']['a_paterno'].' '.$vehiculo['asesores']['a_materno'].'</p>
                </body>
                </html>')->setPaper('A4', 'landscape');
                
                return $pdf->stream($request['exp'].'_docs_particualr');
                break;
            
            case 4:
                //primero creo el finiquito
                $pdf = app('dompdf.wrapper');   
                $pdf->loadHTML('<!DOCTYPE html>
                <html lang="en">
                <head>
                    <meta charset="UTF-8">
                    <meta name="viewport" content="width=device-width, initial-scale=1.0">
                    <meta http-equiv="X-UA-Compatible" content="ie=edge">
                    <title>Documentacion QUALITAS</title>
                    <style>
                        body {
                            background: url(img/encuesta_gnp.jpg); 
                            background-size: cover;
                            background-repeat: no-repeat;
                            /* Arriba | Derecha | Abajo | Izquierda */
                            background-size: 100% 100%;
                            /* Arriba | Derecha | Abajo | Izquierda */
                            margin: -50px -38px -60px -39px;
                        }

                        img {
                            width: 780px; height: 1150px;
                        }

                        #img2 {
                            width: 800px; height: 1120px;
                        }

                        #img3 {
                            transform: rotate(-90deg);
                            width: 1130px; height: 800px;
                            position: absolute; 
                            top: 166px; 
                            left: -170px
                            transform: rotate(-90deg);
                        }

                        #vertical {
                            transform: rotate(-90deg);
                        }
                    </style>
                </head>
                <body>
                    <hr> <!-- Salto de página -->
                    <img id="img2" src="img/encuesta_qualitas.jpg">
                    <p style="position: absolute; top: 245px; left: 240px;">DTR Centro Integral Automotriz</p>
                    <p style="position: absolute; top: 259.5px; left: 245px;">'.$cliente['nombre'].'</p>
                    <p style="position: absolute; top: 277px; left: 268px;">'.$cliente['telefono'].'</p>
                    <p style="position: absolute; top: 244px; left: 560px;">'.$vehiculo['no_siniestro'].'</p>
                    <p style="position: absolute; top: 960px; left: 325px;">'.$cliente['correo'].'</p>
                    <hr> <!-- Salto de página -->
                    <img id="img3" src="img/Boleta_de_salida.jpg">
                    <p id="vertical" style="position: absolute; top: 125px; left: 85px;">'.$vehiculo['id'].'</p>
                    <p id="vertical" style="position: absolute; top: 400px; left: 85px;">'.$hoy.'</p>
                    <p id="vertical" style="position: absolute; top: 880px; left: 120px;">'.$cliente['nombre'].'</p>
                    <p id="vertical" style="position: absolute; top: 180px; left: 163px;">'.$cliente['telefono'].'</p>
                    <p id="vertical" style="position: absolute; top: 925px; left: 240px;">'.$vehiculo['marcas']['marca'].' '.$vehiculo['submarcas']['submarca'].'</p>
                    <p id="vertical" style="position: absolute; top: 470px; left: 257px;">'.$vehiculo['modelo'].'</p>
                    <p id="vertical" style="position: absolute; top: 110px; left: 253px;">'.$vehiculo['color'].'</p>
                    <p id="vertical" style="position: absolute; top: 660px; left: 377px;">'.$cliente['correo'].'</p>
                    <p id="vertical" style="position: absolute; top: 270px; left: 407px;">'.$vehiculo['asesores']['nombre'].' '.$vehiculo['asesores']['a_paterno'].' '.$vehiculo['asesores']['a_materno'].'</p>
                </body>
                </html>');
                
                return $pdf->stream($request['exp'].'_docs_qualitas');
                break;
            
            case 8:
                //primero creo el finiquito
                $pdf = app('dompdf.wrapper');   
                $pdf->loadHTML('<!DOCTYPE html>
                <html lang="en">
                <head>
                    <meta charset="UTF-8">
                    <meta name="viewport" content="width=device-width, initial-scale=1.0">
                    <meta http-equiv="X-UA-Compatible" content="ie=edge">
                    <title>Documentacion BBVA</title>
                    <style>
                        body {
                            background: url(img/finiquito_bbva.jpg); 
                            background-size: cover;
                            background-repeat: no-repeat;
                            /* Arriba | Derecha | Abajo | Izquierda */
                            background-size: 100% 100%;
                            /* Arriba | Derecha | Abajo | Izquierda */
                            margin: -50px -38px -60px -39px;
                        }

                        img {
                            width: 780px; height: 1150px;
                        }

                        #img2 {
                            width: 780px; height: 1110px;
                        }

                        #img3 {
                            transform: rotate(-90deg);
                            width: 1130px; height: 800px;
                            position: absolute; 
                            top: 166px; 
                            left: -170px
                            transform: rotate(-90deg);
                        }

                        #vertical {
                            transform: rotate(-90deg);
                        }
                    </style>
                </head>
                <body>
                    <p style="position: absolute; top: 198px; left: 580px;">'.$vehiculo['no_siniestro'].'</p>
                    <p style="position: absolute; top: 318px; left: 588px;">'.$dia.'</p>
                    <p style="position: absolute; top: 318px; left: 708px;">'.$mes.'</p>
                    <p style="position: absolute; top: 339px; left: 80px;">'.$anooo.'</p>
                    <p style="position: absolute; top: 339px; left: 417px;">'.$vehiculo['no_siniestro'].'</p>
                    <p style="position: absolute; top: 498px; left: 470px;">Seguros BBVA</p>
                    <p style="position: absolute; top: 737px; left: 180px;">Saltillo Coahuila de Zaragoza, México</p>
                    <p style="position: absolute; top: 740px; left: 595px;">'.$dia.'</p>
                    <p style="position: absolute; top: 740px; left: 655px;">'.$mes.'</p>
                    <p style="position: absolute; top: 740px; left: 705px;">'.$anooo.'</p>
                    <p style="position: absolute; top: 850px; left: 130px;">'.$cliente['nombre'].'</p>
                    <hr> <!-- Salto de página -->
                    <img src="img/encuesta_bbva.jpg">
                    <p style="position: absolute; top: 170px; left: 120px;">DTR Centro Integral Automotriz</p>
                    <p style="position: absolute; top: 203px; left: 120px;">'.$vehiculo['marcas']['marca'].' '.$vehiculo['submarcas']['submarca'].'</p>
                    <p style="position: absolute; top: 170px; left: 610px;">'.$vehiculo['no_siniestro'].'</p>
                    <p style="position: absolute; top: 203px; left: 570px;">'.$vehiculo['placas'].'</p>
                    <p style="position: absolute; top: 290px; left: 300px;">'.substr($vehiculo['fecha_llegada'], 8, 2).'</p>
                    <p style="position: absolute; top: 290px; left: 350px;">'.substr($vehiculo['fecha_llegada'], 5, 2).'</p>
                    <p style="position: absolute; top: 290px; left: 393px;">'.substr($vehiculo['fecha_llegada'], 0, 4).'</p>
                    <p style="position: absolute; top: 330px; left: 300px;">'.substr($vehiculo['fecha_valuacion'], 8, 2).'</p>
                    <p style="position: absolute; top: 330px; left: 350px;">'.substr($vehiculo['fecha_valuacion'], 5, 2).'</p>
                    <p style="position: absolute; top: 330px; left: 393px;">'.substr($vehiculo['fecha_valuacion'], 0, 4).'</p>
                    <p style="position: absolute; top: 980px; left: 110px;">'.$cliente['nombre'].'</p>
                    <hr> <!-- Salto de página -->
                    <img id="img3" src="img/Boleta_de_salida.jpg">
                    <p id="vertical" style="position: absolute; top: 125px; left: 85px;">'.$vehiculo['id'].'</p>
                    <p id="vertical" style="position: absolute; top: 400px; left: 85px;">'.$hoy.'</p>
                    <p id="vertical" style="position: absolute; top: 880px; left: 120px;">'.$cliente['nombre'].'</p>
                    <p id="vertical" style="position: absolute; top: 180px; left: 163px;">'.$cliente['telefono'].'</p>
                    <p id="vertical" style="position: absolute; top: 925px; left: 240px;">'.$vehiculo['marcas']['marca'].' '.$vehiculo['submarcas']['submarca'].'</p>
                    <p id="vertical" style="position: absolute; top: 470px; left: 257px;">'.$vehiculo['modelo'].'</p>
                    <p id="vertical" style="position: absolute; top: 110px; left: 253px;">'.$vehiculo['color'].'</p>
                    <p id="vertical" style="position: absolute; top: 660px; left: 377px;">'.$cliente['correo'].'</p>
                    <p id="vertical" style="position: absolute; top: 270px; left: 407px;">'.$vehiculo['asesores']['nombre'].' '.$vehiculo['asesores']['a_paterno'].' '.$vehiculo['asesores']['a_materno'].'</p>
                </body>
                </html>');
                
                return $pdf->stream($request['exp'].'_docs_bbva');
                break;

            default:
                # code...
                break;
        }
    }

    public function index_entrega_estatus_vehiculo(){
        $vehiculos = Vehiculo::with(['marcas:id,marca', 'submarcas:id,submarca', 'clientes:id,nombre', 'asesores:id,nombre,a_paterno,a_materno', 'estatus:id,status'])
                            ->select('id_aux','id','estatus_id','modelo', 'color', 'marca_id', 'linea_id', 'cliente_id', 'placas', 'id_asesor', 'no_siniestro', 'fecha_salida_taller')
                            ->where('estatus_id','5')
                            ->orWhere('estatus_id','6')
                            ->orWhere('estatus_id','7')
                            ->orderBy('id_aux')
                            ->get();

        return view('entrega.estatus.l_cambiarEstatus', compact('vehiculos'));
    }

    public function u_cambiarEstatus(Vehiculo $vehiculo){
        $list_estatus = Estatus::all();

        $e_actual = Estatus::select('status')
                            ->where('id', $vehiculo['estatus_id'])
                            ->first();

        return view('entrega.estatus.u_cambiarEstatus', compact(['vehiculo','list_estatus', 'e_actual']));
    }

    public function update_cambiarEstatus(Request $request, Vehiculo $vehiculo){
        if ($request->e_nuevo == 0) {
            return redirect()->route('l_cambiarEstatus')->with('warning','Selecciona el estatus del Vehiculo con Expediente ->"'. $vehiculo->id . '".');
        } else {
            $vehiculo->estatus_id = $request->e_nuevo;
            $vehiculo->fecha_salida_taller = $request->fecha_salida_taller;
            if ($vehiculo->save()) {
                return redirect()->route('l_cambiarEstatus')->with('success','Estatus del Vehiculo Actualizado.');
            } else {
                return redirect()->route('l_cambiarEstatus')->with('error','Estatus del Vehiculo no Actualizado.');
            }
            
        }
        
    }

    public function u_valuaciones(Vehiculo $vehiculo){
        $list_estatus = Estatus::all();

        $e_actual = Estatus::select('status')
                            ->where('id', $vehiculo['estatus_id'])
                            ->first();

        if ($vehiculo->fecha_autorizacion == "" || $vehiculo->fecha_autorizacion == " " || $vehiculo->fecha_autorizacion == NULL || $vehiculo->fecha_autorizacion == null) {
            //$fecha_ll = new DateTime($value->getFechaLlegada());
            $fecha_ll = date_create($vehiculo->fecha_llegada);
            $fecha_a = date_create(date("Y-m-d"));
            //$now = new DateTime('now');
            $dife = date_diff($fecha_ll, $fecha_a);
            //$dife = json_encode($dife);
            //$dife = json_decode($dife);
            //$dife = $fecha_ll->diff($now)->format('%d');
            $difee = $dife->{'days'};
        } else {
            $difee = $vehiculo->diferencia_tres_dias;
        }

        return view('administracion.valuaciones.u_valuaciones', compact(['vehiculo', 'list_estatus', 'e_actual', 'difee']));
    }

    public function u_refaccionesAdmon(Vehiculo $vehiculo){
        $list_estatus = Estatus::all();

        $e_actual = Estatus::select('status')
                            ->where('id', $vehiculo['estatus_id'])
                            ->first();

        if ($vehiculo->fecha_autorizacion == "" || $vehiculo->fecha_autorizacion == " " || $vehiculo->fecha_autorizacion == NULL || $vehiculo->fecha_autorizacion == null) {
            //$fecha_ll = new DateTime($value->getFechaLlegada());
            $fecha_ll = date_create($vehiculo->fecha_llegada);
            $fecha_a = date_create(date("Y-m-d"));
            //$now = new DateTime('now');
            $dife = date_diff($fecha_ll, $fecha_a);
            //$dife = json_encode($dife);
            //$dife = json_decode($dife);
            //$dife = $fecha_ll->diff($now)->format('%d');
            $difee = $dife->{'days'};
        } else {
            $difee = $vehiculo->diferencia_tres_dias;
        }

        return view('administracion.refacciones.u_refaccionesAdmon', compact(['vehiculo', 'list_estatus', 'e_actual', 'difee']));
    }

    public function update_valuaciones(Vehiculo $vehiculo, Request $request){
        //dd($vehiculo, $request);

        switch ($request->estatus) {
            case 5:
                $dias_rep = $request->dias_rep;
                break;
                
            case 6:
                $dias_rep = 0;
                break;

            case 7:
                $dias_rep = 0;
                break;
            
            default:
                $dias_rep = "No esta en Taller o Transito";
                break;
        }

        if ($request->fecha_autorizacion != "" && $request->cantidadfin != 0) {
            $porcentaje = round(($request->cantidadfin * 100)/$request->cantidadini, 2);
            $vehiculo->estatus_id = $request->estatus;
            $vehiculo->fecha_llegada_taller = $request->fecha_llegada;
            $vehiculo->fecha_valuacion = $request->fecha_envio;
            $vehiculo->diferencia_tres_dias = $request->diferencia;
            $vehiculo->cantidad_inicial = $request->cantidadini;
            $vehiculo->piezas_cambiadas_inicial = $request->pzscambioini;
            $vehiculo->piezas_reparacion_inicial = $request->pzsreparaini;
            $vehiculo->fecha_autorizacion = $request->fecha_autorizacion;
            $vehiculo->cantidad_final = $request->cantidadfin;
            $vehiculo->piezas_cambiadas_final = $request->pzscambiofin;
            $vehiculo->piezas_reparacion_final = $request->pzsreparafin;
            $vehiculo->piezas_vendidas = $request->pzsvendidas;
            $vehiculo->fecha_promesa = $dias_rep;
            $vehiculo->importe_piezas_vendidas = $request->importepzsvendidas;
            $vehiculo->porcentaje_aprobacion = $porcentaje;
            if ($request->pzscambioini == 0) {
                $vehiculo->refacciones_id = 6;
            }

            if ($vehiculo->save()) {
                return redirect()->route('l_valuaciones')->with('success','Valuacion Actualizada.');
            } else {
                return redirect()->route('l_valuaciones')->with('error','Valuacion no Actualizada.');
            }
        } else {
            $vehiculo->estatus_id = $request->estatus;
            $vehiculo->fecha_llegada_taller = $request->fecha_llegada;
            $vehiculo->fecha_valuacion = $request->fecha_envio;
            $vehiculo->cantidad_inicial = $request->cantidadini;
            $vehiculo->piezas_cambiadas_inicial = $request->pzscambioini;
            $vehiculo->piezas_reparacion_inicial = $request->pzsreparaini;
            $vehiculo->piezas_vendidas = $request->pzsvendidas;
            $vehiculo->fecha_promesa = $dias_rep;
            $vehiculo->importe_piezas_vendidas = $request->importepzsvendidas;
            if ($request->pzscambioini == 0) {
                $vehiculo->refacciones_id = 6;
            }

            if ($vehiculo->save()) {
                return redirect()->route('l_valuaciones')->with('success','Valuacion Actualizada.');
            } else {
                return redirect()->route('l_valuaciones')->with('error','Valuacion no Actualizada.');
            }
            
        }
        
    }

    public function update_Brefacciones(Request $request, Vehiculo $vehiculo){
        
        if ($vehiculo->estatus_id == $request->estatus) {
            $e_actual = Estatus::select('status')
                            ->where('id', $vehiculo['estatus_id'])
                            ->first();

            return redirect()->route('l_Brefacciones')->with('warning','No se Actualizo el estatus "'. $e_actual->status . '".');
        } else {
            $vehiculo->estatus_id = $request->estatus;
            if ($vehiculo->save()) {
                return redirect()->route('l_Brefacciones')->with('success','Estatus Actualizado.');
            } else {
                return redirect()->route('l_Brefacciones')->with('error','Estatus no Actualizado.');
            }
        }
    }

    public function i_asignacionPersonal(Vehiculo $vehiculo){
        $list_personal = Personal::with('area')->orderby('nombre')->get();

        return view('administracion.asignacionPersonal.i_asignacionPersonal', compact(['vehiculo','list_personal']));
    }

    public function insert_asignacionPersonal(Request $request, Vehiculo $vehiculo){
        if (isset($request->aplicaHoja)) {
            $vehiculo->aplica_hojalateria = 1;
        } else {
            $vehiculo->aplica_hojalateria = 0;
        }
        $vehiculo->fecha_hojalateria = $request->fechahoja;
        $vehiculo->asignado_hojalateria = $request->personalH;
        $vehiculo->comentarios_hojalateria = $request->comentariosHoja;

        if (isset($request->aplicaPin)) {
            $vehiculo->aplica_pintura = 1;
        } else {
            $vehiculo->aplica_pintura = 0;
        }
        $vehiculo->fecha_pintura = $request->fechaPin;
        $vehiculo->asignado_pintura = $request->personalPin;
        $vehiculo->comentario_pintura = $request->comentariosPin;

        if (isset($request->aplicaArm)) {
            $vehiculo->aplica_armado = 1;
        } else {
            $vehiculo->aplica_armado = 0;
        }
        $vehiculo->fecha_armado = $request->fechaArm;
        $vehiculo->asignado_armado = $request->personalArm;
        $vehiculo->comentario_armado = $request->comentariosArm;

        if (isset($request->aplicaDet)) {
            $vehiculo->aplica_detallado = 1;
        } else {
            $vehiculo->aplica_detallado = 0;
        }
        $vehiculo->fecha_detallado = $request->fechaDet;
        $vehiculo->asignado_detallado = $request->personalDet;
        $vehiculo->comentario_detallado = $request->comentariosDet;

        if (isset($request->aplicaMeca)) {
            $vehiculo->aplica_mecanica = 1;
        } else {
            $vehiculo->aplica_mecanica = 0;
        }
        $vehiculo->fecha_mecanica = $request->fechaMeca;
        $vehiculo->asignado_mecanica = $request->personalMec;
        $vehiculo->comentario_mecanica = $request->comentariosMeca;

        if (isset($request->aplicaLava)) {
            $vehiculo->aplica_lavado = 1;
        } else {
            $vehiculo->aplica_lavado = 0;
        }
        $vehiculo->fecha_lavado = $request->fechaLava;
        $vehiculo->asignado_lavado = $request->personalLava;
        $vehiculo->comentario_lavado = $request->comentariosLava;

        if ($vehiculo->save()) {
            return redirect()->route('l_asignacionPersonal')->with('success','Personal Asignado.');
        } else {
            return redirect()->route('l_asignacionPersonal')->with('error','Personal no Asignado.');
        }
    }

    public function u_asignacionPersonal(Vehiculo $vehiculo)
    {
        //dd($vehiculo);
        $hojalateria = Personal::with('area')
                                ->where('id', $vehiculo->asignado_hojalateria)
                                ->first();

        $pintura = Personal::with('area')
                                ->where('id', $vehiculo->asignado_pintura)
                                ->first();

        $armado = Personal::with('area')
                                ->where('id', $vehiculo->asignado_armado)
                                ->first();

        $detallado = Personal::with('area')
                                ->where('id', $vehiculo->asignado_detallado)
                                ->first();

        $mecanica = Personal::with('area')
                                ->where('id', $vehiculo->asignado_mecanica)
                                ->first();

        $lavado = Personal::with('area')
                                ->where('id', $vehiculo->asignado_lavado)
                                ->first();                        

        return view('administracion.asignacionPersonal.u_asignacionPersonal', compact(['vehiculo', 'hojalateria', 'pintura', 'armado', 'detallado','mecanica', 'lavado']));
    }

    public function update_asignacionPersonal(Request $request, Vehiculo $vehiculo){
        //dd($request, $vehiculo);

        $vehiculo->fecha_hojalateria = $request->fechahoja;
        $vehiculo->comentarios_hojalateria = $request->comentariosHoja;

        $vehiculo->fecha_pintura = $request->fechapin;
        $vehiculo->comentario_pintura = $request->comentariospin;

        $vehiculo->fecha_armado = $request->fechaarm;
        $vehiculo->comentario_armado = $request->comentariosarm;

        $vehiculo->fecha_detallado = $request->fechadeta;
        $vehiculo->comentario_detallado = $request->comentariosdeta;

        $vehiculo->fecha_mecanica = $request->fechameca;
        $vehiculo->comentario_mecanica = $request->comentariosmeca;

        $vehiculo->fecha_lavado = $request->fechalava;
        $vehiculo->comentario_lavado = $request->comentarioslava;

        $vehiculo->fecha_entrega_interna = $request->fechainter;
        $vehiculo->entrego = $request->entrego;
        $vehiculo->recibio = $request->recibio;

        if ($vehiculo->save()) {
            return redirect()->route('l_asignacionPersonal')->with('success','Seguimiento Actualizado.');
        } else {
            return redirect()->route('l_asignacionPersonal')->with('error','Seguimiento no Actualizado.');
        }
    }

    public function u_valuacionesPA(Vehiculo $vehiculo){
        $list_estatus = Estatus::all();

        $e_actual = Estatus::select('status')
                            ->where('id', $vehiculo['estatus_id'])
                            ->first();

        if ($vehiculo->fecha_autorizacion == "" || $vehiculo->fecha_autorizacion == " " || $vehiculo->fecha_autorizacion == NULL || $vehiculo->fecha_autorizacion == null) {
            //$fecha_ll = new DateTime($value->getFechaLlegada());
            $fecha_ll = date_create($vehiculo->fecha_llegada);
            $fecha_a = date_create(date("Y-m-d"));
            //$now = new DateTime('now');
            $dife = date_diff($fecha_ll, $fecha_a);
            //$dife = json_encode($dife);
            //$dife = json_decode($dife);
            //$dife = $fecha_ll->diff($now)->format('%d');
            $difee = $dife->{'days'};
        } else {
            $difee = $vehiculo->diferencia_tres_dias;
        }

        return view('administracion.procesoAdmistrativo.u_valuacionesPAdmon', compact(['vehiculo', 'list_estatus', 'e_actual', 'difee']));
    }

    public function update_valuacionesPA(Vehiculo $vehiculo, Request $request){
        //dd($vehiculo, $request);

        switch ($request->estatus) {
            case 5:
                $dias_rep = $request->dias_rep;
                break;
                
            case 6:
                $dias_rep = 0;
                break;

            case 7:
                $dias_rep = 0;
                break;
            
            default:
                $dias_rep = "No esta en Taller o Transito";
                break;
        }

        if ($request->fecha_autorizacion != "" && $request->cantidadfin != 0) {
            $porcentaje = round(($request->cantidadfin * 100)/$request->cantidadini, 2);
            $vehiculo->estatus_id = $request->estatus;
            $vehiculo->fecha_llegada_taller = $request->fecha_llegada;
            $vehiculo->fecha_valuacion = $request->fecha_envio;
            $vehiculo->diferencia_tres_dias = $request->diferencia;
            $vehiculo->cantidad_inicial = $request->cantidadini;
            $vehiculo->piezas_cambiadas_inicial = $request->pzscambioini;
            $vehiculo->piezas_reparacion_inicial = $request->pzsreparaini;
            $vehiculo->fecha_autorizacion = $request->fecha_autorizacion;
            $vehiculo->cantidad_final = $request->cantidadfin;
            $vehiculo->piezas_cambiadas_final = $request->pzscambiofin;
            $vehiculo->piezas_reparacion_final = $request->pzsreparafin;
            $vehiculo->piezas_vendidas = $request->pzsvendidas;
            $vehiculo->fecha_promesa = $dias_rep;
            $vehiculo->importe_piezas_vendidas = $request->importepzsvendidas;
            $vehiculo->porcentaje_aprobacion = $porcentaje;
            if ($request->pzscambioini == 0) {
                $vehiculo->refacciones_id = 6;
            }

            if ($vehiculo->save()) {
                return redirect()->route('l_valuaciones')->with('success','Valuacion Actualizada.');
            } else {
                return redirect()->route('l_valuaciones')->with('error','Valuacion no Actualizada.');
            }
        } else {
            $vehiculo->estatus_id = $request->estatus;
            $vehiculo->fecha_llegada_taller = $request->fecha_llegada;
            $vehiculo->fecha_valuacion = $request->fecha_envio;
            $vehiculo->cantidad_inicial = $request->cantidadini;
            $vehiculo->piezas_cambiadas_inicial = $request->pzscambioini;
            $vehiculo->piezas_reparacion_inicial = $request->pzsreparaini;
            $vehiculo->piezas_vendidas = $request->pzsvendidas;
            $vehiculo->fecha_promesa = $dias_rep;
            $vehiculo->importe_piezas_vendidas = $request->importepzsvendidas;
            if ($request->pzscambioini == 0) {
                $vehiculo->refacciones_id = 6;
            }

            if ($vehiculo->save()) {
                return redirect()->route('l_procesoAdministrativo')->with('success','Valuacion Actualizada.');
            } else {
                return redirect()->route('l_procesoAdministrativo')->with('error','Valuacion no Actualizada.');
            }
            
        }
        
    }

    public function u_refaccionesAdmonPA(Vehiculo $vehiculo){
        $list_estatus = Estatus::all();

        $e_actual = Estatus::select('status')
                            ->where('id', $vehiculo['estatus_id'])
                            ->first();

        if ($vehiculo->fecha_autorizacion == "" || $vehiculo->fecha_autorizacion == " " || $vehiculo->fecha_autorizacion == NULL || $vehiculo->fecha_autorizacion == null) {
            //$fecha_ll = new DateTime($value->getFechaLlegada());
            $fecha_ll = date_create($vehiculo->fecha_llegada);
            $fecha_a = date_create(date("Y-m-d"));
            //$now = new DateTime('now');
            $dife = date_diff($fecha_ll, $fecha_a);
            //$dife = json_encode($dife);
            //$dife = json_decode($dife);
            //$dife = $fecha_ll->diff($now)->format('%d');
            $difee = $dife->{'days'};
        } else {
            $difee = $vehiculo->diferencia_tres_dias;
        }

        return view('administracion.procesoAdmistrativo.u_refaccionesPAdmon', compact(['vehiculo', 'list_estatus', 'e_actual', 'difee']));
    }

    public function update_BrefaccionesPA(Request $request, Vehiculo $vehiculo){
        
        if ($vehiculo->estatus_id == $request->estatus) {
            $e_actual = Estatus::select('status')
                            ->where('id', $vehiculo['estatus_id'])
                            ->first();

            return redirect()->route('l_Brefacciones')->with('warning','No se Actualizo el estatus "'. $e_actual->status . '".');
        } else {
            $vehiculo->estatus_id = $request->estatus;
            if ($vehiculo->save()) {
                return redirect()->route('l_procesoAdministrativo')->with('success','Estatus Actualizado.');
            } else {
                return redirect()->route('l_procesoAdministrativo')->with('error','Estatus no Actualizado.');
            }
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Vehiculo  $vehiculo
     * @return \Illuminate\Http\Response
     */
    public function show(Vehiculo $vehiculo)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Vehiculo  $vehiculo
     * @return \Illuminate\Http\Response
     */
    public function edit(Vehiculo $vehiculo)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Vehiculo  $vehiculo
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Vehiculo $vehiculo)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Vehiculo  $vehiculo
     * @return \Illuminate\Http\Response
     */
    public function destroy(Vehiculo $vehiculo)
    {
        //
    }
}
