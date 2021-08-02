<?php

use Illuminate\Routing\Route as RoutingRoute;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

//Recepcion
    //AltaVehiculo
        Route::get('i_vehiculo', 'VehiculoController@i_vehiculo')->name('i_vehiculos');
        Route::get('ultimo_vehiculo', 'VehiculoController@ultimo_vehiculo');
        Route::get('ultimo_vehiculo_nuevo', 'VehiculoController@ultimo_vehiculo_nuevo');
        Route::get('listado_marcas', 'ModelosvController@listado_marcas');
        Route::post('listado_submarcas', 'SubmarcavController@listado_submarcas');
        Route::get('listado_asesores', 'AsesoresController@listado_asesores');
        Route::get('listado_aseguradoras', 'AseguradorasController@listado_aseguradoras');
        Route::get('listado_estatus', 'EstatusController@listado_estatus');
        Route::get('listado_niveldano', 'NivelDanoController@listado_niveldano');
        Route::get('listado_formaarribo', 'FormaAriboController@listado_formaarribo');
        Route::post('/i_vehiculo', 'VehiculoController@store');
    //endAltaVehiculo

    //Checklist
        Route::get('i_checklist', 'ChecklistController@i_checklist')->name('i_checklist');
        Route::get('l_checklist', 'ChecklistController@index')->name('l_checklist');
        Route::get('e_chv', 'ChecklistController@exist_chv');
        Route::get('mlmca', 'VehiculoController@mlmca');
        Route::post('i_checklist', 'ChecklistController@store');
        Route::get('getClienteCh', 'ClientesController@getInfoClieteCheck');
        Route::get('create_pdf/{exp}', 'ChecklistController@create_pdf')->name('create_pdf');
        Route::post('/d_checklist/{checklist}', 'ChecklistController@destroy')->name('d_checklist');
    //endChecklist
    
    //AltaEvidenciaRecepcion
        Route::get('i_evidenciaR', 'ArchivosController@i_evidenciaR')->name('upload_evidenciar');
        Route::post('upload_evidenciar', 'ArchivosController@upload_evidenciaR');
    //endAltaEvidenciaRecepcion

//endRecepcion

//Costeo
    //Presupuesto
        Route::get('l_presupuestos', 'PresupuestosController@index')->name('l_presupuestos');
        Route::get('i_presupuesto', 'PresupuestosController@i_presupuesto')->name('i_presupuesto');
        Route::get('e_pres', 'PresupuestosController@exist_pres');
        Route::post('i_presupuesto', 'PresupuestosController@store');
        Route::get('/u_presupuesto/{presupuestos}', 'PresupuestosController@edit')->name('u_presupuesto');
        Route::post('/u_presupuesto/{presupuestos}', 'PresupuestosController@update');
        Route::get('create_pdfp/{exp}', 'PresupuestosController@create_pdfp')->name('create_pdfp');
        Route::post('/d_presupuesto/{presupuestos}', 'PresupuestosController@destroy')->name('d_presupuesto');
    //endPresupuesto

    //AltaEvidenciaPresupuesto
        Route::get('i_evidenciaP', 'ArchivosController@i_evidenciaP')->name('upload_evidenciap');
        Route::post('upload_evidenciap', 'ArchivosController@upload_evidenciaP');
    //endAltaEvidenciaPresupuesto
//endCosteo

//Compras
    //CotizarRefacciones
        Route::get('l_compras', 'CostrefaccionesController@index')->name('l_compras');
        Route::get('i_cotizacion', 'CostrefaccionesController@i_cotizacion')->name('i_cotizacion');
        Route::get('e_cost', 'CostrefaccionesController@exist_cost');
        Route::post('i_cotizacion', 'CostrefaccionesController@store');
        Route::get('create_pdfcot/{exp}', 'CostrefaccionesController@create_pdfcot')->name('create_pdfcot');
        Route::post('/d_costrefacciones/{costrefacciones}', 'CostrefaccionesController@destroy')->name('d_costrefacciones');
    //endCotizarRefacciones

    //AltaEvidenciaCotizarRefacciones
        Route::get('i_evidenciaCom', 'ArchivosController@i_evidenciaCom')->name('upload_evidenciacom');
        Route::post('upload_evidenciacom', 'ArchivosController@upload_evidenciaCom');
    //endAltaEvidenciaCotizarRefacciones
