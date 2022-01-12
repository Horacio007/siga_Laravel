@extends('layouts.master')
@section('content')
<div class="container-fluid">
    <form action="/i_vehiculo" method="post" id="formdata">
        @csrf
        <div class="row">
            <div class="col text-center">
                <h3>Datos de Llegada</h3>
            </div>
        </div>
        <div class="row">
            <div class="col-md-4">
                <label for="ifecha">Fecha de Llegada</label>
                <input type="text" name="fecha" id="ifecha" class="form-control" readonly>
            </div>
            <div class="col-md-4">
                <label for="iexpediente">No. Expediente</label>
                <input type="text" name="expediente" id="iexpediente" class="form-control" required>       
            </div>
            <div class="col-md-4">
                <label for="iexpediente">No. Ultimo Expediente</label>
                <input type="text" id="iuexpediente" class="form-control" readonly>
            </div>
        </div>
        <br>
        <div class="row">
            <div class="col text-center">
                <h3>Datos del Cliente</h3>
            </div>
        </div>
        <div class="row">
            <div class="col-md-4">
                <label for="inombre">Nombre del Cliente</label>
                <input type="text" name="nombre" class="form-control" id="inombre" placeholder="Nombre" required>
            </div>
            <div class="col-md-4">
                <label for="itelefono">Numero de Telefono</label>
                <input type="tel" name="telefono" class="form-control" id="itel" placeholder="Telefono" pattern="[0-9]{10}" required>          
            </div>
            <div class="col-md-4">
                <label for="icorreo">Correo Electronico</label>
                <input type="email" name="correo" class="form-control" id="icorreo" placeholder="Correo" required>
            </div>
        </div>
        <br>
        <div class="row">
            <div class="col text-center">
                <h3>Datos del Vehículo</h3>
            </div>
        </div> 
        <div class="row">
            <div class="col-md-4">
                <label for="imarca">Marca</label>
                <select name="marca" id="sautos" class="form-control" required>

                </select>
            </div>
            <div class="col-md-4">
                <label for="isubmarca">Sub-marca</label>
                <select name="submarca" id="sautoslinea" class="form-control" required>
                    
                </select>
            </div>
            <div class="col-md-4">
                <label for="imodelo">Modelo</label>
                <input type="text" name="modelo" class="form-control" id="imodelo" placeholder="Modelo" required>
            </div>
        </div>
        <br>
        <div class="row">
            <div class="col-md-4">
                <label for="icolor">Color</label>
                <input type="text" name="color" class="form-control" id="icolor" placeholder="Color" required>            
            </div>
            <div class="col-md-4">
                <label for="iplacas">Placas</label>
                <input type="text" name="placas" class="form-control" id="iplacas" placeholder="Placas" required>
            </div>
            <div class="col-md-4">
                <label for="isiniestro">Siniestro</label>
                <input type="text" name="siniestro" class="form-control" id="isiniestro" placeholder="Siniestro" required>
            </div>
        </div>
        <br>
        <div class="row">
            <div class="col-md-4">
                <label for="iasesor">Asesor</label>
                <select name="asesor" id="sasesor" class="form-control" required>
                    
                </select>         
            </div>
            <div class="col-md-4">
                <label for="iaseguradora">Aseguradora</label>
                <select name="aseguradora" id="saseguradora" class="form-control" required>
                    
                </select>  
            </div>
            <div class="col-md-4">
                <label for="lestatus">Estatus</label>
                <select name="estatus" id="sestatus" class="form-control" required>
                    
                </select>  
            </div>
        </div>
        <br>
        <div class="row">
            <div class="col-md-4">
                <label for="">Nivel de daño</label>
                <select name="nivel" id="snivel" class="form-control" required>
                    
                </select>  
            </div>
            <div class="col-md-4">
                <label for="">Forma de arribo</label>
                <select name="arribo" id="sarribo" class="form-control" required>
                    
                </select> 
            </div>
            <div class="col-md-4">
                <label for=""></label>
                <button type="submit" class="btn btn-primary btn-lg btn-block" id="btn_registrar">Registrar</button>
            </div>
        </div>
        <br>
        <div id="d_ini" class="row">
            <div id="d_incial">
                <div class="col">
                    <label for="">Diagnostico Inicial</label>
                    <input type="text" class="form-control" name="diag_ini" required>
                </div>
            </div>
        </div>
    </form>
</div>
<script src="{{ asset('js/recepcion/vehiculo/vehiculo.js') }}"></script>
<script src="{{ asset('/libs/jsPDF/jspdf.debug.js') }}"></script>
@endsection