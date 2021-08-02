<?php

namespace App\Http\Controllers;

use App\Models\Ingresos;
use App\Models\Vehiculo;
use App\Models\Tipo_pago;
use App\Models\Tipo_servicio;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class IngresosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $list_ingresos = DB::select('SELECT
                                        ingresos.id,
                                        ingresos.id_vehiculo,
                                        modelosv.marca,
                                        submarcav.submarca,
                                        vehiculo.color,
                                        vehiculo.modelo,
                                        vehiculo.placas,
                                        aseguradoras.nombre AS aseguradora,
                                        tipo_servicio.tipo_servicio,
                                        ingresos.fecha_anticipo,
                                        ingresos.anticipo,
                                        ingresos.tipo_pago_anticipo,
                                        ingresos.fecha_finiquito,
                                        ingresos.finiquito,
                                        ingresos.tipo_pago_finiquito,
                                        ingresos.total
                                    FROM
                                        vehiculo,
                                        modelosv,
                                        submarcav,
                                        aseguradoras,
                                        ingresos,
                                        tipo_servicio
                                    WHERE
                                        (ingresos.id_vehiculo = vehiculo.id)
                                    AND vehiculo.marca_id = modelosv.id
                                    AND vehiculo.linea_id = submarcav.id
                                    AND aseguradoras.id = vehiculo.cliente_id
                                    AND tipo_servicio.id = ingresos.tipo_servicio
                                    ORDER BY
                                        ingresos.id');

        //$list = Ingresos::with(['expedientes', 'tipo_pago_a', 'tipo_pago_f', 'tipo_servicio'])->get();
        //dd($list[68]);
        //dd($list_ingresos);
        return view('ingresos.ingresos.l_ingresos', compact('list_ingresos'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $vehiculos = Vehiculo::with(['marcas:id,marca', 'submarcas:id,submarca', 'clientes:id,nombre', 'asesores:id,nombre,a_paterno,a_materno', 'estatus:id,status'])
                            ->select('id_aux','id','estatus_id','modelo', 'color', 'marca_id', 'linea_id', 'cliente_id', 'placas', 'id_asesor', 'no_siniestro', 'fecha_salida_taller')
                            ->where('estatus_id','3')
                            ->orderBy('id_aux')
                            ->get();

        $tipo_pago = Tipo_pago::all();

        $tipo_servicio = Tipo_servicio::all();

        return view('ingresos.ingresos.i_ingresos', compact(['vehiculos', 'tipo_pago', 'tipo_servicio']));
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
        $ingreso = new Ingresos();
        $ingreso->id_vehiculo = $request->iexpediente2;
        $ingreso->cliente = $request->cliente;
        $ingreso->tipo_servicio = $request->tipo_servicio;
        $ingreso->fecha_anticipo = $request->fanticipo;
        $ingreso->anticipo = $request->ianticipo;
        $ingreso->tipo_pago_anticipo = $request->tipo_anticipo;
        $ingreso->fecha_finiquito = $request->ffiniquito;
        $ingreso->finiquito = $request->ifiniquito;
        $ingreso->tipo_pago_finiquito = $request->tipo_finiquito;
        $ingreso->total = $request->total;

        if ($ingreso->save()) {
            return redirect()->route('l_ingresos')->with('success','Ingreso Registrado.');
        } else {
            return redirect()->route('l_ingresos')->with('error','Ingreso no Registrado.');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Ingresos  $ingresos
     * @return \Illuminate\Http\Response
     */
    public function show(Ingresos $ingresos)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Ingresos  $ingresos
     * @return \Illuminate\Http\Response
     */
    public function edit(Ingresos $ingresos)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Ingresos  $ingresos
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Ingresos $ingresos)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Ingresos  $ingresos
     * @return \Illuminate\Http\Response
     */
    public function destroy(Ingresos $ingresos)
    {
        //
    }
}
