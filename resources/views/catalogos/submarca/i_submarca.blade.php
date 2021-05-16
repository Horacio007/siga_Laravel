@extends('layouts.master')
@section('content')
    <div class="container-fluid">
        <form action="/i_submarca" method="post" id="formdata">
            @csrf
            <div class="row">
                <div class="col text-center">
                    <h3>Registrar SubMarca</h3>
                </div>
            </div>
            <br>
            <div class="row">
                <div class="col-md-4"></div>
                <div class="col-md-4">
                    <label for="">Nombre:</label>
                    <select name="marca" id="smarca" class="form-control" required>
                        <option disabled selected>Elige una marca</option>
                        @foreach ($list_marcas as $marca)
                            <option value="{{$marca->id}}">{{$marca->marca}}</option>
                        @endforeach
                    </select>
                    <br>
                    <label for="">Submarca</label>
                    <input type="text" name="submarca" id="isubmarca" class="form-control" required>
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
        </form>
    </div>
@endsection