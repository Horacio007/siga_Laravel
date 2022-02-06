<?php

namespace App\Http\Controllers;

use App\Models\Forma_pago;
use App\Models\Gastos;
use App\Models\Vehiculo;
use App\Models\si_no;
use App\Models\Conceptos_pagos;
use App\Models\recibo_pago_proveedores;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class GastosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $list_gastos = Gastos::with(['forma_pagos', 'facturas', 'concepto_pagos', 'expedientes'])
                                ->get();

        //dd($list_gastos[0]->forma_pagos);
        return view('costos.gastos.l_gastos', compact('list_gastos'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $list_vehiculo = Vehiculo::with(['marcas:id,marca', 'submarcas:id,submarca', 'clientes:id,nombre', 'asesores:id,nombre,a_paterno,a_materno', 'estatusV:id,status', 'estatusProceso:id,estatus'])
                                ->select('id_aux','id','estatus_id', 'estatusProceso_id','modelo', 'color', 'marca_id', 'linea_id', 'cliente_id', 'placas', 'id_asesor', 'fecha_salida_taller')
                                ->whereIn('estatus_id',['5', '6'])
                                ->whereNotIn('estatusProceso_id', ['1', '5', '12'])
                                ->orderBy('id_aux')
                                ->get();

        $sino = si_no::all();
        $conceptos_pago = Conceptos_pagos::all();
        $forma_pago = Forma_pago::all();
        //dd($list_vehiculo[0]);
        return view('costos.gastos.i_gastos', compact(['list_vehiculo', 'sino', 'conceptos_pago', 'forma_pago']));
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
        $gasto = new Gastos();
        $gasto->fecha = $request->fecha;
        $gasto->articulos = $request->articulo;
        $gasto->gastos = $request->cantidad;
        $gasto->forma_pago = $request->forma_pago; 
        $gasto->factura = $request->sfactura;
        $gasto->tipo = $request->gasto;
        $gasto->proveedor = $request->proveedor;
        $gasto->expediente = $request->expediente;

        if ($gasto->save()) {
            return redirect()->route('l_gastos')->with('success','Gasto Registrado.');
        } else {
            return redirect()->route('l_gastos')->with('error','Gasto no Registrado.');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Gastos  $gastos
     * @return \Illuminate\Http\Response
     */
    public function show(Gastos $gastos)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Gastos  $gastos
     * @return \Illuminate\Http\Response
     */
    public function edit(Gastos $gastos)
    {
        //dd($gastos);
        $sino = si_no::all();
        $conceptos_pago = Conceptos_pagos::all();
        $forma_pago = Forma_pago::all();
        return view('costos.gastos.u_gastos', compact(['gastos', 'sino', 'conceptos_pago', 'forma_pago']));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Gastos  $gastos
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Gastos $gastos)
    {
        $gastos->fecha = $request->fecha;
        $gastos->articulos = $request->articulo;
        $gastos->gastos = $request->cantidad;
        $gastos->forma_pago = $request->forma_pago; 
        $gastos->factura = $request->sfactura;
        $gastos->tipo = $request->gasto;
        $gastos->proveedor = $request->proveedor;
        $gastos->expediente = $request->expediente;

        if ($gastos->save()) {
            return redirect()->route('l_gastos')->with('success','Gasto Actualizado.');
        } else {
            return redirect()->route('l_gastos')->with('error','Gasto no Actualizado.');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Gastos  $gastos
     * @return \Illuminate\Http\Response
     */
    public function destroy(Gastos $gastos)
    {
        $recibo = recibo_pago_proveedores::where('concepto', $gastos->articulos)
                            ->whereDate('fecha', $gastos->fecha)
                            ->where('cantidad',  $gastos->gastos)
                            ->where('forma_pago', $gastos->forma_pago)
                            ->where('proveedor', $gastos->proveedor)
                            ->where('aplica_factura', $gastos->factura)
                            ->where('tipo_gasto_id', $gastos->tipo)
                            //->where('id_vehiculo',  $gastos->expediente??null)
                            ->first();
        //dd($recibo);
        if ($recibo??'') {
            $recibo->delete();
        }
        

        if ($gastos->delete()) {
            return redirect()->route('l_gastos')->with('success','Gasto Eliminado.');
        } else {
            return redirect()->route('l_gastos')->with('error','Gasto no Eliminado.');
        }
    }

    public function h_gastos(){
        return view('costos.historico_gastos.g_gastosmos');
    }

    public function g_tipo_gasto_mes(Request $request){
        if (isset($request->tpgmes)) {
            $renta = DB::select('SELECT 
                                    tipo, 
                                    SUM(gastos) as gastos 
                                FROM 
                                    gastos
                                WHERE 
                                    tipo = 1 
                                AND MONTH(fecha) = MONTH(NOW()) 
                                AND YEAR(fecha) = YEAR(NOW())');

            $impuesto = DB::select('SELECT 
                                        tipo, 
                                        SUM(gastos) as gastos 
                                    FROM 
                                        gastos 
                                    WHERE 
                                        tipo = 2 
                                    AND MONTH(fecha) = MONTH(NOW()) 
                                    AND YEAR(fecha) = YEAR(NOW())');

            $nomina = DB::select('SELECT 
                                    tipo, 
                                    SUM(gastos) as gastos 
                                FROM 
                                    gastos 
                                WHERE 
                                    tipo = 3 
                                AND MONTH(fecha) = MONTH(NOW()) 
                                AND YEAR(fecha) = YEAR(NOW())');

            $equipo = DB::select('SELECT 
                                    tipo, 
                                    SUM(gastos) as gastos 
                                FROM 
                                    gastos 
                                WHERE 
                                    tipo = 4 
                                AND MONTH(fecha) = MONTH(NOW()) 
                                AND YEAR(fecha) = YEAR(NOW())');

            $materiales_acabado = DB::select('SELECT 
                                                tipo, 
                                                SUM(gastos) as gastos   
                                            FROM 
                                                gastos 
                                            WHERE 
                                                tipo = 5 
                                            AND MONTH(fecha) = MONTH(NOW()) 
                                            AND YEAR(fecha) = YEAR(NOW())');

            $refacciones = DB::select('SELECT 
                                        tipo, 
                                        SUM(gastos) as gastos 
                                    FROM 
                                        gastos 
                                    WHERE 
                                        tipo = 6 
                                    AND MONTH(fecha) = MONTH(NOW()) 
                                    AND YEAR(fecha) = YEAR(NOW())');

            $servicios = DB::select('SELECT 
                                        tipo, 
                                        SUM(gastos) as gastos 
                                    FROM 
                                        gastos 
                                    WHERE 
                                        tipo = 7 
                                    AND MONTH(fecha) = MONTH(NOW()) 
                                    AND YEAR(fecha) = YEAR(NOW())');

            $administracion = DB::select('SELECT 
                                            tipo, 
                                            SUM(gastos) as gastos 
                                        FROM 
                                            gastos 
                                        WHERE 
                                            tipo = 8 
                                        AND MONTH(fecha) = MONTH(NOW()) 
                                        AND YEAR(fecha) = YEAR(NOW())');

            $tot = DB::select('SELECT 
                                tipo, 
                                SUM(gastos) as gastos 
                            FROM 
                                gastos 
                            WHERE 
                                tipo = 9 
                            AND MONTH(fecha) = MONTH(NOW()) 
                            AND YEAR(fecha) = YEAR(NOW())');

            $papeleria = DB::select('SELECT 
                                        tipo, 
                                        SUM(gastos) as gastos 
                                    FROM 
                                        gastos 
                                    WHERE 
                                        tipo = 10 
                                    AND MONTH(fecha) = MONTH(NOW()) 
                                    AND YEAR(fecha) = YEAR(NOW())');

            $herramienta = DB::select('SELECT 
                                            tipo, 
                                            SUM(gastos) as gastos 
                                        FROM 
                                            gastos 
                                        WHERE 
                                            tipo = 11 
                                        AND MONTH(fecha) = MONTH(NOW()) 
                                        AND YEAR(fecha) = YEAR(NOW())');

            $miscelaneos = DB::select('SELECT 
                                            tipo, 
                                            SUM(gastos) as gastos 
                                        FROM 
                                            gastos 
                                        WHERE 
                                            tipo = 12 
                                        AND MONTH(fecha) = MONTH(NOW()) 
                                        AND YEAR(fecha) = YEAR(NOW())');

            $limpieza = DB::select('SELECT 
                                        tipo, 
                                        SUM(gastos) as gastos 
                                        FROM 
                                            gastos 
                                        WHERE 
                                            tipo = 13 
                                        AND MONTH(fecha) = MONTH(NOW()) 
                                        AND YEAR(fecha) = YEAR(NOW())');

            $materiales_proceso = DB::select('SELECT 
                                                tipo, 
                                                SUM(gastos) as gastos 
                                            FROM 
                                                gastos 
                                            WHERE 
                                                tipo = 14 
                                            AND MONTH(fecha) = MONTH(NOW()) 
                                            AND YEAR(fecha) = YEAR(NOW())');

            $datos = array(
                array('Renta' => 'Renta', 'cantidad' => $renta[0]->gastos),
                array('Impuestos' => 'Impuestos', 'cantidad' => $impuesto[0]->gastos),
                array('Nomina' => 'Nomina', 'cantidad' => $nomina[0]->gastos),
                array('Equipo' => 'Equipo', 'cantidad' => $equipo[0]->gastos),
                array('Materiales de Acabado' => 'Materiales de Acabado', 'cantidad' => $materiales_acabado[0]->gastos),
                array('Refacciónes' => 'Refacciónes', 'cantidad' => $refacciones[0]->gastos),
                array('Servicios' => 'Servicios', 'cantidad' => $servicios[0]->gastos),
                array('Administración' => 'Administración', 'cantidad' => $administracion[0]->gastos),
                array('T.O.T' => 'T.O.T', 'cantidad' => $tot[0]->gastos),
                array('Papeleria' => 'Papeleria', 'cantidad' => $papeleria[0]->gastos),
                array('Herramientas' => 'Herramientas', 'cantidad' => $herramienta[0]->gastos),
                array('Miscelaneos' => 'Miscelaneos', 'cantidad' => $miscelaneos[0]->gastos),
                array('Limpieza' => 'Limpieza', 'cantidad' => $limpieza[0]->gastos),
                array('Materiales' => 'Materiales de Proceso', 'cantidad' => $materiales_proceso[0]->gastos)
            );

            foreach ($datos as $key => $row) {
                $aux[$key] = $row['cantidad'];
            }
    
            array_multisort($aux, SORT_DESC, $datos);
    
            return json_encode($datos);
        }
    }
}
