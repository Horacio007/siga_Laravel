@extends('layouts.master')
@section('content')
    <div class="container-fluid">
        <form action="" method="post" id="formdata">
            @csrf
            <div class="container-fluid">
                <form action="" method="post" id="formdata">
                    <div class="row">
                        <div class="col text-center">
                            <h3>Afinaciones</h3>
                        </div>
                    </div>
                    <br>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="card">
                                <div class="card-header">
                                    Afinación General/Mayor
                                </div>
                                <div class="card-body">
                                    <p>
                                        <ul>
                                            <li style="list-style-type:square">Aceite Mineral/Sintetico/Semi-Sintetico/Multigrado</li>
                                            <li style="list-style-type:square">Filtro de Aceite</li>
                                            <li style="list-style-type:square">Filtro de Aire</li>
                                            <li style="list-style-type:square">Filtro de Gasolina</li>
                                            <li style="list-style-type:square">Bujias Iridio/Platino/Tradicional</li>
                                            <li style="list-style-type:square">Lavado de Inyectores</li>
                                        </ul>
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="card">
                                <div class="card-header">
                                    Afinación Menor
                                </div>
                                <div class="card-body">
                                    <p>
                                        <ul>
                                            <li style="list-style-type:square">Aceite Mineral/Sintetico/Semi-Sintetico/Multigrado</li>
                                            <li style="list-style-type:square">Filtro de Aceite</li>
                                            <li style="list-style-type:square">Filtro de Aire</li>
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