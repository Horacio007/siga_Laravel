<?php

namespace App\Http\Controllers;

use App\Models\Clientes;
use App\Models\Vehiculo;
use Illuminate\Support\Facades\DB;
use Facade\FlareClient\Http\Client;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Http\Request;
use Codedge\Fpdf\Fpdf\Fpdf;

class ClientesController extends Controller
{
    use SoftDeletes;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $list_clientes = DB::select("SELECT
                                    vehiculo.id,
                                    modelosv.marca,
                                    submarcav.submarca,
                                    vehiculo.modelo,
                                    aseguradoras.nombre AS aseguradora,
                                    vehiculo.no_siniestro,
                                    vehiculo.fecha_llegada,
                                    clientes.nombre,
                                    clientes.telefono,
                                    clientes.correo,
                                    vehiculo.fecha_salida_taller,
                                    vehiculo.id_aux
                                FROM
                                    vehiculo,
                                    clientes,
                                    modelosv,
                                    submarcav,
                                    aseguradoras
                                WHERE
                                    clientes.id = vehiculo.id_aux
                                AND vehiculo.marca_id = modelosv.id
                                AND vehiculo.linea_id = submarcav.id
                                AND aseguradoras.id = vehiculo.cliente_id
                                ORDER BY
                                    clientes.id");

        return view('entrega.clientes.l_clientes', compact('list_clientes'));
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

    public function getInfoClieteCheck(Request $request){
        $r = Vehiculo::select('id_aux')
                    ->where('id', $request['id'])
                    ->first();

        $c = Clientes::select('nombre', 'telefono', 'correo')
                    ->where('id',$r['id_aux'])
                    ->first();

        return response()->json($c);
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
     * @param  \App\Models\Clientes  $clientes
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
        $u_vehiculo = Vehiculo::with(['marcas:id,marca', 'submarcas:id,submarca', 'clientes:id,nombre', 'asesores:id,nombre,a_paterno,a_materno', 'estatusV:id,status'])
                                ->where('id', $request->exp)->first();

        $uc = Clientes::select('id', 'nombre', 'telefono', 'correo')
                        ->where('id', $u_vehiculo->id_aux)
                        ->get();

        $pdf = new FPDF();
        $pdf->AddPage();
        $pdf->SetFont('Arial','',14);
        $pdf->Image('../public/img/alta_vehiculoo.jpg', -10, -10, 0, 170);
        $pdf->SetXY('148', '37');
        $pdf->Cell(0, 0, utf8_decode($request->exp), 0, 0, 'I');
        $pdf->SetXY('148', '44.5');
        $pdf->Cell(0, 0, utf8_decode($u_vehiculo->no_siniestro??''), 0, 0, 'I');
        $pdf->SetXY('148', '52.4');
        $pdf->Cell(0, 0, utf8_decode(date("d/m/Y")), 0, 0, 'I');
        $pdf->SetXY('54', '57');
        $pdf->Cell(0, 0, utf8_decode($uc[0]['nombre']??''), 0, 0, 'I');
        $pdf->SetXY('35', '69');
        $pdf->Cell(0, 0, utf8_decode($uc[0]['telefono']??''), 0, 0, 'I');
        $pdf->SetXY('112', '69');
        $pdf->Cell(0, 0, utf8_decode($uc[0]['correo']??''), 0, 0, 'I');
        $pdf->SetXY('27', '110');
        $pdf->Cell(0, 0, utf8_decode($u_vehiculo->marcas->marca??''), 0, 0, 'I');
        $pdf->SetXY('92', '110');
        $pdf->Cell(0, 0, utf8_decode($u_vehiculo->submarcas->submarca??''), 0, 0, 'I');
        $pdf->SetXY('152', '110');
        $pdf->Cell(0, 0, utf8_decode($u_vehiculo->modelo??''), 0, 0, 'I');
        $pdf->SetXY('26', '127.5');
        $pdf->Cell(0, 0, utf8_decode($u_vehiculo->color??''), 0, 0, 'I');
        $pdf->SetXY('82', '127.5');
        $pdf->Cell(0, 0, utf8_decode($u_vehiculo->placas??''), 0, 0, 'I');
        $pdf->SetXY('142', '127.5');
        $pdf->Cell(0, 0, utf8_decode($u_vehiculo->asesores->nombre." ".$u_vehiculo->asesores->a_paterno." ".$u_vehiculo->asesores->a_materno), 0, 0, 'I');
        $pdf->SetXY('42', '139');
        $pdf->Cell(0, 0, utf8_decode($u_vehiculo->clientes->nombre??''), 0, 0, 'I');
        $pdf->Output();
        exit;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Clientes  $clientes
     * @return \Illuminate\Http\Response
     */
    public function edit(Clientes $clientes)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Clientes  $clientes
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Clientes $clientes)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Clientes  $clientes
     * @return \Illuminate\Http\Response
     */
    public function destroy(Clientes $clientes)
    {
        //
    }
}
