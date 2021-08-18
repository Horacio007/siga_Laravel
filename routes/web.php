<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Artisan;

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
    return view('auth.login');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

require __DIR__.'/auth.php';
/*
//Artisan
    //Migrate
        Route::get('migrate', function() {
            Artisan::call('migrate');
        })->middleware('auth');
    //endMigrate

    //Seed
        Route::get('seed', function() {
            Artisan::call('db:seed');
        })->middleware('auth');
    //endSeed
//endArtisan
*/

//Menu
    //Menu
        Route::get('menu', 'LoginController@menu')->name('menu')->middleware('auth');
    //endMenu
//endMenu

//Recepcion
    //AltaVehiculo
        Route::get('i_vehiculo', 'VehiculoController@i_vehiculo')->name('i_vehiculos')->middleware('auth');
        Route::get('ultimo_vehiculo', 'VehiculoController@ultimo_vehiculo')->middleware('auth');
        Route::get('ultimo_vehiculo_nuevo', 'VehiculoController@ultimo_vehiculo_nuevo')->middleware('auth');
        Route::get('listado_marcas', 'ModelosvController@listado_marcas')->middleware('auth');
        Route::post('listado_submarcas', 'SubmarcavController@listado_submarcas')->middleware('auth');
        Route::get('listado_asesores', 'AsesoresController@listado_asesores')->middleware('auth');
        Route::get('listado_aseguradoras', 'AseguradorasController@listado_aseguradoras')->middleware('auth');
        Route::get('listado_estatus', 'EstatusController@listado_estatus')->middleware('auth');
        Route::get('listado_niveldano', 'NivelDanoController@listado_niveldano')->middleware('auth');
        Route::get('listado_formaarribo', 'FormaAriboController@listado_formaarribo')->middleware('auth');
        Route::post('/i_vehiculo', 'VehiculoController@store')->middleware('auth');
    //endAltaVehiculo

    //Checklist
        Route::get('i_checklist', 'ChecklistController@i_checklist')->name('i_checklist')->middleware('auth')->middleware('auth');
        Route::get('l_checklist', 'ChecklistController@index')->name('l_checklist')->middleware('auth')->middleware('auth');
        Route::get('e_chv', 'ChecklistController@exist_chv')->middleware('auth');
        Route::get('mlmca', 'VehiculoController@mlmca')->middleware('auth');
        Route::post('i_checklist', 'ChecklistController@store')->middleware('auth');
        Route::get('getClienteCh', 'ClientesController@getInfoClieteCheck')->middleware('auth');
        Route::get('create_pdf/{exp}', 'ChecklistController@create_pdf')->name('create_pdf')->middleware('auth')->middleware('auth');
        Route::post('/d_checklist/{checklist}', 'ChecklistController@destroy')->name('d_checklist')->middleware('auth')->middleware('auth');
    //endChecklist

    //AltaEvidenciaRecepcion
        Route::get('i_evidenciaR', 'ArchivosController@i_evidenciaR')->name('upload_evidenciar')->middleware('auth')->middleware('auth');
        Route::post('upload_evidenciar', 'ArchivosController@upload_evidenciaR')->middleware('auth');
    //endAltaEvidenciaRecepcion
//endRecepcion

//Costeo
    //Presupuesto
        Route::get('l_presupuestos', 'PresupuestosController@index')->name('l_presupuestos')->middleware('auth');
        Route::get('i_presupuesto', 'PresupuestosController@i_presupuesto')->name('i_presupuesto')->middleware('auth');
        Route::get('e_pres', 'PresupuestosController@exist_pres')->middleware('auth');
        Route::post('i_presupuesto', 'PresupuestosController@store')->middleware('auth');
        Route::get('/u_presupuesto/{presupuestos}', 'PresupuestosController@edit')->name('u_presupuesto')->middleware('auth');
        Route::post('/u_presupuesto/{presupuestos}', 'PresupuestosController@update')->middleware('auth');
        Route::get('create_pdfp/{exp}', 'PresupuestosController@create_pdfp')->name('create_pdfp')->middleware('auth');
        Route::post('/d_presupuesto/{presupuestos}', 'PresupuestosController@destroy')->name('d_presupuesto')->middleware('auth');
    //endPresupuesto

    //AltaEvidenciaPresupuesto
        Route::get('i_evidenciaP', 'ArchivosController@i_evidenciaP')->name('upload_evidenciap')->middleware('auth')->middleware('auth');
        Route::post('upload_evidenciap', 'ArchivosController@upload_evidenciaP')->middleware('auth');
    //endAltaEvidenciaPresupuesto
