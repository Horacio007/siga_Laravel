<?php

namespace App\Http\Controllers;

use App\Models\Recibo_pagos;
use App\Models\Modelosv;
use App\Models\Submarcav;
use App\Models\Aseguradoras;
use App\Models\Tipo_pago;
use App\Models\Vehiculo;
use Illuminate\Http\Request;

class ReciboPagosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $list_recibos = Recibo_pagos::with(['expedientes', 'tipo_pagos', 'cliente'])
                                    ->get();
        
        $marcas = Modelosv::all();
        $submarcas = Submarcav::all();
        $aseguradoras = Aseguradoras::all();

        return view('recibo_pago.recibos.l_recibos_pago', compact(['list_recibos', 'marcas', 'submarcas', 'aseguradoras']));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $vehiculos = Vehiculo::with(['marcas:id,marca', 'submarcas:id,submarca', 'clientes:id,nombre', 'asesores:id,nombre,a_paterno,a_materno', 'estatus:id,status'])
                            ->select('id_aux','id','estatus_id','modelo', 'color', 'marca_id', 'linea_id', 'cliente_id', 'placas', 'id_asesor', 'no_siniestro', 'fecha_salida_taller')
                            ->where('estatus_id','3')
                            ->orderBy('id_aux')
                            ->get();


        $tipo_pago = Tipo_pago::all();

        return view('recibo_pago.recibos.i_recibos_pago', compact(['tipo_pago', 'vehiculos']));
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
        $recibo = new Recibo_pagos();
        $recibo->fecha = $request->fecha;
        $recibo->id_vehiculo = $request->iexpediente2;
        $recibo->folio = $request->folio;
        $recibo->recibi = $request->cliente;
        $recibo->cantidad = $request->cantidad;
        $recibo->concepto = $request->concepto;
        $recibo->forma_pago = $request->tipo_pago;
        if ($recibo->save()) {
            return redirect()->route('l_recibo_pagos')->with('success','Recibo de Pago Registrado.');
        } else {
            return redirect()->route('l_recibo_pagos')->with('error','Recibo de Pago Registrado.');
        }
        
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Recibo_pagos  $recibo_pagos
     * @return \Illuminate\Http\Response
     */
    public function show(Recibo_pagos $recibo_pagos)
    {
        $marca = Modelosv::where('id', $recibo_pagos->expedientes->marca_id)->first();
        $linea = Submarcav::where('id', $recibo_pagos->expedientes->linea_id)->first();
        $aseguradora = Aseguradoras::where('id', $recibo_pagos->expedientes->cliente_id)->first();
        $forma_pago = Tipo_pago::where('id', $recibo_pagos->forma_pago)->first();
        //dd($forma_pago);
        $concepto = '';
        $concepto2 = '';
        if (strlen($recibo_pagos->concepto) < 54) {
            $concepto.= '<p style="position: absolute; top: 330px; left: 240px;">'.$recibo_pagos['concepto'].'</p>';
            $concepto2.= '<p style="position: absolute; top: 810px; left: 240px;">'.$recibo_pagos['concepto'].'</p>';
        } else {
            $concepto.= '<p style="position: absolute; top: 330px; left: 240px;">'.substr($recibo_pagos['concepto'], 0, 55).'</p>';
            $concepto.= '<p style="position: absolute; top: 350px; left: 240px;">'.substr($recibo_pagos['concepto'], 55).'</p>';
            $concepto2.= '<p style="position: absolute; top: 810px; left: 240px;">'.substr($recibo_pagos['concepto'], 0, 55).'</p>';
            $concepto2.= '<p style="position: absolute; top: 830px; left: 240px;">'.substr($recibo_pagos['concepto'], 55).'</p>';
        }

        $pdf = app('dompdf.wrapper');   
        $pdf->loadHTML('<!DOCTYPE html>
        <html lang="en">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <meta http-equiv="X-UA-Compatible" content="ie=edge">
            <title>Recibo de Pago</title>
            <style>
                body {
                    background: url(img/recibo_depago.jpg); 
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
            <p style="position: absolute; top: 190px; left: 580px;">'.$recibo_pagos['fecha'].'</p>
            <p style="position: absolute; top: 670px; left: 580px;">'.$recibo_pagos['fecha'].'</p>
            <p style="position: absolute; top: 213px; left: 580px;">'.$recibo_pagos['id_vehiculo'].'</p>
            <p style="position: absolute; top: 693px; left: 580px;">'.$recibo_pagos['id_vehiculo'].'</p>
            <p style="position: absolute; top: 233px; left: 580px;">'.$recibo_pagos['folio'].'</p>
            <p style="position: absolute; top: 713px; left: 580px;">'.$recibo_pagos['folio'].'</p>
            <p style="position: absolute; top: 263px; left: 200px;">'.$recibo_pagos['cliente']['nombre'].'</p>
            <p style="position: absolute; top: 742px; left: 200px;">'.$recibo_pagos['cliente']['nombre'].'</p>
            <p style="position: absolute; top: 286px; left: 220px;">$'.$recibo_pagos['cantidad'].'</p>
            <p style="position: absolute; top: 765px; left: 220px;">$'.$recibo_pagos['cantidad'].'</p>
            <p style="position: absolute; top: 310px; left: 240px;">'.$marca->marca.' '.$linea->submarca.' '.$recibo_pagos['expedientes']['modelo'].' '.$recibo_pagos['expedientes']['color'].' '.$recibo_pagos['expedientes']['placas'].' '.$aseguradora->nombre.'</p>
            <p style="position: absolute; top: 790px; left: 240px;">'.$marca->marca.' '.$linea->submarca.' '.$recibo_pagos['expedientes']['modelo'].' '.$recibo_pagos['expedientes']['color'].' '.$recibo_pagos['expedientes']['placas'].' '.$aseguradora->nombre.'</p>
            '.$concepto.'
            '.$concepto2.'
            <p style="position: absolute; top: 417px; left: 240px;">'.$forma_pago->tipo_pago.'</p>
            <p style="position: absolute; top: 875px; left: 240px;">'.$forma_pago->tipo_pago.'</p>
        </body>
        </html>');
        
        return $pdf->stream($recibo_pagos['id_vehiculo'].'_recibo_pago');

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Recibo_pagos  $recibo_pagos
     * @return \Illuminate\Http\Response
     */
    public function edit(Recibo_pagos $recibo_pagos)
    {
        $tipo_pago = Tipo_pago::all();    
    
        return view('recibo_pago.recibos.u_recibos_pago', compact(['tipo_pago', 'recibo_pagos']));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Recibo_pagos  $recibo_pagos
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Recibo_pagos $recibo_pagos)
    {
        $recibo_pagos->fecha = $request->fecha;
        $recibo_pagos->cantidad = $request->cantidad;
        $recibo_pagos->concepto = $request->concepto;
        $recibo_pagos->forma_pago = $request->tipo_pago;
        if ($recibo_pagos->save()) {
            return redirect()->route('l_recibo_pagos')->with('success','Recibo de Pago Actualizado.');
        } else {
            return redirect()->route('l_recibo_pagos')->with('error','Recibo de Pago Actualizado.');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Recibo_pagos  $recibo_pagos
     * @return \Illuminate\Http\Response
     */
    public function destroy(Recibo_pagos $recibo_pagos)
    {
        if ($recibo_pagos->delete()) {
            return redirect()->route('l_recibo_pagos')->with('success','Recibo de Pago Eliminado.');
        } else {
            return redirect()->route('l_recibo_pagos')->with('error','Recibo de Pago no Eliminado.');
        }
    }
}
