@extends('layouts.master')
@section('content')
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/dt-1.10.24/datatables.min.css"/>
    <div class="container-fluid">
        <form action="" method="post" id="formdata">
            @csrf
            <div class="row">
                <div class="col text-center">
                    <h3>Listado de Asesores</h3>
                </div>
            </div>
            <br>
            <div class="row">
                <div class="col-md-3"></div>
                <div class="col-md-6">
                    <a href="{{url('/i_asesor')}}" class="btn btn-info">Registrar</a>
                </div>
                <div class="col-md-3"></div>
            </div>
            <br>
            <div class="row">
                <div class="col-md-3"></div>
                <div class="col-md-6">
                    <table id="list_asesores" class="table table-striped table-bordered" border="0">
                        <thead class="text-capitalize">
                            <th scope="col">#</th>
                            <th scope="col">Aseguradora</th>
                            <th scope="col">Nombre</th>
                            <th scope="col">Apellido Paterno</th>
                            <th scope="col">Apellido Materno</th>
                            <th scope="col">Acciones</th>
                        </thead>
                        <tbody class="">
                            @foreach ($list_asesores as $asesor)
                            <tr>
                                <td>{{$asesor->id}}</td>
                                <td>{{$asesor->aseguradoras->first()->nombre}}</td>
                                <td>{{$asesor->nombre}}</td>
                                <td>{{$asesor->a_paterno}}</td>
                                <td>{{$asesor->a_materno}}</td>
                                <td><a href="{{ route('u_asesor', $asesor->id)}}" class="btn btn-primary"><i class="fa fa-edit"></i></a> 
                                <a href="#" class="btn btn-danger delete" data-toggle='modal' data-target='#modalD' item_id="{{$asesor->id}}"><i class="fa fa-trash"></i></a></td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
        </div>
        </form>
    </div>
    <script type="text/javascript" src="https://cdn.datatables.net/v/dt/dt-1.10.24/datatables.min.js"></script>
    <script src="{{ asset('js/catalogos/asesor/asesor.js') }}"></script>

    <!-- Modal -->
    <div class="modal fade" id="modalD" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">¿Se eliminara?</h5>
                </div>
                    <div class="modal-body">
                        <form action="{{route('d_asesor', 'delete_item')}}" method="post" id="modal_delete">
                            @csrf
                            <label for="">Aseguradora</label>
                            <input type="text" id="iaseguradora" class="form-control" readonly>
                            <br>
                            <label for="">Nombre</label>
                            <input type="text" id="inombre" class="form-control" readonly>
                        </form>
                    </div>
                <div class="modal-footer">
                    <button type="button" id="cerrar" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                    <a href="#" id="btn_delete" class="btn btn-danger delete">Eliminar</a>
                </div>
            </div>
        </div>
    </div>
@endsection