//endCosteo

//Compras
    //CotizarRefacciones
        Route::get('l_compras', 'CostrefaccionesController@index')->name('l_compras')->middleware('auth')->middleware('auth');
        Route::get('i_cotizacion', 'CostrefaccionesController@i_cotizacion')->name('i_cotizacion')->middleware('auth')->middleware('auth');
        Route::get('e_cost', 'CostrefaccionesController@exist_cost')->middleware('auth');
        Route::post('i_cotizacion', 'CostrefaccionesController@store')->middleware('auth');
        Route::get('create_pdfcot/{exp}', 'CostrefaccionesController@create_pdfcot')->name('create_pdfcot')->middleware('auth')->middleware('auth');
        Route::post('/d_costrefacciones/{costrefacciones}', 'CostrefaccionesController@destroy')->name('d_costrefacciones')->middleware('auth')->middleware('auth');
    //endCotizarRefacciones

    //AltaEvidenciaCotizarRefacciones
        Route::get('i_evidenciaCom', 'ArchivosController@i_evidenciaCom')->name('upload_evidenciacom')->middleware('auth')->middleware('auth');
        Route::post('upload_evidenciacom', 'ArchivosController@upload_evidenciaCom')->middleware('auth');
    //endAltaEvidenciaCotizarRefacciones
//endCompras

//Refacciones
    //AltaActualizarProv
        Route::get('l_refacciones', 'AlmacenController@index')->name('l_refacciones')->middleware('auth')->middleware('auth');
        Route::get('i_refaccion', 'AlmacenController@i_refaccion')->name('i_refaccion')->middleware('auth')->middleware('auth');
        Route::get('e_ve', 'AlmacenController@e_ve')->middleware('auth');
        Route::post('i_refaccion', 'AlmacenController@store')->middleware('auth');
        Route::get('/u_refaccion/{almacen}', 'AlmacenController@edit')->name('u_refaccion')->middleware('auth')->middleware('auth');
        Route::post('/u_refaccion/{almacen}', 'AlmacenController@update')->middleware('auth');
        Route::post('/d_refaccion/{almacen}', 'AlmacenController@destroy')->name('d_refaccion')->middleware('auth')->middleware('auth');
        Route::get('/b_refaccion/{almacen}', 'AlmacenController@baja_edit')->name('b_refaccion')->middleware('auth')->middleware('auth');
        Route::post('/b_refaccion/{almacen}', 'AlmacenController@baja_update')->middleware('auth');
    //endltaActualizarProv

    //SeguimientoRefaccionesRecepcionRefacciones
        Route::get('l_segrefacciones', 'AlmacenController@index2')->name('l_segrefacciones')->middleware('auth')->middleware('auth');
        Route::get('/u_segrefaccion/{almacen}', 'AlmacenController@edit2')->name('u_segrefaccion')->middleware('auth')->middleware('auth');
        Route::post('/u_segrefaccion/{almacen}', 'AlmacenController@u_segrefaccion')->name('u_segrefaccion')->middleware('auth')->middleware('auth');
        Route::post('/u_segrefaccion/{almacen}', 'AlmacenController@update2')->middleware('auth');
        Route::post('/d_segrefaccion/{almacen}', 'AlmacenController@destroy2')->name('d_segrefaccion')->middleware('auth')->middleware('auth');
    //SeguimientoRefaccionesRecepcionRefacciones

    //RefaccionesEntregadas
        Route::get('l_entregdasrefacciones', 'AlmacenController@index3')->name('l_entregdasrefacciones')->middleware('auth')->middleware('auth');
    //endRefaccionesEntregadas

    //Codigos
        Route::get('l_codigos', 'CodigosController@index')->name('l_codigos')->middleware('auth')->middleware('auth');
    //endCodigos
//endRefacciones

