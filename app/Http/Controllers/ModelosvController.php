<?php

namespace App\Http\Controllers;

use App\Models\Modelosv;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Http\Request;

class ModelosvController extends Controller
{
    use SoftDeletes;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $list_marcas = Modelosv::all();
        return view('catalogos.marca.l_marcas', compact('list_marcas'));
    }

    public function i_marca(){
        return view('catalogos.marca.i_marcas');
    }

    public function listado_marcas(Request $request){
        
        if ($request['select_marca'] == true) {
            $marcas = Modelosv::select('id', 'marca')
                            ->orderBy('marca')
                            ->get();

        
            //$output = '<select name="marca" id="sautoslinea" class="form-control"><option value="0">Seleccione la Marca del Vehículo:</option>';
            $output = "<option value='0'>Seleccione la Marca del Vehículo:</option>";
            for ($i=0; $i < sizeof($marcas); $i++) { 
                $output .= '<option value="'.$marcas[$i]['id'].'">'.$marcas[$i]['marca'].'</option>';
            }

            //$output .= '</select>';

            return response()->json(['marcas' => $output]);
        } else {
            return response()->json(['marcas' => 'Hubo un problema!!!']);
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
        $r = Modelosv::where('marca', $request['marca'])
                        ->select('marca')
                        ->get();

        if ($r->isEmpty()) {
            $marca = new Modelosv;
            $marca->marca = $request->marca;
            if ($marca->save()) {
                return redirect()->route('lista_marcas')->with('success','Marca Registrada.');
            } else {
                return redirect()->route('lista_marcas')->with('error','Marca no Registrada.');
            }
        } else {
            return back()->with('warning','La marca "'. $request['marca'] .'" ya esta registrada.');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Modelosv  $modelosv
     * @return \Illuminate\Http\Response
     */
    public function show(Modelosv $modelosv)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Modelosv  $modelosv
     * @return \Illuminate\Http\Response
     */
    public function edit(Modelosv $modelosv)
    {
        return view('catalogos.marca.u_marcas', compact('modelosv'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Modelosv  $modelosv
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Modelosv $modelosv)
    {
        if ($modelosv->marca == $request->marca) {
            return redirect()->route('lista_marcas')->with('warning','No se Actualizo la marca "'. $request->marca . '".');
        } else {
            $modelosv->marca = $request->marca;
            if ($modelosv->save()) {
                return redirect()->route('lista_marcas')->with('success','Marca Actualizada.');
            } else {
                return redirect()->route('lista_marcas')->with('error','Marca no Actualizada.');
            }
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Modelosv  $modelosv
     * @return \Illuminate\Http\Response
     */
    public function destroy(Modelosv $modelosv)
    {
        if ($modelosv->delete()) {
            return redirect()->route('lista_marcas')->with('success','Marca Eliminada.');
        } else {
            return redirect()->route('lista_marcas')->with('error','Marca no Eliminada.');
        }
    }
}
