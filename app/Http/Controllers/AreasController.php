<?php

namespace App\Http\Controllers;

use App\Models\Areas;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Http\Request;

class AreasController extends Controller
{
    use SoftDeletes;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $list_areas = Areas::all();
        return view('catalogos.area.l_areas', compact('list_areas'));
    }

    public function i_area(){
        return view('catalogos.area.i_areas');
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
        $r = Areas::where('nombre', $request['areas'])
                        ->select('nombre')
                        ->get();

        if ($r->isEmpty()) {
            $area = new Areas;
            $area->nombre = $request->areas;
            if ($area->save()) {
                return redirect()->route('lista_areas')->with('success','Area Registrada.');
            } else {
                return redirect()->route('lista_areas')->with('error','Area no Registrada.');
            }
        } else {
            return back()->with('warning','La area "'. $request['areas'] .'" ya esta registrada.');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Areas  $areas
     * @return \Illuminate\Http\Response
     */
    public function show(Areas $areas)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Areas  $areas
     * @return \Illuminate\Http\Response
     */
    public function edit(Areas $areas)
    {
        return view('catalogos.area.u_areas', compact('areas'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Areas  $areas
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Areas $areas)
    {
        if ($areas->nombre == $request->areas) {
            return redirect()->route('lista_areas')->with('warning','No se Actualizo area "'. $request->areas . '".');
        } else {
            $areas->nombre = $request->areas;
            if ($areas->save()) {
                return redirect()->route('lista_areas')->with('success','Area Actualizada.');
            } else {
                return redirect()->route('lista_areas')->with('error','Area no Actualizada.');
            }
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Areas  $areas
     * @return \Illuminate\Http\Response
     */
    public function destroy(Areas $areas)
    {
        if ($areas->delete()) {
            return redirect()->route('lista_areas')->with('success','Area Eliminada.');
        } else {
            return redirect()->route('lista_areas')->with('error','Area no Eliminada.');
        }
    }
}