//Taller
    //OrdeneTrabajo
        Route::get('l_ordenest', 'OrdenTrabajoController@index')->name('l_ordenest')->middleware('auth')->middleware('auth');
        Route::get('i_ordenest', 'OrdenTrabajoController@i_ordenest')->name('i_ordenest')->middleware('auth')->middleware('auth');
        Route::post('i_ordenest', 'OrdenTrabajoController@store')->middleware('auth');
        Route::get('create_pdfot/{exp}', 'OrdenTrabajoController@create_pdfot')->name('create_pdfot')->middleware('auth')->middleware('auth');
        Route::post('/d_ordenest/{orden_trabajo}', 'OrdenTrabajoController@destroy')->name('d_ordenest')->middleware('auth')->middleware('auth');
    //endOrdeneTrabajo

    //OrdenMecanica
        Route::get('l_ordenesm', 'OrdenMecanicaController@index')->name('l_ordenesm')->middleware('auth')->middleware('auth');
        Route::get('i_ordenesm', 'OrdenMecanicaController@i_ordenesm')->name('i_ordenesm')->middleware('auth')->middleware('auth');
        Route::post('i_ordenesm', 'OrdenMecanicaController@store')->middleware('auth');
        Route::get('create_pdfom/{exp}', 'OrdenMecanicaController@create_pdfom')->name('create_pdfom')->middleware('auth')->middleware('auth');
        Route::post('/d_ordenesm/{orden_mecanica}', 'OrdenMecanicaController@destroy')->name('d_ordenesm')->middleware('auth')->middleware('auth');
    //endOrdenMecanica

    //OrdenRetrabajo
        Route::get('l_ordenesrt', 'OrdenRetrabajoController@index')->name('l_ordenesrt')->middleware('auth')->middleware('auth');
        Route::get('i_ordenesrt', 'OrdenRetrabajoController@i_ordenesrt')->name('i_ordenesrt')->middleware('auth')->middleware('auth');
        Route::post('i_ordenesrt', 'OrdenRetrabajoController@store')->middleware('auth');
        Route::get('create_pdfort/{exp}', 'OrdenRetrabajoController@create_pdfort')->name('create_pdfort')->middleware('auth')->middleware('auth');
        Route::post('/d_ordenesrt/{orden_retrabajo}', 'OrdenRetrabajoController@destroy')->name('d_ordenesrt')->middleware('auth')->middleware('auth');
    //endOrdenRetrabajo
//endTaller

//Entrega
    //Clientes
        Route::get('l_clientes', 'ClientesController@index')->name('l_clientes')->middleware('auth')->middleware('auth');
    //endClientes

    //Documentacion
        Route::get('l_docs', 'VehiculoController@indexDocs')->name('l_docs')->middleware('auth')->middleware('auth');
        Route::get('create_pdfentrega/{exp}', 'VehiculoController@create_pdfentrega')->name('create_pdfentrega')->middleware('auth')->middleware('auth');
    //endDocumentacion

    //CambiarEstatus
        Route::get('l_cambiarEstatus', 'VehiculoController@index_entrega_estatus_vehiculo')->name('l_cambiarEstatus')->middleware('auth')->middleware('auth');
        Route::get('/u_cambiarEstatus/{vehiculo}', 'VehiculoController@u_cambiarEstatus')->name('u_cambiarEstatus')->middleware('auth')->middleware('auth');
        Route::post('/u_cambiarEstatus/{vehiculo}', 'VehiculoController@update_cambiarEstatus')->middleware('auth');
    //endCambiarEstatus

    //ISC
        Route::get('l_ics', 'IscController@index')->name('l_ics')->middleware('auth')->middleware('auth');
        Route::get('i_ics', 'IscController@i_ics')->name('i_ics')->middleware('auth')->middleware('auth');
        Route::post('i_ics', 'IscController@store')->middleware('auth');
        Route::post('/d_ics/{isc}', 'IscController@destroy')->name('d_ics')->middleware('auth')->middleware('auth');
    //endISC

    //EntregaSubirArchivos
        Route::get('i_evidenciaE', 'ArchivosController@i_evidenciaE')->name('upload_evidenciae')->middleware('auth')->middleware('auth');
        Route::post('upload_evidenciae', 'ArchivosController@upload_evidenciae')->middleware('auth');
    //endEntregaSubirArchivos
//endEntrega

