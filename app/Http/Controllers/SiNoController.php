<?php

namespace App\Http\Controllers;

use App\Models\si_no;
use Illuminate\Http\Request;
use SiNo;

class SiNoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $list_sino =si_no::all();

        return view('catalogos.si_no.l_sino', compact('list_sino'));
    }

    public function i_sino(){
        return view('catalogos.si_no.i_sino');
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
        $r = si_no::where('nombre', $request['tipo'])
                        ->select('nombre')
                        ->get();

        if ($r->isEmpty()) {
            $tipo = new si_no;
            $tipo->nombre = $request->tipo;
            if ($tipo->save()) {
                return redirect()->route('l_sino')->with('success','Tipo si/no Registrado.');
            } else {
                return redirect()->route('l_sino')->with('error','Tipo si/no no Registrado.');
            }
        } else {
            return back()->with('warning','El tipo de si/no "'. $request['tipo'] .'" ya esta registrado.');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\si_no  $si_no
     * @return \Illuminate\Http\Response
     */
    public function show(si_no $si_no)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\si_no  $si_no
     * @return \Illuminate\Http\Response
     */
    public function edit(si_no $si_no)
    {
        return view('catalogos.si_no.u_sino', compact('si_no'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\si_no  $si_no
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, si_no $si_no)
    {
        if ($si_no->nombre == $request->tipo) {
            return redirect()->route('l_sino')->with('warning','No se Actualizo si/no "'. $request->tipo . '".');
        } else {
            $si_no->nombre = $request->tipo;
            if ($si_no->save()) {
                return redirect()->route('l_sino')->with('success','Si/No Actualizado.');
            } else {
                return redirect()->route('l_sino')->with('error','Si/No no Actualizado.');
            }
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\si_no  $si_no
     * @return \Illuminate\Http\Response
     */
    public function destroy(si_no $si_no)
    {
        if ($si_no->delete()) {
            return redirect()->route('l_sino')->with('success','Si/No Eliminado.');
        } else {
            return redirect()->route('l_sino')->with('error','Si/No no Eliminado.');
        }
    }
}
