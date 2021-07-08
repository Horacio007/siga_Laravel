<?php

namespace App\Http\Controllers;

use App\Models\Presupuestos;
use App\Models\Vehiculo;
use App\Models\Clientes;
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
        return view('costeo.presupuesto.i_presupuesto');
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
        $presu = new Presupuestos();
        $presu->id_vehiculo = $request->expediente;
        $presu->op = $request->operacion;
        $presu->nivel = $request->nivel;
        $presu->concepto = $request->concepto;
        $presu->momh = $request->momh;
        $presu->momp = $request->momp;
        $presu->momm = $request->momm;
        $presu->tot = $request->tot;
        $presu->refacciones = $request->refacciones;
        $presu->tmomh = $request->tmomh;
        $presu->tmomp = $request->tmomp;
        $presu->tmomm = $request->tmomm;
        $presu->ttot = $request->ttot;
        $presu->trefacciones = $request->trefacciones;
        $presu->subtotal = $request->subtotal;
        $presu->iva = $request->iva;
        $presu->total = $request->total;

        if ($presu->save()) {
            return 1;
        } else {
            return 'Presupuesto no Registrado.';
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
        return view('costeo.presupuesto.u_presupuesto', compact('presupuestos'));
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
        if ($presupuestos->op == $request->op) {
            return redirect()->route('l_presupuestos')->with('warning','No se Actualizo el Presupuesto, no se detectaron cambios en la información.');
        } else {
            $presupuestos->op = $request->toperacion;
            $presupuestos->nivel = $request->tnivel;
            $presupuestos->concepto = $request->tconcepto;
            $presupuestos->momh = $request->tmomh;
            $presupuestos->momp = $request->tmomp;
            $presupuestos->momm = $request->tmomm;
            $presupuestos->tot = $request->ttot;
            $presupuestos->refacciones = $request->trefacciones;
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
        $y = 138;
        $ops = '';
        for ($i=0; $i < count($operacion); $i++) {
            $ops.= '<p style="position: absolute; top: '.$y.'; left: 3;">'.strtoupper($operacion[$i]).'</p>';
            $y = $y+17;
        }

        $nivel = $presupuesto['nivel'];
        strlen($nivel);
        $nivel = explode('/', $nivel);
        $y = 138;
        $niv = '';
        for ($i=0; $i < count($nivel); $i++) {
            $niv.= '<p style="position: absolute; top: '.$y.'; left: 15;">'.strtoupper($nivel[$i]).'</p>';
            $y = $y+17;
        }

        $concepto = $presupuesto['concepto'];
        strlen($concepto);
        $concepto = explode('/', $concepto);
        $y = 138;
        $con = '';
        for ($i=0; $i < count($concepto); $i++) {
            $con.= '<p style="position: absolute; top: '.$y.'; left: 58;">'.strtoupper($concepto[$i]).'</p>';
            $y = $y+17;
        }

        $momh = $presupuesto['momh'];
        strlen($momh);
        $momh = explode('/', $momh);
        $y = 138;
        $momhh = '';
        for ($i=0; $i < count($momh); $i++) {
            $momhh.= '<p style="position: absolute; top: '.$y.'; left: 348;">'.strtoupper($momh[$i]).'</p>';
            $y = $y+17;
        }

        $momp = $presupuesto['momp'];
        strlen($momp);
        $momp = explode('/', $momp);
        $y = 138;
        $mompp = '';
        for ($i=0; $i < count($momp); $i++) {
            $mompp.= '<p style="position: absolute; top: '.$y.'; left: 384;">'.strtoupper($momp[$i]).'</p>';
            $y = $y+17;
        }

        $momm = $presupuesto['momm'];
        strlen($momm);
        $momm = explode('/', $momm);
        $y = 138;
        $mommm = '';
        for ($i=0; $i < count($momm); $i++) {
            $mommm.= '<p style="position: absolute; top: '.$y.'; left: 421;">'.strtoupper($momm[$i]).'</p>';
            $y = $y+17;
        }

        $tot = $presupuesto['tot'];
        strlen($tot);
        $tot = explode('/', $tot);
        $y = 138;
        $tott = '';
        for ($i=0; $i < count($tot); $i++) {
            $tott.= '<p style="position: absolute; top: '.$y.'; left: 457;">'.strtoupper($tot[$i]).'</p>';
            $y = $y+17;
        }

        $refacciones = $presupuesto['refacciones'];
        strlen($refacciones);
        $refacciones = explode('/', $refacciones);
        $y = 138;
        $ref = '';
        for ($i=0; $i < count($refacciones); $i++) {
            $ref.= '<p style="position: absolute; top: '.$y.'; left: 492;">'.strtoupper($refacciones[$i]).'</p>';
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
        <body background="img/formato_presupuesto2.jpg">
            <p style="position: absolute; top: 20px; left: 250px;">Expediente -> '.$request['exp'].'</p>
            <p style="position: absolute; top: 65px; left: 68px;">'.$cliente['nombre'].' '.$cliente['a_paterno'].' '.$cliente['a_materno'].'</p>
            <p style="position: absolute; top: 130px; left: 68px;">'.$vehiculo['clientes']['nombre'].'</p>
            <p style="position: absolute; top: 65px; left: 300px;">'.$vehiculo['marcas']['marca'].'</p>
            <p style="position: absolute; top: 87px; left: 300px;">'.$vehiculo['submarcas']['submarca'].'</p>
            <p style="position: absolute; top: 110px; left: 300px;">'.$vehiculo['modelo'].'</p>
            <p style="position: absolute; top: 130px; left: 300px;">'.$vehiculo['color'].'</p>
            <p style="position: absolute; top: 65; left: 535px;">'.$vehiculo['placas'].'</p>
            <p style="position: absolute; top: 82; left: 535px;">'.$hoy.'</p>
            <p style="position: absolute; top: 97; left: 535px;">'.$vehiculo['estatus']['status'].'</p>
            '.$ops.'
            '.$niv.'
            '.$con.'
            '.$momhh.'
            '.$mompp.'
            '.$mommm.'
            '.$tott.'
            '.$ref.'
            <p style="position: absolute; top: 620; left: 462px;">'.$presupuesto['tmomh'].'</p>
            <p style="position: absolute; top: 620; left: 511px;">'.$presupuesto['tmomp'].'</p>
            <p style="position: absolute; top: 620; left: 560px;">'.$presupuesto['tmomm'].'</p>
            <p style="position: absolute; top: 620; left: 608px;">'.$presupuesto['ttot'].'</p>
            <p style="position: absolute; top: 620; left: 656px;">'.$presupuesto['trefacciones'].'</p>
            <p style="position: absolute; top: 635; left: 654px;">'.$presupuesto['subtotal'].'</p>
            <p style="position: absolute; top: 648; left: 654px;">'.$presupuesto['iva'].'</p>
            <p style="position: absolute; top: 661; left: 654px;">'.$presupuesto['total'].'</p>
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
