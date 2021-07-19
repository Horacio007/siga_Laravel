@extends('layouts.master')
@section('content')
    <div class="container-fluid">
        <form action="/i_personal" method="post" id="formdata">
            @csrf
            <div class="row">
                <div class="col text-center">
                    <h3>Registrar Personal</h3>
                </div>
            </div>
            <br>
            <div class="row">
                <div class="col-md-4"></div>
                <div class="col-md-4">
                    <label for="">Area:</label>
                    <select name="area" id="area" class="form-control" required>
                        <option disabled selected>Elige una area</option>
                        @foreach ($list_areas as $area)
                            <option value="{{$area->id}}">{{$area->nombre}}</option>
                        @endforeach
                    </select>
                    <br>
                    <label for="">Nombre</label>
                    <input type="text" name="personal" id="personal" class="form-control" required>
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