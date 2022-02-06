@extends('layouts.master')
@section('content')
    <div class="container-fluid">
        <form action="/i_estatusE" method="post" id="formdata">
            @csrf
            <div class="row">
                <div class="col text-center">
                    <h3>Registrar Proceso</h3>
                </div>
            </div>
            <br>
            <div class="row">
                <div class="col-md-4"></div>
                <div class="col-md-4">
                    <label for="">Nombre:</label>
                    <select name="ubicacion" id="ubicacion" class="form-control" required>
                        <option disabled selected>Elige una ubicacion</option>
                        @foreach ($list_ubicaciones as $ubicacion)
                            <option value="{{$ubicacion->id}}">{{$ubicacion->status}}</option>
                        @endforeach
                    </select>
                    <br>
                    <label for="">Proceso</label>
                    <input type="text" name="proceso" id="proceso" class="form-control" placeholder="Nombre del proceso" required>
                </div>
                <div class="col-md-4"></div>
            </div>
            <br>
            <div class="row">
                <div class="col-md-4"></div>
                <div class="col-md-4">
                    <input type="submit" value="Registrar" class="btn btn-primary btn-lg btn-block">
                </div>
                <div class="col-md-4"></div>
            </div>
        </div>
        </form>
    </div>
@endsection