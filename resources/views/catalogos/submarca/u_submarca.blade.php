@extends('layouts.master')
@section('content')
    <div class="container-fluid">
        <form action="{{route('u_submarca', $submarcav->id)}}" method="post" id="formdata">
            @csrf
            <div class="row">
                <div class="col text-center">
                    <h3>Actualizar SubMarca</h3>
                </div>
            </div>
            <br>
            <div class="row">
                <div class="col-md-4"></div>
                <div class="col-md-4">
                    <label for="">Nombre:</label>
                    <input type="text" name="marca" id="imarca" value="{{$submarcav->marca->marca}}" class="form-control" readonly required>
                    <br>
                    <label for="">Submarca</label>
                    <input type="text" name="submarca" id="isubmarca" value="{{$submarcav->submarca}}" class="form-control" required>
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