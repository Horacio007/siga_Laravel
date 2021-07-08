<?php

namespace App\Http\Controllers;

use App\Models\Checklist;
use App\Models\Vehiculo;
use App\Models\Clientes;
use App\Models\Archivos;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade as PDF;

class ChecklistController extends Controller
{
    use SoftDeletes;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $list_checklist = DB::select("SELECT checklist.id, checklist.id_aux_vehiculo, modelosv.marca, submarcav.submarca, vehiculo.color, vehiculo.modelo, aseguradoras.nombre, vehiculo.no_siniestro FROM vehiculo, checklist, modelosv, submarcav, aseguradoras WHERE checklist.id_aux_vehiculo = vehiculo.id AND vehiculo.marca_id = modelosv.id AND vehiculo.linea_id = submarcav.id AND vehiculo.cliente_id = aseguradoras.id ORDER BY  checklist.id");
        return view('recepcion.checklist.l_checklist', compact('list_checklist'));
    }

    public function i_checklist(){
        return view('recepcion.checklist.i_checklist');
    }

    public function exist_chv(Request $request){

        $vehiculo = Vehiculo::select('id')
                            ->where('id', $request['id'])
                            ->get();
        if ($vehiculo->isEmpty()) {
            return response()->json(['vehiculo' => 0]);
        } else {
            $e_check = Checklist::select('id_aux_vehiculo')
                        ->where('id_aux_vehiculo', $request['id'])
                        ->get();

            if ($e_check->isEmpty()) {
                return response()->json(['vehiculo' => 1]);
            } else {
                return response()->json(['vehiculo' => 00]);
            }
            
        }
        
    }

    public function create_pdf(Request $request){

        $vehiculo = Vehiculo::with(['marcas:id,marca', 'submarcas:id,submarca', 'clientes:id,nombre', 'asesores:id,nombre,a_paterno,a_materno'])
                            ->where('id', $request['exp'])
                            ->select('modelo', 'color', 'marca_id', 'linea_id', 'cliente_id', 'placas', 'id_asesor')
                            ->first();

        $r = Vehiculo::select('id_aux')
                    ->where('id', $request['exp'])
                    ->first();

        $cliente = Clientes::select('nombre', 'telefono', 'correo')
                            ->where('id',$r['id_aux'])
                            ->first();

        $checklist = Checklist::select('*')
                                ->where('id_aux_vehiculo', $request->exp)
                                ->first();

        $dia = date("d");
        $mes = date('m');
        $año = date('Y');

        $pdf = app('dompdf.wrapper');

        if ($vehiculo['clientes']['nombre'] == 'Particular') {
            $aseguradora = '<p style="position: absolute; top: 163; left: 453;">X</p>';
        } else {
            $aseguradora = '<p style="position: absolute; top: 132; left: 430;">'.$vehiculo['clientes']['nombre'].'</p>';
        }

        if ($checklist['luces_front'] == 1) {
            $lucesfrontales = '<p style="position: absolute; top: 335; left: 143;">X</p>';
        } else {
            $lucesfrontales = '<p style="position: absolute; top: 335; left: 157;">X</p>';
        }

        if ($checklist['cuarto_luces'] == 1) {
            $cuarto_luces = '<p style="position: absolute; top: 348.5; left: 143;">X</p>';
        } else {
            $cuarto_luces = '<p style="position: absolute; top: 348.5; left: 157.5;">X</p>';
        }
        
        if ($checklist['direccional_izq'] == 1) {
            $direccional_izq = '<p style="position: absolute; top: 362.5; left: 143;">X</p>';
        } else {
            $direccional_izq = '<p style="position: absolute; top: 362.5; left: 157.5;">X</p>';
        }
        
        if ($checklist['direccional_der'] == 1) {
            $direccional_der = '<p style="position: absolute; top: 376; left: 143;">X</p>';
        } else {
            $direccional_der = '<p style="position: absolute; top: 376; left: 157.5;">X</p>';
        }
        
        if ($checklist['espejo_der'] == 1) {
            $espejo_der = '<p style="position: absolute; top: 390; left: 143;">X</p>';
        } else {
            $espejo_der = '<p style="position: absolute; top: 390; left: 157.5;">X</p>';
        }

        if ($checklist['espejo_izq'] == 1) {
            $espejo_izq = '<p style="position: absolute; top: 403; left: 143;">X</p>';  
        } else {
            $espejo_izq = '<p style="position: absolute; top: 403; left: 157.5;">X</p>';
        }
        
        if ($checklist['cristales'] == 1) {
            $cristales = '<p style="position: absolute; top: 417; left: 143;">X</p>';
        } else {
            $cristales = '<p style="position: absolute; top: 417; left: 157.5;">X</p>';
        }
        
        if ($checklist['emblema'] == 1) {
            $emblema = '<p style="position: absolute; top: 431; left: 143;">X</p>';
        } else {
            $emblema = '<p style="position: absolute; top: 431; left: 157.5;">X</p>';
        }
        
        if ($checklist['llantas'] == 1) {
            $llantas = '<p style="position: absolute; top: 444.5; left: 143;">X</p>';
        } else {
            $llantas = '<p style="position: absolute; top: 444.5; left: 157.2;">X</p>';
        }
        
        if ($checklist['tapon_ruedas'] == 1) {
            $tapon_ruedas = '<p style="position: absolute; top: 457; left: 143;">X</p>';
        } else {
            $tapon_ruedas = '<p style="position: absolute; top: 457; left: 157;">X</p>';
        }
        
        if ($checklist['molduras'] == 1) {
            $molduras = '<p style="position: absolute; top: 471; left: 143;">X</p>';
        } else {
            $molduras = '<p style="position: absolute; top: 471; left: 157;">X</p>';
        }
        
        if ($checklist['tapa_gasolina'] == 1) {
            $tapa_gasolina = '<p style="position: absolute; top: 484.5; left: 143;">X</p>';
        } else {
            $tapa_gasolina = '<p style="position: absolute; top: 484.5; left: 157;">X</p>';
        }

        if ($checklist['stopp'] == 1) {
            $stopp = '<p style="position: absolute; top: 498; left: 143;">X</p>';
        } else {
            $stopp = '<p style="position: absolute; top: 498; left: 157;">X</p>';
        }
        
        if ($checklist['luz_tras_izq'] == 1) {
            $luz_tras_izq = '<p style="position: absolute; top: 511.8; left: 143;">X</p>';
        } else {
            $luz_tras_izq = '<p style="position: absolute; top: 511.8; left: 157;">X</p>';
        }
        
        if ($checklist['luz_tras_der'] == 1) {
            $luz_tras_der = '<p style="position: absolute; top: 525.5; left: 143;">X</p>';
        } else {
            $luz_tras_der = '<p style="position: absolute; top: 525.5; left: 157;">X</p>';
        }
        
        if ($checklist['direccional_tras_izq'] == 1) {
            $direccional_tras_izq = '<p style="position: absolute; top: 538.7; left: 143;">X</p>';
        } else {
            $direccional_tras_izq = '<p style="position: absolute; top: 538.7; left: 157;">X</p>';
        }

        if ($checklist['direccional_tras_der'] == 1) {
            $direccional_tras_der = '<p style="position: absolute; top: 552; left: 143;">X</p>';
        } else {
            $direccional_tras_der = '<p style="position: absolute; top: 552; left: 157;">X</p>';
        }
        
        if ($checklist['luz_placa'] == 1) {
            $luz_placa = '<p style="position: absolute; top: 566; left: 143;">X</p>';
        } else {
            $luz_placa = '<p style="position: absolute; top: 566; left: 157;">X</p>';
        }
        
        if ($checklist['luz_cajuela'] == 1) {
            $luz_cajuela = '<p style="position: absolute; top: 578.5; left: 143;">X</p>';
        } else {
            $luz_cajuela = '<p style="position: absolute; top: 578.5; left: 157;">X</p>';
        }
        
        if ($checklist['luz_tablero'] == 1) {
            $luz_tablero = '<p style="position: absolute; top: 337; left: 292;">X</p>';
        } else {
            $luz_tablero = '<p style="position: absolute; top: 337; left: 310.2;">X</p>';
        }
        
        if ($checklist['instrumentos_tablero'] == 1) {
            $instrumentos_tablero = '<p style="position: absolute; top: 351; left: 292;">X</p>';
        } else {
            $instrumentos_tablero = '<p style="position: absolute; top: 351; left: 310.2;">X</p>';
        }

        if ($checklist['llaves'] == 1) {
            $llaves = '<p style="position: absolute; top: 364.7; left: 292;">X</p>';
        } else {
            $llaves = '<p style="position: absolute; top: 364.7; left: 310.2;">X</p>';
        }
        
        if ($checklist['limpia_parabrisas_fron'] == 1) {
            $limpia_parabrisas_fron = '<p style="position: absolute; top: 378.5; left: 292;">X</p>';
        } else {
            $limpia_parabrisas_fron = '<p style="position: absolute; top: 378.5; left: 310.2;">X</p>';
        }
        
        if ($checklist['limpia_parabrisas_tras'] == 1) {
            $limpia_parabrisas_tras = '<p style="position: absolute; top: 392; left: 292;">X</p>';
        } else {
            $limpia_parabrisas_tras = '<p style="position: absolute; top: 392; left: 310.2;">X</p>';
        }

        if ($checklist['estereo'] == 1) {
            $estereo = '<p style="position: absolute; top: 406; left: 292;">X</p>';
        } else {
            $estereo = '<p style="position: absolute; top: 406; left: 310.2;">X</p>';
        }
        
        if ($checklist['bocinas_fron'] == 1) {
            $bocinas_fron = '<p style="position: absolute; top: 420; left: 292;">X</p>';
        } else {
            $bocinas_fron = '<p style="position: absolute; top: 420; left: 310.2;">X</p>';
        }
        
        if ($checklist['bocinas_tras'] == 1) {
            $bocinas_tras = '<p style="position: absolute; top: 433; left: 292;">X</p>';
        } else {
            $bocinas_tras = '<p style="position: absolute; top: 433; left: 310.2;">X</p>';
        }
        
        if ($checklist['encendedor'] == 1) {
            $encendedor = '<p style="position: absolute; top: 446; left: 292;">X</p>';
        } else {
            $encendedor = '<p style="position: absolute; top: 446; left: 310.2;">X</p>';
        }

        if ($checklist['espejo_retrovisor'] == 1) {
            $espejo_retrovisor = '<p style="position: absolute; top: 460; left: 292;">X</p>';
        } else {
            $espejo_retrovisor = '<p style="position: absolute; top: 460; left: 310.2;">X</p>';
        }
        
        if ($checklist['cenicero'] == 1) {
            $cenicero = '<p style="position: absolute; top: 474; left: 292;">X</p>';
        } else {
            $cenicero = '<p style="position: absolute; top: 474; left: 310.2;">X</p>';
        }
        
        if ($checklist['cinturones'] == 1) {
            $cinturones = '<p style="position: absolute; top: 487; left: 292;">X</p>';
        } else {
            $cinturones = '<p style="position: absolute; top: 487; left: 310.2;">X</p>';
        }
        
        if ($checklist['luz_int'] == 1) {
            $luz_int = '<p style="position: absolute; top: 501; left: 292;">X</p>';
        } else {
            $luz_int = '<p style="position: absolute; top: 501; left: 310.2;">X</p>';
        }

        if ($checklist['parasol_izq'] == 1) {
            $parasol_izq = '<p style="position: absolute; top: 515; left: 292;">X</p>';
        } else {
            $parasol_izq = '<p style="position: absolute; top: 515; left: 310.2;">X</p>';
        }
        
        if ($checklist['parasol_der'] == 1) {
            $parasol_der = '<p style="position: absolute; top: 528; left: 292;">X</p>';
        } else {
            $parasol_der = '<p style="position: absolute; top: 528; left: 310.2;">X</p>';
        }
        
        if ($checklist['vestiduras_tela'] == 1) {
            $vestiduras_tela = '<p style="position: absolute; top: 542; left: 292;">X</p>';
        } else {
            $vestiduras_tela = '<p style="position: absolute; top: 542; left: 310.2;">X</p>';
        }
        
        if ($checklist['vestiduras_piel'] == 1) {
            $vestiduras_piel = '<p style="position: absolute; top: 555; left: 292;">X</p>';
        } else {
            $vestiduras_piel = '<p style="position: absolute; top: 555; left: 310.2;">X</p>';
        }

        if ($checklist['testigos_tablero'] == 1) {
            $testigos_tablero = '<p style="position: absolute; top: 568; left: 292;">X</p>';
        } else {
            $testigos_tablero = '<p style="position: absolute; top: 568; left: 310.2;">X</p>';
        }
        
        if ($checklist['refaccion'] == 1) {
            $refaccion = '<p style="position: absolute; top: 342; left: 438;">X</p>';
            
        } else {
            $refaccion = '<p style="position: absolute; top: 342; left: 454;">X</p>';
        }
        
        if ($checklist['dado_seguridad'] == 1) {
            $dado_seguridad = '<p style="position: absolute; top: 357; left: 438;">X</p>';
        } else {
            $dado_seguridad = '<p style="position: absolute; top: 357; left: 454;">X</p>';
        }
        
        if ($checklist['gato'] == 1) {
            $gato = '<p style="position: absolute; top: 372; left: 438;">X</p>';
        } else {
            $gato = '<p style="position: absolute; top: 372; left: 454;">X</p>';
        }
        
        if ($checklist['maneral'] == 1) {
            $maneral = '<p style="position: absolute; top: 387; left: 438;">X</p>';
        } else {
            $maneral = '<p style="position: absolute; top: 387; left: 454;">X</p>';
        }
        
        if ($checklist['herramientas'] == 1) {
            $herramientas = '<p style="position: absolute; top: 402; left: 438;">X</p>';
        } else {
            $herramientas = '<p style="position: absolute; top: 402; left: 454;">X</p>';
        }
        
        if ($checklist['triangulos'] == 1) {
            $triangulos = '<p style="position: absolute; top: 417; left: 438;">X</p>';
        } else {
            $triangulos = '<p style="position: absolute; top: 417; left: 454;">X</p>';
        }
        
        if ($checklist['botiquin'] == 1) {
            $botiquin = '<p style="position: absolute; top: 433; left: 438;">X</p>';
        } else {
            $botiquin = '<p style="position: absolute; top: 433; left: 454;">X</p>';
        }
        
        if ($checklist['extintor'] == 1) {
            $extintor = '<p style="position: absolute; top: 448; left: 438;">X</p>';
        } else {
            $extintor = '<p style="position: absolute; top: 448; left: 454;">X</p>';
        }
        
        if ($checklist['cables'] == 1) {
            $cables = '<p style="position: absolute; top: 463; left: 438;">X</p>';
        } else {
            $cables = '<p style="position: absolute; top: 463; left: 454;">X</p>';
        }
        
        if ($checklist['claxon'] == 1) {
            $claxon = '<p style="position: absolute; top: 496; left: 447;">X</p>';
        } else {
            $claxon = '<p style="position: absolute; top: 496; left: 464;">X</p>';
        }
        
        if ($checklist['tapon_aceite'] == 1) {
            $tapon_aceite = '<p style="position: absolute; top: 510; left: 447;">X</p>';
        } else {
            $tapon_aceite = '<p style="position: absolute; top: 510; left: 464;">X</p>';
        }
        
        if ($checklist['tapon_gasolina'] == 1) {
            $tapon_gasolina = '<p style="position: absolute; top: 523; left: 447;">X</p>';
        } else {
            $tapon_gasolina = '<p style="position: absolute; top: 523; left: 464;">X</p>';
        }
        
        if ($checklist['tapon_radiador'] == 1) {
            $tapon_radiador = '<p style="position: absolute; top: 537; left: 447;">X</p>';
        } else {
            $tapon_radiador = '<p style="position: absolute; top: 537; left: 464;">X</p>';
        }
        
        if ($checklist['vayoneta_aceite'] == 1) {
            $vayoneta_aceite = '<p style="position: absolute; top: 550; left: 447;">X</p>';
        } else {
            $vayoneta_aceite = '<p style="position: absolute; top: 550; left: 464;">X</p>';
        }
        
        if ($checklist['bateria'] == 1) {
            $bateria = '<p style="position: absolute; top: 563; left: 447;">X</p>';
        } else {
            $bateria = '<p style="position: absolute; top: 563; left: 464;">X</p>';
        }

        $observaciones = $checklist['observaciones'];
        strlen($observaciones);
        $observaciones = explode('/', $observaciones);
        $y = 608;
        $obs = '';
        for ($i=0; $i < count($observaciones); $i++) {
            $obs.= '<p style="position: absolute; top: '.$y.'; left: 45;">'.$observaciones[$i].'</p>';
            $y = $y+12;
        }
        
        switch ($checklist['cambustible']) {
            case 1:
                $combustible = '<strong><h2 style="position: absolute; top: 591; left: 424;">|</h2></strong>';
                break;
            case 2:
                $combustible = '<strong><h2 style="position: absolute; top: 598; left: 444.5;">|</h2></strong>';
                break;
            case 3:
                $combustible = '<strong><h2 style="position: absolute; top: 602; left: 468;">|</h2></strong>';
                break;
            case 4:
                $combustible = '<strong><h2 style="position: absolute; top: 600; left: 492;">|</h2></strong>';
                break;
            case 5:
                $combustible = '<strong><h2 style="position: absolute; top: 592.5; left: 518;">|</h2></strong>';
                break;
            
            default:
                echo "No tiene combustible";
                break;
        }

        $kilometraje = '<p style="position: absolute; top: 700; left: 460;">'.$checklist['kilometraje'].'</p>';

        $dueno_v = '<p style="position: absolute; top: 701; left: 65;">'.$cliente['nombre'].'</p>';

        $asesor = '<p style="position: absolute; top: 703; left: 282;">'.$vehiculo['asesores']['nombre'].' '.$vehiculo['asesores']['a_paterno'].' '.$vehiculo['asesores']['a_materno'].'</p>';

        $firmas = Archivos::where('id_vehiculo',$request['exp'])->get();
        $firma_c = $firmas[0]['ruta'];
        $firma_a = $firmas[1]['ruta'];
        
        $pdf->loadHTML('<!DOCTYPE html>
        <html lang="en">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <meta http-equiv="X-UA-Compatible" content="ie=edge">
            <title>Checklist</title>
        </head>
        <body background="img/checklist2.jpg">
            <p style="position: absolute; top: 20px; left: 560px;">'.$request['exp'].'</p>
            <p style="position: absolute; top: 90px; left: 572px;">'.$dia.'</p>
            <p style="position: absolute; top: 90px; left: 615px;">'.$mes.'</p>
            <p style="position: absolute; top: 91px; left: 655px;">'.$año.'</p>
            <p style="position: absolute; top: 160px; left: 128px;">'.$cliente['nombre'].'</p>
            <p style="position: absolute; top: 190px; left: 132px;">'.$cliente['telefono'].'</p>
            <p style="position: absolute; top: 219px; left: 128px;">'.$cliente['correo'].'</p>
            <p style="position: absolute; top: 118; left: 297;">'.$vehiculo['marcas']['marca'].'</p>
            <p style="position: absolute; top: 140; left: 307;">'.$vehiculo['submarcas']['submarca'].'</p>
            <p style="position: absolute; top: 160; left: 301;">'.$vehiculo['modelo'].'</p>
            <p style="position: absolute; top: 181; left: 296;">'.$vehiculo['color'].'</p>
            <p style="position: absolute; top: 202; left: 300;">'.$vehiculo['placas'].'</p>
            '.$aseguradora.'
            '.$lucesfrontales.'
            '.$cuarto_luces.'
            '.$direccional_izq.'
            '.$direccional_der.'
            '.$espejo_der.'
            '.$espejo_izq.'
            '.$cristales.'
            '.$emblema.'
            '.$llantas.'
            '.$tapon_ruedas.'
            '.$molduras.'
            '.$tapa_gasolina.'
            '.$stopp.'
            '.$luz_tras_izq.'
            '.$luz_tras_der.'
            '.$direccional_tras_izq.'
            '.$direccional_tras_der.'
            '.$luz_placa.'
            '.$luz_cajuela.'
            '.$luz_tablero.'
            '.$instrumentos_tablero.'
            '.$llaves.'
            '.$limpia_parabrisas_fron.'
            '.$limpia_parabrisas_tras.'
            '.$estereo.'
            '.$bocinas_fron.'
            '.$bocinas_tras.'
            '.$encendedor.'
            '.$espejo_retrovisor.'
            '.$cenicero.'
            '.$cinturones.'
            '.$luz_int.'
            '.$parasol_izq.'
            '.$parasol_der.'
            '.$vestiduras_tela.'
            '.$vestiduras_piel.'
            '.$testigos_tablero.'
            '.$refaccion.'
            '.$dado_seguridad.'
            '.$gato.'
            '.$maneral.'
            '.$herramientas.'
            '.$triangulos.'
            '.$botiquin.'
            '.$extintor.'
            '.$cables.'
            '.$claxon.'
            '.$tapon_aceite.'
            '.$tapon_gasolina.'
            '.$tapon_radiador.'
            '.$vayoneta_aceite.'
            '.$bateria.'
            '.$obs.'
            '.$combustible.'
            '.$kilometraje.'
            '.$dueno_v.'
            '.$asesor.'
            <img id="firma" src="storage/'.$firma_c.'" width="150" height="100" style="position: absolute; top: 994px; left: 70; remove-bg: filter: brightness(1.1); mix-blend-mode: multiply;"></img>
            <img id="firma" src="storage/'.$firma_a.'" width="150" height="100" style="position: absolute; top: 994px; left: 300; remove-bg: filter: brightness(1.1); mix-blend-mode: multiply;"></img>
        </body>
        </body>
        </html>');
        
        return $pdf->stream($request['exp'].'_checklist');
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
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
        $data = $request->all();
        $check = new Checklist();
        foreach ($check->getFillable() as $field) {
            if (!isset($request[$field])) {
                $data[$field] = 0;
            }
        }
        //dd($data);
        $checklist = new Checklist($data);
        $checklist->id_aux_vehiculo = $request->expediente;
        $checklist->cambustible = $request->combustible;
        $checklist->kilometraje = $request->kilometraje;
        $checklist->observaciones = $request->observaciones;
    
        $firmas = ['firma_c', 'firma_a'];
        for ($i=0; $i < 2; $i++) {
            $archivos = new Archivos();
            $archivos->id_vehiculo = $request->expediente;
            $f = ''.$firmas[$i];
            $data_uri = $request->$f;
            $encoded_image = explode(",", $data_uri)[1];
            $decoded_image = base64_decode($encoded_image);
            $nombre = $request->expediente.'_'.$firmas[$i].'.png';
            Storage::disk('public')->put("files/$nombre", $decoded_image);
            $archivos->ruta = "files/$nombre";
            $archivos->save();
        }

        if ($checklist->save()) {
            return redirect()->route('i_checklist')->withSuccess('Checklist Registrado.');
        } else {
            return redirect()->route('i_checklist')->withError('Checklist no Registrado.');
        }
        
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Checklist  $checklist
     * @return \Illuminate\Http\Response
     */
    public function show(Checklist $checklist)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Checklist  $checklist
     * @return \Illuminate\Http\Response
     */
    public function edit(Checklist $checklist)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Checklist  $checklist
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Checklist $checklist)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Checklist  $checklist
     * @return \Illuminate\Http\Response
     */
    public function destroy(Checklist $checklist)
    {
        if ($checklist->delete()) {
            return redirect()->route('l_checklist')->with('success','Checklist Eliminado.');
        } else {
            return redirect()->route('l_checklist')->with('error','Checklist no Eliminado.');
        }
    }
}