//Aministracion
    //VerArchivos
        Route::get('l_archivos', 'ArchivosController@index')->name('l_archivos')->middleware('auth')->middleware('auth');
        Route::get('see_archivos/{exp}', 'ArchivosController@verArchivos')->name('see_archivos')->middleware('auth')->middleware('auth');
        Route::post('/d_archivos/{archivos}', 'ArchivosController@destroy')->name('d_archivos')->middleware('auth')->middleware('auth');
    //endVerArchivos

    //Valuaciones
        Route::get('l_valuaciones', 'VehiculoController@indexV')->name('l_valuaciones')->middleware('auth')->middleware('auth');
        Route::get('/u_valuaciones/{vehiculo}', 'VehiculoController@u_valuaciones')->name('u_valuaciones')->middleware('auth')->middleware('auth');
        Route::post('/u_valuaciones/{vehiculo}', 'VehiculoController@update_valuaciones')->middleware('auth');
    //endValuaciones

    //RefaccionesAdmon
        Route::get('l_Brefacciones', 'VehiculoController@indexR')->name('l_Brefacciones')->middleware('auth');
        Route::get('/u_Brefacciones/{vehiculo}', 'VehiculoController@u_refaccionesAdmon')->name('u_Brefacciones')->middleware('auth');
        Route::post('/u_Brefacciones/{vehiculo}', 'VehiculoController@update_Brefacciones')->middleware('auth');
    //endRefaccionesAdmon

    //AsignacionPersonal
        Route::get('l_asignacionPersonal', 'VehiculoController@indexAP')->name('l_asignacionPersonal')->middleware('auth');
        Route::get('i_asignacionPersonal/{vehiculo}', 'VehiculoController@i_asignacionPersonal')->name('i_asignacionPersonal')->middleware('auth');
        Route::post('i_asignacionPersonal/{vehiculo}', 'VehiculoController@insert_asignacionPersonal')->middleware('auth');
        Route::get('/u_asignacionPersonal/{vehiculo}', 'VehiculoController@u_asignacionPersonal')->name('u_asignacionPersonal')->middleware('auth');
        Route::post('/u_asignacionPersonal/{vehiculo}', 'VehiculoController@update_asignacionPersonal')->middleware('auth');
    //endAsignacionPersonal

    //ProcesoAdministrativo
        Route::get('l_procesoAdministrativo', 'VehiculoController@indexPA')->name('l_procesoAdministrativo')->middleware('auth');
        Route::get('/u_valuacionesPA/{vehiculo}', 'VehiculoController@u_valuacionesPA')->name('u_valuacionesPA')->middleware('auth');
        Route::post('/u_valuacionesPA/{vehiculo}', 'VehiculoController@update_valuacionesPA')->middleware('auth');
        Route::get('/u_BrefaccionesPA/{vehiculo}', 'VehiculoController@u_refaccionesAdmonPA')->name('u_BrefaccionesPA')->middleware('auth');
        Route::post('/u_BrefaccionesPA/{vehiculo}', 'VehiculoController@update_BrefaccionesPA')->middleware('auth');
    //endProcesoAdministrativo

    //ProcesoTaller
        Route::get('l_procesoTaller', 'VehiculoController@indexPT')->name('l_procesoTaller')->middleware('auth');
        Route::get('/u_asignacionPersonalPT/{vehiculo}', 'VehiculoController@u_asignacionPersonalPT')->name('u_asignacionPersonalPT')->middleware('auth');
        Route::post('/u_asignacionPersonalPT/{vehiculo}', 'VehiculoController@update_asignacionPersonalPT')->middleware('auth');
    //endProcesoTaller

    //Monitor
        Route::get('monitor', 'VehiculoController@monitor')->name('monitor')->middleware('auth');
    //endMonitor

    //Metricos
        Route::get('metricos', 'VehiculoController@indexMetricos')->name('metricos')->middleware('auth');
        Route::get('g_ventregados', 'VehiculoController@g_ventregados')->middleware('auth');
        Route::get('g_vrecibidos', 'VehiculoController@g_vrecibidos')->middleware('auth');
        Route::get('g_ventregadosselect', 'VehiculoController@g_ventregadosselect')->middleware('auth');
        Route::get('g_vrecibidosselect', 'VehiculoController@g_vrecibidosselect')->middleware('auth');
        Route::get('g_diesentregados', 'VehiculoController@g_diesentregados')->middleware('auth');
        Route::get('g_diesrecibidos', 'VehiculoController@g_diesrecibidos')->middleware('auth');
        Route::get('g_isccu', 'IscController@g_isccu')->middleware('auth');
        Route::get('g_isccutotal', 'IscController@g_isccutotal')->middleware('auth');
        Route::get('g_aud_limpieza', 'AudLimpiezaController@g_aud_limpieza')->middleware('auth');
        Route::get('g_aud_limpieza_actual', 'AudLimpiezaController@g_aud_limpieza_actual')->middleware('auth');
        Route::get('g_aud_limpieza_encargado', 'AudLimpiezaController@g_aud_limpieza_encargado')->middleware('auth');
        Route::get('g_aud_limpieza_actual_personal', 'AudLimpiezaController@g_aud_limpieza_actual_personal')->middleware('auth');
    //endMetricos
