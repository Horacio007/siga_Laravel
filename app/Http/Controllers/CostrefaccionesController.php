<?php

namespace App\Http\Controllers;

use App\Models\Costrefacciones;
use App\Models\Vehiculo;
use App\Models\Clientes;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\SoftDeletes;

class CostrefaccionesController extends Controller
{
    use SoftDeletes;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $list_cotizaciones = DB::select("SELECT 
                                            costrefacciones.id, 
                                            costrefacciones.id_vehiculo, 
                                            modelosv.marca, 
                                            submarcav.submarca, 
                                            vehiculo.color, 
                                            vehiculo.modelo, 
                                            aseguradoras.nombre, 
                                            vehiculo.no_siniestro 
                                        FROM 
                                            vehiculo, 
                                            costrefacciones, 
                                            modelosv, 
                                            submarcav, 
                                            aseguradoras 
                                        WHERE 
                                            costrefacciones.id_vehiculo = vehiculo.id 
                                        AND vehiculo.marca_id = modelosv.id 
                                        AND vehiculo.linea_id = submarcav.id 
                                        AND vehiculo.cliente_id = aseguradoras.id 
                                        ORDER BY 
                                            costrefacciones.id");
        
        return view('compras.cotizar.l_cotizaciones', compact('list_cotizaciones'));
    }

    public function i_cotizacion(){
        return view('compras.cotizar.i_cotizacion');
    }

    public function exist_cost(Request $request){
        $vehiculo = Vehiculo::select('id')
                            ->where('id', $request['id'])
                            ->get();
        if ($vehiculo->isEmpty()) {
            return response()->json(['vehiculo' => 0]);
        } else {
            $e_cost = Costrefacciones::select('id_vehiculo')
                        ->where('id_vehiculo', $request['id'])
                        ->get();

            if ($e_cost->isEmpty()) {
                return response()->json(['vehiculo' => 1]);
            } else {
                return response()->json(['vehiculo' => 00]);
            }
            
        }
    }

