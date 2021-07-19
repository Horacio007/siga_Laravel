<?php

namespace App\Http\Controllers;

use App\Models\Personal;
use App\Models\Areas;
use Illuminate\Http\Request;

class PersonalController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $list_personal = Personal::with('area')->get();
        //dd($list_personal);

        return view('catalogos.personal.l_personal', compact('list_personal'));
    }

    public function select_area(){
        $list_areas = Areas::all();
        return view('catalogos.personal.i_personal', compact('list_areas'));
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
        $p = Personal::where('nombre', $request['personal'])
                        ->select('nombre')
                        ->get();

        if ($p->isEmpty()) {
            $personal = new Personal;
            $personal->id_area = $request->area;
            $personal->nombre = $request->personal;
            if ($personal->save()) {
                return redirect()->route('l_personal')->with('success','Personal Registrado.');
            } else {
                return redirect()->route('l_personal')->with('error','Personal no Registrado.');
            }
        } else {
            return back()->with('warning','El personal "'. $request['personal'] .'" ya esta registrado.');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Personal  $personal
     * @return \Illuminate\Http\Response
     */
    public function show(Personal $personal)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Personal  $personal
     * @return \Illuminate\Http\Response
     */
    public function edit(Personal $personal)
    {
        return view('catalogos.personal.u_personal', compact('personal'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Personal  $personal
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Personal $personal)
    {
        if ($personal->nombre == $request->personal) {
            return redirect()->route('l_personal')->with('warning','No se Actualizo el personal "'. $request->personal . '".');
        } else {
            $personal->nombre = $request->personal;
            if ($personal->save()) {
                return redirect()->route('l_personal')->with('success','Personal Actualizado.');
            } else {
                return redirect()->route('l_personal')->with('error','Personal no Actualizado.');
            }
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Personal  $personal
     * @return \Illuminate\Http\Response
     */
    public function destroy(Personal $personal)
    {
        if ($personal->delete()) {
            return redirect()->route('l_personal')->with('success','Personal Eliminado.');
        } else {
            return redirect()->route('l_personal')->with('error','Personal no Eliminado.');
        }
    }
}