//endCompras

//Refacciones
    //AltaActualizarProv
        Route::get('l_refacciones', 'AlmacenController@index')->name('l_refacciones');
        Route::get('i_refaccion', 'AlmacenController@i_refaccion')->name('i_refaccion');
        Route::get('e_ve', 'AlmacenController@e_ve');
        Route::post('i_refaccion', 'AlmacenController@store');
        Route::get('/u_refaccion/{almacen}', 'AlmacenController@edit')->name('u_refaccion');
        Route::post('/u_refaccion/{almacen}', 'AlmacenController@update');
        Route::post('/d_refaccion/{almacen}', 'AlmacenController@destroy')->name('d_refaccion');
        Route::get('/b_refaccion/{almacen}', 'AlmacenController@baja_edit')->name('b_refaccion');
        Route::post('/b_refaccion/{almacen}', 'AlmacenController@baja_update');
    //endltaActualizarProv

    //SeguimientoRefaccionesRecepcionRefacciones
        Route::get('l_segrefacciones', 'AlmacenController@index2')->name('l_segrefacciones');
        Route::get('/u_segrefaccion/{almacen}', 'AlmacenController@edit2')->name('u_segrefaccion');
        Route::post('/u_segrefaccion/{almacen}', 'AlmacenController@u_segrefaccion')->name('u_segrefaccion');
        Route::post('/u_segrefaccion/{almacen}', 'AlmacenController@update2');
        Route::post('/d_segrefaccion/{almacen}', 'AlmacenController@destroy2')->name('d_segrefaccion');
    //SeguimientoRefaccionesRecepcionRefacciones

    //RefaccionesEntregadas
        Route::get('l_entregdasrefacciones', 'AlmacenController@index3')->name('l_entregdasrefacciones');
    //endRefaccionesEntregadas

    //Codigos
        Route::get('l_codigos', 'CodigosController@index')->name('l_codigos');
    //endCodigos
//endRefacciones

//Taller
    //OrdeneTrabajo
        Route::get('l_ordenest', 'OrdenTrabajoController@index')->name('l_ordenest');
        Route::get('i_ordenest', 'OrdenTrabajoController@i_ordenest')->name('i_ordenest');
        Route::post('i_ordenest', 'OrdenTrabajoController@store');
        Route::get('create_pdfot/{exp}', 'OrdenTrabajoController@create_pdfot')->name('create_pdfot');
        Route::post('/d_ordenest/{orden_trabajo}', 'OrdenTrabajoController@destroy')->name('d_ordenest');
    //endOrdeneTrabajo

    //OrdenMecanica
        Route::get('l_ordenesm', 'OrdenMecanicaController@index')->name('l_ordenesm');
        Route::get('i_ordenesm', 'OrdenMecanicaController@i_ordenesm')->name('i_ordenesm');
        Route::post('i_ordenesm', 'OrdenMecanicaController@store');
        Route::get('create_pdfom/{exp}', 'OrdenMecanicaController@create_pdfom')->name('create_pdfom');
        Route::post('/d_ordenesm/{orden_mecanica}', 'OrdenMecanicaController@destroy')->name('d_ordenesm');
    //endOrdenMecanica

    //OrdenRetrabajo
        Route::get('l_ordenesrt', 'OrdenRetrabajoController@index')->name('l_ordenesrt');
        Route::get('i_ordenesrt', 'OrdenRetrabajoController@i_ordenesrt')->name('i_ordenesrt');
        Route::post('i_ordenesrt', 'OrdenRetrabajoController@store');
        Route::get('create_pdfort/{exp}', 'OrdenRetrabajoController@create_pdfort')->name('create_pdfort');
        Route::post('/d_ordenesrt/{orden_retrabajo}', 'OrdenRetrabajoController@destroy')->name('d_ordenesrt');
    //endOrdenRetrabajo
