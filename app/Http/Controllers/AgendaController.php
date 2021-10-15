<?php

namespace App\Http\Controllers;

use App\Models\Agenda;
use Illuminate\Http\Request;

class AgendaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('recepcion.agenda.agenda');
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
        $agenda =  new Agenda();
        $agenda->title = $request->title;
        $agenda->motivo = $request->motivo;
        $fecha_ini = $request->start.' '.$request->start2;
        $agenda->start = $fecha_ini;
        $fecha_fin = $request->end.' '.$request->end2;
        $agenda->end = $fecha_fin;

        if ($agenda->save()) {
            return 1;
        } else {
            return 0;
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Agenda  $agenda
     * @return \Illuminate\Http\Response
     */
    public function show(Agenda $agenda)
    {
        $agenda = Agenda::all();
        return response()->json($agenda);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Agenda  $agenda
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $agenda = Agenda::find($id);
        return response()->json($agenda);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Agenda  $agenda
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Agenda $agenda)
    {
        $agenda->title = $request->title;
        $agenda->motivo = $request->motivo;
        $fecha_ini = $request->start.' '.$request->start2;
        $agenda->start = $fecha_ini;
        $fecha_fin = $request->end.' '.$request->end2;
        $agenda->end = $fecha_fin;

        if ($agenda->save()) {
            return 1;
        } else {
            return 0;
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Agenda  $agenda
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $agenda = Agenda::find($id)->delete();
        return response()->json($agenda);
    }
}
