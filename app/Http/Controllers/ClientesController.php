<?php

namespace App\Http\Controllers;

use App\Models\Clientes;
use App\Models\Vehiculo;
use Illuminate\Support\Facades\DB;
use Facade\FlareClient\Http\Client;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Http\Request;

class ClientesController extends Controller
{
    use SoftDeletes;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $list_clientes = DB::select("SELECT
                                    vehiculo.id,
                                    modelosv.marca,
                                    submarcav.submarca,
                                    vehiculo.modelo,
                                    aseguradoras.nombre AS aseguradora,
                                    vehiculo.no_siniestro,
                                    vehiculo.fecha_llegada,
                                    clientes.nombre,
                                    clientes.telefono,
                                    clientes.correo,
                                    vehiculo.fecha_salida_taller
                                FROM
                                    vehiculo,
                                    clientes,
                                    modelosv,
                                    submarcav,
                                    aseguradoras
                                WHERE
                                    clientes.id = vehiculo.id_aux
                                AND vehiculo.marca_id = modelosv.id
                                AND vehiculo.linea_id = submarcav.id
                                AND aseguradoras.id = vehiculo.cliente_id
                                ORDER BY
                                    clientes.id");

        return view('entrega.clientes.l_clientes', compact('list_clientes'));
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

    public function getInfoClieteCheck(Request $request){
        $r = Vehiculo::select('id_aux')
                    ->where('id', $request['id'])
                    ->first();

        $c = Clientes::select('nombre', 'telefono', 'correo')
                    ->where('id',$r['id_aux'])
                    ->first();

        return response()->json($c);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Clientes  $clientes
     * @return \Illuminate\Http\Response
     */
    public function show(Clientes $clientes)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Clientes  $clientes
     * @return \Illuminate\Http\Response
     */
    public function edit(Clientes $clientes)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Clientes  $clientes
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Clientes $clientes)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Clientes  $clientes
     * @return \Illuminate\Http\Response
     */
    public function destroy(Clientes $clientes)
    {
        //
    }
}