    public function create_pdfcot(Request $request){
        $vehiculo = Vehiculo::with(['marcas:id,marca', 'submarcas:id,submarca', 'clientes:id,nombre', 'asesores:id,nombre,a_paterno,a_materno','estatusV:id,status'])
                            ->where('id', $request['exp'])
                            ->select('modelo', 'color', 'marca_id', 'linea_id', 'cliente_id', 'placas', 'id_asesor', 'estatus_id')
                            ->first();

        $r = Vehiculo::select('id_aux')
                    ->where('id', $request['exp'])
                    ->first();

        $cliente = Clientes::select('nombre', 'telefono', 'correo')
                            ->where('id',$r['id_aux'])
                            ->first();

        $costeo = Costrefacciones::select('*')
                                ->where('id_vehiculo', $request->exp)
                                ->first();

        $concepto = $costeo['concepto'];
        strlen($concepto);
        $concepto = explode('/', $concepto);
        $y = 105;
        $con = '';
        for ($i=0; $i < count($concepto); $i++) {
            $con.= '<p style="position: absolute; top: '.$y.'px; left: 60px;">'.$concepto[$i].'</p>';
            $y = $y+30;
        }

        $cantidad = $costeo['cantidad'];
        strlen($cantidad);
        $cantidad = explode('/', $cantidad);
        $y = 105;
        $can = '';
        for ($i=0; $i < count($cantidad); $i++) {
            $can.= '<p style="position: absolute; top: '.$y.'px; left: 413px;">'.$cantidad[$i].'</p>';
            $y = $y+30;
        }

        $proveedor1 = $costeo['proveedor1'];
        strlen($proveedor1);
        $proveedor1 = explode('/', $proveedor1);
        $y = 105;
        $prov1 = '';
        for ($i=0; $i < count($proveedor1); $i++) {
            $prov1.= '<p style="position: absolute; top: '.$y.'px; left: 435px;">'.$proveedor1[$i].'</p>';
            $y = $y+30;
        }
        
        $proveedor2 = $costeo['proveedor2'];
        strlen($proveedor2);
        $proveedor2 = explode('/', $proveedor2);
        $y = 105;
        $prov2 = '';
        for ($i=0; $i < count($proveedor2); $i++) {
            $prov2.= '<p style="position: absolute; top: '.$y.'px; left: 490px;">'.$proveedor2[$i].'</p>';
            $y = $y+30;
        }

        $proveedor3 = $costeo['proveedor3'];
        strlen($proveedor3);
        $proveedor3 = explode('/', $proveedor3);
        $y = 105;
        $prov3 = '';
        for ($i=0; $i < count($proveedor3); $i++) {
            $prov3.= '<p style="position: absolute; top: '.$y.'px; left: 545px;">'.$proveedor3[$i].'</p>';
            $y = $y+30;
        }

        $proveedorfinal = $costeo['proveedorfinal'];
        strlen($proveedorfinal);
        $proveedorfinal = explode('/', $proveedorfinal);
        $y = 105;
        $provf = '';
        for ($i=0; $i < count($proveedorfinal); $i++) {
            $provf.= '<p style="position: absolute; top: '.$y.'px; left: 600px;">'.$proveedorfinal[$i].'</p>';
            $y = $y+30;
        }

        $costo = $costeo['costo'];
        strlen($costo);
        $costo = explode('/', $costo);
        $y = 105;
        $cost = '';
        for ($i=0; $i < count($costo); $i++) {
            $cost.= '<p style="position: absolute; top: '.$y.'px; left: 655px;">'.$costo[$i].'</p>';
            $y = $y+30;
        }

        $fecha_promesa = $costeo['fecha_promesa'];
        strlen($fecha_promesa);
        $fecha_promesa = explode('/', $fecha_promesa);
        $y = 105;
        $f_prom = '';
        for ($i=0; $i < count($fecha_promesa); $i++) {
            $f_prom.= '<p style="position: absolute; top: '.$y.'px; left: 710px;">'.$fecha_promesa[$i].'</p>';
            $y = $y+30;
        }

        $num_guia = $costeo['num_guia'];
        strlen($num_guia);
        $num_guia = explode('/', $num_guia);
        $y = 105;
        $n_gia = '';
        for ($i=0; $i < count($num_guia); $i++) {
            $n_gia.= '<p style="position: absolute; top: '.$y.'px; left: 600;">'.$num_guia[$i].'</p>';
            $y = $y+30;
        }

        $comentarios = $costeo['comentarios'];
        strlen($comentarios);
        $comentarios = explode('/', $comentarios);
        $y = 105;
        $com = '';
        for ($i=0; $i < count($comentarios); $i++) {
            $com.= '<p style="position: absolute; top: '.$y.'px; left: 997px;">'.$comentarios[$i].'</p>';
            $y = $y+30;
        }

        $pdf = app('dompdf.wrapper');   
        $pdf->loadHTML('<!DOCTYPE html>
        <html lang="en">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <meta http-equiv="X-UA-Compatible" content="ie=edge">
            <title>Costeo de Refacciónes</title>
            <style>
                body {
                    background: url(img/formato_cotrefacciones.jpg); 
                    background-size: cover;
                    background-repeat: no-repeat;
                    /* Arriba | Derecha | Abajo | Izquierda */
                    margin: -55px -5em -65px -100px;
                    height: 1000vh;
                }
            </style>
        </head>
        <body>
            <p style="position: absolute; top: 7px; left: 127px;">'.$request['exp'].'</p>
            <p style="position: absolute; top: 7px; left: 433px;">'.$vehiculo['marcas']['marca']. ' '. $vehiculo['submarcas']['submarca'].'</p>
            <p style="position: absolute; top: 7px; left: 860px;">'.$vehiculo['clientes']['nombre'].'</p>
            <p style="position: absolute; top: 31px; left: 92px;">'.$vehiculo['color'].'</p>
            <p style="position: absolute; top: 31px; left: 427px;">'.$vehiculo['modelo'].'</p>
            '.$con.'
            '.$can.'
            <p style="position: absolute; top: 77px; left: 435px;">'.$costeo['nombreprov1'].'</p>
            <p style="position: absolute; top: 77px; left: 490px;">'.$costeo['nombreprov2'].'</p>
            <p style="position: absolute; top: 77px; left: 545px;">'.$costeo['nombreprov3'].'</p>
            '.$prov1.'
            '.$prov2.'
            '.$prov3.'
            <p style="position: absolute; top: 700px; left: 435px;">'.$costeo['tproveedor1'].'</p>
            <p style="position: absolute; top: 700px; left: 490px;">'.$costeo['tproveedor2'].'</p>
            <p style="position: absolute; top: 700px; left: 545px;">'.$costeo['tproveedor3'].'</p>
            '.$provf.'
            '.$cost.'
            <p style="position: absolute; top: 700px; left: 655px;">'.$costeo['costofinal'].'</p>
            '.$f_prom.'
            '.$n_gia.'
            '.$com.'
        </body>
        </body>
        </html>')->setPaper('A4', 'landscape');
        
        return $pdf->stream($request['exp'].'_costeo_refacciones');
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
        //return $request;
        $cotizacion = new Costrefacciones();
        $cotizacion->id_vehiculo = $request->expediente;
        $cotizacion->concepto = $request->concepto;
        $cotizacion->cantidad = $request->cantidad;
        $cotizacion->nombreprov1 = $request->nombreprov1;
        $cotizacion->nombreprov2 = $request->nombreprov2;
        $cotizacion->nombreprov3 = $request->nombreprov3;
        $cotizacion->proveedor1 = $request->proveedor1;
        $cotizacion->proveedor2 = $request->proveedor2;
        $cotizacion->proveedor3 = $request->proveedor3;
        $cotizacion->tproveedor1 = $request->tpremier;
        $cotizacion->tproveedor2 = $request->troto;
        $cotizacion->tproveedor3 = $request->taldo;
        $cotizacion->proveedorfinal = $request->tproveedorf;
        $cotizacion->costo = $request->tcostos;
        $cotizacion->costofinal = $request->tcostosf;
        $cotizacion->fecha_promesa = $request->tfechapromesa;
        $cotizacion->num_guia = $request->tnumguia;
        $cotizacion->comentarios = $request->tcomentarios;
        $cotizacion->fecha = $request->fecha;

        if ($cotizacion->save()) {
            return 1;
        } else {
            return 'Costeo de Refacciones no Registrado.';
        }
        

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Costrefacciones  $costrefacciones
     * @return \Illuminate\Http\Response
     */
    public function show(Costrefacciones $costrefacciones)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Costrefacciones  $costrefacciones
     * @return \Illuminate\Http\Response
     */
    public function edit(Costrefacciones $costrefacciones)
    {
        $j = 1;
        $k = 1;
        $l = 1;
        //dd($costrefacciones);
        return view('compras.cotizar.u_cotizacion', compact(['costrefacciones', 'j', 'k', 'l']));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Costrefacciones  $costrefacciones
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Costrefacciones $costrefacciones)
    {
        //dd($request, $costrefacciones);

        $cantidad = "";
        $proveedor1 = "";
        $proveedor2 = "";
        $proveedor3 = "";
        $proveedorfinal = "";
        $costo = "";
        $fechasp = "";
        $guias = "";
        $comentarios = "";

        $costrefacciones->nombreprov1 = $request->nprovedor1;
        $costrefacciones->nombreprov2 = $request->nprovedor2;
        $costrefacciones->nombreprov3 = $request->nprovedor3;

        $costrefacciones->tproveedor1 = $request->tprov1;
        $costrefacciones->tproveedor2 = $request->tprov2;
        $costrefacciones->tproveedor3 = $request->tprov3;

        $costrefacciones->costofinal = $request->tcostosf;

        for ($i=1; $i <= $request->t_ref ; $i++) {
            if ($request['tcantidad_'.$i] != null) {
                $cantidad.= $request['tcantidad_'.$i].'/';
            }
            
            if ($request['tproveedor1_'.$i] != null) {
                $proveedor1.= $request['tproveedor1_'.$i].'/';
            }
            
            if ($request['tproveedor2_'.$i] != null) {
                $proveedor2.=  $request['tproveedor2_'.$i].'/';
            }
            
            if ($request['tproveedor3_'.$i] != null) {
                $proveedor3.=  $request['tproveedor3_'.$i].'/';
            }
            
            if ($request['tproveedorf_'.$i] != null) {
                $proveedorfinal.= $request['tproveedorf_'.$i].'/';
            }
            
            if ($request['tcostosf_'.$i] != null) {
                $costo.= $request['tcostosf_'.$i].'/';
            }
            
            if ($request['tfechapromesa_'.$i] != null) {
                $fechasp.= $request['tfechapromesa_'.$i].'/';
            }
            
            if ($request['tnumguia_'.$i] != null) {
                $guias.= $request['tnumguia_'.$i].'-';
            }
            
            if ($request['tcomentarios_'.$i] != null) {
                $comentarios.= $request['tcomentarios_'.$i].'/';
            }
        }

        $costrefacciones->cantidad = $cantidad;
        $costrefacciones->proveedor1 = $proveedor1;
        $costrefacciones->proveedor2 = $proveedor2;
        $costrefacciones->proveedor3 = $proveedor3;
        $costrefacciones->proveedorfinal = $proveedorfinal;
        $costrefacciones->costo = $costo;
        $costrefacciones->fecha_promesa = $fechasp;
        $costrefacciones->num_guia = $guias;
        $costrefacciones->comentarios = $comentarios;

        //dd($costrefacciones);

        if ($costrefacciones->save()) {
            return redirect()->route('l_compras')->with('success','Costeo Actualizado.');
        } else {
            return redirect()->route('l_compras')->with('error','Costeo no Actualizado.');
        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Costrefacciones  $costrefacciones
     * @return \Illuminate\Http\Response
     */
    public function destroy(Costrefacciones $costrefacciones)
    {
        if ($costrefacciones->delete()) {
            return redirect()->route('l_compras')->with('success','Costeo de Refacciónes Eliminado.');
        } else {
            return redirect()->route('l_compras')->with('error','Costeo de Refacciónes no Eliminado.');
        }
    }
}
