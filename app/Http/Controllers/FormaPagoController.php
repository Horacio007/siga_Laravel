<?php

namespace App\Http\Controllers;

use App\Models\Forma_pago;
use Illuminate\Http\Request;

class FormaPagoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $list_formapago = Forma_pago::all();

        return view('catalogos.forma_pago.l_formapago', compact('list_formapago'));
    }

    public function i_formapago(){
        return view('catalogos.forma_pago.i_formapago');
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
        $r = Forma_pago::where('forma_pago', $request['tipo'])
                        ->select('forma_pago')
                        ->get();

        if ($r->isEmpty()) {
            $forma_pago = new Forma_pago;
            $forma_pago->forma_pago = $request->tipo;
        if ($forma_pago->save()) {
            return redirect()->route('l_formapago')->with('success','Forma Pago Registrada.');
        } else {
            return redirect()->route('l_formapago')->with('error','Forma Pago no Registrada.');
        }
        } else {
            return back()->with('warning','La forma pago "'. $request['tipo'] .'" ya esta registrada.');
}
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Forma_pago  $forma_pago
     * @return \Illuminate\Http\Response
     */
    public function show(Forma_pago $forma_pago)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Forma_pago  $forma_pago
     * @return \Illuminate\Http\Response
     */
    public function edit(Forma_pago $forma_pago)
    {
        return view('catalogos.forma_pago.u_formapago', compact('forma_pago'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Forma_pago  $forma_pago
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Forma_pago $forma_pago)
    {
        if ($forma_pago->forma_pago == $request->tipo) {
            return redirect()->route('l_formapago')->with('warning','No se Actualizo forma pago "'. $request->tipo . '".');
        } else {
            $forma_pago->forma_pago = $request->tipo;
            if ($forma_pago->save()) {
                return redirect()->route('l_formapago')->with('success','Forma Pago Actualizado.');
            } else {
                return redirect()->route('l_formapago')->with('error','Forma Pago no Actualizado.');
            }
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Forma_pago  $forma_pago
     * @return \Illuminate\Http\Response
     */
    public function destroy(Forma_pago $forma_pago)
    {
        if ($forma_pago->delete()) {
            return redirect()->route('l_formapago')->with('success','Forma Pago Eliminado.');
        } else {
            return redirect()->route('l_formapago')->with('error','Forma Pago no Eliminado.');
        }
    }
}
