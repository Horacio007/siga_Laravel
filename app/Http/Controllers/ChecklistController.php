<?php

namespace App\Http\Controllers;

use App\Models\Checklist;
use App\Models\Vehiculo;
use App\Models\Clientes;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade as PDF;

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
        $data = ['saludo' => 'Hola Mundo'];

        //$dompdf = PDF::loadView('', $data);
        //$pdf = App::make('dompdf');
        //$dpdf = PDF::loadView('recepcion.checklist.checklist_pdf');
       

        $pdf = app('dompdf.wrapper');
        $pdf->loadHTML('<img src="img/checklist.jpg" width="750px" height="1031"></img>');
        //$pdf->loadView('recepcion.checklist.checklist_pdf', $data);
        //$pdf->loadHTML('<img src="img/checklist.jpg" width="750px" height="1031"');
        //$pdf->loadView('recepcion.checklist.checklist_pdf');
        $pdf->loadHTML('<h1>'.$cliente['nombre'].'</h1>');
        $pdf->loadHTML('<h1>'.$cliente['telefono'].'</h1>');
        //$pdf->loadHTML('<h1>Styde.net</h1>');
        //$pdf->render();
        return $pdf->stream('mi-archivo.pdf');
        
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