//endAdministracion

//Catalogos
    //Marca
        Route::get('l_marcas', 'ModelosvController@index')->name('lista_marcas')->middleware('auth');
        Route::get('i_marca', 'ModelosvController@i_marca')->name('i_marcas')->middleware('auth');
        Route::post('/i_marca', 'ModelosvController@store')->middleware('auth');
        Route::get('/u_marca/{modelosv}', 'ModelosvController@edit')->name('u_marca')->middleware('auth');
        Route::post('/u_marca/{modelosv}', 'ModelosvController@update')->middleware('auth');
        Route::post('/d_marca/{modelosv}', 'ModelosvController@destroy')->name('d_marca')->middleware('auth');
    //endMarca

    //SubMarca
        Route::get('l_submarcas', 'SubmarcavController@index')->name('lista_submarcas')->middleware('auth');
        Route::get('i_submarca', 'SubmarcavController@select_marca')->name('i_submarca')->middleware('auth');
        Route::post('/i_submarca', 'SubmarcavController@store')->middleware('auth');
        Route::get('/u_submarca/{submarcav}', 'SubmarcavController@edit')->name('u_submarca')->middleware('auth');
        Route::post('/u_submarca/{submarcav}', 'SubmarcavController@update')->middleware('auth');
        Route::post('/d_submarca/{submarcav}', 'SubmarcavController@destroy')->name('d_submarca')->middleware('auth');
    //endSubMarca

    //Area
        Route::get('l_areas', 'AreasController@index')->name('lista_areas')->middleware('auth');
        Route::get('i_area', 'AreasController@i_area')->name('i_area')->middleware('auth');
        Route::post('/i_area', 'AreasController@store')->middleware('auth');
        Route::get('/u_area/{areas}', 'AreasController@edit')->name('u_area')->middleware('auth');
        Route::post('/u_area/{areas}', 'AreasController@update')->middleware('auth');
        Route::post('/d_area/{areas}', 'AreasController@destroy')->name('d_area')->middleware('auth');
    //endArea

    //Aseguradora
        Route::get('l_aseguradoras', 'AseguradorasController@index')->name('lista_aseguradoras')->middleware('auth');
        Route::get('i_aseguradora', 'AseguradorasController@i_aseguradora')->name('i_aseguradora')->middleware('auth');
        Route::post('/i_aseguradora', 'AseguradorasController@store')->middleware('auth');
        Route::get('/u_aseguradora/{aseguradoras}', 'AseguradorasController@edit')->name('u_aseguradora')->middleware('auth');
        Route::post('/u_aseguradora/{aseguradoras}', 'AseguradorasController@update')->middleware('auth');
        Route::post('/d_aseguradora/{aseguradoras}', 'AseguradorasController@destroy')->name('d_aseguradora')->middleware('auth');
    //endAseguradora

    //Asesores
        Route::get('l_asesores', 'AsesoresController@index')->name('lista_asesores')->middleware('auth');
        Route::get('i_asesor', 'AsesoresController@select_aseguradora')->name('i_asesor')->middleware('auth');
        Route::post('/i_asesor', 'AsesoresController@store')->middleware('auth');
        Route::get('/u_asesor/{asesores}', 'AsesoresController@edit')->name('u_asesor')->middleware('auth');
        Route::post('/u_asesor/{asesores}', 'AsesoresController@update')->middleware('auth');
        Route::post('/d_asesor/{asesores}', 'AsesoresController@destroy')->name('d_asesor')->middleware('auth');
    //endAsesores

    //Estatus
        Route::get('l_estatus', 'EstatusController@index')->name('lista_estatus')->middleware('auth');
        Route::get('i_estatus', 'EstatusController@i_estatus')->name('i_estatus')->middleware('auth');
        Route::post('/i_estatus', 'EstatusController@store')->middleware('auth');
        Route::get('/u_estatus/{estatus}', 'EstatusController@edit')->name('u_estatus')->middleware('auth');
        Route::post('/u_estatus/{estatus}', 'EstatusController@update')->middleware('auth');
        Route::post('/d_estatus/{estatus}', 'EstatusController@destroy')->name('d_estatus')->middleware('auth');
    //endEstatus

    //NivelDano
        Route::get('l_niveldano', 'NivelDanoController@index')->name('lista_niveldano')->middleware('auth');
        Route::get('i_niveldano', 'NivelDanoController@i_niveldano')->name('i_niveldano')->middleware('auth');
        Route::post('/i_niveldano', 'NivelDanoController@store')->middleware('auth');
        Route::get('/u_niveldano/{nivel_dano}', 'NivelDanoController@edit')->name('u_niveldano')->middleware('auth');
        Route::post('/u_niveldano/{nivel_dano}', 'NivelDanoController@update')->middleware('auth');
        Route::post('/d_niveldano/{nivel_dano}', 'NivelDanoController@destroy')->name('d_niveldano')->middleware('auth');
    //endNivelDano

    //FormaAribo
        Route::get('l_formaarribo', 'FormaAriboController@index')->name('lista_formaarribo')->middleware('auth');
        Route::get('i_formaarribo', 'FormaAriboController@i_formaarribo')->name('i_formaarribo')->middleware('auth');
        Route::post('/i_formaarribo', 'FormaAriboController@store')->middleware('auth');
        Route::get('/u_formaarribo/{forma_aribo}', 'FormaAriboController@edit')->name('u_formaarribo')->middleware('auth');
        Route::post('/u_formaarribo/{forma_aribo}', 'FormaAriboController@update')->middleware('auth');
        Route::post('/d_formaarribo/{forma_aribo}', 'FormaAriboController@destroy')->name('d_formaarribo')->middleware('auth');
    //endFormaAribo

    //EstatusRefacciones
        Route::get('l_estatusalm', 'EstatusalmacenController@index')->name('lista_estatusalm')->middleware('auth');
        Route::get('i_estatusalm', 'EstatusalmacenController@i_estatusalm')->name('i_estatusalm')->middleware('auth');
        Route::post('/i_estatusalm', 'EstatusalmacenController@store')->middleware('auth');
        Route::get('/u_estatusalm/{estatusalmacen}', 'EstatusalmacenController@edit')->name('u_estatusalm')->middleware('auth');
        Route::post('/u_estatusalm/{estatusalmacen}', 'EstatusalmacenController@update')->middleware('auth');
        Route::post('/d_estatusalm/{estatusalmacen}', 'EstatusalmacenController@destroy')->name('d_estatusalm')->middleware('auth');
    //endEstatusRefacciones

    //EstatusdDeLasRefacciones
        Route::get('l_estatusrefas', 'EstatusrefaccionesController@index')->name('l_estatusrefas')->middleware('auth');
        Route::get('i_estatusref', 'EstatusrefaccionesController@i_estatusref')->name('i_estatusref')->middleware('auth');
        Route::post('/i_estatusref', 'EstatusrefaccionesController@store')->middleware('auth');
        Route::get('/u_estatusref/{estatusrefacciones}', 'EstatusrefaccionesController@edit')->name('u_estatusref')->middleware('auth');
        Route::post('/u_estatusref/{estatusrefacciones}', 'EstatusrefaccionesController@update')->middleware('auth');
        Route::post('/d_estatusref/{estatusrefacciones}', 'EstatusrefaccionesController@destroy')->name('d_estatusref')->middleware('auth');
    //endEstatusdDeLasRefacciones

    //Personal
        Route::get('l_personal', 'PersonalController@index')->name('l_personal')->middleware('auth');
        Route::get('i_personal', 'PersonalController@select_area')->name('i_personal')->middleware('auth');
        Route::post('i_personal', 'PersonalController@store')->middleware('auth');
        Route::get('/u_personal/{personal}', 'PersonalController@edit')->name('u_personal')->middleware('auth');
        Route::post('/u_personal/{personal}', 'PersonalController@update')->middleware('auth');
        Route::post('/d_personal/{personal}', 'PersonalController@destroy')->name('d_personal')->middleware('auth');
    //endPersonal

    //TipoPago
        Route::get('l_tipopago', 'TipoPagoController@index')->name('l_tipopago')->middleware('auth');
        Route::get('i_tipopago', 'TipoPagoController@i_tipopago')->name('i_tipopago')->middleware('auth');
        Route::post('i_tipopago', 'TipoPagoController@store')->middleware('auth');
        Route::get('/u_tipopago/{tipo_pago}', 'TipoPagoController@edit')->name('u_tipopago')->middleware('auth');
        Route::post('/u_tipopago/{tipo_pago}', 'TipoPagoController@update')->middleware('auth');
        Route::post('/d_tipopago/{tipo_pago}', 'TipoPagoController@destroy')->name('d_tipopago')->middleware('auth');
    //endTipoPago

    //TipoServicio
        Route::get('l_tiposervicio', 'TipoServicioController@index')->name('l_tiposervicio')->middleware('auth');
        Route::get('i_tiposervicio', 'TipoServicioController@i_tiposervicio')->name('i_tiposervicio')->middleware('auth');
        Route::post('i_tiposervicio', 'TipoServicioController@store')->middleware('auth');
        Route::get('/u_tiposervicio/{tipo_servicio}', 'TipoServicioController@edit')->name('u_tiposervicio')->middleware('auth');
        Route::post('/u_tiposervicio/{tipo_servicio}', 'TipoServicioController@update')->middleware('auth');
        Route::post('/d_tiposervicio/{tipo_servicio}', 'TipoServicioController@destroy')->name('d_tiposervicio')->middleware('auth');
    //endTipoServicio

    //SiNo
        Route::get('l_sino', 'SiNoController@index')->name('l_sino')->middleware('auth');
        Route::get('i_sino', 'SiNoController@i_sino')->name('i_sino')->middleware('auth');
        Route::post('i_sino', 'SiNoController@store')->middleware('auth');
        Route::get('/u_sino/{si_no}', 'SiNoController@edit')->name('u_sino')->middleware('auth');
        Route::post('/u_sino/{si_no}', 'SiNoController@update')->middleware('auth');
        Route::post('/d_sino/{si_no}', 'SiNoController@destroy')->name('d_sino')->middleware('auth');
    //endSiNo

    //ConceptosPagos
        Route::get('l_conceptopago', 'ConceptosPagosController@index')->name('l_conceptopago')->middleware('auth');
        Route::get('i_conceptopago', 'ConceptosPagosController@i_conceptopago')->name('i_conceptopago')->middleware('auth');
        Route::post('i_conceptopago', 'ConceptosPagosController@store')->middleware('auth');
        Route::get('/u_conceptopago/{conceptos_pagos}', 'ConceptosPagosController@edit')->name('u_conceptopago')->middleware('auth');
        Route::post('/u_conceptopago/{conceptos_pagos}', 'ConceptosPagosController@update')->middleware('auth');
        Route::post('/d_conceptopago/{conceptos_pagos}', 'ConceptosPagosController@destroy')->name('d_conceptopago')->middleware('auth');
    //endConceptosPagos

    //FormaPago
        Route::get('l_formapago', 'FormaPagoController@index')->name('l_formapago')->middleware('auth');
        Route::get('i_formapago', 'FormaPagoController@i_formapago')->name('i_formapago')->middleware('auth');
        Route::post('i_formapago', 'FormaPagoController@store')->middleware('auth');
        Route::get('/u_formapago/{forma_pago}', 'FormaPagoController@edit')->name('u_formapago')->middleware('auth');
        Route::post('/u_formapago/{forma_pago}', 'FormaPagoController@update')->middleware('auth');
        Route::post('/d_formapago/{forma_pago}', 'FormaPagoController@destroy')->name('d_formapago')->middleware('auth');
    //endFormaPago

    //EstatusFacturas
        Route::get('l_estatusF', 'EstatusaseguradorasController@index')->name('l_estatusF')->middleware('auth');
        Route::get('i_estatusF', 'EstatusaseguradorasController@create')->name('i_estatusF')->middleware('auth');
        Route::post('i_estatusF', 'EstatusaseguradorasController@store')->middleware('auth');
        Route::get('/u_estatusF/{estatusaseguradoras}', 'EstatusaseguradorasController@edit')->name('u_estatusF')->middleware('auth');
        Route::post('/u_estatusF/{estatusaseguradoras}', 'EstatusaseguradorasController@update')->middleware('auth');
        Route::post('/d_estatusF/{estatusaseguradoras}', 'EstatusaseguradorasController@destroy')->name('d_estatusF')->middleware('auth');
    //endEstatusFacturas

    //Usuarios
        /*
        Route::get('l_usuarios', 'UsuariosController@index')->name('l_usuarios')->middleware('auth');
        Route::get('i_usuarios', 'UsuariosController@create')->name('i_usuarios')->middleware('auth');
        */
    //endUsuarios
