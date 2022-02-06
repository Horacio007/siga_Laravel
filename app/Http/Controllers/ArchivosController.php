<?php

namespace App\Http\Controllers;

use App\Models\Archivos;
use App\Models\Vehiculo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class ArchivosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $list_archivos = DB::select('SELECT
                                        archivos.id,
                                        archivos.id_vehiculo,
                                        archivos.ruta,
                                        modelosv.marca,
                                        submarcav.submarca,
                                        vehiculo.color,
                                        vehiculo.modelo,
                                        aseguradoras.nombre
                                    FROM
                                        archivos,
                                        vehiculo,
                                        modelosv,
                                        submarcav,
                                        aseguradoras
                                    WHERE
                                        archivos.id_vehiculo = vehiculo.id
                                    AND vehiculo.marca_id = modelosv.id
                                    AND vehiculo.linea_id = submarcav.id
                                    AND aseguradoras.id = vehiculo.cliente_id
                                    AND archivos.created_at IS NOT NULL
                                    ');

        return view('administracion.archivos.l_archivos', compact('list_archivos'));
    }

    public function verArchivos(Request $request){
        $arch = Archivos::select('ruta')
                        ->where('id', $request->exp)
                        ->first();
        
        return Storage::response('/public/'.$arch->ruta);
    }

    public function i_evidenciaR(){
        $vehiculos = Vehiculo::with(['marcas:id,marca', 'submarcas:id,submarca', 'clientes:id,nombre', 'asesores:id,nombre,a_paterno,a_materno', 'estatusV:id,status', 'estatusProceso:id,estatus'])
                            ->select('id', 'estatus_id', 'estatusProceso_id', 'modelo', 'color', 'marca_id', 'linea_id', 'cliente_id', 'placas', 'id_asesor', 'no_siniestro')
                            ->whereIn('estatus_id',['5', '6'])
                            ->whereNotIn('estatusProceso_id', ['1', '5', '9', '12'])
                            ->orderBy('id_aux')
                            ->get();
        //dd($vehiculos);
        return view('recepcion.evidencia.i_evidenciar', compact('vehiculos'));
    }

    public function upload_evidenciaR(Request $request){
        //dd($request->izip);
        $files = $request->file('izip');
        if ($request->hasFile('izip')) {
            foreach ($files as $file) {
                $fileName = Str::slug($file->getClientOriginalName()). '.' . $file->getClientOriginalExtension();
                if (Storage::putFileAs('/public/files/',$file, $fileName)) {
                    $archivo = new Archivos();
                    $archivo->id_vehiculo = $request->expediente;
                    $archivo->ruta = 'files/' . $fileName;
                    $archivo->save();
                }
            }
            return 1;
        } else {
            return 0;
        }
        
        foreach ($request as $archivo) {
            $evidencia = new Archivos();
            $evidencia->id_vehiculo = $archivo->iexpediente;
        }
    }

    public function i_evidenciaP(){
        $vehiculos = Vehiculo::with(['marcas:id,marca', 'submarcas:id,submarca', 'clientes:id,nombre', 'asesores:id,nombre,a_paterno,a_materno', 'estatusV:id,status', 'estatusProceso:id,estatus'])
                            ->select('id', 'estatus_id', 'estatusProceso_id', 'modelo', 'color', 'marca_id', 'linea_id', 'cliente_id', 'placas', 'id_asesor', 'no_siniestro')
                            ->whereIn('estatus_id',['5', '6'])
                            ->whereNotIn('estatusProceso_id', ['1', '5', '9', '12'])
                            ->orderBy('id_aux')
                            ->get();
        //dd($vehiculos);
        return view('costeo.evidencia.i_evidenciap', compact('vehiculos'));
    }

    public function upload_evidenciaP(Request $request){
        //dd($request->izip);
        $files = $request->file('izip');
        if ($request->hasFile('izip')) {
            foreach ($files as $file) {
                $fileName = Str::slug($file->getClientOriginalName()). '.' . $file->getClientOriginalExtension();
                if (Storage::putFileAs('/public/files/',$file, $fileName)) {
                    $archivo = new Archivos();
                    $archivo->id_vehiculo = $request->expediente;
                    $archivo->ruta = 'files/' . $fileName;
                    $archivo->save();
                }
            }
            return 1;
        } else {
            return 0;
        }
        
        foreach ($request as $archivo) {
            $evidencia = new Archivos();
            $evidencia->id_vehiculo = $archivo->iexpediente;
        }
    }

    public function i_evidenciaCom(){
        $vehiculos = Vehiculo::with(['marcas:id,marca', 'submarcas:id,submarca', 'clientes:id,nombre', 'asesores:id,nombre,a_paterno,a_materno', 'estatusV:id,status', 'estatusProceso:id,estatus'])
                            ->select('id', 'estatus_id', 'estatusProceso_id', 'modelo', 'color', 'marca_id', 'linea_id', 'cliente_id', 'placas', 'id_asesor', 'no_siniestro', 'fecha_llegada')
                            ->whereIn('estatus_id',['5', '6'])
                            ->whereNotIn('estatusProceso_id', ['1', '5', '9', '12'])
                            ->orderBy('id_aux')
                            ->get();
        //dd($vehiculos);
        return view('compras.evidencia.i_evidenciacom', compact('vehiculos'));
    }

    public function upload_evidenciaCom(Request $request){
        //dd($request->izip);
        $files = $request->file('izip');
        if ($request->hasFile('izip')) {
            foreach ($files as $file) {
                $fileName = Str::slug($file->getClientOriginalName()). '.' . $file->getClientOriginalExtension();
                if (Storage::putFileAs('/public/files/',$file, $fileName)) {
                    $archivo = new Archivos();
                    $archivo->id_vehiculo = $request->expediente;
                    $archivo->ruta = 'files/' . $fileName;
                    $archivo->save();
                }
            }
            return 1;
        } else {
            return 0;
        }
        
        foreach ($request as $archivo) {
            $evidencia = new Archivos();
            $evidencia->id_vehiculo = $archivo->iexpediente;
        }
    }

    public function i_evidenciaE(){
        $vehiculos = Vehiculo::with(['marcas:id,marca', 'submarcas:id,submarca', 'clientes:id,nombre', 'asesores:id,nombre,a_paterno,a_materno', 'estatusV:id,status', 'estatusProceso:id,estatus'])
                            ->select('id', 'estatus_id', 'estatusProceso_id', 'modelo', 'color', 'marca_id', 'linea_id', 'cliente_id', 'placas', 'id_asesor', 'no_siniestro', 'fecha_llegada')
                            ->whereIn('estatus_id',['5', '6'])
                            ->whereNotIn('estatusProceso_id', ['1', '5', '9', '12'])
                            ->orderBy('id_aux')
                            ->get();
        //dd($vehiculos);
        return view('entrega.evidencia.i_evidenciaent', compact('vehiculos'));
    }

    public function upload_evidenciae(Request $request){
         //dd($request->izip);
         $files = $request->file('izip');
         if ($request->hasFile('izip')) {
             foreach ($files as $file) {
                 $fileName = Str::slug($file->getClientOriginalName()). '.' . $file->getClientOriginalExtension();
                 if (Storage::putFileAs('/public/files/',$file, $fileName)) {
                     $archivo = new Archivos();
                     $archivo->id_vehiculo = $request->expediente;
                     $archivo->ruta = 'files/' . $fileName;
                     $archivo->save();
                 }
             }
             return 1;
         } else {
             return 0;
         }
         
         foreach ($request as $archivo) {
             $evidencia = new Archivos();
             $evidencia->id_vehiculo = $archivo->iexpediente;
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Archivos  $archivos
     * @return \Illuminate\Http\Response
     */
    public function show(Archivos $archivos)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Archivos  $archivos
     * @return \Illuminate\Http\Response
     */
    public function edit(Archivos $archivos)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Archivos  $archivos
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Archivos $archivos)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Archivos  $archivos
     * @return \Illuminate\Http\Response
     */
    public function destroy(Archivos $archivos)
    {
        if ($archivos->delete()) {
            Storage::disk('public')->delete($archivos->ruta);
            return redirect()->route('l_archivos')->with('success','Archivo Eliminado.');
        } else {
            return redirect()->route('l_archivos')->with('error','Archivo no Eliminado.');
        }
        
    }
}
