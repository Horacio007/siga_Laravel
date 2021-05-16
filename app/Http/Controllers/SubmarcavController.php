<?php

namespace App\Http\Controllers;

use App\Models\Submarcav;
use App\Models\Modelosv;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Http\Request;

class SubmarcavController extends Controller
{
    use SoftDeletes;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //$list_submarcas = Submarcav::with('marca')->orderBy('id_marca')->get();
        $list_submarcas = Submarcav::with('marca')->get();
        return view('catalogos.submarca.l_submarcas', compact('list_submarcas'));
    }

    public function select_marca(){
        $list_marcas = Modelosv::all();
        return view('catalogos.submarca.i_submarca', compact('list_marcas'));
    }

    public function listado_submarcas(Request $request){
        if ($request['submarcas_select'] == true) {
            $submarcas = Submarcav::select('id', 'submarca')
                                    ->where('id_marca', '=', $request['id_marca'])
                                    ->orderBy('submarca')
                                    ->get();

            $output = "<option value='0'>Seleccione la SubMarca del Vehículo:</option>";
            for ($i=0; $i < sizeof($submarcas); $i++) { 
                $output .= '<option value="'.$submarcas[$i]['id'].'">'.$submarcas[$i]['submarca'].'</option>';
            }

            return response()->json(['submarcas' => $output]);
        } else {
            return response()->json(['submarcas' => 'Hubo un problema!!!']);
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
        $r = Submarcav::where('submarca', $request['submarca'])
                        ->select('submarca')
                        ->get();

        if ($r->isEmpty()) {
            $submarcav = new Submarcav;
            $submarcav->id_marca = $request->marca;
            $submarcav->submarca = $request->submarca;
            if ($submarcav->save()) {
                return redirect()->route('lista_submarcas')->with('success','SubMarca Registrada.');
            } else {
                return redirect()->route('lista_submarcas')->with('error','SubMarca no Registrada.');
            }
        } else {
            return back()->with('warning','La submarca "'. $request['submarca'] .'" ya esta registrada.');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Submarcav  $submarcav
     * @return \Illuminate\Http\Response
     */
    public function show(Submarcav $submarcav)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Submarcav  $submarcav
     * @return \Illuminate\Http\Response
     */
    public function edit(Submarcav $submarcav)
    {
        return view('catalogos.submarca.u_submarca', compact('submarcav'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Submarcav  $submarcav
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Submarcav $submarcav)
    {   
        if ($submarcav->submarca == $request->submarca) {
            return redirect()->route('lista_submarcas')->with('warning','No se Actualizo la submarca "'. $request->submarca . '".');
        } else {
            $submarcav->submarca = $request->submarca;
            if ($submarcav->save()) {
                return redirect()->route('lista_submarcas')->with('success','SubMarca Actualizada.');
            } else {
                return redirect()->route('lista_submarcas')->with('error','SubMarca no Actualizada.');
            }
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Submarcav  $submarcav
     * @return \Illuminate\Http\Response
     */
    public function destroy(Submarcav $submarcav)
    {
        if ($submarcav->delete()) {
            return redirect()->route('lista_submarcas')->with('success','SubMarca Eliminada.');
        } else {
            return redirect()->route('lista_submarcas')->with('error','SubMarca no Eliminada.');
        }
    }
}