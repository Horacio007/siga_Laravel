<?php

namespace App\Http\Controllers;

use App\Models\forma_aribo;
use Illuminate\Http\Request;

class FormaAriboController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $list_forma = forma_aribo::all();
        return view('catalogos.forma_arribo.l_forma_arribo', compact('list_forma'));
    }

    public function i_formaarribo(){
        return view('catalogos.forma_arribo.i_forma_arribo');
    }

    public function listado_formaarribo(Request $request){
        if ($request['select_formaarribo'] == true) {
            $forma = forma_aribo::select('id', 'forma_arribo')
                            ->orderBy('forma_arribo')
                            ->get();

        
            //$output = '<select name="marca" id="sautoslinea" class="form-control"><option value="0">Seleccione la Marca del Vehículo:</option>';
            $output = "<option value='0'>Seleccione la Forma de Arribo del Vehículo:</option>";
            for ($i=0; $i < sizeof($forma); $i++) { 
                $output .= '<option value="'.$forma[$i]['id'].'">'.$forma[$i]['forma_arribo'].'</option>';
            }

            //$output .= '</select>';

            return response()->json(['forma' => $output]);
        } else {
            return response()->json(['forma' => 'Hubo un problema!!!']);
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
        $r = forma_aribo::where('forma_arribo', $request['forma'])
        ->select('forma_arribo')
        ->get();

        if ($r->isEmpty()) {
            $forma = new forma_aribo();
            $forma->forma_arribo = $request->forma;
            if ($forma->save()) {
                return redirect()->route('lista_formaarribo')->with('success','Forma de Arribo Registrada.');
            } else {
                return redirect()->route('lista_formaarribo')->with('error','Forma de Arribo no Registrada.');
            }
        } else {
            return back()->with('warning','La Forma de Arribo"'. $request['forma'] .'" ya esta registrada.');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\forma_aribo  $forma_aribo
     * @return \Illuminate\Http\Response
     */
    public function show(forma_aribo $forma_aribo)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\forma_aribo  $forma_aribo
     * @return \Illuminate\Http\Response
     */
    public function edit(forma_aribo $forma_aribo)
    {
        return view('catalogos.forma_arribo.u_forma_arribo', compact('forma_aribo'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\forma_aribo  $forma_aribo
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, forma_aribo $forma_aribo)
    {
        if ($forma_aribo->forma_arribo == $request->forma) {
            return redirect()->route('lista_formaarribo')->with('warning','No se Actualizo la forma de arribo "'. $request->forma . '".');
        } else {
            $forma_aribo->forma_arribo = $request->forma;
            if ($forma_aribo->save()) {
                return redirect()->route('lista_formaarribo')->with('success','Forma de Arribo Actualizada.');
            } else {
                return redirect()->route('lista_formaarribo')->with('error','Forma de Arribo no Actualizada.');
            }
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\forma_aribo  $forma_aribo
     * @return \Illuminate\Http\Response
     */
    public function destroy(forma_aribo $forma_aribo)
    {
        if ($forma_aribo->delete()) {
            return redirect()->route('lista_formaarribo')->with('success','Forma de Arribo Eliminada.');
        } else {
            return redirect()->route('lista_formaarribo')->with('error','Forma de Arribo no Eliminada.');
        }
    }
}
