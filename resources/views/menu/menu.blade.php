@extends('layouts.master')
@section('content')
<style>
    #hbienvenidos{
        color: coral;
        display: flex;
        justify-content: center;
        align-items: center;
        margin-top: 15%;
    }
</style>
<div class= "container-fluid">
        <div class = "row">
          <div class ="col text-center">
            <h1 id ="hbienvenidos">Bienvenido al Sistema Integral de Gestión Automotriz</h1>
            <h1 id ="hbienvenidos">Usuario: {{ucfirst(Auth::user()->name)}}</h1>
          </div>
        </div>
      </div>
</div>
@endsection