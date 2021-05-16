<?php

namespace App\Http\Controllers;

use App\Models\Vehiculo;
use App\Models\Clientes;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Http\Request;

class VehiculoController extends Controller
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

    public function i_vehiculo(){
        return view('recepcion.vehiculo.i_vehiculo');
    }

    public function ultimo_vehiculo_nuevo(Request $request){

        if ($request['noexpediente'] == true) {
            $ultimo = Vehiculo::select('id')
                            ->orderBy('id_aux', 'DESC')
                            ->limit(1)
                            ->get();
                            
            $ultimov = $ultimo[0]['id'];
            switch ($ultimov) {
                case strlen($ultimov) == 9:
                    $hoy = date("dmY");
                    $ultimov += 100000000;
                    settype($ultimov, 'string');
                    settype($hoy, 'string');
                    $expediente = $ultimov[0];
                    $expediente .=$hoy;
                    settype($expediente, 'integer');
                    return response()->json(['nuevo' => $expediente]);
                    break;

                case strlen($ultimov) == 10:
                    $hoy = date("dmY");
                    $ultimov += 100000000;
                    settype($ultimov, 'string');
                    settype($hoy, 'string');
                    $expediente = $ultimov[0];
                    $expediente .= $ultimov[1];
                    $expediente .=$hoy;
                    settype($expediente, 'integer');
                    return response()->json(['nuevo' => $expediente]);
                    break;

                case strlen($ultimov) == 11:
                    $hoy = date("dmY");
                    $ultimov += 100000000;
                    settype($ultimov, 'string');
                    settype($hoy, 'string');
                    $expediente = $ultimov[0];
                    $expediente .= $ultimov[1];
                    $expediente .= $ultimov[2];
                    $expediente .=$hoy;
                    settype($expediente, 'integer');
                    return response()->json(['nuevo' => $expediente]);
                    break;
                
                default:
                    echo "No hay vehiculos registrados";
                    break;
                }
        } else {
            return response()->json(['nuevo' => 'Hubo un problema!!!']);
        }
    }

    public function ultimo_vehiculo(Request $request){

        if ($request['nouexpediente'] == true) {
            $ultimov = Vehiculo::select('id')
                            ->orderBy('id_aux', 'DESC')
                            ->limit(1)
                            ->get();
        
            return response()->json(['ultimo' => $ultimov]);
        } else {
            return response()->json(['ultimo' => 'Hubo un problema!!!']);
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
        //dd($request);
        $r = Vehiculo::where('id', $request['expediente'])
                        ->select('id')
                        ->get();

        if ($r->isEmpty()) {

            $c = new Clientes();
            $c->nombre = $request->nombre;
            $c->telefono = $request->telefono;
            $c->correo = $request->correo;
            
            if ($c->save()) {
                $uc = Clientes::select('id')
                                ->orderBy('id', 'DESC')
                                ->limit(1)
                                ->get();

                $vehiculo = new Vehiculo();
                $vehiculo->id = $request->expediente;
                $vehiculo->id_cliente = $uc[0]['id'];
                $vehiculo->id_asesor = $request->asesor;
                $vehiculo->estatus = $request->estatus;
                $vehiculo->fecha_llegada = date("Ymd");;
                $vehiculo->marca_id = $request->marca;
                $vehiculo->linea_id = $request->submarca;
                $vehiculo->color = $request->color;
                $vehiculo->modelo = $request->modelo;
                $vehiculo->placas = $request->placas;
                $vehiculo->cliente_id = $request->aseguradora;
                $vehiculo->no_siniestro = $request->siniestro;
                $vehiculo->n_dano = $request->nivel;
                $vehiculo->f_arribo = $request->arribo;

                if ($vehiculo->save()) {
                    return redirect()->route('i_vehiculos')->with('success','Vehiculo Registrado.');
                } else {
                    return redirect()->route('i_vehiculos')->with('error','Vehiculo no Registrado.');
                }

            } else {
                return redirect()->route('i_vehiculos')->with('error','Cliente no Registrado.');
            }
            
        } else {
            
            $r = Vehiculo::with(['marcas:id,marca', 'submarcas:id,submarca', 'clientes:id,nombre'])
                        ->where('id', $request['expediente'])
                        ->select('id', 'marca_id', 'linea_id', 'color', 'modelo', 'placas', 'cliente_id', 'no_siniestro')
                        ->get();

            return back()->with('warning','Expediente ya registrado con el vehiculo "'. $r[0]['marcas']['marca'] . ' ' . $r[0]['submarcas']['submarca'] . ' ' . $r[0]['color'] . 
                                ' ' .$r[0]['modelo'] . ' ' . $r[0]['placas'] . ' ' . $r[0]['clientes']['nombre'] . ' ' . $r[0]['no_siniestro'] .'" .');             
        }


    }
    
    public function mlmca(Request $request){
        $vehiculo = Vehiculo::with(['marcas:id,marca', 'submarcas:id,submarca', 'clientes:id,nombre'])
                            ->where('id', $request['id'])
                            ->select('modelo', 'color', 'marca_id', 'linea_id', 'cliente_id', 'placas')
                            ->first();

        $r = Vehiculo::select('id_aux')
        ->where('id', $request['id'])
        ->first();

        $c = Clientes::select('nombre', 'telefono', 'correo')
                    ->where('id',$r['id_aux'])
                    ->first();

        //dd($vehiculo);
        return response()->json([$vehiculo, $c]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Vehiculo  $vehiculo
     * @return \Illuminate\Http\Response
     */
    public function show(Vehiculo $vehiculo)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Vehiculo  $vehiculo
     * @return \Illuminate\Http\Response
     */
    public function edit(Vehiculo $vehiculo)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Vehiculo  $vehiculo
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Vehiculo $vehiculo)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Vehiculo  $vehiculo
     * @return \Illuminate\Http\Response
     */
    public function destroy(Vehiculo $vehiculo)
    {
        //
    }
}
