<?php

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

    //AltaChecklist
    Route::get('i_checklist', 'ChecklistController@i_checklist')->name('i_checklist');
    Route::get('e_chv', 'ChecklistController@exist_chv');
    Route::get('mlmca', 'VehiculoController@mlmca');
    Route::post('i_checklist', 'ChecklistController@store');
    Route::get('getClienteCh', 'ClientesController@getInfoClieteCheck');
    //endAltaChecklist

//endRecepcion

//Aministracion
    
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

    //Nivel_dano
    Route::get('l_niveldano', 'NivelDanoController@index')->name('lista_niveldano');
    Route::get('i_niveldano', 'NivelDanoController@i_niveldano')->name('i_niveldano');
    Route::post('/i_niveldano', 'NivelDanoController@store');
    Route::get('/u_niveldano/{nivel_dano}', 'NivelDanoController@edit')->name('u_niveldano');
    Route::post('/u_niveldano/{nivel_dano}', 'NivelDanoController@update');
    Route::post('/d_niveldano/{nivel_dano}', 'NivelDanoController@destroy')->name('d_niveldano');
    //endNivel_dano

    //Forma_aribo
    Route::get('l_formaarribo', 'FormaAriboController@index')->name('lista_formaarribo');
    Route::get('i_formaarribo', 'FormaAriboController@i_formaarribo')->name('i_formaarribo');
    Route::post('/i_formaarribo', 'FormaAriboController@store');
    Route::get('/u_formaarribo/{forma_aribo}', 'FormaAriboController@edit')->name('u_formaarribo');
    Route::post('/u_formaarribo/{forma_aribo}', 'FormaAriboController@update');
    Route::post('/d_formaarribo/{forma_aribo}', 'FormaAriboController@destroy')->name('d_formaarribo');
    //endForma_aribo
//endCatalogos