//endCatalogos

//Costos
    //Gastos
        Route::get('l_gastos', 'GastosController@index')->name('l_gastos')->middleware('auth');
        Route::get('i_gastos', 'GastosController@create')->name('i_gastos')->middleware('auth');
        Route::get('/get_idV', 'VehiculoController@get_idV')->middleware('auth');
        Route::get('/existe_vehiculo_gastos', 'VehiculoController@existe_vehiculo_gastos')->middleware('auth');
        Route::post('i_gastos', 'GastosController@store')->middleware('auth');
        Route::get('/u_gastos/{gastos}', 'GastosController@edit')->name('u_gastos')->middleware('auth');
        Route::post('/u_gastos/{gastos}', 'GastosController@update')->middleware('auth');
        Route::post('/d_gastos/{gastos}', 'GastosController@destroy')->name('d_gastos')->middleware('auth');
        Route::get('/g_tipo_gasto_mes', 'GastosController@g_tipo_gasto_mes')->middleware('auth');
        Route::get('/h_gastos', 'GastosController@h_gastos')->name('h_gastos')->middleware('auth');
    //endGastos
//endCostos

//Ingresos
    //ReciboPagos
        Route::get('l_recibo_pagos', 'ReciboPagosController@index')->name('l_recibo_pagos')->middleware('auth');
        Route::get('i_recibo_pagos', 'ReciboPagosController@create')->name('i_recibo_pagos')->middleware('auth');
        Route::post('i_recibo_pagos', 'ReciboPagosController@store')->middleware('auth');
        Route::get('/u_recibo_pagos/{recibo_pagos}', 'ReciboPagosController@edit')->name('u_recibo_pagos')->middleware('auth');
        Route::post('/u_recibo_pagos/{recibo_pagos}', 'ReciboPagosController@update')->middleware('auth');
        Route::get('create_pdfRP/{recibo_pagos}', 'ReciboPagosController@show')->name('create_pdfRP')->middleware('auth');
        Route::post('/d_recibo_pagos/{recibo_pagos}', 'ReciboPagosController@destroy')->name('d_recibo_pagos')->middleware('auth');
    //endReciboPagos
    
    //Facturas
        Route::get('l_facturas', 'FacturasController@index')->name('l_facturas')->middleware('auth');
        Route::get('i_facturas', 'FacturasController@create')->name('i_facturas')->middleware('auth');
        Route::post('i_facturas', 'FacturasController@store')->middleware('auth');
        Route::get('/u_facturas/{facturas}', 'FacturasController@edit')->name('u_facturas')->middleware('auth');
        Route::post('/u_facturas/{facturas}', 'FacturasController@update')->middleware('auth');
        Route::post('/d_facturas/{facturas}', 'FacturasController@destroy')->name('d_facturas')->middleware('auth');
    //endFacturas

    //Ingresos
        /*
        Route::get('l_ingresos', 'IngresosController@index')->name('l_ingresos')->middleware('auth');
        Route::get('i_ingresos', 'IngresosController@create')->name('i_ingresos')->middleware('auth');
        Route::post('i_ingresos', 'IngresosController@store')->middleware('auth');
        Route::get('/u_ingresos/{ingresos}', 'IngresosController@edit')->name('u_ingresos')->middleware('auth');
        */
    //endIngresos
