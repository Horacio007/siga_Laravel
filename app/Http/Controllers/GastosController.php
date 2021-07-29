<?php

namespace App\Http\Controllers;

use App\Models\Forma_pago;
use App\Models\Gastos;
use App\Models\Vehiculo;
use App\Models\si_no;
use App\Models\Conceptos_pagos;
use Illuminate\Http\Request;

class GastosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $list_gastos = Gastos::with(['forma_pagos', 'facturas', 'concepto_pagos', 'expedientes'])
                                ->get();

        //dd($list_gastos[0]->forma_pagos);
        return view('costos.gastos.l_gastos', compact('list_gastos'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $list_vehiculo = Vehiculo::with(['marcas:id,marca', 'submarcas:id,submarca', 'clientes:id,nombre', 'asesores:id,nombre,a_paterno,a_materno', 'estatus:id,status'])
                                ->select('id_aux','id','estatus_id','modelo', 'color', 'marca_id', 'linea_id', 'cliente_id', 'placas', 'id_asesor', 'fecha_salida_taller')
                                ->where('estatus_id', 5)
                                ->orWhere('estatus_id', 6)
                                ->orWhere('estatus_id', 3)
                                ->orderBy('id_aux')
                                ->get();

        $sino = si_no::all();
        $conceptos_pago = Conceptos_pagos::all();
        $forma_pago = Forma_pago::all();
        //dd($list_vehiculo[0]);
        return view('costos.gastos.i_gastos', compact(['list_vehiculo', 'sino', 'conceptos_pago', 'forma_pago']));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Gastos  $gastos
     * @return \Illuminate\Http\Response
     */
    public function show(Gastos $gastos)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Gastos  $gastos
     * @return \Illuminate\Http\Response
     */
    public function edit(Gastos $gastos)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Gastos  $gastos
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Gastos $gastos)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Gastos  $gastos
     * @return \Illuminate\Http\Response
     */
    public function destroy(Gastos $gastos)
    {
        //
    }
}
