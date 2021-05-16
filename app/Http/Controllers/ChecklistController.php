<?php

namespace App\Http\Controllers;

use App\Models\Checklist;
use App\Models\Vehiculo;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Http\Request;

class ChecklistController extends Controller
{
    use SoftDeletes;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    public function i_checklist(){
        return view('recepcion.checklist.i_checklist');
    }

    public function exist_chv(Request $request){

        $vehiculo = Vehiculo::select('id')
                            ->where('id', $request['id'])
                            ->get();
        if ($vehiculo->isEmpty()) {
            return response()->json(['vehiculo' => 0]);
        } else {
            $e_check = Checklist::select('id_aux_vehiculo')
                        ->where('id_aux_vehiculo', $request['id'])
                        ->get();

            if ($e_check->isEmpty()) {
                return response()->json(['vehiculo' => 1]);
            } else {
                return response()->json(['vehiculo' => 00]);
            }
            
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

        $data = $request->all();
        $check = new Checklist();
        foreach ($check->getFillable() as $field) {
            if (!isset($request[$field])) {
                $data[$field] = 0;
            }
        }
        //dd($data);
        $checklist = new Checklist($data);
        $checklist->id_aux_vehiculo = $request->expediente;
        $checklist->cambustible = $request->combustible;
        $checklist->kilometraje = $request->kilometraje;
        $checklist->observaciones = $request->observaciones;

        if ($checklist->save()) {
            return redirect()->route('i_checklist')->withSuccess('Checklist Registrado.');
        } else {
            return redirect()->route('i_checklist')->withError('Checklist no Registrado.');
        }
        
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Checklist  $checklist
     * @return \Illuminate\Http\Response
     */
    public function show(Checklist $checklist)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Checklist  $checklist
     * @return \Illuminate\Http\Response
     */
    public function edit(Checklist $checklist)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Checklist  $checklist
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Checklist $checklist)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Checklist  $checklist
     * @return \Illuminate\Http\Response
     */
    public function destroy(Checklist $checklist)
    {
        //
    }
}
