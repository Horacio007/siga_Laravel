@extends('layouts.masterLogin')
@section('content')
<style>
    input { 
        font-family: FontAwesome;
        font-style: normal;
        font-weight: normal;
        text-decoration: inherit;
    }

    #btnlogin {
        cursor:pointer; 
        cursor: hand;
    }
</style>
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet"/>
<div class="container-fluid">
    <form action="{{ route('vl') }}" id="formdata">
        @csrf
        <div class="row">
            <div class="col text-center">
            <img src="/img/dtrlogoblanco.jpg" alt="logo no cargado" id="logodtr">
            </div> 
        </div>
        <div class="row">
            <div class="col-md-4"></div>
            <div class="col-md-4 text-center">
                <input type="text" class="form-control" name="usr" id="usr" placeholder="&#xF007; Usuario" required>
            </div>
            <div class="col-md-4"></div>
        </div>
        <br>
        <div class="row">
            <div class="col-md-4"></div>
            <div class="col-md-4 text-center">
                <input type="password" class="form-control" name="pwd" id="usr" placeholder="&#xF09C; Contraseña" required>
            </div>
            <div class="col-md-4"></div>
        </div>
        <br>
        <div class="row">
            <div class="col-md-4"></div>
            <div class="col-md-4 text-center">
                <button type="submit" class="btn btn-primary btn-lg btn-block" id="btn_login">Entrar</button>
            </div>
            <div class="col-md-4"></div>
        </div>
    </form>
</div>

<script src="https://www.google.com/recaptcha/api.js" async defer></script>
@endsection