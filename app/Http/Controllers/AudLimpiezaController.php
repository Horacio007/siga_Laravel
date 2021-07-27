<?php

namespace App\Http\Controllers;

use App\Models\Aud_limpieza;
use Illuminate\Support\Facades\DB;
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

    public function g_aud_limpieza(Request $request){
        if (isset($request->aud_limpiza)) {
            $auditoria = DB::select('SELECT 
                                    TRUNCATE(AVG(oficinas),2) as oficinas, 
                                    TRUNCATE(AVG(al_limpieza),2) as al_limpieza, 
                                    TRUNCATE(AVG(al_refacciones),2) as al_refacciones, 
                                    TRUNCATE(AVG(comedor),2) as comedor, 
                                    TRUNCATE(AVG(mecanica),2) as mecanica, 
                                    TRUNCATE(AVG(hojalateria),2) as hojalateria, 
                                    TRUNCATE(AVG(prep_pint),2) as prep_pint, 
                                    TRUNCATE(AVG(al_pinturas),2) as al_pinturas, 
                                    TRUNCATE(AVG(pul_det_lav),2) as pul_det_lav, 
                                    TRUNCATE(AVG(lavado),2) as lavado 
                                FROM 
                                    aud_limpieza 
                                WHERE 
                                    MONTH(fecha) = MONTH(NOW())-1 
                                AND oficinas != 0');

            //dd($auditoria);
            $x = array('Oficinas', 'Almacen de Limpieza', 'Almacen de Refacciones', 'Comedor', 'Mecanica', 'Hojalateria', 'Preparacion y Pintura', 'Almacen de Pinturas', 'Pulido y Detallado', 'Lavado');
            $y = array($auditoria[0]->oficinas, $auditoria[0]->al_limpieza, $auditoria[0]->al_refacciones, $auditoria[0]->comedor, $auditoria[0]->mecanica, $auditoria[0]->hojalateria, $auditoria[0]->prep_pint, $auditoria[0]->al_pinturas, $auditoria[0]->pul_det_lav, $auditoria[0]->lavado);

            $datos = array(
                'area' => $x,
                'total' => $y,
                'mes' => intval(date('m'))-2
            );

            return json_encode($datos);
        }
    }

    public function g_aud_limpieza_actual(Request $request){
        if (isset($request->aud_limpiza)) {
            $auditoria = DB::select('SELECT 
                                    TRUNCATE(AVG(oficinas),2) as oficinas, 
                                    TRUNCATE(AVG(al_limpieza),2) as al_limpieza, 
                                    TRUNCATE(AVG(al_refacciones),2) as al_refacciones, 
                                    TRUNCATE(AVG(comedor),2) as comedor, 
                                    TRUNCATE(AVG(mecanica),2) as mecanica, 
                                    TRUNCATE(AVG(hojalateria),2) as hojalateria, 
                                    TRUNCATE(AVG(prep_pint),2) as prep_pint, 
                                    TRUNCATE(AVG(al_pinturas),2) as al_pinturas, 
                                    TRUNCATE(AVG(pul_det_lav),2) as pul_det_lav, 
                                    TRUNCATE(AVG(lavado),2) as lavado 
                                FROM 
                                    aud_limpieza 
                                WHERE 
                                    MONTH(fecha) = MONTH(NOW()) 
                                AND oficinas != 0');

            //dd($auditoria);
            $x = array('Oficinas', 'Almacen de Limpieza', 'Almacen de Refacciones', 'Comedor', 'Mecanica', 'Hojalateria', 'Preparacion y Pintura', 'Almacen de Pinturas', 'Pulido y Detallado', 'Lavado');
            $y = array($auditoria[0]->oficinas, $auditoria[0]->al_limpieza, $auditoria[0]->al_refacciones, $auditoria[0]->comedor, $auditoria[0]->mecanica, $auditoria[0]->hojalateria, $auditoria[0]->prep_pint, $auditoria[0]->al_pinturas, $auditoria[0]->pul_det_lav, $auditoria[0]->lavado);

            $datos = array(
                'area' => $x,
                'total' => $y,
                'mes' => intval(date('m'))-1
            );

            return json_encode($datos);
        }
    }

    public function g_aud_limpieza_encargado(Request $request){
        if (isset($request->aud_limpiza)) {
            $auditoria = DB::select('SELECT 
                                        TRUNCATE(AVG(oficinas),2) as oficinas, 
                                        TRUNCATE(AVG(al_limpieza),2) as al_limpieza, 
                                        TRUNCATE(AVG(al_refacciones),2) as al_refacciones, 
                                        TRUNCATE(AVG(comedor),2) as comedor, 
                                        TRUNCATE(AVG(mecanica),2) as mecanica, 
                                        TRUNCATE(AVG(hoja_1),2) as hoja_1, 
                                        TRUNCATE(AVG(hoja_2),2) as hoja_2, 
                                        TRUNCATE(AVG(hoja_3),2) as hoja_3, 
                                        TRUNCATE(AVG(hojalateria),2) as hojalateria, 
                                        TRUNCATE(AVG(prep_pint),2) as prep_pint, 
                                        TRUNCATE(AVG(al_pinturas),2) as al_pinturas, 
                                        TRUNCATE(AVG(pul_det_lav),2) as pul_det_lav, 
                                        TRUNCATE(AVG(lavado),2) as lavado 
                                    FROM 
                                        aud_limpieza 
                                    WHERE 
                                        MONTH(fecha) = MONTH(NOW())-1 
                                    AND oficinas != 0');

            //dd($auditoria);
            $x = array('Oficinas', 'Almacen de Limpieza', 'Almacen de Refacciones', 'Comedor', 'Mecanica', 'Hojalatero 1 -> Marcial', 'Hojalatero 2 -> Luis Carlos', 'Hojalatero 3 -> ','Preparacion y Pintura', 'Almacen de Pinturas', 'Pulido y Detallado', 'Lavado');
            $y = array($auditoria[0]->oficinas, $auditoria[0]->al_limpieza, $auditoria[0]->al_refacciones, $auditoria[0]->comedor, $auditoria[0]->mecanica, $auditoria[0]->hoja_1, $auditoria[0]->hoja_2, $auditoria[0]->hoja_3, $auditoria[0]->hojalateria, $auditoria[0]->prep_pint, $auditoria[0]->al_pinturas, $auditoria[0]->pul_det_lav, $auditoria[0]->lavado);

            $datos = array(
                'area / personal' => $x,
                'total' => $y,
                'mes' => intval(date('m'))-2
            );

            return json_encode($datos);
        }
    }

    public function g_aud_limpieza_actual_personal(Request $request){
        if (isset($request->aud_limpiza)) {
            $auditoria = DB::select('SELECT 
                                        TRUNCATE(AVG(oficinas),2) as oficinas, 
                                        TRUNCATE(AVG(al_limpieza),2) as al_limpieza, 
                                        TRUNCATE(AVG(al_refacciones),2) as al_refacciones, 
                                        TRUNCATE(AVG(comedor),2) as comedor, 
                                        TRUNCATE(AVG(mecanica),2) as mecanica, 
                                        TRUNCATE(AVG(hoja_1),2) as hoja_1, 
                                        TRUNCATE(AVG(hoja_2),2) as hoja_2, 
                                        TRUNCATE(AVG(hoja_3),2) as hoja_3, 
                                        TRUNCATE(AVG(hojalateria),2) as hojalateria, 
                                        TRUNCATE(AVG(prep_pint),2) as prep_pint, 
                                        TRUNCATE(AVG(al_pinturas),2) as al_pinturas, 
                                        TRUNCATE(AVG(pul_det_lav),2) as pul_det_lav, 
                                        TRUNCATE(AVG(lavado),2) as lavado 
                                    FROM 
                                        aud_limpieza 
                                    WHERE 
                                        MONTH(fecha) = MONTH(NOW()) 
                                    AND oficinas != 0');

            //dd($auditoria);
            $x = array('Oficinas', 'Almacen de Limpieza', 'Almacen de Refacciones', 'Comedor', 'Mecanica', 'Hojalatero 1 -> Marcial', 'Hojalatero 2 -> Luis Carlos', 'Hojalatero 3 -> ','Preparacion y Pintura', 'Almacen de Pinturas', 'Pulido y Detallado', 'Lavado');
            $y = array($auditoria[0]->oficinas, $auditoria[0]->al_limpieza, $auditoria[0]->al_refacciones, $auditoria[0]->comedor, $auditoria[0]->mecanica, $auditoria[0]->hoja_1, $auditoria[0]->hoja_2, $auditoria[0]->hoja_3, $auditoria[0]->hojalateria, $auditoria[0]->prep_pint, $auditoria[0]->al_pinturas, $auditoria[0]->pul_det_lav, $auditoria[0]->lavado);

            $datos = array(
                'area / personal' => $x,
                'total' => $y,
                'mes' => intval(date('m'))-1
            );

            return json_encode($datos);
        }
    }

    public function afinaciones(){
        return view('catalogo_servicios.afinaciones.afinaciones');
    }

    public function frenos(){
        return view('catalogo_servicios.frenos.frenos');
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
