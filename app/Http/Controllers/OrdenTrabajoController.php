<?php

namespace App\Http\Controllers;

use App\Models\Orden_trabajo;
use App\Models\Vehiculo;
use App\Models\Asesores;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class OrdenTrabajoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $list_ordenes = DB::select("SELECT
                                    orden_trabajo.id,
                                    orden_trabajo.id_vehiculo,
                                    modelosv.marca,
                                    submarcav.submarca,
                                    vehiculo.modelo,
                                    aseguradoras.nombre,
                                    orden_trabajo.fecha,
                                    orden_trabajo.reparacion,
                                    orden_trabajo.observaciones,
                                    asesores.nombre
                                FROM
                                    vehiculo,
                                    orden_trabajo,
                                    modelosv,
                                    submarcav,
                                    aseguradoras,
                                    asesores
                                WHERE
                                    orden_trabajo.id_vehiculo = vehiculo.id
                                AND vehiculo.marca_id = modelosv.id
                                AND vehiculo.linea_id = submarcav.id
                                AND aseguradoras.id = vehiculo.cliente_id
                                AND asesores.id = orden_trabajo.elaboro
                                ORDER BY
                                    orden_trabajo.id");

        return view('taller.ordenesTrabajo.l_ordenesTrabajo', compact('list_ordenes'));
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

    public function i_ordenest(){
        $vehiculos = Vehiculo::with(['marcas:id,marca', 'submarcas:id,submarca', 'clientes:id,nombre', 'asesores:id,nombre,a_paterno,a_materno', 'estatus:id,status'])
                            ->select('id','estatus_id','modelo', 'color', 'marca_id', 'linea_id', 'cliente_id', 'placas', 'id_asesor', 'no_siniestro', 'fecha_llegada')
                            ->where('estatus_id','5')
                            ->orWhere('estatus_id','6')
                            ->orWhere('estatus_id','7')
                            ->orderBy('id_aux')
                            ->get();

        return view('taller.ordenesTrabajo.i_ordenesTrabajo', compact('vehiculos'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //echo count($reparacion);
        $r = '';
        $h = '';
        $p = '';
        $m = '';

        $f =  Date('Y-m-d');

        for ($i=0; $i < count($request->reparacion); $i++) { 
            $r .= $request->reparacion[$i].'/';
            $h .= strval($request->hojalateria[$i]).'/';
            $p .= strval($request->pintura[$i]).'/';
            $m .= strval($request->mecanica[$i]).'/';
        }

        $ordent = new Orden_trabajo();
        $ordent->id_vehiculo = $request->id;
        $ordent->fecha = $f;
        $ordent->reparacion = $r;
        $ordent->hojalateria = $h;
        $ordent->pintura = $p;
        $ordent->mecanica = $m;
        $ordent->observaciones = $request->observaciones;
        $ordent->elaboro = $request->elaboro;

        if ($ordent->save()) {
            return 1;
        } else {
            return 'Orden de Trabajo no registrada';
        }
        
    }

    public function create_pdfot(Request $request){

        $r = Orden_trabajo::select('id_vehiculo')
                    ->where('id', $request->exp)
                    ->first();

        $vehiculo = Vehiculo::with(['marcas:id,marca', 'submarcas:id,submarca', 'clientes:id,nombre', 'asesores:id,nombre,a_paterno,a_materno','estatus:id,status'])
                            ->where('id', $r->id_vehiculo)
                            ->select('modelo', 'color', 'marca_id', 'linea_id', 'cliente_id', 'placas', 'id_asesor', 'estatus_id')
                            ->first();

        $orden = Orden_trabajo::select('*')->where('id',$request->exp)->first();

        $y = 212;
        $reparacion = $orden['reparacion'];
        strlen($reparacion);
        $reparacion = explode('/', $orden['reparacion']);
        $rep = "";
        for ($i=0; $i < count($reparacion); $i++) { 
            $rep.= '<p style="position: absolute; top: '.$y.'px; left: 93px;">'.$reparacion[$i].'</p>';
            $y = $y + 23;
        }

        $y = 212;
        $hojalateria = $orden['hojalateria'];
        strlen($hojalateria);
        $hojalateria = explode('/', $orden['hojalateria']);
        $hoja = "";
        for ($i=0; $i < count($hojalateria); $i++) {
            if ($hojalateria[$i] == 1) {
                $hoja.= '<p style="position: absolute; top: '.$y.'px; left: 540px;">X</p>';
                $y = $y + 23;
            } else {
                $hoja.= '<p style="position: absolute; top: '.$y.'px; left: 540px;"></p>';
                $y = $y + 23;
            }
        }

        $y = 212;
        $pintura = $orden['pintura'];
        strlen($pintura);
        $pintura = explode('/', $orden['pintura']);
        $pin = "";
        for ($i=0; $i < count($pintura); $i++) {
            if ($pintura[$i] == 1) {
                $pin.= '<p style="position: absolute; top: '.$y.'px; left: 630px;">X</p>';
                $y = $y + 23;
            } else {
                $pin.= '<p style="position: absolute; top: '.$y.'px; left: 630px;"></p>';
                $y = $y + 23;
            }
        }

        $y = 212;
        $mecanica = $orden['mecanica'];
        strlen($mecanica);
        $mecanica = explode('/', $orden['mecanica']);
        $mec = "";
        for ($i=0; $i < count($mecanica); $i++) {
            if ($mecanica[$i] == 1) {
                $mec.= '<p style="position: absolute; top: '.$y.'px; left: 720px;">X</p>';
                $y = $y + 23;
            } else {
                $mec.= '<p style="position: absolute; top: '.$y.'px; left: 720px;"></p>';
                $y = $y + 23;
            }
        }

        $y = 850;
        $observaciones = $orden['observaciones'];
        strlen($observaciones);
        $observaciones = explode('/', $orden['observaciones']);
        $obs = "";
        for ($i=0; $i < count($observaciones); $i++) {
            if (strlen($observaciones[$i]) > 43) {
                $p1 = substr($observaciones[$i], 0, 80);
                $p2 = substr($observaciones[$i], 80, 160);
                $obs.= '<p style="position: absolute; top: '.$y.'px; left: 260px;">'.$p1.'</p>';
                $y = $y + 23;
                $obs.= '<p style="position: absolute; top: '.$y.'px; left: 260px;">'.$p2.'</p>';
                $y = $y + 23;
            } else {
                $p1 = substr($observaciones[$i], 0, 80);
                $obs.= '<p style="position: absolute; top: '.$y.'px; left: 260px;">'.$p1.'</p>';
                $y = $y + 23;
            }
        }

        $elaboro = Asesores::select('nombre', 'a_paterno', 'a_materno')
                            ->where('id', $orden['elaboro'])
                            ->first();
        
        $nombre = $elaboro['nombre'].' '.$elaboro['a_paterno'].' '.$elaboro['a_materno']; 

        $pdf = app('dompdf.wrapper');   
        $pdf->loadHTML('<!DOCTYPE html>
        <html lang="en">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <meta http-equiv="X-UA-Compatible" content="ie=edge">
            <title>Orden de Trabajo</title>
            <style>
                body {
                    background: url(img/orden_trabajo.jpg); 
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
            </style>
        </head>
        <body>
            <p style="position: absolute; top: 25px; left: 90px;">'.$orden['fecha'].'</p>
            <p style="position: absolute; top: 50px; left: 343px;">'.$orden['id_vehiculo'].'</p>
            <p style="position: absolute; top: 50px; left: 93px;">'.$vehiculo['marcas']['marca'].'</p>
            <p style="position: absolute; top: 73px; left: 93px;">'.$vehiculo['submarcas']['submarca'].'</p>
            <p style="position: absolute; top: 73px; left: 343px;">'.$vehiculo['clientes']['nombre'].'</p>
            <p style="position: absolute; top: 119px; left: 93px;">'.$vehiculo['color'].'</p>
            <p style="position: absolute; top: 96px; left: 93px;">'.$vehiculo['modelo'].'</p>
            <p style="position: absolute; top: 142px; left: 93px;">'.$vehiculo['placas'].'</p>
            '.$rep.'
            '.$hoja.'
            '.$pin.'
            '.$mec.'
            '.$obs.'
            <p style="position: absolute; top: 1083px; left: 320px;">'.$nombre.'</p>
            <hr> <!-- Salto de página -->
            <img src="img/listado_materiales.jpg">
            <p style="position: absolute; top: 43px; left: 320px;">'.$orden['id_vehiculo'].'</p>
            <p style="position: absolute; top: 43px; left: 93px;">'.$vehiculo['marcas']['marca'].'</p>
            <p style="position: absolute; top: 65px; left: 93px;">'.$vehiculo['submarcas']['submarca'].'</p>
            <p style="position: absolute; top: 65px; left: 320px;">'.$vehiculo['clientes']['nombre'].'</p>
            <p style="position: absolute; top: 105px; left: 93px;">'.$vehiculo['color'].'</p>
            <p style="position: absolute; top: 85px; left: 93px;">'.$vehiculo['modelo'].'</p>
            <p style="position: absolute; top: 128px; left: 93px;">'.$vehiculo['placas'].'</p>
        </body>
        </html>');
        
        return $pdf->stream($request['exp'].'_orden_trabajo');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Orden_trabajo  $orden_trabajo
     * @return \Illuminate\Http\Response
     */
    public function show(Orden_trabajo $orden_trabajo)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Orden_trabajo  $orden_trabajo
     * @return \Illuminate\Http\Response
     */
    public function edit(Orden_trabajo $orden_trabajo)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Orden_trabajo  $orden_trabajo
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Orden_trabajo $orden_trabajo)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Orden_trabajo  $orden_trabajo
     * @return \Illuminate\Http\Response
     */
    public function destroy(Orden_trabajo $orden_trabajo)
    {
        if ($orden_trabajo->delete()) {
            return redirect()->route('l_ordenest')->with('success','Orden de Trabajo Eliminada.');
        } else {
            return redirect()->route('l_ordenest')->with('error','Orden de Trabajo no Eliminada.');
        }
    }
}
