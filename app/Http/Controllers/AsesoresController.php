<?php

namespace App\Http\Controllers;

use App\Models\Asesores;
use App\Models\Aseguradoras;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Http\Request;

class AsesoresController extends Controller
{
    use SoftDeletes;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //$list_asesores = Asesores::all();
        $list_asesores = Asesores::with('aseguradoras')->get();
        //dd($list_asesores);
        return view('catalogos.asesor.l_asesores', compact('list_asesores'));
        //->first()->id
    }

    public function i_asesor(){
        return view('catalogos.asesor.i_asesores');
    }

    public function select_aseguradora(){
        $list_aseguradora = Aseguradoras::all();
        return view('catalogos.asesor.i_asesores', compact('list_aseguradora'));
    }

    public function listado_asesores(Request $request){
        
        if ($request['select_asesor'] == true) {
            $asesores = Asesores::select('id', 'id_aseguradora', 'nombre', 'a_paterno', 'a_materno')
                            ->orderBy('nombre')
                            ->get();

        
            //$output = '<select name="marca" id="sautoslinea" class="form-control"><option value="0">Seleccione la Marca del Vehículo:</option>';
            $output = "<option value='0'>Seleccione la Marca del Vehículo:</option>";
            for ($i=0; $i < sizeof($asesores); $i++) { 
                $output .= '<option value="'.$asesores[$i]['id'].'">'.$asesores[$i]['nombre']. ' ' . $asesores[$i]['a_paterno'] . ' '. $asesores[$i]['a_materno'] .'</option>';
            }

            //$output .= '</select>';

            return response()->json(['asesores' => $output]);
        } else {
            return response()->json(['asesores' => 'Hubo un problema!!!']);
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
        $r = Asesores::select('id_aseguradora', 'nombre', 'a_paterno', 'a_materno')
                        ->where('id_aseguradora', $request['aseguradora'])
                        ->where('nombre', $request['nombre'])
                        ->where('a_paterno', $request['apaterno'])
                        ->where('a_materno', $request['amaterno'])
                        ->get();

        if ($r->isEmpty()) {
            $asesores = new Asesores();
            $asesores->id_aseguradora = $request->aseguradora;
            $asesores->nombre = $request->nombre;
            $asesores->a_paterno = $request->apaterno;
            $asesores->a_materno = $request->amaterno;
            if ($asesores->save()) {
                return redirect()->route('lista_asesores')->with('success','Asesor Registrado.');
            } else {
                return redirect()->route('lista_asesores')->with('error','Asesor no Registrado.');
            }
        } else {
            return back()->with('warning','El asesor "'. $request['submarca'] .'" ya esta registrado.');
        }
        
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Asesores  $asesores
     * @return \Illuminate\Http\Response
     */
    public function show(Asesores $asesores)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Asesores  $asesores
     * @return \Illuminate\Http\Response
     */
    public function edit(Asesores $asesores)
    {
        $list_aseguradoras = Aseguradoras::all();
        $n = Aseguradoras::select('id', 'nombre')
                            ->where('id', $asesores->id_aseguradora)
                            ->get();

        return view('catalogos.asesor.u_asesores', compact(['asesores', 'list_aseguradoras', 'n']));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Asesores  $asesores
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Asesores $asesores)
    {
        if ($asesores->id_aseguradora == $request->aseguradora && $asesores->nombre == $request->nombre && $asesores->a_paterno == $request->apaterno && $asesores->a_materno == $request->amaterno) {
            return redirect()->route('lista_asesores')->with('warning','No se Actualizo el asesor "'. $request->nombre .' '. $request->apaterno . ' '. $request->amaterno .'".');
        } else {
            $asesores->id_aseguradora = $request->aseguradora;
            $asesores->nombre = $request->nombre;
            $asesores->a_paterno = $request->apaterno;
            $asesores->a_materno = $request->amaterno;
            if ($asesores->save()) {
                return redirect()->route('lista_asesores')->with('success','Asesor Actualizado.');
            } else {
                return redirect()->route('lista_asesores')->with('error','Asesor no Actualizado.');
            }
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Asesores  $asesores
     * @return \Illuminate\Http\Response
     */
    public function destroy(Asesores $asesores)
    {
        //dd($asesores);
        if ($asesores->delete()) {
            return redirect()->route('lista_asesores')->with('success','Asesor Eliminado.');
        } else {
            return redirect()->route('lista_asesores')->with('error','Asesor no Eliminado.');
        }
    }
}
