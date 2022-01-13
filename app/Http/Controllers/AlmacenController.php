<?php

namespace App\Http\Controllers;

use App\Models\Almacen;
use App\Models\Vehiculo;
use App\Models\Aseguradoras;
use App\Models\Estatusalmacen;
use App\Models\Modelosv;
use App\Models\Submarcav;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\SoftDeletes;

class AlmacenController extends Controller
{
    use SoftDeletes;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $list_refacciones = DB::select("SELECT
                                            almacen.id,
                                            almacen.fecha_llegada,
                                            aseguradoras.nombre,
                                            almacen.descripcion,
                                            modelosv.marca,
                                            submarcav.submarca,
                                            vehiculo.modelo,
                                            almacen.id_vehiculo,
                                            almacen.ubicacion,
                                            almacen.fecha_entrega,
                                            estatusalmacen.estatus,
                                            almacen.comentarios
                                        FROM
                                            vehiculo,
                                            almacen,
                                            modelosv,
                                            submarcav,
                                            aseguradoras,
                                            estatusalmacen
                                        WHERE
                                            almacen.id_vehiculo = vehiculo.id
                                        AND almacen.estatus_id = 1
                                        AND vehiculo.marca_id = modelosv.id
                                        AND vehiculo.linea_id = submarcav.id
                                        AND almacen.aseguradora_id = aseguradoras.id
                                        AND almacen.estatus_id = estatusalmacen.id
                                        ORDER BY
                                            almacen.id");

        return view('refacciones.refacciones.altaRefacciones.l_refacciones', compact('list_refacciones'));
    }

    public function index2()
    {
        /*AND ISNULL (almacen.fecha_llegada)
        $list_refacciones = DB::select("SELECT
                                            almacen.id,
                                            almacen.id_vehiculo,
                                            almacen.fecha_llegada,
                                            aseguradoras.nombre,
                                            almacen.descripcion,
                                            modelosv.marca,
                                            submarcav.submarca,
                                            vehiculo.modelo,
                                            almacen.ubicacion,
                                            almacen.fecha_entrega,
                                            estatusalmacen.estatus,
                                            almacen.comentarios,
                                            almacen.proveedor,
                                            almacen.fecha_promesa
                                        FROM
                                            vehiculo,
                                            almacen,
                                            modelosv,
                                            submarcav,
                                            aseguradoras,
                                            estatusalmacen
                                        WHERE
                                            almacen.id_vehiculo = vehiculo.id
                                        AND vehiculo.estatus_id != 7
                                        AND almacen.estatus_id != 3
                                        AND almacen.estatus_id != 4
                                        AND almacen.estatus_id != 2
                                        AND almacen.estatus_id IS NULL
                                        AND vehiculo.marca_id = modelosv.id
                                        AND vehiculo.linea_id = submarcav.id
                                        AND almacen.aseguradora_id = aseguradoras.id
                                        AND almacen.estatus_id = estatusalmacen.id
                                        ORDER BY
                                            almacen.id DESC");
        */

        $list_refacciones = Almacen::with(['vehiculo', 'estatus', 'aseguradora'])
                                    ->orderBy('id')
                                    ->get();
        $marcas = Modelosv::all();
        $submarcas = Submarcav::all();
        $aseguradoras = Aseguradoras::all();
        //dd($list_refacciones[0]);
        return view('refacciones.refacciones.seguimientoRefacciones.l_segRefacciones', compact(['list_refacciones', 'marcas', 'submarcas', 'aseguradoras']));
    }

