<?php

namespace App\Http\Controllers;

use App\Models\Tipo_pago;
use Illuminate\Http\Request;

class TipoPagoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $list_tipo_pago = Tipo_pago::all();

        return view('catalogos.tipo_pago.l_tipopago', compact('list_tipo_pago'));
    }

    public function i_tipopago(){
        return view('catalogos.tipo_pago.i_tipopago');
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
        $r = Tipo_pago::where('tipo_pago', $request['tipo'])
                        ->select('tipo_pago')
                        ->get();

        if ($r->isEmpty()) {
            $tipo = new Tipo_pago;
            $tipo->tipo_pago = $request->tipo;
            if ($tipo->save()) {
                return redirect()->route('l_tipopago')->with('success','Tipo Pago Registrado.');
            } else {
                return redirect()->route('l_tipopago')->with('error','Tipo Pago no Registrado.');
            }
        } else {
            return back()->with('warning','El tipo de pago "'. $request['tipo'] .'" ya esta registrado.');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Tipo_pago  $tipo_pago
     * @return \Illuminate\Http\Response
     */
    public function show(Tipo_pago $tipo_pago)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Tipo_pago  $tipo_pago
     * @return \Illuminate\Http\Response
     */
    public function edit(Tipo_pago $tipo_pago)
    {
        return view('catalogos.tipo_pago.u_tipopago', compact('tipo_pago'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Tipo_pago  $tipo_pago
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Tipo_pago $tipo_pago)
    {
        if ($tipo_pago->tipo_pago == $request->tipo) {
            return redirect()->route('l_tipopago')->with('warning','No se Actualizo tipo pago "'. $request->tipo . '".');
        } else {
            $tipo_pago->tipo_pago = $request->tipo;
            if ($tipo_pago->save()) {
                return redirect()->route('l_tipopago')->with('success','Tipo Pago Actualizado.');
            } else {
                return redirect()->route('l_tipopago')->with('error','Tipo Pago no Actualizado.');
            }
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Tipo_pago  $tipo_pago
     * @return \Illuminate\Http\Response
     */
    public function destroy(Tipo_pago $tipo_pago)
    {
        if ($tipo_pago->delete()) {
            return redirect()->route('l_tipopago')->with('success','Tipo Pago Eliminado.');
        } else {
            return redirect()->route('l_tipopago')->with('error','Tipo Pago no Eliminado.');
        }
    }
}
