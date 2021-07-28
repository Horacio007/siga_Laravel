<?php

namespace App\Http\Controllers;

use App\Models\Tipo_servicio;
use Illuminate\Http\Request;

class TipoServicioController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $list_tipo_servicio = Tipo_servicio::all();

        return view('catalogos.tipo_servicio.l_tiposervicio', compact('list_tipo_servicio'));
    }

    public function i_tiposervicio(){
        return view('catalogos.tipo_servicio.i_tiposervicio');
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
        $r = Tipo_servicio::where('tipo_servicio', $request['tipo'])
                        ->select('tipo_servicio')
                        ->get();

        if ($r->isEmpty()) {
            $tipo = new Tipo_servicio;
            $tipo->tipo_servicio = $request->tipo;
            if ($tipo->save()) {
                return redirect()->route('l_tiposervicio')->with('success','Tipo Servicio Registrado.');
            } else {
                return redirect()->route('l_tiposervicio')->with('error','Tipo Servicio no Registrado.');
            }
        } else {
            return back()->with('warning','El tipo de servicio "'. $request['tipo'] .'" ya esta registrado.');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Tipo_servicio  $tipo_servicio
     * @return \Illuminate\Http\Response
     */
    public function show(Tipo_servicio $tipo_servicio)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Tipo_servicio  $tipo_servicio
     * @return \Illuminate\Http\Response
     */
    public function edit(Tipo_servicio $tipo_servicio)
    {
        return view('catalogos.tipo_servicio.u_tiposervicio', compact('tipo_servicio'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Tipo_servicio  $tipo_servicio
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Tipo_servicio $tipo_servicio)
    {
        if ($tipo_servicio->tipo_servicio == $request->tipo) {
            return redirect()->route('l_tiposervicio')->with('warning','No se Actualizo tipo servicio "'. $request->tipo . '".');
        } else {
            $tipo_servicio->tipo_servicio = $request->tipo;
            if ($tipo_servicio->save()) {
                return redirect()->route('l_tiposervicio')->with('success','Tipo Servicio Actualizado.');
            } else {
                return redirect()->route('l_tiposervicio')->with('error','Tipo Servicio no Actualizado.');
            }
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Tipo_servicio  $tipo_servicio
     * @return \Illuminate\Http\Response
     */
    public function destroy(Tipo_servicio $tipo_servicio)
    {
        if ($tipo_servicio->delete()) {
            return redirect()->route('l_tiposervicio')->with('success','Tipo Servicio Eliminado.');
        } else {
            return redirect()->route('l_tiposervicio')->with('error','Tipo Servicio no Eliminado.');
        }
    }
}
