<?php

namespace App\Http\Controllers;

use App\Models\Estatusrefacciones;
use Illuminate\Http\Request;

class EstatusrefaccionesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $list_refacciones= Estatusrefacciones::all();
        return view('catalogos.estatusRefacciones.l_estatusRefacciones', compact('list_refacciones'));
    }

    public function i_estatusref(){
        return view('catalogos.estatusRefacciones.i_estatusRefacciones');
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
        $r = Estatusrefacciones::where('estatus', $request['estatus'])
        ->select('estatus')
        ->get();

        if ($r->isEmpty()) {
            $estatus = new Estatusrefacciones;
            $estatus->estatus = $request->estatus;
            if ($estatus->save()) {
                return redirect()->route('l_estatusrefas')->with('success','Estatus Registrado.');
            } else {
                return redirect()->route('l_estatusrefas')->with('error','Estatus no Registrado.');
            }
        } else {
            return back()->with('warning','El estatus "'. $request['estatus'] .'" ya esta registrado.');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Estatusrefacciones  $estatusrefacciones
     * @return \Illuminate\Http\Response
     */
    public function show(Estatusrefacciones $estatusrefacciones)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Estatusrefacciones  $estatusrefacciones
     * @return \Illuminate\Http\Response
     */
    public function edit(Estatusrefacciones $estatusrefacciones)
    {
        return view('catalogos.estatusRefacciones.u_estatusRefacciones', compact('estatusrefacciones'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Estatusrefacciones  $estatusrefacciones
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Estatusrefacciones $estatusrefacciones)
    {
        if ($estatusrefacciones->estatus == $request->estatus) {
            return redirect()->route('l_estatusrefas')->with('warning','No se Actualizo el estatus "'. $request->estatus . '".');
        } else {
            $estatusrefacciones->estatus = $request->estatus;
            if ($estatusrefacciones->save()) {
                return redirect()->route('l_estatusrefas')->with('success','Estatus Actualizado.');
            } else {
                return redirect()->route('l_estatusrefas')->with('error','Estatus no Actualizado.');
            }
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Estatusrefacciones  $estatusrefacciones
     * @return \Illuminate\Http\Response
     */
    public function destroy(Estatusrefacciones $estatusrefacciones)
    {
        if ($estatusrefacciones->delete()) {
            return redirect()->route('l_estatusrefas')->with('success','Estatus Eliminado.');
        } else {
            return redirect()->route('l_estatusrefas')->with('error','Estatus no Eliminado.');
        }
    }
}
