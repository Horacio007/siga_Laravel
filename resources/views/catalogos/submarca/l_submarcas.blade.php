@extends('layouts.master')
@section('content')
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/dt-1.10.24/datatables.min.css"/>
    <div class="container-fluid">
        <form action="" method="post" id="formdata">
            @csrf
            <div class="row">
                <div class="col text-center">
                    <h3>Listado de SubMarcas</h3>
                </div>
            </div>
            <br>
            <div class="row">
                <div class="col-md-3"></div>
                <div class="col-md-6">
                    <a href="{{url('/i_submarca')}}" class="btn btn-info">Registrar</a>
                </div>
                <div class="col-md-3"></div>
            </div>
            <br>
            <div class="row">
                <div class="col-md-3"></div>
                <div class="col-md-6">
                    <table id="list_submarcas" class="table table-striped table-bordered" border="0">
                        <thead class="text-capitalize">
                            <th scope="col">#</th>
                            <th scope="col">Marca</th>
                            <th scope="col">SubMarca</th>
                            <th scope="col">Acciones</th>
                        </thead>
                        <tbody class="">
                            @foreach ($list_submarcas as $submarcav)
                            <tr>
                                <td>{{$submarcav->id}}</td>
                                <td>{{$submarcav->marca->marca}}</td>
                                <td>{{$submarcav->submarca}}</td>
                                <td><a href="{{ route('u_submarca', $submarcav->id)}}" class="btn btn-primary"><i class="fa fa-edit"></i></a> 
                                <a href="#" class="btn btn-danger delete" data-toggle='modal' data-target='#modalD' item_id="{{$submarcav->id}}"><i class="fa fa-trash"></i></a></td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
        </div>
        </form>
    </div>
    <script type="text/javascript" src="https://cdn.datatables.net/v/dt/dt-1.10.24/datatables.min.js"></script>
    <script src="{{ asset('js/catalogos/submarca/submarca.js') }}"></script>

    <!-- Modal -->
    <div class="modal fade" id="modalD" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">¿Se eliminara?</h5>
                </div>
                    <div class="modal-body">
                        <form action="{{route('d_submarca', 'delete_item')}} " method="post" id="modal_delete">
                            @csrf
                            <label for="">Marca</label>
                            <input type="text" id="imarca" class="form-control" readonly>
                            <label for="">SubMarca</label>
                            <input type="text" id="isubmarca" class="form-control" readonly>
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