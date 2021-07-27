@extends('layouts.master')
@section('content')
    <div class="container-fluid">
        <form action="" method="post" id="formdata">
            @csrf
            <div class="container-fluid">
                <form action="" method="post" id="formdata">
                    <div class="row">
                        <div class="col text-center">
                            <h3>Frenos</h3>
                        </div>
                    </div>
                    <br>
                    <div class="row">
                        <div class="col">
                            <div class="card">
                                <div class="card-header">
                                    Revicion y Trabajo de Frenos
                                </div>
                                <div class="card-body">
                                    <p>
                                        <ul>
                                            <li style="list-style-type:square">Cambio de Balatas</li>
                                            <li style="list-style-type:square">Rectificación de Discos o Tambores</li>
                                            <li style="list-style-type:square">Reposicion de Liquido de Frenos</li>
                                            <li style="list-style-type:square">Purgar Liquido de Frenos</li>
                                            <li style="list-style-type:square">Purgar Clutch</li>
                                        </ul>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </form>
    </div>
@endsection