//endTaller

//Entrega
    //Clientes
        Route::get('l_clientes', 'ClientesController@index')->name('l_clientes');
    //endClientes

    //Documentacion
        Route::get('l_docs', 'VehiculoController@indexDocs')->name('l_docs');
        Route::get('create_pdfentrega/{exp}', 'VehiculoController@create_pdfentrega')->name('create_pdfentrega');
    //endDocumentacion

    //CambiarEstatus
        Route::get('l_cambiarEstatus', 'VehiculoController@index_entrega_estatus_vehiculo')->name('l_cambiarEstatus');
        Route::get('/u_cambiarEstatus/{vehiculo}', 'VehiculoController@u_cambiarEstatus')->name('u_cambiarEstatus');
        Route::post('/u_cambiarEstatus/{vehiculo}', 'VehiculoController@update_cambiarEstatus');
    //endCambiarEstatus
   
    //ISC
        Route::get('l_ics', 'IscController@index')->name('l_ics');
        Route::get('i_ics', 'IscController@i_ics')->name('i_ics');
        Route::post('i_ics', 'IscController@store');
        Route::post('/d_ics/{isc}', 'IscController@destroy')->name('d_ics');
    //endISC

    //EntregaSubirArchivos
        Route::get('i_evidenciaE', 'ArchivosController@i_evidenciaE')->name('upload_evidenciae');
        Route::post('upload_evidenciae', 'ArchivosController@upload_evidenciae');
    //endEntregaSubirArchivos
//endEntrega

//Aministracion
    //VerArchivos
        Route::get('l_archivos', 'ArchivosController@index')->name('l_archivos');
        Route::get('see_archivos/{exp}', 'ArchivosController@verArchivos')->name('see_archivos');
        Route::post('/d_archivos/{archivos}', 'ArchivosController@destroy')->name('d_archivos');
    //endVerArchivos

    //Valuaciones
        Route::get('l_valuaciones', 'VehiculoController@indexV')->name('l_valuaciones');
        Route::get('/u_valuaciones/{vehiculo}', 'VehiculoController@u_valuaciones')->name('u_valuaciones');
        Route::post('/u_valuaciones/{vehiculo}', 'VehiculoController@update_valuaciones');
    //endValuaciones

    //RefaccionesAdmon
        Route::get('l_Brefacciones', 'VehiculoController@indexR')->name('l_Brefacciones');
        Route::get('/u_Brefacciones/{vehiculo}', 'VehiculoController@u_refaccionesAdmon')->name('u_Brefacciones');
        Route::post('/u_Brefacciones/{vehiculo}', 'VehiculoController@update_Brefacciones');
    //endRefaccionesAdmon

    //AsignacionPersonal
        Route::get('l_asignacionPersonal', 'VehiculoController@indexAP')->name('l_asignacionPersonal');
        Route::get('i_asignacionPersonal/{vehiculo}', 'VehiculoController@i_asignacionPersonal')->name('i_asignacionPersonal');
        Route::post('i_asignacionPersonal/{vehiculo}', 'VehiculoController@insert_asignacionPersonal');
        Route::get('/u_asignacionPersonal/{vehiculo}', 'VehiculoController@u_asignacionPersonal')->name('u_asignacionPersonal');
        Route::post('/u_asignacionPersonal/{vehiculo}', 'VehiculoController@update_asignacionPersonal');
    //endAsignacionPersonal

    //ProcesoAdministrativo
        Route::get('l_procesoAdministrativo', 'VehiculoController@indexPA')->name('l_procesoAdministrativo');
        Route::get('/u_valuacionesPA/{vehiculo}', 'VehiculoController@u_valuacionesPA')->name('u_valuacionesPA');
        Route::post('/u_valuacionesPA/{vehiculo}', 'VehiculoController@update_valuacionesPA');
        Route::get('/u_BrefaccionesPA/{vehiculo}', 'VehiculoController@u_refaccionesAdmonPA')->name('u_BrefaccionesPA');
        Route::post('/u_BrefaccionesPA/{vehiculo}', 'VehiculoController@update_BrefaccionesPA');
    //endProcesoAdministrativo

    //ProcesoTaller
        Route::get('l_procesoTaller', 'VehiculoController@indexPT')->name('l_procesoTaller');
        Route::get('/u_asignacionPersonalPT/{vehiculo}', 'VehiculoController@u_asignacionPersonalPT')->name('u_asignacionPersonalPT');
        Route::post('/u_asignacionPersonalPT/{vehiculo}', 'VehiculoController@update_asignacionPersonalPT');
    //endProcesoTaller

    //Metricos
        Route::get('metricos', 'VehiculoController@indexMetricos')->name('metricos');
        Route::get('g_ventregados', 'VehiculoController@g_ventregados');
        Route::get('g_vrecibidos', 'VehiculoController@g_vrecibidos');
        Route::get('g_ventregadosselect', 'VehiculoController@g_ventregadosselect');
        Route::get('g_vrecibidosselect', 'VehiculoController@g_vrecibidosselect');
        Route::get('g_diesentregados', 'VehiculoController@g_diesentregados');
        Route::get('g_diesrecibidos', 'VehiculoController@g_diesrecibidos');
        Route::get('g_isccu', 'IscController@g_isccu');
        Route::get('g_isccutotal', 'IscController@g_isccutotal');
        Route::get('g_aud_limpieza', 'AudLimpiezaController@g_aud_limpieza');
        Route::get('g_aud_limpieza_actual', 'AudLimpiezaController@g_aud_limpieza_actual');
        Route::get('g_aud_limpieza_encargado', 'AudLimpiezaController@g_aud_limpieza_encargado');
        Route::get('g_aud_limpieza_actual_personal', 'AudLimpiezaController@g_aud_limpieza_actual_personal');
    //endMetricos
    