    public function index3()
    {
        $list_refacciones = DB::select("SELECT
                                            almacen.id,
                                            almacen.id_vehiculo,
                                            almacen.fecha_llegada,
                                            aseguradoras.nombre,
                                            almacen.descripcion,
                                            modelosv.marca,
                                            submarcav.submarca,
                                            vehiculo.modelo,
                                            almacen.ubicacion,
                                            almacen.fecha_entrega,
                                            estatusalmacen.estatus,
                                            almacen.comentarios,
                                            almacen.proveedor,
                                            almacen.fecha_promesa
                                        FROM
                                            vehiculo,
                                            almacen,
                                            modelosv,
                                            submarcav,
                                            aseguradoras,
                                            estatusalmacen
                                        WHERE
                                            almacen.id_vehiculo = vehiculo.id
                                        AND almacen.estatus_id = 3
                                        AND vehiculo.marca_id = modelosv.id
                                        AND vehiculo.linea_id = submarcav.id
                                        AND almacen.aseguradora_id = aseguradoras.id
                                        AND almacen.estatus_id = estatusalmacen.id
                                        ORDER BY
                                            almacen.id DESC");

        return view('refacciones.refacciones.entregadasRefacciones.l_entregadasRefacciones', compact('list_refacciones'));
    }

    public function i_refaccion(){
        $vehiculos = Vehiculo::with(['marcas:id,marca', 'submarcas:id,submarca', 'clientes:id,nombre', 'asesores:id,nombre,a_paterno,a_materno', 'estatus:id,status'])
                            ->select('id','estatus_id','modelo', 'color', 'marca_id', 'linea_id', 'cliente_id', 'placas', 'id_asesor', 'no_siniestro', 'fecha_llegada')
                            ->where('estatus_id','5')
                            ->orWhere('estatus_id','6')
                            ->orWhere('estatus_id','7')
                            ->orderBy('id_aux')
                            ->get();

        return view('refacciones.refacciones.altaRefacciones.i_refaccion', compact('vehiculos'));
    }

    public function e_ve(Request $request){
        $vehiculo = Vehiculo::select('id')
                            ->where('id', $request['id'])
                            ->get();
        if ($vehiculo->isEmpty()) {
            return response()->json(['vehiculo' => 0]);
        } else {
            return response()->json(['vehiculo' => 1]);
            
        }
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
        //dd($request);
        $refaccion = new Almacen();
        $refaccion->id_vehiculo = $request->expediente;
        $refaccion->descripcion = $request->descripcion;
        if (isset($request->fechapromesa)) {
            $refaccion->fecha_promesa = $request->fechapromesa;
        }
        
        if ($request->proveedor) {
            $refaccion->proveedor = $request->proveedor;
        }
        
        $refaccion->estatus_id = 1;
        $refaccion_Aseg = Aseguradoras::select('id')->where('nombre',$request->aseguradora)->first()->id;
        $refaccion->aseguradora_id = $refaccion_Aseg;
        
        if ($refaccion->save()) {
            $pzs = DB::select("SELECT COUNT(descripcion) AS descripcion FROM almacen WHERE id_vehiculo = $request->expediente");
            foreach ($pzs as $pzss) {
                $piezas = $pzss->descripcion;
            }

            if ($piezas == 1) {
                $fecha = Date('Y-m-d');
                $vehiculo = Vehiculo::find($request->expediente);
                $vehiculo->refacciones_id = 3;
                $vehiculo->p_asignados = $fecha;
                $vehiculo->save();
            }

            return redirect()->route('i_refaccion')->withSuccess('Refaccion Registrada.');
            
        } else {
            return redirect()->route('i_refaccion')->withError('Refaccion no Registrado.');
        }
        
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Almacen  $almacen
     * @return \Illuminate\Http\Response
     */
    public function show(Almacen $almacen)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Almacen  $almacen
     * @return \Illuminate\Http\Response
     */
    public function edit(Almacen $almacen)
    {
        //dd($almacen);
        $vehiculo = Vehiculo::with(['marcas:id,marca', 'submarcas:id,submarca', 'clientes:id,nombre', 'asesores:id,nombre,a_paterno,a_materno', 'estatus:id,status'])
                            ->where('id', $almacen->id_vehiculo)
                            ->select('modelo', 'color', 'marca_id', 'linea_id', 'cliente_id', 'placas', 'id_asesor', 'estatus_id')
                            ->first();

        return view('refacciones.refacciones.altaRefacciones.u_refaccion', compact(['almacen', 'vehiculo']));
    }

    public function edit2(Almacen $almacen){
        return view('refacciones.refacciones.seguimientoRefacciones.u_segrefaccion', compact('almacen'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Almacen  $almacen
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Almacen $almacen)
    {
        if ($almacen->descripcion == $request->descripcion && $almacen->proveedor == $request->proveedor && $almacen->fecha_promesa == $request->fechapromesa) {
            return redirect()->route('l_refacciones')->with('warning','No se Actualizo la refaccion "'. $request->descripcion . '".');
        } else {
            $almacen->descripcion = $request->descripcion;
            $almacen->proveedor = $request->proveedor;
            $almacen->fecha_promesa = $request->fechapromesa;
            if ($almacen->save()) {
                return redirect()->route('l_refacciones')->with('success','Refaccion Actualizada.');
            } else {
                return redirect()->route('l_refacciones')->with('error','Refaccion no Actualizada.');
            }
            
        }
        
    }

    public function update2(Request $request, Almacen $almacen)
    {
        if ($almacen->fecha_llegada == $request->fechallegada && $almacen->ubicacion == $request->ubicacion && $almacen->comentarios == $request->comentarios) {
            return redirect()->route('l_segrefacciones')->with('warning','No se Actualizo la refaccion "'. $almacen->descripcion . '".');
        } else {
            $almacen->fecha_llegada = $request->fechallegada;
            $almacen->ubicacion = $request->ubicacion;
            $almacen->comentarios = $request->comentarios;
            $almacen->save();

            $select_estatus_refacciones = DB::select("SELECT COUNT(fecha_promesa) as pzs_promesa, COUNT(fecha_llegada) as pzs_llegada FROM almacen WHERE id_vehiculo = $almacen->id_vehiculo");
            foreach ($select_estatus_refacciones as $pzs) {
                $pzs_promesa = $pzs->pzs_promesa;
                $pzs_llegada = $pzs->pzs_llegada;
            }

            if ($pzs_promesa == $pzs_llegada) {
                $vehiculo = Vehiculo::find($almacen->id_vehiculo);
                $vehiculo->refacciones_id = 4;
                $fecha2 = Date('Y-m-d');
                $vehiculo->r_disponibles = $fecha2;
                $vehiculo->save();
            } 

            if ($almacen->save()) {
                return redirect()->route('l_segrefacciones')->with('success','Refaccion Actualizada.');
            } else {
                return redirect()->route('l_segrefacciones')->with('error','Refaccion no Actualizada.');
            }
            
        }
        
    }

    public function baja_edit(Almacen $almacen){
        $estatusV = Estatusalmacen::select('id','estatus')
                            ->orderBy('estatus')
                            ->get();

        $estatusN = Estatusalmacen::select('estatus')
                                    ->where('id', $almacen->estatus_id)
                                    ->first();
 
        return view('refacciones.refacciones.altaRefacciones.b_refaccion', compact(['almacen', 'estatusV', 'estatusN']));
    }

    public function baja_update(Request $request, Almacen $almacen){
        $almacen->ubicacion = $request->ubicacion;
        $almacen->fecha_entrega = $request->fecha_entrega;
        $almacen->estatus_id = $request->nestatus;
        $almacen->comentarios = $request->comentarios;

        if ($almacen->save()) {
            return redirect()->route('l_refacciones')->with('success','Refaccion Actualizada.');
        } else {
            return redirect()->route('l_refacciones')->with('error','Refaccion no Actualizada.');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Almacen  $almacen
     * @return \Illuminate\Http\Response
     */
    public function destroy(Almacen $almacen)
    {
        if ($almacen->delete()) {
            return redirect()->route('l_refacciones')->with('success','Refaccion Eliminada.');
        } else {
            return redirect()->route('l_refacciones')->with('error','Refaccion no Eliminada.');
        }
        
    }

    public function destroy2(Almacen $almacen)
    {
        if ($almacen->delete()) {
            return redirect()->route('l_segrefacciones')->with('success','Refaccion Eliminada.');
        } else {
            return redirect()->route('l_segrefacciones')->with('error','Refaccion no Eliminada.');
        }
        
    }
}
