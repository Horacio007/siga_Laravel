<?php

namespace App\Http\Controllers;

use App\Models\Estatusaseguradoras;
use Illuminate\Http\Request;
use Symfony\Component\HttpKernel\HttpCache\Esi;

class EstatusaseguradorasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $list_estatus = Estatusaseguradoras::all();

        return view('catalogos.facturas.l_facturas', compact('list_estatus'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('catalogos.facturas.i_facturas');
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
        $r = Estatusaseguradoras::where('estatus', $request['estatus'])
                                ->select('estatus')
                                ->get();

        if ($r->isEmpty()) {
            $estatus = new Estatusaseguradoras;
            $estatus->estatus = $request->estatus;
            if ($estatus->save()) {
                return redirect()->route('l_estatusF')->with('success','Estatus Registrado.');
            } else {
                return redirect()->route('l_estatusF')->with('error','Estatus no Registrado.');
            }
        } else {
            return back()->with('warning','El estatus "'. $request['estatus'] .'" ya esta registrado.');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Estatusaseguradoras  $estatusaseguradoras
     * @return \Illuminate\Http\Response
     */
    public function show(Estatusaseguradoras $estatusaseguradoras)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Estatusaseguradoras  $estatusaseguradoras
     * @return \Illuminate\Http\Response
     */
    public function edit(Estatusaseguradoras $estatusaseguradoras)
    {
        return view('catalogos.facturas.u_facturas', compact('estatusaseguradoras'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Estatusaseguradoras  $estatusaseguradoras
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Estatusaseguradoras $estatusaseguradoras)
    {
        if ($estatusaseguradoras->estatus == $request->estatus) {
            return redirect()->route('l_estatusF')->with('warning','No se Actualizo el estatus "'. $request->estatus . '".');
        } else {
            $estatusaseguradoras->estatus = $request->estatus;
            if ($estatusaseguradoras->save()) {
                return redirect()->route('l_estatusF')->with('success','Estatus Actualizado.');
            } else {
                return redirect()->route('l_estatusF')->with('error','Estatus no Actualizado.');
            }
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Estatusaseguradoras  $estatusaseguradoras
     * @return \Illuminate\Http\Response
     */
    public function destroy(Estatusaseguradoras $estatusaseguradoras)
    {
        if ($estatusaseguradoras->delete()) {
            return redirect()->route('l_estatusF')->with('success','Estatus Eliminado.');
        } else {
            return redirect()->route('l_estatusF')->with('error','Estatus no Eliminado.');
        }
    }
}
