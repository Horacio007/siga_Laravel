<?php

namespace App\Http\Controllers;

use App\Models\Estatusaseguradoras;
use App\Models\Facturas;
use Illuminate\Support\Facades\DB;
use App\Models\Vehiculo;
use App\Models\Ingresos;
use Illuminate\Http\Request;

class FacturasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        /*
        $list_facturas = Facturas::with(['expedientes', 'estatusFac'])
                                    ->get();
        */
        $list_facturas = DB::select('SELECT
                                        facturas.id,
                                        facturas.id_vehiculo,
                                        modelosv.marca,
                                        submarcav.submarca,
                                        vehiculo.color,
                                        vehiculo.modelo,
                                        vehiculo.placas,
                                        aseguradoras.nombre AS aseguradora,
                                        facturas.cantidad,
                                        facturas.fecha_facturacion,
                                        estatusaseguradoras.estatus,
                                        facturas.fecha_bbva,
                                        facturas.comentarios
                                    FROM
                                        vehiculo,
                                        modelosv,
                                        submarcav,
                                        aseguradoras,
                                        estatusaseguradoras,
                                        facturas
                                    WHERE
                                        facturas.id_vehiculo = vehiculo.id
                                    AND vehiculo.marca_id = modelosv.id
                                    AND vehiculo.linea_id = submarcav.id
                                    AND aseguradoras.id = vehiculo.cliente_id
                                    AND estatusaseguradoras.id = facturas.estatus_aseguradora
                                    ORDER BY
                                        facturas.id');

        //dd($list_facturas);
        return view('ingresos.facturas.l_facturas', compact('list_facturas'));
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

        $estausF = Estatusaseguradoras::all();                    
        
        return view('ingresos.facturas.i_facturas', compact(['vehiculos', 'estausF']));
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
        $factura = new Facturas;
        $factura->id_vehiculo = $request->iexpediente2;
        $factura->cantidad = $request->cantidad;
        $factura->fecha_facturacion = $request->fechaf;
        $factura->estatus_aseguradora = $request->sestatus;
        if (isset($request->fbbva)) {
            $factura->fecha_bbva = $request->fbbva;
        }
        $factura->comentarios = $request->comentarios;

        if ($factura->save()) {
            return redirect()->route('i_facturas')->with('success','Factura Registrada.');
        } else {
            return redirect()->route('i_facturas')->with('error','Factura no Registrada.');
        }
        
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Facturas  $facturas
     * @return \Illuminate\Http\Response
     */
    public function show(Facturas $facturas)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Facturas  $facturas
     * @return \Illuminate\Http\Response
     */
    public function edit(Facturas $facturas)
    {
        $vehiculos = Vehiculo::with(['marcas:id,marca', 'submarcas:id,submarca', 'clientes:id,nombre', 'asesores:id,nombre,a_paterno,a_materno', 'estatus:id,status'])
                            ->select('id_aux','id','estatus_id','modelo', 'color', 'marca_id', 'linea_id', 'cliente_id', 'placas', 'id_asesor', 'no_siniestro', 'fecha_salida_taller')
                            ->where('id',$facturas->id_vehiculo)
                            ->first();

        $estausF = Estatusaseguradoras::all();                    
        
        return view('ingresos.facturas.u_facturas', compact(['vehiculos', 'estausF','facturas']));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Facturas  $facturas
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Facturas $facturas)
    {
        //$facturas->id_vehiculo = $request->iexpediente2;
        $facturas->cantidad = $request->cantidad;
        $facturas->fecha_facturacion = $request->fechaf;
        $facturas->estatus_aseguradora = $request->sestatus;
        $facturas->fecha_bbva = $request->fbbva;
        $facturas->comentarios = $request->comentarios;

        if ($facturas->save()) {
            if (isset($request->fbbva)) {
                $ingresos = new Ingresos();
                $ingresos->id_vehiculo = $facturas->id_vehiculo;
                $ingresos->tipo_servicio = 2;
                $ingresos->fecha_finiquito = $request->fbbva;
                $ingresos->finiquito = $request->cantidad;
                $ingresos->tipo_pago_finiquito = 3;
                $ingresos->total = $request->cantidad;
                $ingresos->save();
            }
            return redirect()->route('l_facturas')->with('success','Factura Actualizada.');
        } else {
            return redirect()->route('l_facturas')->with('error','Factura no Actualizada.');
        }
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Facturas  $facturas
     * @return \Illuminate\Http\Response
     */
    public function destroy(Facturas $facturas)
    {
        if ($facturas->delete()) {
            return redirect()->route('l_facturas')->with('success','Factura Eliminada.');
        } else {
            return redirect()->route('l_facturas')->with('error','Factura no Eliminada.');
        }
    }
}
