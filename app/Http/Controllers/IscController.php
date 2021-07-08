<?php

namespace App\Http\Controllers;

use App\Models\Isc;
use App\Models\Vehiculo;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class IscController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $encuestas = DB::select("SELECT
                                    isc.id,
                                    isc.id_vehiculo,
                                    isc.id_cliente,
                                    isc.atendio,
                                    modelosv.marca,
                                    submarcav.submarca,
                                    vehiculo.color,
                                    vehiculo.modelo,
                                    vehiculo.placas,
                                    aseguradoras.nombre AS aseguradora,
                                    isc.fecha,
                                    isc.p1,
                                    isc.p2,
                                    isc.p3,
                                    isc.p4,
                                    isc.p5,
                                    isc.p7,
                                    isc.total
                                FROM
                                    vehiculo,
                                    isc,
                                    modelosv,
                                    submarcav,
                                    aseguradoras
                                WHERE 
                                    isc.id_vehiculo = vehiculo.id
                                AND vehiculo.marca_id = modelosv.id
                                AND vehiculo.linea_id = submarcav.id
                                AND aseguradoras.id = vehiculo.cliente_id
                                ORDER BY
                                    isc.id");

        return view('entrega.isc.l_isc', compact('encuestas'));
    }

    public function i_ics(){
        $vehiculos = Vehiculo::with(['marcas:id,marca', 'submarcas:id,submarca', 'clientes:id,nombre', 'asesores:id,nombre,a_paterno,a_materno', 'estatus:id,status'])
                            ->select('id','estatus_id','modelo', 'color', 'marca_id', 'linea_id', 'cliente_id', 'placas', 'id_asesor', 'no_siniestro', 'fecha_llegada')
                            ->where('estatus_id','3')
                            ->orderBy('id_aux')
                            ->get();

        return view('entrega.isc.i_isc', compact('vehiculos'));
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
        $isc = new Isc();
        $isc->id_vehiculo = $request->id;
        $isc->id_cliente = $request->n_cliente;
        $isc->atendio = $request->atendio;
        $isc->fecha = $request->fecha;
        $isc->p1 = $request->p1;
        $isc->p2 = $request->p2;
        $isc->p3 = $request->p3;
        $isc->p4 = $request->p4;
        $isc->p5 = $request->p5;
        $isc->p7 = $request->p7;
        $isc->total = $request->total;
        $isc->cliente_id = $request->id_c;

        if ($isc->save()) {
            return 1;
        } else {
            return 'Encuesta no registrada';
        }
        
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Isc  $isc
     * @return \Illuminate\Http\Response
     */
    public function show(Isc $isc)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Isc  $isc
     * @return \Illuminate\Http\Response
     */
    public function edit(Isc $isc)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Isc  $isc
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Isc $isc)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Isc  $isc
     * @return \Illuminate\Http\Response
     */
    public function destroy(Isc $isc)
    {
        if ($isc->delete()) {
            return redirect()->route('l_ics')->with('success','Encuesta Eliminada.');
        } else {
            return redirect()->route('l_ics')->with('error','Encuesta no Eliminada.');
        }
        
    }
}
