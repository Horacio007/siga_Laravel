<?php

namespace App\Http\Controllers;

use App\Models\Orden_retrabajo;
use Illuminate\Support\Facades\DB;
use App\Models\Vehiculo;
use Illuminate\Http\Request;

class OrdenRetrabajoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $list_ordenes = DB::select("SELECT
                                    orden_retrabajo.id,
                                    orden_retrabajo.id_vehiculo,
                                    modelosv.marca,
                                    submarcav.submarca,
                                    vehiculo.modelo,
                                    aseguradoras.nombre,
                                    orden_retrabajo.fecha,
                                    orden_retrabajo.observaciones,
                                    asesores.nombre
                                FROM
                                    vehiculo,
                                    orden_retrabajo,
                                    modelosv,
                                    submarcav,
                                    aseguradoras,
                                    asesores
                                WHERE
                                    orden_retrabajo.id_vehiculo = vehiculo.id
                                AND vehiculo.marca_id = modelosv.id
                                AND vehiculo.linea_id = submarcav.id
                                AND aseguradoras.id = vehiculo.cliente_id
                                AND asesores.id = orden_retrabajo.elaboro
                                ORDER BY
                                    orden_retrabajo.id");

        return view('taller.ordenesRetrabajo.l_ordenesRetrabajo', compact('list_ordenes'));
    }

    public function i_ordenesrt(){
        $vehiculos = Vehiculo::with(['marcas:id,marca', 'submarcas:id,submarca', 'clientes:id,nombre', 'asesores:id,nombre,a_paterno,a_materno', 'estatus:id,status'])
                            ->select('id','estatus_id','modelo', 'color', 'marca_id', 'linea_id', 'cliente_id', 'placas', 'id_asesor', 'no_siniestro', 'fecha_llegada')
                            ->where('estatus_id','5')
                            ->orWhere('estatus_id','6')
                            ->orWhere('estatus_id','7')
                            ->orderBy('id_aux')
                            ->get();

        return view('taller.ordenesRetrabajo.i_ordenesRetrabajo', compact('vehiculos'));
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
        $f =  Date('Y-m-d');
        $o = '';

        for ($i=0; $i < count($request->observaciones); $i++) { 
            $o .= $request->observaciones[$i].'/';
        }

        $ordenrt = new Orden_retrabajo();
        $ordenrt->id_vehiculo = $request->id;
        $ordenrt->fecha = $f;
        $ordenrt->observaciones = $o;
        $ordenrt->elaboro = $request->elaboro;

        if ($ordenrt->save()) {
            return 1;
        } else {
            return 'Orden de Retrabajo no registrada';
        }
    }

    public function create_pdfort(Request $request){
        $r = Orden_retrabajo::select('id_vehiculo')
                    ->where('id', $request->exp)
                    ->first();

        $vehiculo = Vehiculo::with(['marcas:id,marca', 'submarcas:id,submarca', 'clientes:id,nombre', 'asesores:id,nombre,a_paterno,a_materno','estatus:id,status'])
                            ->where('id', $r->id_vehiculo)
                            ->select('modelo', 'color', 'marca_id', 'linea_id', 'cliente_id', 'placas', 'id_asesor', 'estatus_id')
                            ->first();

        $orden = Orden_retrabajo::select('*')->where('id',$request->exp)->first();

        $y = 180;
        $x = 180;
        $observaciones = explode('/', $orden->observaciones);
        $obs = "";
        for ($i=0; $i < count($observaciones); $i++) { 
            if (strlen($observaciones[$i]) > 43) {
                $p1 = substr($observaciones[$i], 0, 80);
                $p2 = substr($observaciones[$i], 80, 160);
                $obs.= '<p style="position: absolute; top: '.$y.'px; left: 5px;">'.$p1.'</p>';
                $y = $y + 17.5;
                $obs.= '<p style="position: absolute; top: '.$x.'px; left: 5px;">'.$p2.'</p>';
                $y = $y + 17.5;
            } else {
                $p1 = substr($observaciones[$i], 0, 80);
                $obs.= '<p style="position: absolute; top: '.$x.'px; left: 5px;">'.$p1.'</p>';
                $x = $x + 17.5;
            }
        }

        $pdf = app('dompdf.wrapper');   
        $pdf->loadHTML('<!DOCTYPE html>
        <html lang="en">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <meta http-equiv="X-UA-Compatible" content="ie=edge">
            <title>Orden de Retrabajo</title>
            <style>
                body {
                    background: url(img/orden_retrabajo.jpg); 
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
            <p style="position: absolute; top: 17px; left: 90px;">'.$orden['fecha'].'</p>
            <p style="position: absolute; top: 40px; left: 343px;">'.$orden['id_vehiculo'].'</p>
            <p style="position: absolute; top: 40px; left: 93px;">'.$vehiculo['marcas']['marca'].'</p>
            <p style="position: absolute; top: 60px; left: 93px;">'.$vehiculo['submarcas']['submarca'].'</p>
            <p style="position: absolute; top: 60px; left: 343px;">'.$vehiculo['clientes']['nombre'].'</p>
            <p style="position: absolute; top: 98px; left: 93px;">'.$vehiculo['color'].'</p>
            <p style="position: absolute; top: 80px; left: 93px;">'.$vehiculo['modelo'].'</p>
            <p style="position: absolute; top: 120px; left: 93px;">'.$vehiculo['placas'].'</p>
            '.$obs.'
        </body>
        </html>');
        
        return $pdf->stream($request['exp'].'_orden_retrabajo');


    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Orden_retrabajo  $orden_retrabajo
     * @return \Illuminate\Http\Response
     */
    public function show(Orden_retrabajo $orden_retrabajo)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Orden_retrabajo  $orden_retrabajo
     * @return \Illuminate\Http\Response
     */
    public function edit(Orden_retrabajo $orden_retrabajo)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Orden_retrabajo  $orden_retrabajo
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Orden_retrabajo $orden_retrabajo)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Orden_retrabajo  $orden_retrabajo
     * @return \Illuminate\Http\Response
     */
    public function destroy(Orden_retrabajo $orden_retrabajo)
    {
        if ($orden_retrabajo->delete()) {
            return redirect()->route('l_ordenesrt')->with('success','Orden de Retrabajo Eliminada.');
        } else {
            return redirect()->route('l_ordenesrt')->with('error','Orden de Retrabajo no Eliminada.');
        }
    }
}
