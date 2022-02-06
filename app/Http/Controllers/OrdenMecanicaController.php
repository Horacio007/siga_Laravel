<?php

namespace App\Http\Controllers;

use App\Models\Orden_mecanica;
use Illuminate\Support\Facades\DB;
use App\Models\Vehiculo;
use App\Models\Asesores;
use Illuminate\Http\Request;

class OrdenMecanicaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $list_ordenes = DB::select("SELECT
                                    orden_mecanica.id,
                                    orden_mecanica.id_vehiculo,
                                    modelosv.marca,
                                    submarcav.submarca,
                                    vehiculo.modelo,
                                    aseguradoras.nombre,
                                    orden_mecanica.fecha,
                                    orden_mecanica.diagnostico,
                                    asesores.nombre
                                FROM
                                    vehiculo,
                                    orden_mecanica,
                                    modelosv,
                                    submarcav,
                                    aseguradoras,
                                    asesores
                                WHERE
                                    orden_mecanica.id_vehiculo = vehiculo.id
                                AND vehiculo.marca_id = modelosv.id
                                AND vehiculo.linea_id = submarcav.id
                                AND aseguradoras.id = vehiculo.cliente_id
                                AND asesores.id = orden_mecanica.elaboro
                                ORDER BY
                                    orden_mecanica.id");

        return view('taller.ordenesMecanica.l_ordenesMecanica', compact('list_ordenes'));
    }

    public function i_ordenesm(){
        $vehiculos = Vehiculo::with(['marcas:id,marca', 'submarcas:id,submarca', 'clientes:id,nombre', 'asesores:id,nombre,a_paterno,a_materno', 'estatusV:id,status', 'estatusProceso:id,estatus'])
                            ->select('id', 'estatus_id', 'estatusProceso_id', 'modelo', 'color', 'marca_id', 'linea_id', 'cliente_id', 'placas', 'id_asesor', 'no_siniestro', 'fecha_llegada')
                            ->whereIn('estatus_id',['5', '6'])
                            ->whereNotIn('estatusProceso_id', ['1', '5', '9', '12'])
                            ->orderBy('id_aux')
                            ->get();

        return view('taller.ordenesMecanica.i_ordenesMecanica', compact('vehiculos'));
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
        $f =  Date('Y-m-d');
        $d = '';

        for ($i=1; $i < $request->cont; $i++) { 
            if ($request['diagnostico_'.$i] != null) {
                $d .= $request['diagnostico_'.$i].'/';
            }
        }

        $ordenm = new Orden_mecanica();
        $ordenm->id_vehiculo = $request->expediente;
        $ordenm->fecha = $f;
        $ordenm->diagnostico = $d;
        $elaboro = Vehiculo::select('id_asesor')
                            ->where('id', $request->expediente)
                            ->first();
        //dd($elaboro);
        $ordenm->elaboro = $elaboro->id_asesor;

        if ($ordenm->save()) {
            return redirect()->route('l_ordenesm')->with('success','Orden de Mecanica Registrada.');
        } else {
            return redirect()->route('l_ordenesm')->with('error','Orden de Mecanica Registrada.');
        }
    }

    public function create_pdfom(Request $request){
        $r = Orden_mecanica::select('id_vehiculo')
                    ->where('id', $request->exp)
                    ->first();

        $vehiculo = Vehiculo::with(['marcas:id,marca', 'submarcas:id,submarca', 'clientes:id,nombre', 'asesores:id,nombre,a_paterno,a_materno','estatusV:id,status'])
                            ->where('id', $r->id_vehiculo)
                            ->select('modelo', 'color', 'marca_id', 'linea_id', 'cliente_id', 'placas', 'id_asesor', 'estatus_id')
                            ->first();

        $orden = Orden_mecanica::select('*')->where('id',$request->exp)->first();

        $y = 154;
        $x = 154;
        $diagnostico = explode('/', $orden->diagnostico);
        $diag = "";
        for ($i=0; $i < count($diagnostico); $i++) { 
            if (strlen($diagnostico[$i]) > 43) {
                $p1 = substr($diagnostico[$i], 0, 80);
                $p2 = substr($diagnostico[$i], 80, 160);
                $diag.= '<p style="position: absolute; top: '.$y.'px; left: 720px;">'.$p1.'</p>';
                $y = $y + 17.5;
                $diag.= '<p style="position: absolute; top: '.$x.'px; left: 720px;">'.$p2.'</p>';
                $y = $y + 17.5;
            } else {
                $p1 = substr($diagnostico[$i], 0, 80);
                $diag.= '<p style="position: absolute; top: '.$x.'px; left: 90px;">'.$p1.'</p>';
                $x = $x + 17.5;
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
            <title>Orden de Mecanica</title>
            <style>
                body {
                    background: url(img/orden_mecanica.jpg); 
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
            <p style="position: absolute; top: 12px; left: 90px;">'.$orden['fecha'].'</p>
            <p style="position: absolute; top: 31px; left: 343px;">'.$orden['id_vehiculo'].'</p>
            <p style="position: absolute; top: 31px; left: 93px;">'.$vehiculo['marcas']['marca'].'</p>
            <p style="position: absolute; top: 48px; left: 93px;">'.$vehiculo['submarcas']['submarca'].'</p>
            <p style="position: absolute; top: 48px; left: 343px;">'.$vehiculo['clientes']['nombre'].'</p>
            <p style="position: absolute; top: 82px; left: 93px;">'.$vehiculo['color'].'</p>
            <p style="position: absolute; top: 65px; left: 93px;">'.$vehiculo['modelo'].'</p>
            <p style="position: absolute; top: 100px; left: 93px;">'.$vehiculo['placas'].'</p>
            '.$diag.'
        </body>
        </html>');
        
        return $pdf->stream($request['exp'].'_orden_mecanica');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Orden_mecanica  $orden_mecanica
     * @return \Illuminate\Http\Response
     */
    public function show(Orden_mecanica $orden_mecanica)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Orden_mecanica  $orden_mecanica
     * @return \Illuminate\Http\Response
     */
    public function edit(Orden_mecanica $orden_mecanica)
    {
        return view('taller.ordenesMecanica.u_ordenesMecanica', compact('orden_mecanica'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Orden_mecanica  $orden_mecanica
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Orden_mecanica $orden_mecanica)
    {
        //dd($request);
        $d = '';
        for ($i=1; $i < $request->cont2; $i++) {
            if ($request['diagnostico_'.$i] != null) {
                $d .= $request['diagnostico_'.$i].'/';
            }
        }

        $orden_mecanica->diagnostico = $d;

        if ($orden_mecanica->save()) {
            return redirect()->route('l_ordenesm')->with('success','Orden de Mecanica Actualizada.');
        } else {
            return redirect()->route('l_ordenesm')->with('error','Orden de Mecanica no Actualizada.');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Orden_mecanica  $orden_mecanica
     * @return \Illuminate\Http\Response
     */
    public function destroy(Orden_mecanica $orden_mecanica)
    {
        if ($orden_mecanica->delete()) {
            return redirect()->route('l_ordenesm')->with('success','Orden de Mecanica Eliminada.');
        } else {
            return redirect()->route('l_ordenesm')->with('error','Orden de Mecanica no Eliminada.');
        }
    }
}