//endAdministracion

//Catalogos
    //Marca
        Route::get('l_marcas', 'ModelosvController@index')->name('lista_marcas');
        Route::get('i_marca', 'ModelosvController@i_marca')->name('i_marcas');
        Route::post('/i_marca', 'ModelosvController@store');
        Route::get('/u_marca/{modelosv}', 'ModelosvController@edit')->name('u_marca');
        Route::post('/u_marca/{modelosv}', 'ModelosvController@update');
        Route::post('/d_marca/{modelosv}', 'ModelosvController@destroy')->name('d_marca');
    //endMarca

    //SubMarca
        Route::get('l_submarcas', 'SubmarcavController@index')->name('lista_submarcas');
        Route::get('i_submarca', 'SubmarcavController@select_marca')->name('i_submarca');
        Route::post('/i_submarca', 'SubmarcavController@store');
        Route::get('/u_submarca/{submarcav}', 'SubmarcavController@edit')->name('u_submarca');
        Route::post('/u_submarca/{submarcav}', 'SubmarcavController@update');
        Route::post('/d_submarca/{submarcav}', 'SubmarcavController@destroy')->name('d_submarca');
    //endSubMarca

    //Area
        Route::get('l_areas', 'AreasController@index')->name('lista_areas');
        Route::get('i_area', 'AreasController@i_area')->name('i_area');
        Route::post('/i_area', 'AreasController@store');
        Route::get('/u_area/{areas}', 'AreasController@edit')->name('u_area');
        Route::post('/u_area/{areas}', 'AreasController@update');
        Route::post('/d_area/{areas}', 'AreasController@destroy')->name('d_area');
    //endArea

    //Aseguradora
        Route::get('l_aseguradoras', 'AseguradorasController@index')->name('lista_aseguradoras');
        Route::get('i_aseguradora', 'AseguradorasController@i_aseguradora')->name('i_aseguradora');
        Route::post('/i_aseguradora', 'AseguradorasController@store');
        Route::get('/u_aseguradora/{aseguradoras}', 'AseguradorasController@edit')->name('u_aseguradora');
        Route::post('/u_aseguradora/{aseguradoras}', 'AseguradorasController@update');
        Route::post('/d_aseguradora/{aseguradoras}', 'AseguradorasController@destroy')->name('d_aseguradora');
    //endAseguradora

    //Asesores
        Route::get('l_asesores', 'AsesoresController@index')->name('lista_asesores');
        Route::get('i_asesor', 'AsesoresController@select_aseguradora')->name('i_asesor');
        Route::post('/i_asesor', 'AsesoresController@store');
        Route::get('/u_asesor/{asesores}', 'AsesoresController@edit')->name('u_asesor');
        Route::post('/u_asesor/{asesores}', 'AsesoresController@update');
        Route::post('/d_asesor/{asesores}', 'AsesoresController@destroy')->name('d_asesor');
    //endAsesores

    //Estatus
        Route::get('l_estatus', 'EstatusController@index')->name('lista_estatus');
        Route::get('i_estatus', 'EstatusController@i_estatus')->name('i_estatus');
        Route::post('/i_estatus', 'EstatusController@store');
        Route::get('/u_estatus/{estatus}', 'EstatusController@edit')->name('u_estatus');
        Route::post('/u_estatus/{estatus}', 'EstatusController@update');
        Route::post('/d_estatus/{estatus}', 'EstatusController@destroy')->name('d_estatus');
    //endEstatus

    //NivelDano
        Route::get('l_niveldano', 'NivelDanoController@index')->name('lista_niveldano');
        Route::get('i_niveldano', 'NivelDanoController@i_niveldano')->name('i_niveldano');
        Route::post('/i_niveldano', 'NivelDanoController@store');
        Route::get('/u_niveldano/{nivel_dano}', 'NivelDanoController@edit')->name('u_niveldano');
        Route::post('/u_niveldano/{nivel_dano}', 'NivelDanoController@update');
        Route::post('/d_niveldano/{nivel_dano}', 'NivelDanoController@destroy')->name('d_niveldano');
    //endNivelDano

    //FormaAribo
        Route::get('l_formaarribo', 'FormaAriboController@index')->name('lista_formaarribo');
        Route::get('i_formaarribo', 'FormaAriboController@i_formaarribo')->name('i_formaarribo');
        Route::post('/i_formaarribo', 'FormaAriboController@store');
        Route::get('/u_formaarribo/{forma_aribo}', 'FormaAriboController@edit')->name('u_formaarribo');
        Route::post('/u_formaarribo/{forma_aribo}', 'FormaAriboController@update');
        Route::post('/d_formaarribo/{forma_aribo}', 'FormaAriboController@destroy')->name('d_formaarribo');
    //endFormaAribo

    //EstatusRefacciones
        Route::get('l_estatusalm', 'EstatusalmacenController@index')->name('lista_estatusalm');
        Route::get('i_estatusalm', 'EstatusalmacenController@i_estatusalm')->name('i_estatusalm');
        Route::post('/i_estatusalm', 'EstatusalmacenController@store');
        Route::get('/u_estatusalm/{estatusalmacen}', 'EstatusalmacenController@edit')->name('u_estatusalm');
        Route::post('/u_estatusalm/{estatusalmacen}', 'EstatusalmacenController@update');
        Route::post('/d_estatusalm/{estatusalmacen}', 'EstatusalmacenController@destroy')->name('d_estatusalm');
    //endEstatusRefacciones

    //EstatusdDeLasRefacciones
        Route::get('l_estatusrefas', 'EstatusrefaccionesController@index')->name('l_estatusrefas');
        Route::get('i_estatusref', 'EstatusrefaccionesController@i_estatusref')->name('i_estatusref');
        Route::post('/i_estatusref', 'EstatusrefaccionesController@store');
        Route::get('/u_estatusref/{estatusrefacciones}', 'EstatusrefaccionesController@edit')->name('u_estatusref');
        Route::post('/u_estatusref/{estatusrefacciones}', 'EstatusrefaccionesController@update');
        Route::post('/d_estatusref/{estatusrefacciones}', 'EstatusrefaccionesController@destroy')->name('d_estatusref');
    //endEstatusdDeLasRefacciones

    //Personal
        Route::get('l_personal', 'PersonalController@index')->name('l_personal');
        Route::get('i_personal', 'PersonalController@select_area')->name('i_personal');
        Route::post('i_personal', 'PersonalController@store');
        Route::get('/u_personal/{personal}', 'PersonalController@edit')->name('u_personal');
        Route::post('/u_personal/{personal}', 'PersonalController@update');
        Route::post('/d_personal/{personal}', 'PersonalController@destroy')->name('d_personal');
    //endPersonal

    //TipoPago
        Route::get('l_tipopago', 'TipoPagoController@index')->name('l_tipopago');
        Route::get('i_tipopago', 'TipoPagoController@i_tipopago')->name('i_tipopago');
        Route::post('i_tipopago', 'TipoPagoController@store');
        Route::get('/u_tipopago/{tipo_pago}', 'TipoPagoController@edit')->name('u_tipopago');
        Route::post('/u_tipopago/{tipo_pago}', 'TipoPagoController@update');
        Route::post('/d_tipopago/{tipo_pago}', 'TipoPagoController@destroy')->name('d_tipopago');
    //endTipoPago

    //TipoServicio
        Route::get('l_tiposervicio', 'TipoServicioController@index')->name('l_tiposervicio');
        Route::get('i_tiposervicio', 'TipoServicioController@i_tiposervicio')->name('i_tiposervicio');
        Route::post('i_tiposervicio', 'TipoServicioController@store');
        Route::get('/u_tiposervicio/{tipo_servicio}', 'TipoServicioController@edit')->name('u_tiposervicio');
        Route::post('/u_tiposervicio/{tipo_servicio}', 'TipoServicioController@update');
        Route::post('/d_tiposervicio/{tipo_servicio}', 'TipoServicioController@destroy')->name('d_tiposervicio');
    //endTipoServicio

    //SiNo
        Route::get('l_sino', 'SiNoController@index')->name('l_sino');
        Route::get('i_sino', 'SiNoController@i_sino')->name('i_sino');
        Route::post('i_sino', 'SiNoController@store');
        Route::get('/u_sino/{si_no}', 'SiNoController@edit')->name('u_sino');
        Route::post('/u_sino/{si_no}', 'SiNoController@update');
        Route::post('/d_sino/{si_no}', 'SiNoController@destroy')->name('d_sino');
    //endSiNo

    //ConceptosPagos
        Route::get('l_conceptopago', 'ConceptosPagosController@index')->name('l_conceptopago');
        Route::get('i_conceptopago', 'ConceptosPagosController@i_conceptopago')->name('i_conceptopago');
        Route::post('i_conceptopago', 'ConceptosPagosController@store');
        Route::get('/u_conceptopago/{conceptos_pagos}', 'ConceptosPagosController@edit')->name('u_conceptopago');
        Route::post('/u_conceptopago/{conceptos_pagos}', 'ConceptosPagosController@update');
        Route::post('/d_conceptopago/{conceptos_pagos}', 'ConceptosPagosController@destroy')->name('d_conceptopago');
    //endConceptosPagos

    //FormaPago
        Route::get('l_formapago', 'FormaPagoController@index')->name('l_formapago');
        Route::get('i_formapago', 'FormaPagoController@i_formapago')->name('i_formapago');
        Route::post('i_formapago', 'FormaPagoController@store');
        Route::get('/u_formapago/{forma_pago}', 'FormaPagoController@edit')->name('u_formapago');
        Route::post('/u_formapago/{forma_pago}', 'FormaPagoController@update');
        Route::post('/d_formapago/{forma_pago}', 'FormaPagoController@destroy')->name('d_formapago');
    //endFormaPago

    //EstatusFacturas
        Route::get('l_estatusF', 'EstatusaseguradorasController@index')->name('l_estatusF');
        Route::get('i_estatusF', 'EstatusaseguradorasController@create')->name('i_estatusF');
        Route::post('i_estatusF', 'EstatusaseguradorasController@store');
        Route::get('/u_estatusF/{estatusaseguradoras}', 'EstatusaseguradorasController@edit')->name('u_estatusF');
        Route::post('/u_estatusF/{estatusaseguradoras}', 'EstatusaseguradorasController@update');
        Route::post('/d_estatusF/{estatusaseguradoras}', 'EstatusaseguradorasController@destroy')->name('d_estatusF');
    //endEstatusFacturas
