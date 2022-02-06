<?php

namespace App\Http\Controllers;

use App\Models\Orden_trabajo;
use App\Models\Vehiculo;
use App\Models\Asesores;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Codedge\Fpdf\Fpdf\Fpdf;
use iio\libmergepdf\Merger;
use Dompdf\Dompdf;

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
        $vehiculos = Vehiculo::with(['marcas:id,marca', 'submarcas:id,submarca', 'clientes:id,nombre', 'asesores:id,nombre,a_paterno,a_materno', 'estatusV:id,status', 'estatusProceso:id,estatus'])
                            ->select('id', 'estatus_id', 'estatusProceso_id', 'modelo', 'color', 'marca_id', 'linea_id', 'cliente_id', 'placas', 'id_asesor', 'no_siniestro', 'fecha_llegada')
                            ->whereIn('estatus_id',['5', '6'])
                            ->whereNotIn('estatusProceso_id', ['1', '5', '9', '12'])
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
        //dd($request);
        $r = '';
        $h = '';
        $p = '';
        $m = '';

        $f =  Date('Y-m-d');

        for ($i=1; $i < $request->cont; $i++) { 
            $r .= $request['reparaciones_'.$i].'/';
            //$h .= strval($request->hojalateria[$i]).'/';
            //$p .= strval($request->pintura[$i]).'/';
            //$m .= strval($request->mecanica[$i]).'/';
        }

        $ordent = new Orden_trabajo();
        $ordent->id_vehiculo = $request->expediente;
        $ordent->fecha = $f;
        $ordent->reparacion = $r??'';
        $ordent->hojalateria = $h??'';
        $ordent->pintura = $p??'';
        $ordent->mecanica = $m??'';
        $ordent->observaciones = $request->observaciones;
        $elaboro = Vehiculo::select('id_asesor')
                            ->where('id', $request->expediente)
                            ->first();
        $ordent->elaboro = $elaboro->id_asesor;

        if ($ordent->save()) {
            return redirect()->route('l_ordenest')->with('success','Orden de Trabajo Registrada.');
        } else {
            return redirect()->route('l_ordenest')->with('error','Orden de Trabajo no Registrada.');
        }
        
    }

    public function create_pdfot(Request $request){

        $r = Orden_trabajo::select('id_vehiculo')
                    ->where('id', $request->exp)
                    ->first();

        $vehiculo = Vehiculo::with(['marcas:id,marca', 'submarcas:id,submarca', 'clientes:id,nombre', 'asesores:id,nombre,a_paterno,a_materno','estatusV:id,status'])
                            ->where('id', $r->id_vehiculo)
                            ->select('modelo', 'color', 'marca_id', 'linea_id', 'cliente_id', 'placas', 'id_asesor', 'estatus_id')
                            ->first();

        $orden = Orden_trabajo::select('*')->where('id',$request->exp)->first();
        
        $elaboro = Asesores::select('nombre', 'a_paterno', 'a_materno')
                            ->where('id', $orden['elaboro'])
                            ->first();
        
        $nombre = $elaboro['nombre'].' '.$elaboro['a_paterno'].' '.$elaboro['a_materno']; 

        $y = 182;
        $reparacion = $orden['reparacion'];
        strlen($reparacion);
        $reparacion = explode('/', $orden['reparacion']);
        $rep = "";
        for ($i=0; $i < count($reparacion); $i++) { 
            $rep.= '<p style="position: absolute; top: '.$y.'px; left: 92.5px;">'.$reparacion[$i].'</p>';
            $y = $y + 20;
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

        $y = 640;
        $observaciones = $orden['observaciones'];
        strlen($observaciones);
        $observaciones = explode('/', $orden['observaciones']);
        $obs = "";
        for ($i=0; $i < count($observaciones); $i++) {
            if (strlen($observaciones[$i]) > 43) {
                $p1 = substr($observaciones[$i], 0, 80);
                $p2 = substr($observaciones[$i], 80, 160);
                $obs.= '<p style="position: absolute; top: '.$y.'px; left: 30px;">'.$p1.'</p>';
                $y = $y + 15;
                $obs.= '<p style="position: absolute; top: '.$y.'px; left: 30px;">'.$p2.'</p>';
                $y = $y + 15;
            } else {
                $p1 = substr($observaciones[$i], 0, 80);
                $obs.= '<p style="position: absolute; top: '.$y.'px; left: 30px;">'.$p1.'</p>';
                $y = $y + 15;
            }
        }

        $elaboro = Asesores::select('nombre', 'a_paterno', 'a_materno')
                            ->where('id', $orden['elaboro'])
                            ->first();
        
        $nombre = $elaboro['nombre'].' '.$elaboro['a_paterno'].' '.$elaboro['a_materno']; 

        $pdf = app('dompdf.wrapper'); 
        $pdf->setPaper('a4', 'landscape');
        $pdf->loadHTML('<!DOCTYPE html>
        <html lang="en">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <meta http-equiv="X-UA-Compatible" content="ie=edge">
            <title>Orden de Trabajo</title>
            <style>
                body {
                    background: url(img/ordendetrabajo2.jpg); 
                    background-size: cover;
                    background-repeat: no-repeat;
                    /* Arriba | Derecha | Abajo | Izquierda */
                    background-size: 100% 100%;
                    /* Arriba | Derecha | Abajo | Izquierda */
                    margin: -50px -38px -60px -39px;
                    font-size: 12;
                }

                img {
                    width: 780px; height: 1150px;
                }

                #img1 {
                    
                    width: 1120px; height: 800px;
                    position: absolute; 
                    top: 0px; 
                    left: 0px
                }

                #img2 {
                    transform: rotate(270deg);
                    width: 800px; height: 800px;
                    position: absolute; 
                    top: 10px; 
                    left: 10px
                }

                #vertical {
                    transform: rotate(-360deg);
                }

                .page-break {
                    page-break-after: always;
                }

                hr{
                    page-break-after: always;
                    border: none;
                    margin: 0;
                    padding: 0;
                }
            </style>
        </head>
        <body>
            <p style="position: absolute; top: 78px; left: 90px;">'.$orden['fecha'].'</p>
            <p style="position: absolute; top: 92.5px; left: 90px;">'.$orden['id_vehiculo'].'</p>
            <p style="position: absolute; top: 92.5px; left: 260px;">'.$vehiculo['marcas']['marca'].'</p>
            <p style="position: absolute; top: 92.5px; left: 434px;">'.$vehiculo['submarcas']['submarca'].'</p>
            <p style="position: absolute; top: 92.5px; left: 610px;">'.$vehiculo['color'].'</p>
            <p style="position: absolute; top: 92.5px; left: 780px;">'.$vehiculo['modelo'].'</p>
            <p style="position: absolute; top: 108px; left: 90px;">'.$vehiculo['placas'].'</p>
            <p style="position: absolute; top: 108px; left: 260px;">'.$vehiculo['clientes']['nombre'].'</p>
            '.$rep.'
            '.$obs.'
            <p style="position: absolute; top: 702.5px; left: 750px;">'.$nombre.'</p>
            <hr>    
            <img id="img1" src="img/revision_de_puntos_basicos.jpg">
            <p style="position: absolute; top: 153px; left: 380px;">'.$orden['id_vehiculo'].'</p>
            <p style="position: absolute; top: 153px; left: 745px;">'.$vehiculo['marcas']['marca'].'</p>
            <p style="position: absolute; top: 153px; left: 900px;">'.$vehiculo['submarcas']['submarca'].'</p>
            <p style="position: absolute; top: 176px; left: 160px;">'.$vehiculo['modelo'].'</p>
            <p style="position: absolute; top: 176px; left: 350px;">'.$vehiculo['color'].'</p>
            <p style="position: absolute; top: 176px; left: 745px;">'.$vehiculo['placas'].'</p>
            <p style="position: absolute; top: 176px; left: 958px;">'.$vehiculo['clientes']['nombre'].'</p>
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
        return view('taller.ordenesTrabajo.u_ordenesTrabajo', compact('orden_trabajo'));
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
        //dd($request);
        $r = '';
        $h = '';
        $p = '';
        $m = '';

        $f =  Date('Y-m-d');

        for ($i=1; $i < $request->cont2; $i++) {
            if ($request['reparaciones_'.$i] != null) {
                $r .= $request['reparaciones_'.$i].'/';
            }
            //$h .= strval($request->hojalateria[$i]).'/';
            //$p .= strval($request->pintura[$i]).'/';
            //$m .= strval($request->mecanica[$i]).'/';
        }

        $orden_trabajo->reparacion = $r??'';
        $orden_trabajo->hojalateria = $h??'';
        $orden_trabajo->pintura = $p??'';
        $orden_trabajo->mecanica = $m??'';
        $orden_trabajo->observaciones = $request->observaciones;

        if ($orden_trabajo->save()) {
            return redirect()->route('l_ordenest')->with('success','Orden de Trabajo Actualizada.');
        } else {
            return redirect()->route('l_ordenest')->with('error','Orden de Trabajo no Actualizada.');
        }
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
