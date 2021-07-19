@extends('layouts.master')
@section('content')
    <div class="container-fluid">
        <form action="{{route('u_personal', $personal->id)}}" method="post" id="formdata">
            @csrf
            <div class="row">
                <div class="col text-center">
                    <h3>Actualizar Personal</h3>
                </div>
            </div>
            <br>
            <div class="row">
                <div class="col-md-4"></div>
                <div class="col-md-4">
                    <label for="">Area:</label>
                    <input type="text" name="area" id="area" value="{{$personal->area->nombre}}" class="form-control" readonly required>
                    <br>
                    <label for="">Personal</label>
                    <input type="text" name="personal" id="personal" value="{{$personal->nombre}}" class="form-control" required>
                </div>
                <div class="col-md-4"></div>
            </div>
            <br>
            <div class="row">
                <div class="col-md-4"></div>
                <div class="col-md-4">
                    <input type="submit" value="Actualizar" class="btn btn-primary btn-lg btn-block">
                </div>
                <div class="col-md-4"></div>
            </div>
        </form>
    </div>
@endsection