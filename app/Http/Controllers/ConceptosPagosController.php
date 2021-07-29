<?php

namespace App\Http\Controllers;

use App\Models\Conceptos_pagos;
use Illuminate\Http\Request;

class ConceptosPagosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $list_conceptos_pagos = Conceptos_pagos::all();

        return view('catalogos.conceptos_pagos.l_conceptos_pagos', compact('list_conceptos_pagos'));
    }

    public function i_conceptopago(){
        return view('catalogos.conceptos_pagos.i_conceptos_pagos');
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
        $r = Conceptos_pagos::where('concepto_pago', $request['tipo'])
                        ->select('concepto_pago')
                        ->get();

        if ($r->isEmpty()) {
            $tipo = new Conceptos_pagos;
            $tipo->concepto_pago = $request->tipo;
            if ($tipo->save()) {
                return redirect()->route('l_conceptopago')->with('success','Concepto Pago Registrado.');
            } else {
                return redirect()->route('l_conceptopago')->with('error','Concepto Pago no Registrado.');
            }
        } else {
            return back()->with('warning','El concepto de pago "'. $request['tipo'] .'" ya esta registrado.');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Conceptos_pagos  $conceptos_pagos
     * @return \Illuminate\Http\Response
     */
    public function show(Conceptos_pagos $conceptos_pagos)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Conceptos_pagos  $conceptos_pagos
     * @return \Illuminate\Http\Response
     */
    public function edit(Conceptos_pagos $conceptos_pagos)
    {
        return view('catalogos.conceptos_pagos.u_conceptos_pagos', compact('conceptos_pagos'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Conceptos_pagos  $conceptos_pagos
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Conceptos_pagos $conceptos_pagos)
    {
        if ($conceptos_pagos->concepto_pago == $request->tipo) {
            return redirect()->route('l_conceptopago')->with('warning','No se Actualizo concepto pago "'. $request->tipo . '".');
        } else {
            $conceptos_pagos->concepto_pago = $request->tipo;
            if ($conceptos_pagos->save()) {
                return redirect()->route('l_conceptopago')->with('success','Concepto Pago Actualizado.');
            } else {
                return redirect()->route('l_conceptopago')->with('error','Concepto Pago no Actualizado.');
            }
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Conceptos_pagos  $conceptos_pagos
     * @return \Illuminate\Http\Response
     */
    public function destroy(Conceptos_pagos $conceptos_pagos)
    {
        if ($conceptos_pagos->delete()) {
            return redirect()->route('l_conceptopago')->with('success','Concepto Pago Eliminado.');
        } else {
            return redirect()->route('l_conceptopago')->with('error','Concepto Pago no Eliminado.');
        }
    }
}
