<?php

namespace App\Http\Controllers;

use App\Models\nivel_dano;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Http\Request;

class NivelDanoController extends Controller
{
    use SoftDeletes;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $list_niveldano = nivel_dano::all();
        return view('catalogos.nivel_dano.l_nivel_dano', compact('list_niveldano'));
    }

    public function i_niveldano(){
        return view('catalogos.nivel_dano.i_nivel_dano');
    }

    public function listado_niveldano(Request $request){
        if ($request['select_niveldano'] == true) {
            $nivel = nivel_dano::select('id', 'nivel')
                            ->orderBy('nivel')
                            ->get();

        
            //$output = '<select name="marca" id="sautoslinea" class="form-control"><option value="0">Seleccione la Marca del Vehículo:</option>';
            $output = "<option value='0'>Seleccione el Nivel de Daño del Vehículo:</option>";
            for ($i=0; $i < sizeof($nivel); $i++) { 
                $output .= '<option value="'.$nivel[$i]['id'].'">'.$nivel[$i]['nivel'].'</option>';
            }

            //$output .= '</select>';

            return response()->json(['nivel' => $output]);
        } else {
            return response()->json(['nivel' => 'Hubo un problema!!!']);
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
        $r = nivel_dano::where('nivel', $request['dano'])
                        ->select('nivel')
                        ->get();

        if ($r->isEmpty()) {
            $nivel_dano = new nivel_dano;
            $nivel_dano->nivel = $request->dano;
            if ($nivel_dano->save()) {
                return redirect()->route('lista_niveldano')->with('success','Nivel de Daño Registrado.');
            } else {
                return redirect()->route('lista_niveldano')->with('error','Nivel de Daño no Registrado.');
            }
        } else {
            return back()->with('warning','El nivel de daño "'. $request['dano'] .'" ya esta registrado.');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\nivel_dano  $nivel_dano
     * @return \Illuminate\Http\Response
     */
    public function show(nivel_dano $nivel_dano)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\nivel_dano  $nivel_dano
     * @return \Illuminate\Http\Response
     */
    public function edit(nivel_dano $nivel_dano)
    {
        return view('catalogos.nivel_dano.u_nivel_dano', compact('nivel_dano'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\nivel_dano  $nivel_dano
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, nivel_dano $nivel_dano)
    {
        if ($nivel_dano->nivel == $request->nivel) {
            return redirect()->route('lista_niveldano')->with('warning','No se Actualizo el nivel de daño "'. $request->nivel . '".');
        } else {
            $nivel_dano->nivel = $request->nivel;
            if ($nivel_dano->save()) {
                return redirect()->route('lista_niveldano')->with('success','Nivel de Daño Actualizado.');
            } else {
                return redirect()->route('lista_niveldano')->with('error','Nivel de Daño no Actualizado.');
            }
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\nivel_dano  $nivel_dano
     * @return \Illuminate\Http\Response
     */
    public function destroy(nivel_dano $nivel_dano)
    {
        if ($nivel_dano->delete()) {
            return redirect()->route('lista_niveldano')->with('success','Nivel de Daño Eliminado.');
        } else {
            return redirect()->route('lista_niveldano')->with('error','Nivel de Daño no Eliminado.');
        }
    }
}
