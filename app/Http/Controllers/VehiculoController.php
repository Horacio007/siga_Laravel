<?php

namespace App\Http\Controllers;

use App\Models\Vehiculo;
use App\Models\Clientes;
use App\Models\Estatus;
use App\Models\Estatusaseguradoras;
use App\Models\Estatusrefacciones;
use App\Models\Personal;
use App\Models\Recibo_pagos;
use Illuminate\Support\Carbon;
use Facade\FlareClient\Http\Response;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\recibo_pago_proveedores;
use Telegram\Bot\Laravel\Facades\Telegram;
use Codedge\Fpdf\Fpdf\Fpdf;

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
                                ->select('id_aux','id','estatus_id','modelo', 'color', 'marca_id', 'linea_id', 'cliente_id', 'placas', 'id_asesor', 'no_siniestro', 'n_dano', 'f_arribo', 'fecha_llegada', 'fecha_llegada_taller', 'fecha_valuacion', 'diferencia_tres_dias', 'cantidad_inicial', 'piezas_cambiadas_inicial', 'piezas_reparacion_inicial', 'fecha_autorizacion', 'cantidad_final', 'piezas_cambiadas_final', 'piezas_reparacion_final', 'piezas_vendidas', 'importe_piezas_vendidas', 'piezas_vendidas', 'porcentaje_aprobacion', 'fecha_promesa', 'proceso')
                                ->where('estatus_id','5')
                                //->where('id_aux', 433)
                                ->orWhere('estatus_id','6')
                                ->orWhere('estatus_id','9')
                                ->orderBy('id_aux')
                                ->get();

        //dd($valuaciones[0]->formaArribo->forma_arribo);

        return view('administracion.valuaciones.l_valuaciones', compact('valuaciones'));
    }

    public function indexR()
    {
        $refacciones = Vehiculo::with(['marcas:id,marca', 'submarcas:id,submarca', 'clientes:id,nombre', 'asesores:id,nombre,a_paterno,a_materno', 'estatus:id,status', 'nivelDano:id,nivel', 'formaArribo:id,forma_arribo', 'estatusRefacciones:id,estatus'])
                                ->select('id_aux','id','estatus_id','modelo', 'color', 'marca_id', 'linea_id', 'cliente_id', 'placas', 'id_asesor', 'no_siniestro', 'n_dano', 'f_arribo', 'fecha_llegada', 'fecha_llegada_taller', 'refacciones_id','fecha_promesa', 'fecha_autorizacion')
                                ->where('estatus_id','5')
                                //->where('id', '1203112020')
                                ->orWhere('estatus_id', '7')
                                ->orWhere('estatus_id','6')
                                ->orWhere('estatus_id','8')
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
        $proceso_taller = Vehiculo::with(['marcas:id,marca', 'submarcas:id,submarca', 'clientes:id,nombre', 'asesores:id,nombre,a_paterno,a_materno', 'estatus:id,status', 'nivelDano:id,nivel', 'formaArribo:id,forma_arribo', 'personalHojalateria:id,id_area,nombre'])
                                ->select('id_aux','id','estatus_id','modelo', 'color', 'marca_id', 'linea_id', 'cliente_id', 'placas', 'id_asesor', 'no_siniestro', 'n_dano', 'f_arribo', 'aplica_hojalateria', 'fecha_hojalateria', 'aplica_preparacion', 'fecha_preparacion', 'aplica_pintura', 'fecha_pintura', 'aplica_armado', 'fecha_armado', 'aplica_detallado', 'fecha_detallado', 'aplica_mecanica', 'fecha_mecanica', 'aplica_lavado', 'fecha_lavado', 'fecha_entrega_interna', 'asignado_hojalateria', 'asignado_preparacion', 'asignado_pintura', 'asignado_armado', 'asignado_detallado', 'asignado_mecanica', 'asignado_lavado')
                                ->where('estatus_id','5')
                                //->where('marca_id', 38)
                                ->orWhere('estatus_id','6')
                                ->orderBy('id_aux')
                                ->get();

        //dd($proceso_taller[81]);

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
                $uc = Clientes::select('id', 'nombre', 'telefono', 'correo')
                                ->orderBy('id', 'DESC')
                                ->limit(1)
                                ->get();

                $vehiculo = new Vehiculo();
                $vehiculo->id = $request->expediente;
                $vehiculo->id_cliente = $uc[0]['id'];
                $vehiculo->id_asesor = $request->asesor;
                $vehiculo->estatus_id = $request->estatus;
                $vehiculo->fecha_llegada = date("Ymd");
                $vehiculo->marca_id = $request->marca;
                $vehiculo->linea_id = $request->submarca;
                $vehiculo->color = $request->color;
                $vehiculo->modelo = $request->modelo;
                $vehiculo->placas = $request->placas;
                $vehiculo->cliente_id = $request->aseguradora;
                $vehiculo->no_siniestro = $request->siniestro;
                $vehiculo->n_dano = $request->nivel;
                $vehiculo->f_arribo = $request->arribo;
                //se reutilizar la columna de prooveedor_1 para poder almacenar el diagnostico inical 
                if ($request->aseguradora == 3) {
                    $vehiculo->proveedor_1 = $request->diag_ini;
                }

                if ($vehiculo->save()) {
                    $u_vehiculo = Vehiculo::with(['marcas:id,marca', 'submarcas:id,submarca', 'clientes:id,nombre', 'asesores:id,nombre,a_paterno,a_materno', 'estatus:id,status'])
                                        ->where('id', $request->expediente)->first();

                    $est = Estatus::where('id', $u_vehiculo->estatus_id)->first();

                    $text = "Vehiculo Ingresado el dia -> ".Carbon::now()->format('Y-m-d H:i:s')."\n";
                    $text.= "<b>Cliente</b>\n";
                    $text.= "Nombre ->  ".$uc[0]['nombre']??'';
                    $text.= "\n";
                    $text.= "Telefono ->  ".$uc[0]['telefono']??'';
                    $text.= "\n";
                    $text.= "Correo ->  ".$uc[0]['correo']??'';
                    $text.= "\n";
                    $text.= "<b>Vehiculo</b>\n";
                    $text.= "Marca ->  ".$u_vehiculo->marcas->marca??'';
                    $text.= "\n";
                    $text.= "Linea ->  ".$u_vehiculo->submarcas->submarca??'';
                    $text.= "\n";
                    $text.= "Color ->  ".$u_vehiculo->color??'';
                    $text.= "\n";
                    $text.= "Modelo ->  ".$u_vehiculo->modelo??'';
                    $text.= "\n";
                    $text.= "Placas ->  ".$u_vehiculo->placas??'';
                    $text.= "\n";
                    $text.= "Siniestro ->  ".$u_vehiculo->no_siniestro??'';
                    $text.= "\n";
                    $text.= "Asesor ->  ".$u_vehiculo->asesores->nombre." ".$u_vehiculo->asesores->a_paterno." ".$u_vehiculo->asesores->a_materno;
                    $text.= "\n";
                    $text.= "Aseguradora ->  ".$u_vehiculo->clientes->nombre??'';
                    $text.= "\n";
                    $text.= "Estatus ->  ".$est->status??'';
                    $text.= "\n";
                    $text.= "Nivel de daño ->  ".$u_vehiculo->nivelDano->nivel??'';
                    $text.= "\n";
                    $text.= "Forma de arribo ->  ".$u_vehiculo->formaArribo->forma_arribo??'';
                    $text.= "\n";
                    if ($request->aseguradora == 3) {
                        $text.= "Diagnostico inicial ->  ".$request->diag_ini??'';
                        $text.= "\n";
                    }

                    if ($u_vehiculo->estatus_id != 9) {
                        Telegram::sendMessage([
                            'chat_id' => env('TELEGRAM_CHANNEL_ID', ''),
                            'parse_mode' => 'HTML',
                            'text' => $text
                        ]);
                    } 

                    $pdf = new FPDF();
                    $pdf->AddPage();
                    $pdf->SetFont('Arial','',14);
                    $pdf->Image('../public/img/alta_vehiculoo.jpg', -10, -10, 0, 170);
                    $pdf->SetXY('148', '37');
                    $pdf->Cell(0, 0, utf8_decode($request->expediente), 0, 0, 'I');
                    $pdf->SetXY('148', '44.5');
                    $pdf->Cell(0, 0, utf8_decode($u_vehiculo->no_siniestro??''), 0, 0, 'I');
                    $pdf->SetXY('148', '52.4');
                    $pdf->Cell(0, 0, utf8_decode(date("d/m/Y")), 0, 0, 'I');
                    $pdf->SetXY('54', '57');
                    $pdf->Cell(0, 0, utf8_decode($uc[0]['nombre']??''), 0, 0, 'I');
                    $pdf->SetXY('35', '69');
                    $pdf->Cell(0, 0, utf8_decode($uc[0]['telefono']??''), 0, 0, 'I');
                    $pdf->SetXY('112', '69');
                    $pdf->Cell(0, 0, utf8_decode($uc[0]['correo']??''), 0, 0, 'I');
                    $pdf->SetXY('27', '110');
                    $pdf->Cell(0, 0, utf8_decode($u_vehiculo->marcas->marca??''), 0, 0, 'I');
                    $pdf->SetXY('92', '110');
                    $pdf->Cell(0, 0, utf8_decode($u_vehiculo->submarcas->submarca??''), 0, 0, 'I');
                    $pdf->SetXY('152', '110');
                    $pdf->Cell(0, 0, utf8_decode($u_vehiculo->modelo??''), 0, 0, 'I');
                    $pdf->SetXY('26', '127.5');
                    $pdf->Cell(0, 0, utf8_decode($u_vehiculo->color??''), 0, 0, 'I');
                    $pdf->SetXY('82', '127.5');
                    $pdf->Cell(0, 0, utf8_decode($u_vehiculo->placas??''), 0, 0, 'I');
                    $pdf->SetXY('142', '127.5');
                    $pdf->Cell(0, 0, utf8_decode($u_vehiculo->asesores->nombre." ".$u_vehiculo->asesores->a_paterno." ".$u_vehiculo->asesores->a_materno), 0, 0, 'I');
                    $pdf->SetXY('42', '139');
                    $pdf->Cell(0, 0, utf8_decode($u_vehiculo->clientes->nombre??''), 0, 0, 'I');
                    $pdf->Output();
                    exit;
                    
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
                            ->select('modelo', 'color', 'marca_id', 'linea_id', 'cliente_id', 'placas', 'id_asesor', 'estatus_id', 'proveedor_1')
                            ->first();

        $r = Vehiculo::select('id_aux')
                    ->where('id', $request['id'])
                    ->first();

        $c = Clientes::select('id','nombre', 'telefono', 'correo')
                    ->where('id',$r['id_aux'])
                    ->first();

        $rp = Recibo_pagos::all()->last();
        //dd($vehiculo);
        return response()->json([$vehiculo, $c, $rp]);
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
            
            case 5:
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
                $est = Estatus::where('id', $vehiculo->estatus_id)->first();

                $text = "Vehiculo Entregado el dia -> ".Carbon::now()->format('Y-m-d H:i:s')."\n";
                $text.= "Marca ->  ".$vehiculo->marcas->marca??'';
                $text.= "\n";
                $text.= "Linea ->  ".$vehiculo->submarcas->submarca??'';
                $text.= "\n";
                $text.= "Color ->  ".$vehiculo->color??'';
                $text.= "\n";
                $text.= "Modelo ->  ".$vehiculo->modelo??'';
                $text.= "\n";
                $text.= "Placas ->  ".$vehiculo->placas??'';
                $text.= "\n";
                $text.= "Siniestro ->  ".$vehiculo->no_siniestro??'';
                $text.= "\n";
                $text.= "Aseguradora ->  ".$vehiculo->clientes->nombre??'';
                $text.= "\n";
                $text.= "Estatus ->  ".$est->status??'';

                Telegram::sendMessage([
                    'chat_id' => env('TELEGRAM_CHANNEL_ID', ''),
                    'parse_mode' => 'HTML',
                    'text' => $text
                ]);

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

        if ($vehiculo->fecha_valuacion == "" || $vehiculo->fecha_valuacion == " " || $vehiculo->fecha_valuacion == NULL || $vehiculo->fecha_valuacion == null) {
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
        $list_estatus = Estatusrefacciones::all();

        $e_actual = Estatusrefacciones::select('estatus')
                            ->where('id', $vehiculo['refacciones_id'])
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
        if ($vehiculo->estatus_id == 9) {
            $isOrdenAdmicion = true;
        } else {
            $isOrdenAdmicion = false;
        }

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

            case 8:
                $dias_rep = 0;
                break;
            
            default:
                $dias_rep = "No esta en Taller o Transito";
                break;
        }

        if ($request->fecha_autorizacion != "" && $request->cantidadfin != 0) {
            $porcentaje = round(($request->cantidadfin * 100)/$request->cantidadini, 2);
            $vehiculo->estatus_id = $request->estatus;
            if ($request->estatus == 7) {
                $vehiculo->refacciones_id = 6;
            }
            $vehiculo->no_siniestro = $request->no_reporte;
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
            $vehiculo->proceso = $request->deducible;
            if ($request->pzscambioini == 0) {
                $vehiculo->refacciones_id = 7;
            }

            if ($vehiculo->save()) {
                return redirect()->route('l_valuaciones')->with('success','Valuacion Actualizada.');
            } else {
                return redirect()->route('l_valuaciones')->with('error','Valuacion no Actualizada.');
            }
        } else {
            $vehiculo->estatus_id = $request->estatus;
            if ($request->estatus == 7) {
                $vehiculo->refacciones_id = 6;
            }
            $vehiculo->no_siniestro = $request->no_reporte;
            $vehiculo->fecha_llegada_taller = $request->fecha_llegada;
            $vehiculo->fecha_valuacion = $request->fecha_envio;
            $vehiculo->cantidad_inicial = $request->cantidadini;
            $vehiculo->piezas_cambiadas_inicial = $request->pzscambioini;
            $vehiculo->piezas_reparacion_inicial = $request->pzsreparaini;
            $vehiculo->piezas_vendidas = $request->pzsvendidas;
            $vehiculo->fecha_promesa = $dias_rep;
            $vehiculo->importe_piezas_vendidas = $request->importepzsvendidas;
            $vehiculo->proceso = $request->deducible;
            if ($request->pzscambioini == 0) {
                $vehiculo->refacciones_id = 7;
            }

            if ($vehiculo->save()) {

                if ($isOrdenAdmicion && ($request->estatus == 5 || $request->estatus == 6)) {

                    $u_vehiculo = Vehiculo::with(['marcas:id,marca', 'submarcas:id,submarca', 'clientes:id,nombre', 'asesores:id,nombre,a_paterno,a_materno', 'estatus:id,status'])
                                            ->where('id', $vehiculo->id)->first();
    
                    $est = Estatus::where('id', $u_vehiculo->estatus_id)->first();

                    $uc = Clientes::select('id', 'nombre', 'telefono', 'correo')
                                    ->where('id', $u_vehiculo->id_aux)
                                    ->get();
    
                    $text = "Vehiculo Ingresado a travez de Orden de Admición el dia -> ".Carbon::now()->format('Y-m-d H:i:s')."\n";
                    $text.= "<b>Cliente</b>\n";
                    $text.= "Nombre ->  ".$uc[0]['nombre']??'';
                    $text.= "\n";
                    $text.= "Telefono ->  ".$uc[0]['telefono']??'';
                    $text.= "\n";
                    $text.= "Correo ->  ".$uc[0]['correo']??'';
                    $text.= "\n";
                    $text.= "<b>Vehiculo</b>\n";
                    $text.= "Marca ->  ".$u_vehiculo->marcas->marca??'';
                    $text.= "\n";
                    $text.= "Linea ->  ".$u_vehiculo->submarcas->submarca??'';
                    $text.= "\n";
                    $text.= "Color ->  ".$u_vehiculo->color??'';
                    $text.= "\n";
                    $text.= "Modelo ->  ".$u_vehiculo->modelo??'';
                    $text.= "\n";
                    $text.= "Placas ->  ".$u_vehiculo->placas??'';
                    $text.= "\n";
                    $text.= "Siniestro ->  ".$u_vehiculo->no_siniestro??'';
                    $text.= "\n";
                    $text.= "Asesor ->  ".$u_vehiculo->asesores->nombre." ".$u_vehiculo->asesores->a_paterno." ".$u_vehiculo->asesores->a_materno;
                    $text.= "\n";
                    $text.= "Aseguradora ->  ".$u_vehiculo->clientes->nombre??'';
                    $text.= "\n";
                    $text.= "Estatus ->  ".$est->status??'';
                    $text.= "\n";
                    $text.= "Nivel de daño ->  ".$u_vehiculo->nivelDano->nivel??'';
                    $text.= "\n";
                    $text.= "Forma de arribo ->  ".$u_vehiculo->formaArribo->forma_arribo??'';
                    $text.= "\n";
    
                    Telegram::sendMessage([
                        'chat_id' => env('TELEGRAM_CHANNEL_ID', ''),
                        'parse_mode' => 'HTML',
                        'text' => $text
                    ]);
                }

                return redirect()->route('l_valuaciones')->with('success','Valuacion Actualizada.');
            } else {
                return redirect()->route('l_valuaciones')->with('error','Valuacion no Actualizada.');
            }
            
        }
        
    }

    public function update_Brefacciones(Request $request, Vehiculo $vehiculo){
        
        if ($vehiculo->estatus_id == $request->estatus) {
            $e_actual = Estatusrefacciones::select('estatus')
                            ->where('id', $vehiculo['refacciones_id'])
                            ->first();

            return redirect()->route('l_Brefacciones')->with('warning','No se Actualizo el estatus "'. $e_actual->estatus . '".');
        } else {
            $vehiculo->refacciones_id = $request->estatus;
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

        $vehiculo->fecha_entrega_interna = $request->fechainter;
        $vehiculo->entrego = $request->entrego;
        $vehiculo->recibio = $request->recibio;

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

    public function u_asignacionPersonalPT(Vehiculo $vehiculo)
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

        return view('administracion.procesoTaller.u_procesoTaller', compact(['vehiculo', 'hojalateria', 'pintura', 'armado', 'detallado','mecanica', 'lavado']));
    }

    public function update_asignacionPersonalPT(Request $request, Vehiculo $vehiculo){
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
            return redirect()->route('l_procesoTaller')->with('success','Seguimiento Actualizado.');
        } else {
            return redirect()->route('l_procesoTaller')->with('error','Seguimiento no Actualizado.');
        }
    }

    public function u_valuacionesPA(Vehiculo $vehiculo){
        $list_estatus = Estatus::all();

        $e_actual = Estatus::select('status')
                            ->where('id', $vehiculo['estatus_id'])
                            ->first();

        if ($vehiculo->fecha_valuacion == "" || $vehiculo->fecha_valuacion == " " || $vehiculo->fecha_valuacion == NULL || $vehiculo->fecha_valuacion == null) {
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
            //$vehiculo->diferencia_tres_dias = $request->diferencia;
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
            $vehiculo->diferencia_tres_dias = $request->diferencia;
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

    public function indexMetricos(){
        //Total de vehiculos entregados por mes
        $total_V_EMes = DB::select("SELECT 
                                        COUNT(estatus_id) as Total 
                                    FROM 
                                        vehiculo 
                                    WHERE 
                                        estatus_id = 3 
                                    AND MONTH(fecha_salida_taller) = MONTH(NOW())
                                    AND YEAR(fecha_salida_taller) = YEAR(NOW())");

        $total_V_EMesQ = DB::select("SELECT 
                                        COUNT(estatus_id) as Qualitas 
                                    FROM 
                                        vehiculo 
                                    WHERE 
                                        estatus_id = 3 
                                    AND cliente_id = 4
                                    AND MONTH(fecha_salida_taller) = MONTH(NOW())
                                    AND YEAR(fecha_salida_taller) = YEAR(NOW())"); 

        $total_V_EMesG = DB::select("SELECT 
                                        COUNT(estatus_id) as GNP 
                                    FROM 
                                        vehiculo 
                                    WHERE 
                                        estatus_id = 3 
                                    AND cliente_id = 1
                                    AND MONTH(fecha_salida_taller) = MONTH(NOW())
                                    AND YEAR(fecha_salida_taller) = YEAR(NOW())");

        $total_V_EMesP = DB::select("SELECT 
                                        COUNT(estatus_id) as Particular 
                                    FROM 
                                        vehiculo 
                                    WHERE 
                                        estatus_id = 3 
                                    AND cliente_id = 3
                                    AND MONTH(fecha_salida_taller) = MONTH(NOW())
                                    AND YEAR(fecha_salida_taller) = YEAR(NOW())");

        $total_V_EMesBBVA = DB::select("SELECT 
                                        COUNT(estatus_id) as Bancomer 
                                    FROM 
                                        vehiculo 
                                    WHERE 
                                        estatus_id = 3 
                                    AND cliente_id = 5
                                    AND MONTH(fecha_salida_taller) = MONTH(NOW())
                                    AND YEAR(fecha_salida_taller) = YEAR(NOW())");

        $total_V_EMesBanorte = DB::select("SELECT 
                                            COUNT(estatus_id) as Banorte 
                                        FROM 
                                            vehiculo 
                                        WHERE 
                                            estatus_id = 3 
                                        AND cliente_id = 6
                                        AND MONTH(fecha_salida_taller) = MONTH(NOW())
                                        AND YEAR(fecha_salida_taller) = YEAR(NOW())");

        $tabla_VEntregados = array(
                                array(
                                    'compania' => 'Qualitas',
                                    'total' =>  $total_V_EMesQ[0]->Qualitas    
                                ),
                                array(
                                    'compania' => 'GNP',
                                    'total' => $total_V_EMesG[0]->GNP
                                ),
                                array(
                                    'compania' => 'Particular',
                                    'total' =>  $total_V_EMesP[0]->Particular
                                ),
                                array(
                                    'compania' => 'Bancomer',
                                    'total' => $total_V_EMesBBVA[0]->Bancomer
                                ),
                                array(
                                    'compania' => 'Banorte',
                                    'total' => $total_V_EMesBanorte[0]->Banorte
                                ),
                                array(
                                    'compania' => 'Total',
                                    'total' => $total_V_EMes[0]->Total
                                )
                            );
                            
        
        //Total de vehiculos recibidos por mes
        $total_V_RMes = DB::select("SELECT 
                                        COUNT(id_aux) as Total 
                                    FROM 
                                        vehiculo 
                                    WHERE 
                                        MONTH(fecha_llegada) = MONTH(NOW())
                                    AND YEAR(fecha_llegada) = YEAR(NOW())
                                    AND (estatus_id = 5  OR estatus_id = 6)");

        $total_V_RMesQ = DB::select("SELECT 
                                        COUNT(id_aux) as Qualitas 
                                    FROM 
                                        vehiculo 
                                    WHERE
                                        cliente_id = 4
                                    AND MONTH(fecha_llegada) = MONTH(NOW())
                                    AND YEAR(fecha_llegada) = YEAR(NOW())");

        $total_V_RMesG = DB::select("SELECT 
                                        COUNT(id_aux) as GNP 
                                    FROM 
                                        vehiculo 
                                    WHERE
                                        cliente_id = 1
                                    AND MONTH(fecha_llegada) = MONTH(NOW())
                                    AND YEAR(fecha_llegada) = YEAR(NOW())");

        $total_V_RMesP = DB::select("SELECT 
                                        COUNT(id_aux) as Particular 
                                    FROM 
                                        vehiculo 
                                    WHERE
                                        cliente_id = 3
                                    AND MONTH(fecha_llegada) = MONTH(NOW())
                                    AND YEAR(fecha_llegada) = YEAR(NOW())");

        $total_V_RMesBBVA = DB::select("SELECT 
                                        COUNT(id_aux) as Bancomer 
                                    FROM 
                                        vehiculo 
                                    WHERE
                                        cliente_id = 5
                                    AND MONTH(fecha_llegada) = MONTH(NOW())
                                    AND YEAR(fecha_llegada) = YEAR(NOW())");

        $total_V_RMesBanorte = DB::select("SELECT 
                                            COUNT(id_aux) as Banorte 
                                        FROM 
                                            vehiculo 
                                        WHERE
                                            cliente_id = 6
                                        AND MONTH(fecha_llegada) = MONTH(NOW())
                                        AND YEAR(fecha_llegada) = YEAR(NOW())
                                        AND (estatus_id = 5  OR estatus_id = 6)");

        $tabla_VRecibidos = array(
                                array(
                                    'compania' => 'Qualitas',
                                    'total' =>  $total_V_RMesQ[0]->Qualitas    
                                ),
                                array(
                                    'compania' => 'GNP',
                                    'total' => $total_V_RMesG[0]->GNP
                                ),
                                array(
                                    'compania' => 'Particular',
                                    'total' =>  $total_V_RMesP[0]->Particular
                                ),
                                array(
                                    'compania' => 'Bancomer',
                                    'total' => $total_V_RMesBBVA[0]->Bancomer
                                ),
                                array(
                                    'compania' => 'Banorte',
                                    'total' => $total_V_RMesBanorte[0]->Banorte
                                ),
                                array(
                                    'compania' => 'Total',
                                    'total' => $total_V_RMes[0]->Total
                                )
        );

        //tabla de 10 semanas de vehiculos entregados
        $semana0 = DB::select('SELECT 
                                    COUNT(estatus_id) as entregados 
                                FROM 
                                    vehiculo 
                                WHERE 
                                    WEEKOFYEAR(fecha_salida_taller) = WEEKOFYEAR(NOW())
                                AND estatus_id = 3
                                AND YEAR(fecha_salida_taller) = YEAR(NOW())');

        $semana1 = DB::select('SELECT 
                                COUNT(estatus_id) as entregados 
                            FROM 
                                vehiculo 
                            WHERE 
                                WEEKOFYEAR(fecha_salida_taller) = WEEKOFYEAR(NOW())-1
                            AND estatus_id = 3
                            AND YEAR(fecha_salida_taller) = YEAR(NOW())');

        $semana2 = DB::select('SELECT 
                                COUNT(estatus_id) as entregados 
                            FROM 
                                vehiculo 
                            WHERE 
                                WEEKOFYEAR(fecha_salida_taller) = WEEKOFYEAR(NOW())-2
                            AND estatus_id = 3
                            AND YEAR(fecha_salida_taller) = YEAR(NOW())');

        $semana3 = DB::select('SELECT 
                                COUNT(estatus_id) as entregados 
                            FROM 
                                vehiculo 
                            WHERE 
                                WEEKOFYEAR(fecha_salida_taller) = WEEKOFYEAR(NOW())-3
                            AND estatus_id = 3
                            AND YEAR(fecha_salida_taller) = YEAR(NOW())');

        $semana4 = DB::select('SELECT 
                                COUNT(estatus_id) as entregados 
                            FROM 
                                vehiculo 
                            WHERE 
                                WEEKOFYEAR(fecha_salida_taller) = WEEKOFYEAR(NOW())-4
                            AND estatus_id = 3
                            AND YEAR(fecha_salida_taller) = YEAR(NOW())');

        $semana5 = DB::select('SELECT 
                                COUNT(estatus_id) as entregados 
                            FROM 
                                vehiculo 
                            WHERE 
                                WEEKOFYEAR(fecha_salida_taller) = WEEKOFYEAR(NOW())-5
                            AND estatus_id = 3
                            AND YEAR(fecha_salida_taller) = YEAR(NOW())');

        $semana6 = DB::select('SELECT 
                                COUNT(estatus_id) as entregados 
                            FROM 
                                vehiculo 
                            WHERE 
                                WEEKOFYEAR(fecha_salida_taller) = WEEKOFYEAR(NOW())-6
                            AND estatus_id = 3
                            AND YEAR(fecha_salida_taller) = YEAR(NOW())');

        $semana7 = DB::select('SELECT 
                                COUNT(estatus_id) as entregados 
                            FROM 
                                vehiculo 
                            WHERE 
                                WEEKOFYEAR(fecha_salida_taller) = WEEKOFYEAR(NOW())-7
                            AND estatus_id = 3
                            AND YEAR(fecha_salida_taller) = YEAR(NOW())');

        $semana8 = DB::select('SELECT 
                                COUNT(estatus_id) as entregados 
                            FROM 
                                vehiculo 
                            WHERE 
                                WEEKOFYEAR(fecha_salida_taller) = WEEKOFYEAR(NOW())-8
                            AND estatus_id = 3
                            AND YEAR(fecha_salida_taller) = YEAR(NOW())');
                                
        $semana9 = DB::select('SELECT 
                                COUNT(estatus_id) as entregados 
                            FROM 
                                vehiculo 
                            WHERE 
                                WEEKOFYEAR(fecha_salida_taller) = WEEKOFYEAR(NOW())-9
                            AND estatus_id = 3
                            AND YEAR(fecha_salida_taller) = YEAR(NOW())'); 

        $semana10 = DB::select('SELECT 
                                COUNT(estatus_id) as entregados 
                            FROM 
                                vehiculo 
                            WHERE 
                                WEEKOFYEAR(fecha_salida_taller) = WEEKOFYEAR(NOW())-10
                            AND estatus_id = 3
                            AND YEAR(fecha_salida_taller) = YEAR(NOW())');

        $tabla_VEntregados10sem = array(
            array('Semana 10', 'Semana 9', 'Semana 8', 'Semana 7', 'Semana 6', 'Semana 5', 'Semana 4', 'Semana 3', 'Semana 2', 'Semana 1', 'Semana Actual'),
            array($semana10[0]->entregados, $semana9[0]->entregados, $semana8[0]->entregados, $semana7[0]->entregados, $semana6[0]->entregados, $semana5[0]->entregados, $semana4[0]->entregados, $semana3[0]->entregados, $semana2[0]->entregados, $semana1[0]->entregados, $semana0[0]->entregados)
        );

        //tabla de 10 semanas de vehiculos recibidos
        $semanar0 = DB::select('SELECT 
                                    COUNT(estatus_id) as entregados 
                                FROM 
                                    vehiculo 
                                WHERE 
                                    WEEKOFYEAR(fecha_llegada) = WEEKOFYEAR(NOW())
                                AND YEAR(fecha_llegada) = YEAR(NOW())
                                AND (estatus_id = 5  OR estatus_id = 6)');

        $semanar1 = DB::select('SELECT 
                                COUNT(estatus_id) as entregados 
                            FROM 
                                vehiculo 
                            WHERE 
                                WEEKOFYEAR(fecha_llegada) = WEEKOFYEAR(NOW())-1
                            AND YEAR(fecha_llegada) = YEAR(NOW())
                            AND (estatus_id = 5  OR estatus_id = 6)');

        $semanar2 = DB::select('SELECT 
                                COUNT(estatus_id) as entregados 
                            FROM 
                                vehiculo 
                            WHERE 
                                WEEKOFYEAR(fecha_llegada) = WEEKOFYEAR(NOW())-2
                            AND YEAR(fecha_llegada) = YEAR(NOW())
                            AND (estatus_id = 5  OR estatus_id = 6)');

        $semanar3 = DB::select('SELECT 
                                COUNT(estatus_id) as entregados 
                            FROM 
                                vehiculo 
                            WHERE 
                                WEEKOFYEAR(fecha_llegada) = WEEKOFYEAR(NOW())-3
                            AND YEAR(fecha_llegada) = YEAR(NOW())
                            AND (estatus_id = 5  OR estatus_id = 6)');

        $semanar4 = DB::select('SELECT 
                                COUNT(estatus_id) as entregados 
                            FROM 
                                vehiculo 
                            WHERE 
                                WEEKOFYEAR(fecha_llegada) = WEEKOFYEAR(NOW())-4
                            AND YEAR(fecha_llegada) = YEAR(NOW())
                            AND (estatus_id = 5  OR estatus_id = 6)');

        $semanar5 = DB::select('SELECT 
                                COUNT(estatus_id) as entregados 
                            FROM 
                                vehiculo 
                            WHERE 
                                WEEKOFYEAR(fecha_llegada) = WEEKOFYEAR(NOW())-5
                            AND YEAR(fecha_llegada) = YEAR(NOW())
                            AND (estatus_id = 5  OR estatus_id = 6)');

        $semanar6 = DB::select('SELECT 
                                COUNT(estatus_id) as entregados 
                            FROM 
                                vehiculo 
                            WHERE 
                                WEEKOFYEAR(fecha_llegada) = WEEKOFYEAR(NOW())-6
                            AND YEAR(fecha_llegada) = YEAR(NOW())
                            AND (estatus_id = 5  OR estatus_id = 6)');

        $semanar7 = DB::select('SELECT 
                                COUNT(estatus_id) as entregados 
                            FROM 
                                vehiculo 
                            WHERE 
                                WEEKOFYEAR(fecha_llegada) = WEEKOFYEAR(NOW())-7
                            AND YEAR(fecha_llegada) = YEAR(NOW())
                            AND (estatus_id = 5  OR estatus_id = 6)');

        $semanar8 = DB::select('SELECT 
                                COUNT(estatus_id) as entregados 
                            FROM 
                                vehiculo 
                            WHERE 
                                WEEKOFYEAR(fecha_llegada) = WEEKOFYEAR(NOW())-8
                            AND YEAR(fecha_llegada) = YEAR(NOW())
                            AND (estatus_id = 5  OR estatus_id = 6)');
                                
        $semanar9 = DB::select('SELECT 
                                COUNT(estatus_id) as entregados 
                            FROM 
                                vehiculo 
                            WHERE 
                                WEEKOFYEAR(fecha_llegada) = WEEKOFYEAR(NOW())-9
                            AND YEAR(fecha_llegada) = YEAR(NOW())
                            AND (estatus_id = 5  OR estatus_id = 6)'); 

        $semanar10 = DB::select('SELECT 
                                COUNT(estatus_id) as entregados 
                            FROM 
                                vehiculo 
                            WHERE 
                                WEEKOFYEAR(fecha_llegada) = WEEKOFYEAR(NOW())-10
                            AND YEAR(fecha_llegada) = YEAR(NOW())
                            AND (estatus_id = 5  OR estatus_id = 6)');

        $tabla_VRecibidos10sem = array(
            array('Semana 10', 'Semana 9', 'Semana 8', 'Semana 7', 'Semana 6', 'Semana 5', 'Semana 4', 'Semana 3', 'Semana 2', 'Semana 1', 'Semana Actual'),
            array($semanar10[0]->entregados, $semanar9[0]->entregados, $semanar8[0]->entregados, $semanar7[0]->entregados, $semanar6[0]->entregados, $semanar5[0]->entregados, $semanar4[0]->entregados, $semanar3[0]->entregados, $semanar2[0]->entregados, $semanar1[0]->entregados, $semanar0[0]->entregados)
        );

        //vehiculos entregados el dia anterior
        $v_entretagos_ayer = Vehiculo::whereDate('fecha_salida_taller', Carbon::now()->subDay()->format('Y-m-d'))->where('estatus_id', 3)->count();
        $ayer = Carbon::now()->subDay()->format('Y-m-d');
        $v_recibidos_ayer = DB::select("SELECT COUNT(fecha_llegada) as recibidos FROM vehiculo WHERE fecha_llegada = '$ayer' AND (estatus_id = 5  OR estatus_id = 6)");
        //dd($v_recibidos_ayer[0]);
        //$v_recibidos_ayer = Vehiculo::whereDate('fecha_llegada',  Carbon::now()->subDay()->format('Y-m-d'))->where('estatus_id', 5)->orWhere('estatus_id', 6)->count();;

        //dd(Carbon::now()->subDay()->format('Y-m-d'));
        //dd($v_entretagos_ayer);
        return view('administracion.metricos.metricos', compact(['tabla_VEntregados', 'tabla_VRecibidos', 'tabla_VEntregados10sem', 'tabla_VRecibidos10sem', 'v_entretagos_ayer', 'v_recibidos_ayer']));
    }

    public function g_ventregados(Request $request){
        //Total de vehiculos entregados por mes
        if (isset($request->catalago_ventregados)) {
            $total_V_EMes = DB::select("SELECT 
                                            COUNT(estatus_id) as Total 
                                        FROM 
                                            vehiculo 
                                        WHERE 
                                            estatus_id = 3 
                                        AND MONTH(fecha_salida_taller) = MONTH(NOW())
                                        AND YEAR(fecha_salida_taller) = YEAR(NOW())");

            $total_V_EMesQ = DB::select("SELECT 
                                            COUNT(estatus_id) as Qualitas 
                                        FROM 
                                            vehiculo 
                                        WHERE 
                                            estatus_id = 3 
                                        AND cliente_id = 4
                                        AND MONTH(fecha_salida_taller) = MONTH(NOW())
                                        AND YEAR(fecha_salida_taller) = YEAR(NOW())"); 

            $total_V_EMesG = DB::select("SELECT 
                                            COUNT(estatus_id) as GNP 
                                        FROM 
                                            vehiculo 
                                        WHERE 
                                            estatus_id = 3 
                                        AND cliente_id = 1
                                        AND MONTH(fecha_salida_taller) = MONTH(NOW())
                                        AND YEAR(fecha_salida_taller) = YEAR(NOW())");

            $total_V_EMesP = DB::select("SELECT 
                                            COUNT(estatus_id) as Particular 
                                        FROM 
                                            vehiculo 
                                        WHERE 
                                            estatus_id = 3 
                                        AND cliente_id = 3
                                        AND MONTH(fecha_salida_taller) = MONTH(NOW())
                                        AND YEAR(fecha_salida_taller) = YEAR(NOW())");

            $total_V_EMesBBVA = DB::select("SELECT 
                                                COUNT(estatus_id) as Bancomer 
                                            FROM 
                                                vehiculo 
                                            WHERE 
                                                estatus_id = 3 
                                            AND cliente_id = 5
                                            AND MONTH(fecha_salida_taller) = MONTH(NOW())
                                            AND YEAR(fecha_salida_taller) = YEAR(NOW())");

            $total_V_EMesBanorte = DB::select("SELECT 
                                                    COUNT(estatus_id) as Banorte 
                                                FROM 
                                                    vehiculo 
                                                WHERE 
                                                    estatus_id = 3 
                                                AND cliente_id = 6
                                                AND MONTH(fecha_salida_taller) = MONTH(NOW())
                                                AND YEAR(fecha_salida_taller) = YEAR(NOW())");

            $datos = array(
                array('Qualitas', 'GNP', 'Particular', 'Bancomer', 'Banorte', 'Total'),
                array($total_V_EMesQ[0]->Qualitas, $total_V_EMesG[0]->GNP, $total_V_EMesP[0]->Particular, $total_V_EMesBBVA[0]->Bancomer, $total_V_EMesBanorte[0]->Banorte, $total_V_EMes[0]->Total)
            );

            return json_encode($datos);
        }
    }

    public function g_vrecibidos(Request $request){
        //Total de vehiculos recibidos por mes
        if (isset($request->catalago_vrecibidos)) {
            $total_V_RMes = DB::select("SELECT 
                                        COUNT(id_aux) as Total 
                                    FROM 
                                        vehiculo 
                                    WHERE 
                                        MONTH(fecha_llegada) = MONTH(NOW())
                                    AND YEAR(fecha_llegada) = YEAR(NOW())
                                    AND (estatus_id = 5  OR estatus_id = 6)");

            $total_V_RMesQ = DB::select("SELECT 
                                            COUNT(id_aux) as Qualitas 
                                        FROM 
                                            vehiculo 
                                        WHERE
                                            cliente_id = 4
                                        AND MONTH(fecha_llegada) = MONTH(NOW())
                                        AND YEAR(fecha_llegada) = YEAR(NOW())");

            $total_V_RMesG = DB::select("SELECT 
                                            COUNT(id_aux) as GNP 
                                        FROM 
                                            vehiculo 
                                        WHERE
                                            cliente_id = 1
                                        AND MONTH(fecha_llegada) = MONTH(NOW())
                                        AND YEAR(fecha_llegada) = YEAR(NOW())");

            $total_V_RMesP = DB::select("SELECT 
                                            COUNT(id_aux) as Particular 
                                        FROM 
                                            vehiculo 
                                        WHERE
                                            cliente_id = 3
                                        AND MONTH(fecha_llegada) = MONTH(NOW())
                                        AND YEAR(fecha_llegada) = YEAR(NOW())");

            $total_V_RMesBBVA = DB::select("SELECT 
                                            COUNT(id_aux) as Bancomer 
                                        FROM 
                                            vehiculo 
                                        WHERE
                                            cliente_id = 5
                                        AND MONTH(fecha_llegada) = MONTH(NOW())
                                        AND YEAR(fecha_llegada) = YEAR(NOW())");

            $total_V_RMesBanorte = DB::select("SELECT 
                                                COUNT(id_aux) as Banorte 
                                            FROM 
                                                vehiculo 
                                            WHERE
                                                cliente_id = 6
                                            AND MONTH(fecha_llegada) = MONTH(NOW())
                                            AND YEAR(fecha_llegada) = YEAR(NOW())
                                            AND (estatus_id = 5  OR estatus_id = 6)");

            $datos = array(
                array('Qualitas', 'GNP', 'Particular', 'Bancomer', 'Banorte', 'Total'),
                array($total_V_RMesQ[0]->Qualitas, $total_V_RMesG[0]->GNP, $total_V_RMesP[0]->Particular, $total_V_RMesBBVA[0]->Bancomer, $total_V_RMesBanorte[0]->Banorte, $total_V_RMes[0]->Total)
            );

            return json_encode($datos);
        }
    }

    public function g_ventregadosselect(Request $request){
        //Total de vehiculos entregados por mes
        if (isset($request->catalago_ventregados) && isset($request->mes)) {
            $mes = $request->mes;
            $total_V_EMes = DB::select("SELECT 
                                            COUNT(estatus_id) as Total 
                                        FROM 
                                            vehiculo 
                                        WHERE 
                                            estatus_id = 3 
                                        AND MONTH(fecha_salida_taller) = MONTH('$mes')
                                        AND YEAR(fecha_salida_taller) = YEAR('$mes')");

            $total_V_EMesQ = DB::select("SELECT 
                                            COUNT(estatus_id) as Qualitas 
                                        FROM 
                                            vehiculo 
                                        WHERE 
                                            estatus_id = 3 
                                        AND cliente_id = 4
                                        AND MONTH(fecha_salida_taller) = MONTH('$mes')
                                        AND YEAR(fecha_salida_taller) = YEAR('$mes')"); 

            $total_V_EMesG = DB::select("SELECT 
                                            COUNT(estatus_id) as GNP 
                                        FROM 
                                            vehiculo 
                                        WHERE 
                                            estatus_id = 3 
                                        AND cliente_id = 1
                                        AND MONTH(fecha_salida_taller) = MONTH('$mes')
                                        AND YEAR(fecha_salida_taller) = YEAR('$mes')");

            $total_V_EMesP = DB::select("SELECT 
                                            COUNT(estatus_id) as Particular 
                                        FROM 
                                            vehiculo 
                                        WHERE 
                                            estatus_id = 3 
                                        AND cliente_id = 3
                                        AND MONTH(fecha_salida_taller) = MONTH('$mes')
                                        AND YEAR(fecha_salida_taller) = YEAR('$mes')");

            $total_V_EMesBBVA = DB::select("SELECT 
                                                COUNT(estatus_id) as Bancomer 
                                            FROM 
                                                vehiculo 
                                            WHERE 
                                                estatus_id = 3 
                                            AND cliente_id = 5
                                            AND MONTH(fecha_salida_taller) = MONTH('$mes')
                                            AND YEAR(fecha_salida_taller) = YEAR('$mes')");

            $total_V_EMesBanorte = DB::select("SELECT 
                                                    COUNT(estatus_id) as Banorte 
                                                FROM 
                                                    vehiculo 
                                                WHERE 
                                                    estatus_id = 3 
                                                AND cliente_id = 6
                                                AND MONTH(fecha_salida_taller) = MONTH('$mes')
                                                AND YEAR(fecha_salida_taller) = YEAR('$mes')");

            $datos = array(
                array('Qualitas', 'GNP', 'Particular', 'Bancomer', 'Banorte', 'Total'),
                array($total_V_EMesQ[0]->Qualitas, $total_V_EMesG[0]->GNP, $total_V_EMesP[0]->Particular, $total_V_EMesBBVA[0]->Bancomer, $total_V_EMesBanorte[0]->Banorte, $total_V_EMes[0]->Total)
            );

            return json_encode($datos);
        }
    }

    public function g_vrecibidosselect(Request $request){
        //Total de vehiculos recibidos por mes
        if (isset($request->catalago_vrecibidos) && isset($request->mes)) {
            $mes = $request->mes;
            $total_V_RMes = DB::select("SELECT 
                                        COUNT(id_aux) as Total 
                                    FROM 
                                        vehiculo 
                                    WHERE 
                                        MONTH(fecha_llegada) = MONTH('$mes')
                                    AND YEAR(fecha_llegada) = YEAR('$mes')
                                    AND (estatus_id = 5  OR estatus_id = 6)");

            $total_V_RMesQ = DB::select("SELECT 
                                            COUNT(id_aux) as Qualitas 
                                        FROM 
                                            vehiculo 
                                        WHERE
                                            cliente_id = 4
                                        AND MONTH(fecha_llegada) = MONTH('$mes')
                                        AND YEAR(fecha_llegada) = YEAR('$mes')");

            $total_V_RMesG = DB::select("SELECT 
                                            COUNT(id_aux) as GNP 
                                        FROM 
                                            vehiculo 
                                        WHERE
                                            cliente_id = 1
                                        AND MONTH(fecha_llegada) = MONTH('$mes')
                                        AND YEAR(fecha_llegada) = YEAR('$mes')");

            $total_V_RMesP = DB::select("SELECT 
                                            COUNT(id_aux) as Particular 
                                        FROM 
                                            vehiculo 
                                        WHERE
                                            cliente_id = 3
                                        AND MONTH(fecha_llegada) = MONTH('$mes')
                                        AND YEAR(fecha_llegada) = YEAR('$mes')");

            $total_V_RMesBBVA = DB::select("SELECT 
                                            COUNT(id_aux) as Bancomer 
                                        FROM 
                                            vehiculo 
                                        WHERE
                                            cliente_id = 5
                                        AND MONTH(fecha_llegada) = MONTH('$mes')
                                        AND YEAR(fecha_llegada) = YEAR('$mes')");

            $total_V_RMesBanorte = DB::select("SELECT 
                                                COUNT(id_aux) as Banorte 
                                            FROM 
                                                vehiculo 
                                            WHERE
                                                cliente_id = 6
                                            AND MONTH(fecha_llegada) = MONTH('$mes')
                                            AND YEAR(fecha_llegada) = YEAR('$mes')
                                            AND (estatus_id = 5  OR estatus_id = 6)");

            $datos = array(
                array('Qualitas', 'GNP', 'Particular', 'Bancomer', 'Banorte', 'Total'),
                array($total_V_RMesQ[0]->Qualitas, $total_V_RMesG[0]->GNP, $total_V_RMesP[0]->Particular, $total_V_RMesBBVA[0]->Bancomer, $total_V_RMesBanorte[0]->Banorte, $total_V_RMes[0]->Total)
            );

            return json_encode($datos);
        }
    }

    public function g_diesentregados(Request $request){
        if (isset($request->catalago_ventregados)) {
            //tabla de 10 semanas de vehiculos entregados
            $semana0 = DB::select('SELECT 
                    COUNT(estatus_id) as entregados 
                FROM 
                    vehiculo 
                WHERE 
                    WEEKOFYEAR(fecha_salida_taller) = WEEKOFYEAR(NOW())
                AND estatus_id = 3');

            $semana1 = DB::select('SELECT 
                COUNT(estatus_id) as entregados 
            FROM 
                vehiculo 
            WHERE 
                WEEKOFYEAR(fecha_salida_taller) = WEEKOFYEAR(NOW())-1
            AND estatus_id = 3');

            $semana2 = DB::select('SELECT 
                COUNT(estatus_id) as entregados 
            FROM 
                vehiculo 
            WHERE 
                WEEKOFYEAR(fecha_salida_taller) = WEEKOFYEAR(NOW())-2
            AND estatus_id = 3');

            $semana3 = DB::select('SELECT 
                COUNT(estatus_id) as entregados 
            FROM 
                vehiculo 
            WHERE 
                WEEKOFYEAR(fecha_salida_taller) = WEEKOFYEAR(NOW())-3
            AND estatus_id = 3');

            $semana4 = DB::select('SELECT 
                COUNT(estatus_id) as entregados 
            FROM 
                vehiculo 
            WHERE 
                WEEKOFYEAR(fecha_salida_taller) = WEEKOFYEAR(NOW())-4
            AND estatus_id = 3');

            $semana5 = DB::select('SELECT 
                COUNT(estatus_id) as entregados 
            FROM 
                vehiculo 
            WHERE 
                WEEKOFYEAR(fecha_salida_taller) = WEEKOFYEAR(NOW())-5
            AND estatus_id = 3');

            $semana6 = DB::select('SELECT 
                COUNT(estatus_id) as entregados 
            FROM 
                vehiculo 
            WHERE 
                WEEKOFYEAR(fecha_salida_taller) = WEEKOFYEAR(NOW())-6
            AND estatus_id = 3');

            $semana7 = DB::select('SELECT 
                COUNT(estatus_id) as entregados 
            FROM 
                vehiculo 
            WHERE 
                WEEKOFYEAR(fecha_salida_taller) = WEEKOFYEAR(NOW())-7
            AND estatus_id = 3');

            $semana8 = DB::select('SELECT 
                COUNT(estatus_id) as entregados 
            FROM 
                vehiculo 
            WHERE 
                WEEKOFYEAR(fecha_salida_taller) = WEEKOFYEAR(NOW())-8
            AND estatus_id = 3');
                
            $semana9 = DB::select('SELECT 
                COUNT(estatus_id) as entregados 
            FROM 
                vehiculo 
            WHERE 
                WEEKOFYEAR(fecha_salida_taller) = WEEKOFYEAR(NOW())-9
            AND estatus_id = 3'); 

            $semana10 = DB::select('SELECT 
                COUNT(estatus_id) as entregados 
            FROM 
                vehiculo 
            WHERE 
                WEEKOFYEAR(fecha_salida_taller) = WEEKOFYEAR(NOW())-10
            AND estatus_id = 3');

            $datos = array(
                array('Semana 10', 'Semana 9', 'Semana 8', 'Semana 7', 'Semana 6', 'Semana 5', 'Semana 4', 'Semana 3', 'Semana 2', 'Semana 1', 'Semana Actual'),
                array($semana10[0]->entregados, $semana9[0]->entregados, $semana8[0]->entregados, $semana7[0]->entregados, $semana6[0]->entregados, $semana5[0]->entregados, $semana4[0]->entregados, $semana3[0]->entregados, $semana2[0]->entregados, $semana1[0]->entregados, $semana0[0]->entregados)
            );   
            
            return json_encode($datos);
        }
    }

    public function g_diesrecibidos(Request $request){
        if (isset($request->catalago_vrecibidos)) {
            //tabla de 10 semanas de vehiculos recibidos
            $semanar0 = DB::select('SELECT 
                                        COUNT(estatus_id) as entregados 
                                    FROM 
                                        vehiculo 
                                    WHERE 
                                        WEEKOFYEAR(fecha_llegada) = WEEKOFYEAR(NOW())
                                        AND (estatus_id = 5  OR estatus_id = 6)');

            $semanar1 = DB::select('SELECT 
                                        COUNT(estatus_id) as entregados 
                                    FROM 
                                        vehiculo 
                                    WHERE 
                                        WEEKOFYEAR(fecha_llegada) = WEEKOFYEAR(NOW())-1
                                        AND (estatus_id = 5  OR estatus_id = 6)');

            $semanar2 = DB::select('SELECT 
                                        COUNT(estatus_id) as entregados 
                                    FROM 
                                        vehiculo 
                                    WHERE 
                                        WEEKOFYEAR(fecha_llegada) = WEEKOFYEAR(NOW())-2
                                        AND (estatus_id = 5  OR estatus_id = 6)');

            $semanar3 = DB::select('SELECT 
                                        COUNT(estatus_id) as entregados 
                                    FROM 
                                        vehiculo 
                                    WHERE 
                                        WEEKOFYEAR(fecha_llegada) = WEEKOFYEAR(NOW())-3
                                        AND (estatus_id = 5  OR estatus_id = 6)');

            $semanar4 = DB::select('SELECT 
                                        COUNT(estatus_id) as entregados 
                                    FROM 
                                        vehiculo 
                                    WHERE 
                                        WEEKOFYEAR(fecha_llegada) = WEEKOFYEAR(NOW())-4
                                        AND (estatus_id = 5  OR estatus_id = 6)');

            $semanar5 = DB::select('SELECT 
                                        COUNT(estatus_id) as entregados 
                                    FROM 
                                        vehiculo 
                                    WHERE 
                                        WEEKOFYEAR(fecha_llegada) = WEEKOFYEAR(NOW())-5
                                        AND (estatus_id = 5  OR estatus_id = 6)');

            $semanar6 = DB::select('SELECT 
                                        COUNT(estatus_id) as entregados 
                                    FROM 
                                        vehiculo 
                                    WHERE 
                                        WEEKOFYEAR(fecha_llegada) = WEEKOFYEAR(NOW())-6
                                        AND (estatus_id = 5  OR estatus_id = 6)');

            $semanar7 = DB::select('SELECT 
                                        COUNT(estatus_id) as entregados 
                                    FROM 
                                        vehiculo 
                                    WHERE 
                                        WEEKOFYEAR(fecha_llegada) = WEEKOFYEAR(NOW())-7
                                        AND (estatus_id = 5  OR estatus_id = 6)');

            $semanar8 = DB::select('SELECT 
                                        COUNT(estatus_id) as entregados 
                                    FROM 
                                        vehiculo 
                                    WHERE 
                                        WEEKOFYEAR(fecha_llegada) = WEEKOFYEAR(NOW())-8
                                        AND (estatus_id = 5  OR estatus_id = 6)');
                
            $semanar9 = DB::select('SELECT 
                                        COUNT(estatus_id) as entregados 
                                    FROM 
                                        vehiculo 
                                    WHERE 
                                        WEEKOFYEAR(fecha_llegada) = WEEKOFYEAR(NOW())-9
                                        AND (estatus_id = 5  OR estatus_id = 6)'); 

            $semanar10 = DB::select('SELECT 
                                        COUNT(estatus_id) as entregados 
                                    FROM 
                                        vehiculo 
                                    WHERE 
                                        WEEKOFYEAR(fecha_llegada) = WEEKOFYEAR(NOW())-10
                                        AND (estatus_id = 5  OR estatus_id = 6)');

            $datos = array(
                array('Semana 10', 'Semana 9', 'Semana 8', 'Semana 7', 'Semana 6', 'Semana 5', 'Semana 4', 'Semana 3', 'Semana 2', 'Semana 1', 'Semana Actual'),
                array($semanar10[0]->entregados, $semanar9[0]->entregados, $semanar8[0]->entregados, $semanar7[0]->entregados, $semanar6[0]->entregados, $semanar5[0]->entregados, $semanar4[0]->entregados, $semanar3[0]->entregados, $semanar2[0]->entregados, $semanar1[0]->entregados, $semanar0[0]->entregados)
            );

            return json_encode($datos);
        }
    }

    public function get_idV(Request $request){
        if ($request->id == 'N/A') {
            return 'N/A';
        } else {
            $expediente = DB::select('SELECT id FROM vehiculo WHERE id LIKE '%$request->id%'');
            return  $expediente;
        }
    }

    public function existe_vehiculo_gastos(Request $request){
        $id = intval($request->id);

        $vehiculo = Vehiculo::with(['marcas:id,marca', 'submarcas:id,submarca', 'clientes:id,nombre', 'asesores:id,nombre,a_paterno,a_materno', 'estatus:id,status'])
                            ->where('id', 'LIKE', "%$id%")
                            ->select('modelo', 'color', 'marca_id', 'linea_id', 'cliente_id', 'placas', 'id_asesor', 'estatus_id')
                            ->first();
        //return response()->json($vehiculo);
        if ($vehiculo != null) {
            return response()->json($vehiculo);
        } else {
            $val = array(
                'resultado' => 0
            );
            return response()->json($val);
        }
    }

    public function existe_vehiculo_gastos_recibo(Request $request){
        $id = intval($request->id);

        $vehiculo = Vehiculo::with(['marcas:id,marca', 'submarcas:id,submarca', 'clientes:id,nombre', 'asesores:id,nombre,a_paterno,a_materno', 'estatus:id,status'])
                            ->where('id', 'LIKE', "%$id%")
                            ->select('modelo', 'color', 'marca_id', 'linea_id', 'cliente_id', 'placas', 'id_asesor', 'estatus_id')
                            ->first();
        $rpp = recibo_pago_proveedores::all()->last();
        //return response()->json($vehiculo);
        if ($vehiculo != null) {
            return response()->json([$vehiculo, $rpp]);
        } else {
            $val = array(
                'resultado' => 0
            );
            return response()->json($val);
        }
    }

    public function monitor(){

        $monitor = Vehiculo::with(['marcas:id,marca', 'submarcas:id,submarca', 'clientes:id,nombre', 'asesores:id,nombre,a_paterno,a_materno', 'estatus:id,status', 'nivelDano:id,nivel', 'formaArribo:id,forma_arribo'])
                                ->select('id_aux','id','estatus_id','modelo', 'color', 'marca_id', 'linea_id', 'cliente_id', 'placas', 'id_asesor', 'no_siniestro', 'n_dano', 'f_arribo', 'fecha_llegada', 'fecha_valuacion', 'fecha_autorizacion', 'p_asignados', 'r_disponibles', 'aplica_hojalateria', 'fecha_hojalateria', 'aplica_preparacion', 'fecha_preparacion', 'aplica_pintura', 'fecha_pintura', 'aplica_armado', 'fecha_armado', 'aplica_detallado', 'fecha_detallado', 'aplica_mecanica', 'fecha_mecanica', 'aplica_lavado', 'fecha_lavado', 'fecha_entrega_interna', 'asignado_hojalateria', 'asignado_preparacion', 'asignado_pintura', 'asignado_armado', 'asignado_detallado', 'asignado_mecanica', 'asignado_lavado')
                                ->where('estatus_id','5')
                                //->where('id_aux', 433)
                                ->orWhere('estatus_id','6')
                                ->orderBy('id_aux')
                                ->get();
        //dd($monitor);
        return view('administracion.monitor.monitor', compact('monitor'));
    }

    public function monitorF(){

        $monitor = Vehiculo::with(['marcas:id,marca', 'submarcas:id,submarca', 'clientes:id,nombre', 'asesores:id,nombre,a_paterno,a_materno', 'estatus:id,status', 'facturas'])
                                ->select('id_aux','id','estatus_id','modelo', 'color', 'marca_id', 'linea_id', 'cliente_id', 'placas', 'id_asesor', 'no_siniestro', 'fecha_salida_taller')
                                ->where('estatus_id','3')
                                ->whereDate('fecha_salida_taller', '>', '2021-06-01')
                                ->orderBy('id_aux')
                                ->get();
        
        $estatus = Estatusaseguradoras::all();

        return view('administracion.monitor.monitorF', compact(['monitor', 'estatus']));
    }

    public function recorrido(){
        $pdf = new FPDF();
        $pdf->AddPage();
        $pdf->SetFont('Arial','B',12);
        //agrego los encabesados
        $pdf->Cell(190, 8, utf8_decode('Resumen de vehiculos para entrega de la semana # '. date('W')), 1, 1, 'C');
        $pdf->Cell(10, 8, utf8_decode('#'), 1, 0, 'C');
        $pdf->Cell(70, 8, utf8_decode('Vehiculo'), 1, 0, 'C');
        $pdf->Cell(15, 8, utf8_decode('Seg'), 1, 0, 'C');
        $pdf->Cell(95, 8, utf8_decode('Comentarios'), 1, 1, 'C');
        //se terminan los encabezados
        //se obtiene la informacion para poder rellenar la tabla de vehiculos lavado e inspeccion
        $v_entrega = Vehiculo::with(['marcas:id,marca', 'submarcas:id,submarca', 'clientes:id,nombre', 'asesores:id,nombre,a_paterno,a_materno', 'estatus:id,status'])
                        ->select('id_aux','id','estatus_id','modelo', 'color', 'marca_id', 'linea_id', 'cliente_id', 'placas', 'id_asesor', 'no_siniestro', 'fecha_salida_taller')
                        ->where('estatus_id', 5)
                        ->whereNotNull('fecha_entrega_interna')
                        ->get();
        //termino de obtener la informacion
        // lleno la tabla y cambio el tamaño de la letra
        $pdf->SetFont('Arial', '', 12);
        for ($i=0; $i < sizeof($v_entrega); $i++) { 
            $v_entrega_marca = $v_entrega[$i]->marcas->marca;
            $v_entrega_submarca = $v_entrega[$i]->submarcas->submarca;
            $v_entrega_color = $v_entrega[$i]->color;
            $v_entrega_modelo = $v_entrega[$i]->modelo;

            switch ($v_entrega[$i]->clientes->id) {
                case 1:
                    $aseguradora = 'G';
                    break;

                case 3:
                    $aseguradora = 'P';
                    break;
                
                case 4;
                    $aseguradora = 'Q';
                    break;

                case 5:
                    $aseguradora = 'M';
                    break;
                
                case 6;
                    $aseguradora = 'B';
                    break;
                default:
                    $aseguradora = ':)';
                    break;
            }
            $pdf->Cell(10, 8, utf8_decode($i), 1, 0, 'C');
            $pdf->Cell(70, 8, utf8_decode($v_entrega_marca.' '.$v_entrega_submarca.' '.$v_entrega_color.' '.$v_entrega_modelo), 1, 0, 'L');
            $pdf->Cell(15, 8, utf8_decode($aseguradora), 1, 0, 'L');
            $pdf->Cell(95, 8, utf8_decode(''), 1, 1, 'L');
        }
        // salto de linea y preparo todo el siguiente recuadro
        $pdf->Ln();
        $pdf->SetFont('Arial','B',12);
        $pdf->Cell(190, 8, utf8_decode('Resumen de vehiculos para pulir de la semana # '. date('W')), 1, 1, 'C');
        $pdf->Cell(10, 8, utf8_decode('#'), 1, 0, 'C');
        $pdf->Cell(70, 8, utf8_decode('Vehiculo'), 1, 0, 'C');
        $pdf->Cell(15, 8, utf8_decode('Seg'), 1, 0, 'C');
        $pdf->Cell(25, 8, utf8_decode('Detallador'), 1, 0, 'C');
        $pdf->Cell(70, 8, utf8_decode('Comentarios'), 1, 1, 'C');
        //obtengo la informacion correspondiente a la siguiente tabla relacionada a pulido
        $v_pulido = Vehiculo::with(['marcas:id,marca', 'submarcas:id,submarca', 'clientes:id,nombre', 'asesores:id,nombre,a_paterno,a_materno', 'estatus:id,status', 'personalDetallado:id,nombre'])
                        ->select('id_aux','id','estatus_id','modelo', 'color', 'marca_id', 'linea_id', 'cliente_id', 'placas', 'id_asesor', 'no_siniestro', 'fecha_salida_taller', 'comentario_detallado', 'asignado_detallado')
                        ->where('estatus_id', 5)
                        ->where('aplica_detallado', 1)
                        ->whereNotNull('fecha_detallado')
                        ->where('fecha_detallado', '<>','0000-00-00')
                        ->get();
        //dd($v_pulido);
        // lleno la tabla y le cambio la letra
        $pdf->SetFont('Arial','',12);
        for ($i=0; $i < sizeof($v_pulido); $i++) { 
            $v_pulido_marca = $v_pulido[$i]->marcas->marca;
            $v_pulido_submarca = $v_pulido[$i]->submarcas->submarca;
            $v_pulido_color = $v_pulido[$i]->color;
            $v_pulido_modelo = $v_pulido[$i]->modelo;

            switch ($v_pulido[$i]->clientes->id) {
                case 1:
                    $aseguradora = 'G';
                    break;

                case 3:
                    $aseguradora = 'P';
                    break;
                
                case 4;
                    $aseguradora = 'Q';
                    break;

                case 5:
                    $aseguradora = 'M';
                    break;
                
                case 6;
                    $aseguradora = 'B';
                    break;
                default:
                    $aseguradora = ':)';
                    break;
            }
            $pdf->Cell(10, 8, utf8_decode($i), 1, 0, 'C');
            $pdf->Cell(70, 8, utf8_decode($v_pulido_marca.' '.$v_pulido_submarca.' '.$v_pulido_color.' '.$v_pulido_modelo), 1, 0, 'L');
            $pdf->Cell(15, 8, utf8_decode($aseguradora), 1, 0, 'L');
            $pdf->Cell(25, 8, utf8_decode($v_pulido[$i]->personalDetallado->nombre??''), 1, 0, 'C');
            $pdf->Cell(70, 8, utf8_decode($v_pulido[$i]->comentario_detallado??''), 1, 1, 'L');
        }
        // salto de linea y preparo todo el siguiente recuadro
        $pdf->Ln();
        $pdf->SetFont('Arial','B',12);
        $pdf->Cell(190, 8, utf8_decode('Resumen de vehiculos para armar de la semana # '. date('W')), 1, 1, 'C');
        $pdf->Cell(10, 8, utf8_decode('#'), 1, 0, 'C');
        $pdf->Cell(70, 8, utf8_decode('Vehiculo'), 1, 0, 'C');
        $pdf->Cell(15, 8, utf8_decode('Seg'), 1, 0, 'C');
        $pdf->Cell(25, 8, utf8_decode('Armador'), 1, 0, 'C');
        $pdf->Cell(70, 8, utf8_decode('Comentarios'), 1, 1, 'C');
        //obtengo la informacion correspondiente a la siguiente tabla relacionada a armado
        $v_armado = Vehiculo::with(['marcas:id,marca', 'submarcas:id,submarca', 'clientes:id,nombre', 'asesores:id,nombre,a_paterno,a_materno', 'estatus:id,status', 'personalArmado:id,nombre'])
                            ->select('id_aux','id','estatus_id','modelo', 'color', 'marca_id', 'linea_id', 'cliente_id', 'placas', 'id_asesor', 'no_siniestro', 'fecha_salida_taller', 'comentario_armado')
                            ->where('estatus_id', 5)
                            ->where('aplica_armado', 1)
                            ->whereNotNull('fecha_armado')
                            ->whereNotNull('fecha_hojalateria')
                            ->whereNotNull('fecha_pintura')
                            ->where('fecha_armado', '<>','0000-00-00')
                            ->whereNull('fecha_detallado')
                            ->get();
        //lleno la tabla y le cambio la letra
        $pdf->SetFont('Arial','',12);
        for ($i=0; $i < sizeof($v_armado); $i++) { 
            $v_armado_marca = $v_armado[$i]->marcas->marca;
            $v_armado_submarca = $v_armado[$i]->submarcas->submarca;
            $v_armado_color = $v_armado[$i]->color;
            $v_armado_modelo = $v_armado[$i]->modelo;

            switch ($v_armado[$i]->clientes->id) {
                case 1:
                    $aseguradora = 'G';
                    break;

                case 3:
                    $aseguradora = 'P';
                    break;
                
                case 4;
                    $aseguradora = 'Q';
                    break;

                case 5:
                    $aseguradora = 'M';
                    break;
                
                case 6;
                    $aseguradora = 'B';
                    break;
                default:
                    $aseguradora = ':)';
                    break;
            }
            $pdf->Cell(10, 8, utf8_decode($i), 1, 0, 'C');
            $pdf->Cell(70, 8, utf8_decode($v_armado_marca.' '.$v_armado_submarca.' '.$v_armado_color.' '.$v_armado_modelo), 1, 0, 'L');
            $pdf->Cell(15, 8, utf8_decode($aseguradora), 1, 0, 'L');
            $pdf->Cell(25, 8, utf8_decode($v_armado[$i]->personalArmado->nombre??''), 1, 0, 'C');
            $pdf->Cell(70, 8, utf8_decode($v_armado[$i]->comentario_armado??''), 1, 1, 'L');
        }
        // salto de linea y preparo todo el siguiente recuadro
        $pdf->Ln();
        $pdf->SetFont('Arial','B',12);
        $pdf->Cell(190, 8, utf8_decode('Resumen de vehiculos para pintar de la semana # '. date('W')), 1, 1, 'C');
        $pdf->Cell(10, 8, utf8_decode('#'), 1, 0, 'C');
        $pdf->Cell(70, 8, utf8_decode('Vehiculo'), 1, 0, 'C');
        $pdf->Cell(15, 8, utf8_decode('Seg'), 1, 0, 'C');
        $pdf->Cell(25, 8, utf8_decode('Pintor'), 1, 0, 'C');
        $pdf->Cell(70, 8, utf8_decode('Comentarios'), 1, 1, 'C');
        //obtengo la informacion correspondiente a la siguiente tabla relacionada a pintura
        $v_pintura = Vehiculo::with(['marcas:id,marca', 'submarcas:id,submarca', 'clientes:id,nombre', 'asesores:id,nombre,a_paterno,a_materno', 'estatus:id,status', 'personalPintura:id,nombre'])
                            ->select('id_aux','id','estatus_id','modelo', 'color', 'marca_id', 'linea_id', 'cliente_id', 'placas', 'id_asesor', 'no_siniestro', 'fecha_salida_taller', 'comentario_pintura')
                            ->where('estatus_id', 5)
                            ->where('aplica_pintura', 1)
                            ->whereNotNull('fecha_pintura')
                            ->whereNotNull('fecha_hojalateria')
                            ->where('fecha_armado', '<>','0000-00-00')
                            ->get();
        //lleno la tabla y le cambio la letra
        $pdf->SetFont('Arial','',12);
        for ($i=0; $i < sizeof($v_pintura); $i++) { 
            $v_pintura_marca = $v_pintura[$i]->marcas->marca;
            $v_pintura_submarca = $v_pintura[$i]->submarcas->submarca;
            $v_pintura_color = $v_pintura[$i]->color;
            $v_pintura_modelo = $v_pintura[$i]->modelo;

            switch ($v_pintura[$i]->clientes->id) {
                case 1:
                    $aseguradora = 'G';
                    break;

                case 3:
                    $aseguradora = 'P';
                    break;
                
                case 4;
                    $aseguradora = 'Q';
                    break;

                case 5:
                    $aseguradora = 'M';
                    break;
                
                case 6;
                    $aseguradora = 'B';
                    break;
                default:
                    $aseguradora = ':)';
                    break;
            }
            $pdf->Cell(10, 8, utf8_decode($i), 1, 0, 'C');
            $pdf->Cell(70, 8, utf8_decode($v_pintura_marca.' '.$v_pintura_submarca.' '.$v_pintura_color.' '.$v_pintura_modelo), 1, 0, 'L');
            $pdf->Cell(15, 8, utf8_decode($aseguradora), 1, 0, 'L');
            $pdf->Cell(25, 8, utf8_decode($v_pintura[$i]->personalPintura->nombre??''), 1, 0, 'C');
            $pdf->Cell(70, 8, utf8_decode($v_pintura[$i]->comentario_pintura??''), 1, 1, 'L');
        }
        // salto de linea y preparo todo el siguiente recuadro
        $pdf->Ln();
        $pdf->SetFont('Arial','B',12);
        $pdf->Cell(190, 8, utf8_decode('Resumen de vehiculos para hojalatear de la semana # '. date('W')), 1, 1, 'C');
        $pdf->Cell(10, 8, utf8_decode('#'), 1, 0, 'C');
        $pdf->Cell(70, 8, utf8_decode('Vehiculo'), 1, 0, 'C');
        $pdf->Cell(15, 8, utf8_decode('Seg'), 1, 0, 'C');
        $pdf->Cell(25, 8, utf8_decode('Hojalatero'), 1, 0, 'C');
        $pdf->Cell(70, 8, utf8_decode('Comentarios'), 1, 1, 'C');
        //obtengo la informacion correspondiente a la siguiente tabla relacionada a pintura
        $v_hojalateria = Vehiculo::with(['marcas:id,marca', 'submarcas:id,submarca', 'clientes:id,nombre', 'asesores:id,nombre,a_paterno,a_materno', 'estatus:id,status', 'personalHojalateria:id,nombre'])
                            ->select('id_aux','id','estatus_id','modelo', 'color', 'marca_id', 'linea_id', 'cliente_id', 'placas', 'id_asesor', 'no_siniestro', 'fecha_salida_taller', 'comentarios_hojalateria')
                            ->where('estatus_id', 5)
                            ->where('aplica_hojalateria', 1)
                            ->whereNotNull('fecha_hojalateria')
                            ->where('fecha_pintura', '<>','0000-00-00')
                            ->get();
        //lleno la tabla y le cambio la letra
        $pdf->SetFont('Arial','',12);
        for ($i=0; $i < sizeof($v_hojalateria); $i++) { 
            $v_hojalateria_marca = $v_hojalateria[$i]->marcas->marca;
            $v_hojalateria_submarca = $v_hojalateria[$i]->submarcas->submarca;
            $v_hojalateria_color = $v_hojalateria[$i]->color;
            $v_hojalateria_modelo = $v_hojalateria[$i]->modelo;

            switch ($v_hojalateria[$i]->clientes->id) {
                case 1:
                    $aseguradora = 'G';
                    break;

                case 3:
                    $aseguradora = 'P';
                    break;
                
                case 4;
                    $aseguradora = 'Q';
                    break;

                case 5:
                    $aseguradora = 'M';
                    break;
                
                case 6;
                    $aseguradora = 'B';
                    break;
                default:
                    $aseguradora = ':)';
                    break;
            }
            $pdf->Cell(10, 8, utf8_decode($i), 1, 0, 'C');
            $pdf->Cell(70, 8, utf8_decode($v_hojalateria_marca.' '.$v_hojalateria_submarca.' '.$v_hojalateria_color.' '.$v_hojalateria_modelo), 1, 0, 'L');
            $pdf->Cell(15, 8, utf8_decode($aseguradora), 1, 0, 'L');
            $pdf->Cell(25, 8, utf8_decode($v_hojalateria[$i]->personalHojalateria->nombre??''), 1, 0, 'C');
            $pdf->Cell(70, 8, utf8_decode($v_hojalateria[$i]->comentario_hojalateria??''), 1, 1, 'L');
        }
        
        //dd($v_hojalateria);
        $pdf->Output();
        exit;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Vehiculo  $vehiculo
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
        $u_vehiculo = Vehiculo::with(['marcas:id,marca', 'submarcas:id,submarca', 'clientes:id,nombre', 'asesores:id,nombre,a_paterno,a_materno', 'estatus:id,status'])
                                        ->where('id', $request->exp)->first();

        $pdf = new FPDF();
        $pdf->AddPage();
        $pdf->SetFont('Arial','',14);
        $pdf->Image('../public/img/alta_vehiculoo.jpg', -10, -10, 0, 170);
        $pdf->SetXY('148', '37');
        $pdf->Cell(0, 0, utf8_decode($request->expediente), 0, 0, 'I');
        $pdf->SetXY('148', '44.5');
        $pdf->Cell(0, 0, utf8_decode($u_vehiculo->no_siniestro??''), 0, 0, 'I');
        $pdf->SetXY('148', '52.4');
        $pdf->Cell(0, 0, utf8_decode(date("d/m/Y")), 0, 0, 'I');
        $pdf->SetXY('54', '57');
        $pdf->Cell(0, 0, utf8_decode($uc[0]['nombre']??''), 0, 0, 'I');
        $pdf->SetXY('35', '69');
        $pdf->Cell(0, 0, utf8_decode($uc[0]['telefono']??''), 0, 0, 'I');
        $pdf->SetXY('112', '69');
        $pdf->Cell(0, 0, utf8_decode($uc[0]['correo']??''), 0, 0, 'I');
        $pdf->SetXY('27', '110');
        $pdf->Cell(0, 0, utf8_decode($u_vehiculo->marcas->marca??''), 0, 0, 'I');
        $pdf->SetXY('92', '110');
        $pdf->Cell(0, 0, utf8_decode($u_vehiculo->submarcas->submarca??''), 0, 0, 'I');
        $pdf->SetXY('152', '110');
        $pdf->Cell(0, 0, utf8_decode($u_vehiculo->modelo??''), 0, 0, 'I');
        $pdf->SetXY('26', '127.5');
        $pdf->Cell(0, 0, utf8_decode($u_vehiculo->color??''), 0, 0, 'I');
        $pdf->SetXY('82', '127.5');
        $pdf->Cell(0, 0, utf8_decode($u_vehiculo->placas??''), 0, 0, 'I');
        $pdf->SetXY('142', '127.5');
        $pdf->Cell(0, 0, utf8_decode($u_vehiculo->asesores->nombre." ".$u_vehiculo->asesores->a_paterno." ".$u_vehiculo->asesores->a_materno), 0, 0, 'I');
        $pdf->SetXY('42', '139');
        $pdf->Cell(0, 0, utf8_decode($u_vehiculo->clientes->nombre??''), 0, 0, 'I');
        $pdf->Output();
        exit;
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