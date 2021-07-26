<?php

namespace App\Http\Controllers;

use App\Models\Aud_limpieza;
use Illuminate\Http\Request;

class AudLimpiezaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $auditorias = Aud_limpieza::all();

        return view('auditorias.limpieza.l_audlLimpieza', compact('auditorias'));
    }

    public function i_audlimpieza(){
        return view('auditorias.limpieza.i_audLimpieza');
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
        $auditoria = new Aud_limpieza();

        $auditoria->fecha = $request->fecha;
        $auditoria->oficinas = $request->ofi;
        $auditoria->al_limpieza = $request->alimpie;
        $auditoria->al_refacciones = $request->alrefas;
        $auditoria->comedor = $request->comedor;
        $auditoria->mecanica = $request->meca;
        $auditoria->hoja_1 = $request->hoja1;
        $auditoria->hoja_2 = $request->hoja2;
        $auditoria->hoja_3 = $request->hoja3;
        $auditoria->hojalateria = $request->hoja;
        $auditoria->prep_pint = $request->prep_pint;
        $auditoria->al_pinturas = $request->alpin;
        $auditoria->pul_det_lav = $request->puldetlav;
        $auditoria->lavado = $request->lavado;

        if ($auditoria->save()) {
            return redirect()->route('l_audlimpieza')->with('success','Auditoria Registrada.');
        } else {
            return redirect()->route('l_audlimpieza')->with('error','Auditoria no Registrada.');
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Aud_limpieza  $aud_limpieza
     * @return \Illuminate\Http\Response
     */
    public function show(Aud_limpieza $aud_limpieza)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Aud_limpieza  $aud_limpieza
     * @return \Illuminate\Http\Response
     */
    public function edit(Aud_limpieza $aud_limpieza)
    {
        //dd($aud_limpieza);
        return view('auditorias.limpieza.u_audLimpieza', compact('aud_limpieza'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Aud_limpieza  $aud_limpieza
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Aud_limpieza $aud_limpieza)
    {
        $aud_limpieza->fecha = $request->fecha;
        $aud_limpieza->oficinas = $request->ofi;
        $aud_limpieza->al_limpieza = $request->alimpie;
        $aud_limpieza->al_refacciones = $request->alrefas;
        $aud_limpieza->comedor = $request->comedor;
        $aud_limpieza->mecanica = $request->meca;
        $aud_limpieza->hoja_1 = $request->hoja1;
        $aud_limpieza->hoja_2 = $request->hoja2;
        $aud_limpieza->hoja_3 = $request->hoja3;
        $aud_limpieza->hojalateria = $request->hoja;
        $aud_limpieza->prep_pint = $request->prep_pint;
        $aud_limpieza->al_pinturas = $request->alpin;
        $aud_limpieza->pul_det_lav = $request->puldetlav;
        $aud_limpieza->lavado = $request->lavado;

        if ($aud_limpieza->save()) {
            return redirect()->route('l_audlimpieza')->with('success','Auditoria Actualizada.');
        } else {
            return redirect()->route('l_audlimpieza')->with('error','Auditoria no Actualizada.');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Aud_limpieza  $aud_limpieza
     * @return \Illuminate\Http\Response
     */
    public function destroy(Aud_limpieza $aud_limpieza)
    {
        if ($aud_limpieza->delete()) {
            return redirect()->route('l_audlimpieza')->with('success','Auditoria Eliminada.');
        } else {
            return redirect()->route('l_audlimpieza')->with('error','Auditoria no Eliminada.');
        }
    }
}
