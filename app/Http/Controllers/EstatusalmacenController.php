<?php

namespace App\Http\Controllers;

use App\Models\Estatusalmacen;
use Illuminate\Http\Request;

class EstatusalmacenController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $list_almacen = Estatusalmacen::all();
        return view('catalogos.estatusAlmacen.l_estatusAlmacen', compact('list_almacen'));
    }

    public function i_estatusalm(){
        return view('catalogos.estatusAlmacen.i_estatusAlmacen');
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
        $r = Estatusalmacen::where('estatus', $request['estatus'])
                        ->select('estatus')
                        ->get();

        if ($r->isEmpty()) {
            $estatus = new Estatusalmacen;
            $id = Estatusalmacen::all()->last()->id;
            $estatus->id = $id + 1;
            $estatus->estatus = $request->estatus;
            if ($estatus->save()) {
                return redirect()->route('lista_estatusalm')->with('success','Estatus Registrado.');
            } else {
                return redirect()->route('lista_estatusalm')->with('error','Estatus no Registrado.');
            }
        } else {
            return back()->with('warning','El estatus "'. $request['estatus'] .'" ya esta registrado.');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Estatusalmacen  $estatusalmacen
     * @return \Illuminate\Http\Response
     */
    public function show(Estatusalmacen $estatusalmacen)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Estatusalmacen  $estatusalmacen
     * @return \Illuminate\Http\Response
     */
    public function edit(Estatusalmacen $estatusalmacen)
    {
        return view('catalogos.estatusAlmacen.u_estatusAlmacen', compact('estatusalmacen'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Estatusalmacen  $estatusalmacen
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Estatusalmacen $estatusalmacen)
    {
        if ($estatusalmacen->estatus == $request->estatus) {
            return redirect()->route('lista_estatusalm')->with('warning','No se Actualizo estatus "'. $request->estatus . '".');
        } else {
            $estatusalmacen->estatus = $request->estatus;
            if ($estatusalmacen->save()) {
                return redirect()->route('lista_estatusalm')->with('success','Estatus Actualizado.');
            } else {
                return redirect()->route('lista_estatusalm')->with('error','Estatus no Actualizado.');
            }
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Estatusalmacen  $estatusalmacen
     * @return \Illuminate\Http\Response
     */
    public function destroy(Estatusalmacen $estatusalmacen)
    {
        if ($estatusalmacen->delete()) {
            return redirect()->route('lista_estatusalm')->with('success','Estatus Eliminado.');
        } else {
            return redirect()->route('lista_estatusalm')->with('error','Estatus no Eliminado.');
        }
    }
}