//endCatalogos

//Costos
    //Gastos
        Route::get('l_gastos', 'GastosController@index')->name('l_gastos');
        Route::get('i_gastos', 'GastosController@create')->name('i_gastos');
        Route::get('/get_idV', 'VehiculoController@get_idV');
        Route::get('/existe_vehiculo_gastos', 'VehiculoController@existe_vehiculo_gastos');
        Route::post('i_gastos', 'GastosController@store');
        Route::get('/u_gastos/{gastos}', 'GastosController@edit')->name('u_gastos');
        Route::post('/u_gastos/{gastos}', 'GastosController@update');
        Route::post('/d_gastos/{gastos}', 'GastosController@destroy')->name('d_gastos');
        Route::get('/g_tipo_gasto_mes', 'GastosController@g_tipo_gasto_mes');
        Route::get('/h_gastos', 'GastosController@h_gastos')->name('h_gastos');
    //endGastos
//endCostos

//Ingresos
    //Facturas
        Route::get('l_facturas', 'FacturasController@index')->name('l_facturas');
        Route::get('i_facturas', 'FacturasController@create')->name('i_facturas');
        Route::post('i_facturas', 'FacturasController@store');
        Route::get('/u_facturas/{facturas}', 'FacturasController@edit')->name('u_facturas');
        Route::post('/u_facturas/{facturas}', 'FacturasController@update');
        Route::post('/d_facturas/{facturas}', 'FacturasController@destroy')->name('d_facturas');
    //endFacturas

    //Ingresos
        Route::get('l_ingresos', 'IngresosController@index')->name('l_ingresos');
        Route::get('i_ingresos', 'IngresosController@create')->name('i_ingresos');
        Route::post('i_ingresos', 'IngresosController@store');
        Route::get('/u_ingresos/{ingresos}', 'IngresosController@edit')->name('u_ingresos');
    //endIngresos
//endIngresos
    
//Auditorias
    //Limpieza
        Route::get('l_audlimpieza', 'AudLimpiezaController@index')->name('l_audlimpieza');
        Route::get('i_audlimpieza', 'AudLimpiezaController@i_audlimpieza')->name('i_audlimpieza');
        Route::post('i_audlimpieza', 'AudLimpiezaController@store')->name('i_audlimpieza');
        Route::get('/u_audlimpieza/{aud_limpieza}', 'AudLimpiezaController@edit')->name('u_audlimpieza');
        Route::post('/u_audlimpieza/{aud_limpieza}', 'AudLimpiezaController@update');
        Route::post('/d_audlimpieza/{aud_limpieza}', 'AudLimpiezaController@destroy')->name('d_audlimpieza');
    //endLimpieza    
//endAuditorias

//CatalogoServicios
    //Afinaciones
        Route::get('afinaciones', 'AudLimpiezaController@afinaciones')->name('afinaciones');
    //endAfinaciones

    //Frenos
        Route::get('frenos', 'AudLimpiezaController@frenos')->name('frenos');
    //endFrenos
//endCatalogoServicios