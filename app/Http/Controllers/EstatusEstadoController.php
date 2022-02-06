<?php

namespace App\Http\Controllers;

use App\Models\EstatusEstado;
use App\Models\Estatus;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Http\Request;

class EstatusEstadoController extends Controller
{
    use SoftDeletes;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $list_estatus = EstatusEstado::all();
                        
        return view('catalogos.estatusEstado.l_estatusE', compact('list_estatus'));
    }

    public function listado_estatusProceso(Request $request){
        if ($request['proceso_select'] == true) {
            $proceso = EstatusEstado::select('id', 'estatus')
                                    ->where('ubicacion_id', '=', $request['id_ubicacion'])
                                    ->orderBy('estatus')
                                    ->get();

            $output = "<option value='0'>Seleccione el Proceso del Vehículo:</option>";
            for ($i=0; $i < sizeof($proceso); $i++) { 
                $output .= '<option value="'.$proceso[$i]['id'].'">'.$proceso[$i]['estatus'].'</option>';
            }

            return response()->json(['proceso' => $output]);
        } else {
            return response()->json(['proceso' => 'Hubo un problema!!!']);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $list_ubicaciones = Estatus::all()->where('deleted_at', null);

        return view('catalogos.estatusEstado.i_estatusE', compact('list_ubicaciones'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $r = EstatusEstado::where('ubicacion_id', $request['ubicacion'])
                    ->where('estatus', $request['proceso'])
                    ->get();

        if ($r->isEmpty()) {
            $estatus = new EstatusEstado;
            $estatus->ubicacion_id = $request->ubicacion;
            $estatus->estatus = $request->proceso;
            if ($estatus->save()) {
                return redirect()->route('lista_estatusE')->with('success','Proceso Registrado.');
            } else {
                return redirect()->route('lista_estatusE')->with('error','Proceso no Registrado.');
            }
        } else {
            return back()->with('warning','El proceso "'. $request['estatus'] .'" ya esta registrado.');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\EstatusEstado  $estatusEstado
     * @return \Illuminate\Http\Response
     */
    public function show(EstatusEstado $estatusEstado)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\EstatusEstado  $estatusEstado
     * @return \Illuminate\Http\Response
     */
    public function edit(EstatusEstado $estatusEstado)
    {
        return view('catalogos.estatusEstado.u_estatusE', compact('estatusEstado'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\EstatusEstado  $estatusEstado
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, EstatusEstado $estatusEstado)
    {
        if ($estatusEstado->ubicacionEstado->status == $request->ubicacion && $estatusEstado->estatus == $request->proceso) {
            return redirect()->route('lista_estatusE')->with('warning','No se Actualizo el proceso "'. $request->proceso . '".');
        } else {
            $estatusEstado->estatus = $request->proceso;
            if ($estatusEstado->save()) {
                return redirect()->route('lista_estatusE')->with('success','Proceso Actualizado.');
            } else {
                return redirect()->route('lista_estatusE')->with('error','Proceso no Actualizado.');
            }
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\EstatusEstado  $estatusEstado
     * @return \Illuminate\Http\Response
     */
    public function destroy(EstatusEstado $estatusEstado)
    {
        if ($estatusEstado->delete()) {
            return redirect()->route('lista_estatusE')->with('success','Proceso Eliminado.');
        } else {
            return redirect()->route('lista_estatusE')->with('error','Proceso no Eliminado.');
        }
    }
}
