<?php

namespace App\Http\Controllers;

use App\Models\Estatus;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Http\Request;

class EstatusController extends Controller
{
    use SoftDeletes;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $list_estatus = Estatus::all()
                        ->where('deleted_at', null);
                        
        return view('catalogos.estatus.l_estatus', compact('list_estatus'));
    }

    public function i_estatus(){
        return view('catalogos.estatus.i_estatus');
    }

    public function listado_estatus(Request $request){
        if ($request['select_estatus'] == true) {
            $estatus = Estatus::select('id', 'status')
                            ->where('deleted_at', null)
                            ->orderBy('status')
                            ->get();

        
            //$output = '<select name="marca" id="sautoslinea" class="form-control"><option value="0">Seleccione la Marca del Vehículo:</option>';
            $output = "<option value='0'>Seleccione la Ubicación del Vehículo:</option>";
            for ($i=0; $i < sizeof($estatus); $i++) { 
                $output .= '<option value="'.$estatus[$i]['id'].'">'.$estatus[$i]['status'].'</option>';
            }

            //$output .= '</select>';

            return response()->json(['estatus' => $output]);
        } else {
            return response()->json(['estatus' => 'Hubo un problema!!!']);
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
        $r = Estatus::where('status', $request['estatus'])
        ->select('status')
        ->get();

        if ($r->isEmpty()) {
            $estatus = new Estatus;
            $estatus->status = $request->estatus;
            if ($estatus->save()) {
                return redirect()->route('lista_estatus')->with('success','Estatus Registrado.');
            } else {
                return redirect()->route('lista_estatus')->with('error','Estatus no Registrado.');
            }
        } else {
            return back()->with('warning','El estatus "'. $request['estatus'] .'" ya esta registrado.');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Estatus  $estatus
     * @return \Illuminate\Http\Response
     */
    public function show(Estatus $estatus)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Estatus  $estatus
     * @return \Illuminate\Http\Response
     */
    public function edit(Estatus $estatus)
    {
        return view('catalogos.estatus.u_estatus', compact('estatus'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Estatus  $estatus
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Estatus $estatus)
    {
        if ($estatus->status == $request->estatus) {
            return redirect()->route('lista_estatus')->with('warning','No se Actualizo el estatus "'. $request->estatus . '".');
        } else {
            $estatus->status = $request->estatus;
            if ($estatus->save()) {
                return redirect()->route('lista_estatus')->with('success','Estatus Actualizada.');
            } else {
                return redirect()->route('lista_estatus')->with('error','Estatus no Actualizada.');
            }
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Estatus  $estatus
     * @return \Illuminate\Http\Response
     */
    public function destroy(Estatus $estatus)
    {
        if ($estatus->delete()) {
            return redirect()->route('lista_estatus')->with('success','Estatus Eliminada.');
        } else {
            return redirect()->route('lista_estatus')->with('error','Estatus no Eliminada.');
        }
    }
}
