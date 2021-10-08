<?php

namespace App\Http\Controllers;

use App\Models\Presupuestos;
use App\Models\Vehiculo;
use App\Models\Clientes;
use App\Models\Costrefacciones;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\SoftDeletes;

class PresupuestosController extends Controller
{
    use SoftDeletes;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $list_presupuestos = DB::select("SELECT presupuestos.id, presupuestos.id_vehiculo, modelosv.marca, submarcav.submarca, vehiculo.color, vehiculo.modelo, aseguradoras.nombre, vehiculo.no_siniestro FROM vehiculo, presupuestos, modelosv, submarcav, aseguradoras WHERE presupuestos.id_vehiculo = vehiculo.id AND vehiculo.marca_id = modelosv.id AND vehiculo.linea_id = submarcav.id AND vehiculo.cliente_id = aseguradoras.id ORDER BY  presupuestos.id");
        return view('costeo.presupuesto.l_presupuestos', compact('list_presupuestos'));
    }

    public function i_presupuesto(){
        return view('costeo.presupuesto.i_presupuesto2');
    }

    public function exist_pres(Request $request){

        $vehiculo = Vehiculo::select('id')
                            ->where('id', $request['id'])
                            ->get();
        if ($vehiculo->isEmpty()) {
            return response()->json(['vehiculo' => 0]);
        } else {
            $e_pres = Presupuestos::select('id_vehiculo')
                        ->where('id_vehiculo', $request['id'])
                        ->get();

            if ($e_pres->isEmpty()) {
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
        //dd($request);
        $presu = new Presupuestos();
        $costeo = new Costrefacciones();
        $costeo->id_vehiculo = $request->expediente; 
        $presu->id_vehiculo = $request->expediente;

        $opcost = "";

        $op = "";
        $nivel = "";
        $concepto = "";
        $momh = "";
        $momp = "";
        $momm = "";
        $tot = "";
        $refacciones = "";

        for ($i=1; $i < $request->cont; $i++) { 
            if ($request['toperacion_'.$i] == 1) {
                $opcost.= $request['tconcepto_'.$i].'/';
            }
            $op.= $request['toperacion_'.$i].'/';
            $nivel.= $request['tnivel_'.$i].'/';
            $concepto.= $request['tconcepto_'.$i].'/';
            $momh.= $request['tmomh_'.$i].'/';
            $momp.= $request['tmomp_'.$i].'/';
            $momm.= $request['tmomm_'.$i].'/';
            $tot.= $request['ttot_'.$i].'/';
            $refacciones.= $request['trefacciones_'.$i].'/';
        }

        $costeo->concepto = $opcost;
        $costeo->save(); 

        $presu->op = $op;
        $presu->nivel = $nivel;
        $presu->concepto = $concepto;
        $presu->momh = $momh;
        $presu->momp = $momp;
        $presu->momm = $momm;
        $presu->tot = $tot;
        $presu->refacciones = $refacciones;

        $presu->tmomh = $request->itmomh;
        $presu->tmomp = $request->itmomp;
        $presu->tmomm = $request->itmomm;
        $presu->ttot = $request->ittot;
        $presu->trefacciones = $request->itrefacciones;
        $presu->subtotal = $request->isubtotal;
        $presu->iva = $request->iiva;
        $presu->total = $request->itotal;
        
        if ($presu->save()) {
            return redirect()->route('i_presupuesto')->with('success','Presupuesto Registrado.');
        } else {
            return redirect()->route('i_presupuesto')->with('error','Presupuesto no Registrado.');
        }
        
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Presupuestos  $presupuestos
     * @return \Illuminate\Http\Response
     */
    public function show(Presupuestos $presupuestos)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Presupuestos  $presupuestos
     * @return \Illuminate\Http\Response
     */
    public function edit(Presupuestos $presupuestos)
    {
        //dd($presupuestos);
        return view('costeo.presupuesto.u_presupuesto2', compact('presupuestos'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Presupuestos  $presupuestos
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Presupuestos $presupuestos)
    {
        //dd($request, $presupuestos);
        $costeo = Costrefacciones::where('id_vehiculo', $presupuestos->id_vehiculo)->first();

        $opcost = "";

        $op = "";
        $nivel = "";
        $concepto = "";
        $momh = "";
        $momp = "";
        $momm = "";
        $tot = "";
        $refacciones = "";

        for ($i=1; $i < $request->cont2; $i++) { 
            if ($request['toperacion_'.$i] == 1) {
                $opcost.= $request['tconcepto_'.$i].'/';
            }
            if ($request['toperacion_'.$i] != null) {
                $op.= $request['toperacion_'.$i].'/';
            }
            
            if ($nivel.= $request['tnivel_'.$i] != null) {
                $nivel.= $request['tnivel_'.$i].'/';
            }
            
            if ($request['tconcepto_'.$i] != null) {
                $concepto.= $request['tconcepto_'.$i].'/';
            }
            
            if ($request['tmomh_'.$i] != null) {
                $momh.= $request['tmomh_'.$i].'/';
            }
            
            if ($request['tmomp_'.$i] != null) {
                $momp.= $request['tmomp_'.$i].'/';
            }
            
            if ($request['tmomm_'.$i] != null) {
                $momm.= $request['tmomm_'.$i].'/';
            }
            
            if ($request['ttot_'.$i] != null) {
                $tot.= $request['ttot_'.$i].'/';
            }
            
            if ($request['trefacciones_'.$i] != null) {
                $refacciones.= $request['trefacciones_'.$i].'/';
            }
           
        }

        $costeo->concepto = $opcost;
        $costeo->save(); 

        $presupuestos->op = $op;
        $presupuestos->nivel = $nivel;
        $presupuestos->concepto = $concepto;
        $presupuestos->momh = $momh;
        $presupuestos->momp = $momp;
        $presupuestos->momm = $momm;
        $presupuestos->tot = $tot;
        $presupuestos->refacciones = $refacciones;

        $presupuestos->tmomh = $request->ttmomh;
        $presupuestos->tmomp = $request->ttmomp;
        $presupuestos->tmomm = $request->ttmomm;
        $presupuestos->ttot = $request->tttot;
        $presupuestos->trefacciones = $request->ttrefacciones;
        $presupuestos->subtotal = $request->tsubtotal;
        $presupuestos->iva = $request->tiva;
        $presupuestos->total = $request->ttotal;

        if ($presupuestos->save()) {
            return redirect()->route('l_presupuestos')->with('success','Presupuesto Actualizado.');
        } else {
            return redirect()->route('l_presupuestos')->with('error','Presupuesto no Actualizado.');
        }
    }

    public function create_pdfp(Request $request){
        $vehiculo = Vehiculo::with(['marcas:id,marca', 'submarcas:id,submarca', 'clientes:id,nombre', 'asesores:id,nombre,a_paterno,a_materno','estatus:id,status'])
                            ->where('id', $request['exp'])
                            ->select('modelo', 'color', 'marca_id', 'linea_id', 'cliente_id', 'placas', 'id_asesor', 'estatus_id')
                            ->first();

        $r = Vehiculo::select('id_aux')
                    ->where('id', $request['exp'])
                    ->first();

        $cliente = Clientes::select('nombre', 'telefono', 'correo')
                            ->where('id',$r['id_aux'])
                            ->first();

        $presupuesto = Presupuestos::select('*')
                                ->where('id_vehiculo', $request->exp)
                                ->first();

        $hoy = date('d-m-Y');

        $operacion = $presupuesto['op'];
        strlen($operacion);
        $operacion = explode('/', $operacion);
        $y = 162;
        $ops = '';
        for ($i=0; $i < count($operacion); $i++) {
            switch ($operacion[$i]) {
                case 1:
                    $ops.= '<p style="position: absolute; top: '.$y.'; left: 35px;">'.strtoupper('c').'</p>';
                    break;

                case 2:
                    $ops.= '<p style="position: absolute; top: '.$y.'; left: 35px;">'.strtoupper('r').'</p>';
                    break;

                case 3:
                    $ops.= '<p style="position: absolute; top: '.$y.'; left: 35px;">'.strtoupper('rs').'</p>';
                    break;
                
                default:
                    # code...
                    break;
            }

            $y = $y+17;
        }

        $nivel = $presupuesto['nivel'];
        strlen($nivel);
        $nivel = explode('/', $nivel);
        $y = 162;
        $niv = '';
        for ($i=0; $i < count($nivel); $i++) {
            switch ($nivel[$i]) {
                case 1:
                    $niv.= '<p style="position: absolute; top: '.$y.'; left: 65px;">'.strtoupper('a').'</p>';
                    break;

                case 2:
                    $niv.= '<p style="position: absolute; top: '.$y.'; left: 65px;">'.strtoupper('m').'</p>';
                    break;

                case 3:
                    $niv.= '<p style="position: absolute; top: '.$y.'; left: 65px;">'.strtoupper('l').'</p>';
                    break;
                
                default:
                    # code...
                    break;
            }
            
            $y = $y+17;
        }

        $concepto = $presupuesto['concepto'];
        strlen($concepto);
        $concepto = explode('/', $concepto);
        $y = 162;
        $con = '';
        for ($i=0; $i < count($concepto); $i++) {
            $con.= '<p style="position: absolute; top: '.$y.'; left: 130px;">'.$concepto[$i].'</p>';
            $y = $y+17;
        }

        $momh = $presupuesto['momh'];
        strlen($momh);
        $momh = explode('/', $momh);
        $y = 162;
        $momhh = '';
        for ($i=0; $i < count($momh); $i++) {
            $momhh.= '<p style="position: absolute; top: '.$y.'; left: 509px;">'.$momh[$i].'</p>';
            $y = $y+17;
        }

        $momp = $presupuesto['momp'];
        strlen($momp);
        $momp = explode('/', $momp);
        $y = 162;
        $mompp = '';
        for ($i=0; $i < count($momp); $i++) {
            $mompp.= '<p style="position: absolute; top: '.$y.'; left: 558px;">'.$momp[$i].'</p>';
            $y = $y+17;
        }

        $momm = $presupuesto['momm'];
        strlen($momm);
        $momm = explode('/', $momm);
        $y = 162;
        $mommm = '';
        for ($i=0; $i < count($momm); $i++) {
            $mommm.= '<p style="position: absolute; top: '.$y.'; left: 607px;">'.$momm[$i].'</p>';
            $y = $y+17;
        }

        $tot = $presupuesto['tot'];
        strlen($tot);
        $tot = explode('/', $tot);
        $y = 162;
        $tott = '';
        for ($i=0; $i < count($tot); $i++) {
            $tott.= '<p style="position: absolute; top: '.$y.'; left: 656px;">'.$tot[$i].'</p>';
            $y = $y+17;
        }

        $refacciones = $presupuesto['refacciones'];
        strlen($refacciones);
        $refacciones = explode('/', $refacciones);
        $y = 162;
        $ref = '';
        for ($i=0; $i < count($refacciones); $i++) {
            $ref.= '<p style="position: absolute; top: '.$y.'; left: 694px;">'.$refacciones[$i].'</p>';
            $y = $y+17;
        }

        $pdf = app('dompdf.wrapper');
        $pdf->loadHTML('<!DOCTYPE html>
        <html lang="en">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <meta http-equiv="X-UA-Compatible" content="ie=edge">
            <title>Presupuesto</title>
        </head>
        <style>
                body {
                    background: url(img/formato_presupuesto3.jpg); 
                    background-size: cover;
                    background-repeat: no-repeat;
                    /* Arriba | Derecha | Abajo | Izquierda */
                    background-size: 100% 100%;
                    /* Arriba | Derecha | Abajo | Izquierda */
                    margin: -50px -38px -60px -39px;
                }
            </style>
        <body>
            <p style="position: absolute; top: 30px; left: 260px;">Expediente -> '.$request['exp'].'</p>
            <p style="position: absolute; top: 86px; left: 72px;">'.$cliente['nombre'].' '.$cliente['a_paterno'].' '.$cliente['a_materno'].'</p>
            <p style="position: absolute; top: 155px; left: 105px;">'.$vehiculo['clientes']['nombre'].'</p>
            <p style="position: absolute; top: 86px; left: 300px;">'.$vehiculo['marcas']['marca'].'</p>
            <p style="position: absolute; top: 111px; left: 300px;">'.$vehiculo['submarcas']['submarca'].'</p>
            <p style="position: absolute; top: 133px; left: 300px;">'.$vehiculo['modelo'].'</p>
            <p style="position: absolute; top: 155px; left: 300px;">'.$vehiculo['color'].'</p>
            <p style="position: absolute; top: 83; left: 535px;">'.$vehiculo['placas'].'</p>
            <p style="position: absolute; top: 99; left: 535px;">'.$hoy.'</p>
            <p style="position: absolute; top: 116; left: 535px;">'.$vehiculo['estatus']['status'].'</p>
            '.$ops.'
            '.$niv.'
            '.$con.'
            '.$momhh.'
            '.$mompp.'
            '.$mommm.'
            '.$tott.'
            '.$ref.'
            <p style="position: absolute; top: 900px; left: 510px;">'.$presupuesto['tmomh'].'</p>
            <p style="position: absolute; top: 900px; left: 558px;">'.$presupuesto['tmomp'].'</p>
            <p style="position: absolute; top: 900px; left: 607px;">'.$presupuesto['tmomm'].'</p>
            <p style="position: absolute; top: 900px; left: 656px;">'.$presupuesto['ttot'].'</p>
            <p style="position: absolute; top: 900px; left: 694px;">'.$presupuesto['trefacciones'].'</p>
            <p style="position: absolute; top: 918px; left: 694px;">'.$presupuesto['subtotal'].'</p>
            <p style="position: absolute; top: 935px; left: 694px;">'.$presupuesto['iva'].'</p>
            <p style="position: absolute; top: 954px; left: 694px;">'.$presupuesto['total'].'</p>
        </body>
        </body>
        </html>');
        
        return $pdf->stream($request['exp'].'_presupuesto');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Presupuestos  $presupuestos
     * @return \Illuminate\Http\Response
     */
    public function destroy(Presupuestos $presupuestos)
    {
        if ($presupuestos->delete()) {
            return redirect()->route('l_presupuestos')->with('success','Presupuesto Eliminado.');
        } else {
            return redirect()->route('l_presupuestos')->with('error','Presupuesto no Eliminado.');
        }
    }
}
