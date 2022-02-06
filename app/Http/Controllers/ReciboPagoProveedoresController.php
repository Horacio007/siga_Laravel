<?php

namespace App\Http\Controllers;

use App\Models\recibo_pago_proveedores;
use App\Models\Modelosv;
use App\Models\Submarcav;
use App\Models\Aseguradoras;
use App\Models\Tipo_pago;
use App\Models\Vehiculo;
use App\Models\Tipo_servicio;
use App\Models\Facturas;
use App\Models\si_no;
use Carbon\Carbon;
use App\Models\Conceptos_pagos;
use App\Models\Forma_pago;
use App\Models\Gastos;
use Illuminate\Http\Request;

class ReciboPagoProveedoresController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $list_recibos = recibo_pago_proveedores::with(['expedientes', 'tipo_pagos', 'requiere_factura'])
                                    ->get();

        return view('costos.recibo_pago.l_recibo_pago', compact(['list_recibos']));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $vehiculos = Vehiculo::with(['marcas:id,marca', 'submarcas:id,submarca', 'clientes:id,nombre', 'asesores:id,nombre,a_paterno,a_materno', 'estatusV:id,status', 'estatusProceso:id,estatus'])
                            ->select('id_aux','id','estatus_id', 'estatusProceso_id','modelo', 'color', 'marca_id', 'linea_id', 'cliente_id', 'placas', 'id_asesor', 'no_siniestro', 'fecha_salida_taller')
                            ->where('estatus_id', 5)
                            ->where('estatusProceso_id', 9)
                            ->orderBy('id_aux')
                            ->get();

        $conceptos_pago = Conceptos_pagos::all();
        $forma_pago = Forma_pago::all();
        $tipo_pago = Tipo_pago::all();
        $tipo_servicio = Tipo_servicio::all();
        $sino = si_no::all();
        $prr = recibo_pago_proveedores::all()->last()->id??'';

        return view('costos.recibo_pago.i_recibo_pago', compact(['tipo_pago', 'vehiculos', 'tipo_servicio', 'sino', 'forma_pago', 'conceptos_pago', 'prr']));
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
        $recibo = new recibo_pago_proveedores();
        $recibo->fecha = $request->fecha;
        if (is_numeric($request->expediente)) {
            $recibo->id_vehiculo = $request->expediente;
        }
        $recibo->folio = $request->folio;
        $recibo->aplica_factura = $request->sfactura;
        $recibo->cantidad = $request->cantidad;
        $recibo->concepto = $request->articulo;
        $recibo->proveedor = $request->proveedor;
        $recibo->tipo_gasto_id = $request->gasto;
        $recibo->forma_pago = $request->forma_pago;

        if ($recibo->save()) {
            $gasto = new Gastos();
            $gasto->fecha = $request->fecha;
            $gasto->articulos = $request->articulo;
            $gasto->gastos = $request->cantidad;
            $gasto->forma_pago = $request->forma_pago; 
            $gasto->factura = $request->sfactura;
            $gasto->tipo = $request->gasto;
            $gasto->proveedor = $request->proveedor;
            $gasto->expediente = $request->expediente;
            $gasto->save();

            return redirect()->route('l_recibo_pagos_pro')->with('success','Recibo de Pago Registrado.');
        } else {
            return redirect()->route('l_recibo_pagos_pro')->with('error','Recibo de Pago no Registrado.');
        }
        

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\recibo_pago_proveedores  $recibo_pago_proveedores
     * @return \Illuminate\Http\Response
     */
    public function show(recibo_pago_proveedores $recibo_pago_proveedores)
    {
        $concepto = '';
        $concepto2 = '';
        if (strlen($recibo_pago_proveedores->concepto) < 54) {
            $concepto.= '<p style="position: absolute; top: 305px; left: 240px;">'.$recibo_pago_proveedores['concepto'].'</p>';
            $concepto2.= '<p style="position: absolute; top: 755px; left: 240px;">'.$recibo_pago_proveedores['concepto'].'</p>';
        } else {
            $concepto.= '<p style="position: absolute; top: 330px; left: 240px;">'.substr($recibo_pago_proveedores['concepto'], 0, 55).'</p>';
            $concepto.= '<p style="position: absolute; top: 350px; left: 240px;">'.substr($recibo_pago_proveedores['concepto'], 55).'</p>';
            $concepto2.= '<p style="position: absolute; top: 810px; left: 240px;">'.substr($recibo_pago_proveedores['concepto'], 0, 55).'</p>';
            $concepto2.= '<p style="position: absolute; top: 830px; left: 240px;">'.substr($recibo_pago_proveedores['concepto'], 55).'</p>';
        }

        if ($recibo_pago_proveedores->id_vehiculo??'') {
            $id = '<p style="position: absolute; top: 233px; left: 570px;">'.$recibo_pago_proveedores['id_vehiculo'].'</p>';
            $id2 = '<p style="position: absolute; top: 685px; left: 570px;">'.$recibo_pago_proveedores['id_vehiculo'].'</p>';
        } else {
            $id = '<p style="position: absolute; top: 233px; left: 570px;">N/A</p>';
            $id2 = '<p style="position: absolute; top: 685px; left: 570px;">N/A</p>';
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
                        background: url(img/recibo_pago_a_proveedorsolo.jpg); 
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
                <p style="position: absolute; top: 190px; left: 570px;">'.$recibo_pago_proveedores['fecha'].'</p>
                <p style="position: absolute; top: 645px; left: 570px;">'.$recibo_pago_proveedores['fecha'].'</p>
                <p style="position: absolute; top: 213px; left: 570px;">'.$recibo_pago_proveedores['folio'].'</p>
                <p style="position: absolute; top: 665px; left: 570px;">'.$recibo_pago_proveedores['folio'].'</p>
                '.$id.'
                '.$id2.'
                <p style="position: absolute; top: 260px; left: 200px;">'.$recibo_pago_proveedores['proveedor'].'</p>
                <p style="position: absolute; top: 710px; left: 200px;">'.$recibo_pago_proveedores['proveedor'].'</p>
                <p style="position: absolute; top: 283px; left: 220px;">$'.$recibo_pago_proveedores['cantidad'].'</p>
                <p style="position: absolute; top: 730px; left: 220px;">$'.$recibo_pago_proveedores['cantidad'].'</p>
                '.$concepto.'
                '.$concepto2.'
                <p style="position: absolute; top: 352px; left: 240px;">'.$recibo_pago_proveedores['forma_pagos']['forma_pago'].'</p>
                <p style="position: absolute; top: 815px; left: 240px;">'.$recibo_pago_proveedores['forma_pagos']['forma_pago'].'</p>
            </body>
            </html>');
            
            return $pdf->stream($recibo_pago_proveedores['folio'].'_recibo_pago');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\recibo_pago_proveedores  $recibo_pago_proveedores
     * @return \Illuminate\Http\Response
     */
    public function edit(recibo_pago_proveedores $recibo_pago_proveedores)
    {
        $conceptos_pago = Conceptos_pagos::all();
        $forma_pago = Forma_pago::all();
        $tipo_pago = Tipo_pago::all();
        $tipo_servicio = Tipo_servicio::all();
        $sino = si_no::all();
        $prr = recibo_pago_proveedores::all()->last()->folio;

        return view('costos.recibo_pago.u_recibo_pago', compact(['recibo_pago_proveedores', 'forma_pago', 'sino', 'conceptos_pago', 'prr']));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\recibo_pago_proveedores  $recibo_pago_proveedores
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, recibo_pago_proveedores $recibo_pago_proveedores)
    {
        //dd($request, $recibo_pago_proveedores);
        $gasto = Gastos::where('articulos', $recibo_pago_proveedores->concepto)
                            ->whereDate('fecha', $recibo_pago_proveedores->fecha)
                            ->where('gastos',  $recibo_pago_proveedores->cantidad)
                            ->where('forma_pago', $recibo_pago_proveedores->forma_pago)
                            ->where('proveedor', $recibo_pago_proveedores->proveedor)
                            ->where('expediente',  $recibo_pago_proveedores->id_vehiculo??'N/A')
                            ->where('factura', $recibo_pago_proveedores->aplica_factura)
                            ->where('tipo', $recibo_pago_proveedores->tipo_gasto_id)
                            ->first();

        $gasto->fecha = $request->fecha;
        $gasto->articulos = $request->articulo;
        $gasto->gastos = $request->cantidad;
        $gasto->forma_pago = $request->forma_pago; 
        $gasto->factura = $request->sfactura;
        $gasto->tipo = $request->gasto;
        $gasto->proveedor = $request->proveedor;
        $gasto->expediente = $request->expediente;
        $gasto->save();


        $recibo_pago_proveedores->fecha = $request->fecha;
        if (is_numeric($request->expediente)) {
            $recibo_pago_proveedores->id_vehiculo = $request->expediente;
        }

        $recibo_pago_proveedores->aplica_factura = $request->sfactura;
        $recibo_pago_proveedores->cantidad = $request->cantidad;
        $recibo_pago_proveedores->concepto = $request->articulo;
        $recibo_pago_proveedores->proveedor = $request->proveedor;
        $recibo_pago_proveedores->tipo_gasto_id = $request->gasto;
        $recibo_pago_proveedores->forma_pago = $request->forma_pago;

        if ($recibo_pago_proveedores->save()) {
            return redirect()->route('l_recibo_pagos_pro')->with('success','Recibo de Pago Actualizado.');
        } else {
            return redirect()->route('l_recibo_pagos_pro')->with('error','Recibo de Pago no Actualizado.');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\recibo_pago_proveedores  $recibo_pago_proveedores
     * @return \Illuminate\Http\Response
     */
    public function destroy(recibo_pago_proveedores $recibo_pago_proveedores)
    {
        $gasto = Gastos::where('articulos', $recibo_pago_proveedores->concepto)
                            ->whereDate('fecha', $recibo_pago_proveedores->fecha)
                            ->where('gastos',  $recibo_pago_proveedores->cantidad)
                            ->where('forma_pago', $recibo_pago_proveedores->forma_pago)
                            ->where('proveedor', $recibo_pago_proveedores->proveedor)
                            ->where('expediente',  $recibo_pago_proveedores->id_vehiculo??'N/A')
                            ->where('factura', $recibo_pago_proveedores->aplica_factura)
                            ->where('tipo', $recibo_pago_proveedores->tipo_gasto_id)
                            ->first();

        $gasto->delete();

        if ($recibo_pago_proveedores->delete()) {

            return redirect()->route('l_recibo_pagos_pro')->with('success','Recibo de Pago Eliminado.');
        } else {
            return redirect()->route('l_recibo_pagos_pro')->with('error','Recibo de Pago no Eliminado.');
        }
    }
}
