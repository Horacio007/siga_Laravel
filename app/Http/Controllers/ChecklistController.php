<?php

namespace App\Http\Controllers;

use App\Models\Checklist;
use App\Models\Vehiculo;
use App\Models\Clientes;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Http\Request;
use Illuminate\View\View;
use PDF;

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
        $list_checklist = DB::select("SELECT checklist.id, checklist.id_aux_vehiculo, modelosv.marca, submarcav.submarca, vehiculo.color, vehiculo.modelo, aseguradoras.nombre, vehiculo.no_siniestro FROM vehiculo, checklist, modelosv, submarcav, aseguradoras WHERE checklist.id_aux_vehiculo = vehiculo.id AND vehiculo.marca_id = modelosv.id AND vehiculo.linea_id = submarcav.id AND vehiculo.cliente_id = aseguradoras.id ORDER BY  checklist.id");
        return view('recepcion.checklist.l_checklist', compact('list_checklist'));
    }

    public function i_checklist(){
        return view('recepcion.checklist.i_checklist');
    }

    public function pdf(){
        return view('recepcion.checklist.checklist_pdf');
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

    public function create_pdf(Request $request){

        $vehiculo = Vehiculo::with(['marcas:id,marca', 'submarcas:id,submarca', 'clientes:id,nombre', 'asesores:id,nombre,a_paterno,a_materno'])
                            ->where('id', $request['exp'])
                            ->select('modelo', 'color', 'marca_id', 'linea_id', 'cliente_id', 'placas', 'id_asesor')
                            ->first();

        $r = Vehiculo::select('id_aux')
                    ->where('id', $request['exp'])
                    ->first();

        $cliente = Clientes::select('nombre', 'telefono', 'correo')
                            ->where('id',$r['id_aux'])
                            ->first();

        $checklist = Checklist::select('*')
                                ->where('id_aux_vehiculo', $request->exp)
                                ->first();

        $dia = date("d");
        $mes = date('m');
        $año = date('Y');

        $pdf = app('dompdf.wrapper');
        
        $pdf->loadHTML('<!DOCTYPE html>
        <html lang="en">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <meta http-equiv="X-UA-Compatible" content="ie=edge">
            <title>Checklist</title>
        </head>
        <body background="img/checklist2.jpg">
            <p style="position: absolute; top: 20px; left: 560px;">'.$request['exp'].'</p>
            <p style="position: absolute; top: 90px; left: 572px;">'.$dia.'</p>
            <p style="position: absolute; top: 90px; left: 615px;">'.$mes.'</p>
            <p style="position: absolute; top: 91px; left: 655px;">'.$año.'</p>
            <p style="position: absolute; top: 160px; left: 128px;">'.$cliente['nombre'].'</p>
            <p style="position: absolute; top: 190px; left: 132px;">'.$cliente['telefono'].'</p>
            <p style="position: absolute; top: 219px; left: 128px;">'.$cliente['correo'].'</p>
        </body>
        </body>
        </html>');
        
        return $pdf->stream();
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
        dd($request);
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