//endIngresos

//Auditorias
    //Limpieza
        Route::get('l_audlimpieza', 'AudLimpiezaController@index')->name('l_audlimpieza')->middleware('auth');
        Route::get('i_audlimpieza', 'AudLimpiezaController@i_audlimpieza')->name('i_audlimpieza')->middleware('auth');
        Route::post('i_audlimpieza', 'AudLimpiezaController@store')->name('i_audlimpieza')->middleware('auth');
        Route::get('/u_audlimpieza/{aud_limpieza}', 'AudLimpiezaController@edit')->name('u_audlimpieza')->middleware('auth');
        Route::post('/u_audlimpieza/{aud_limpieza}', 'AudLimpiezaController@update')->middleware('auth');
        Route::post('/d_audlimpieza/{aud_limpieza}', 'AudLimpiezaController@destroy')->name('d_audlimpieza')->middleware('auth');
    //endLimpieza    
//endAuditorias

//CatalogoServicios
    //Afinaciones
        Route::get('afinaciones', 'AudLimpiezaController@afinaciones')->name('afinaciones')->middleware('auth');
    //endAfinaciones

    //Frenos
        Route::get('frenos', 'AudLimpiezaController@frenos')->name('frenos')->middleware('auth');
    //endFrenos
//endCatalogoServicios