<?php

namespace App\Http\Controllers;

use App\Models\Aseguradoras;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Http\Request;

class AseguradorasController extends Controller
{
    use SoftDeletes;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $list_aseguradoras = Aseguradoras::all();
        return view('catalogos.aseguradora.l_aseguradoras', compact('list_aseguradoras'));
    }

    public function i_aseguradora(){
        return view('catalogos.aseguradora.i_aseguradoras');
    }

    public function listado_aseguradoras(Request $request){

        if ($request['select_aseguradora'] == true) {
            $aseguradora = Aseguradoras::select('id', 'nombre')
                            ->orderBy('nombre')
                            ->get();

        
            //$output = '<select name="marca" id="sautoslinea" class="form-control"><option value="0">Seleccione la Marca del Vehículo:</option>';
            $output = "<option value='0'>Seleccione la Aseguradora del Vehículo:</option>";
            for ($i=0; $i < sizeof($aseguradora); $i++) { 
                $output .= '<option value="'.$aseguradora[$i]['id'].'">'.$aseguradora[$i]['nombre'].'</option>';
            }

            //$output .= '</select>';

            return response()->json(['aseguradora' => $output]);
        } else {
            return response()->json(['aseguradora' => 'Hubo un problema!!!']);
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
        $r = Aseguradoras::where('nombre', $request['aseguradoras'])
                        ->select('nombre')
                        ->get();

        if ($r->isEmpty()) {
            $aseguradora = new Aseguradoras;
            $aseguradora->nombre = $request->aseguradoras;
            if ($aseguradora->save()) {
                return redirect()->route('lista_aseguradoras')->with('success','Aseguradora Registrada.');
            } else {
                return redirect()->route('lista_aseguradoras')->with('error','Aseguradora no Registrada.');
            }
        } else {
            return back()->with('warning','La aseguradora "'. $request['aseguradoras'] .'" ya esta registrada.');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Aseguradoras  $aseguradoras
     * @return \Illuminate\Http\Response
     */
    public function show(Aseguradoras $aseguradoras)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Aseguradoras  $aseguradoras
     * @return \Illuminate\Http\Response
     */
    public function edit(Aseguradoras $aseguradoras)
    {
        return view('catalogos.aseguradora.u_aseguradoras', compact('aseguradoras'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Aseguradoras  $aseguradoras
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Aseguradoras $aseguradoras)
    {
        if ($aseguradoras->nombre == $request->aseguradoras) {
            return redirect()->route('lista_aseguradoras')->with('warning','No se Actualizo la aseguradora "'. $request->aseguradoras . '".');
        } else {
            $aseguradoras->nombre = $request->aseguradoras;
            if ($aseguradoras->save()) {
                return redirect()->route('lista_aseguradoras')->with('success','Aseguradora Actualizada.');
            } else {
                return redirect()->route('lista_aseguradoras')->with('error','Aseguradora no Actualizada.');
            }
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Aseguradoras  $aseguradoras
     * @return \Illuminate\Http\Response
     */
    public function destroy(Aseguradoras $aseguradoras)
    {
        if ($aseguradoras->delete()) {
            return redirect()->route('lista_aseguradoras')->with('success','Aseguradora Eliminada.');
        } else {
            return redirect()->route('lista_aseguradoras')->with('error','Aseguradora no Eliminada.');
        }
    }
}
