@extends('layouts.master')
@section('content')
<div class="container-fluid">
    <form action="" method="post" id="formdataa">
        @csrf
        <div class="row">
            <div class="col text-center">
                <h3>Alta checklist</h3>
            </div>
        </div>
        <div class="row">
            <div class="col-md-4">
                <label for="lexpediente">No. Expediente</label>
                <input type="text" name="expediente" class="form-control" id="iexpediente" required>
            </div>
            <div class="col-md-4">
                <label for=""></label>
                <button type="button" class="btn btn-primary btn-lg btn-block" id="btn_buscar">Buscar</button>
            </div>
            <div class="col-md-4">
                <label for=""></label>
                <div id="inf" class="text-center">
                    <label for="" id="info"></label>
                </div>
            </div>
        </div>
        <br>
    </form>
    <form action="/i_checklist" method="post" id="formdata">
        @csrf
        <div class="row">
            <div class="col text-center">
                <h3>Inicio checklist</h3>
            </div>
        </div>
        <br>
        <div class="row">
            <div class="col-md-3">
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="row">Exterior</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <th>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="1" name="luces_front" id="lucesfrontales" checked>
                                    <label class="form-check-label" for="defaultCheck1">Luces Frontales</label>
                                </div>
                            </th>
                        </tr>
                        <tr>
                            <th>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="1" name="cuarto_luces" id="cuartoluces" checked>
                                    <label class="form-check-label" for="defaultCheck1">1/4 de Luces</label>
                                </div>
                            </th>
                        </tr>
                        <tr>
                            <th>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="1" name="direccional_izq" id="direccionalizq" checked>
                                    <label class="form-check-label" for="defaultCheck1">Direccional Izq.</label>
                                </div>
                            </th>
                        </tr>
                        <tr>
                            <th>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="1" name="direccional_der" id="direccionalder" checked>
                                    <label class="form-check-label" for="defaultCheck1">Direccional Der.</label>
                                </div>
                            </th>
                        </tr>
                        <tr>
                            <th>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="1" name="espejo_der" id="espejoder" checked>
                                    <label class="form-check-label" for="defaultCheck1">Espejo Der.</label>
                                </div>
                            </th>
                        </tr>
                        <tr>
                            <th>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="1" name="espejo_izq" id="espejoizq" checked>
                                    <label class="form-check-label" for="defaultCheck1">Espejo Izq.</label>
                                </div>
                            </th>
                        </tr>
                        <tr>
                            <th>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="1" name="cristales" id="cristales" checked>
                                    <label class="form-check-label" for="defaultCheck1">Cristales</label>
                                </div>
                            </th>
                        </tr>
                        <tr>
                            <th>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="1" name="emblema" id="emblemas" checked>
                                    <label class="form-check-label" for="defaultCheck1">Emblemas</label>
                                </div>
                            </th>
                        </tr>
                        <tr>
                            <th>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="1" name="llantas" id="llantas" checked>
                                    <label class="form-check-label" for="defaultCheck1">Llantas</label>
                                </div>
                            </th>
                        </tr>
                        <tr>
                            <th>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="1" name="tapon_ruedas" id="tapon_ruedas" checked>
                                    <label class="form-check-label" for="defaultCheck1">Tapon de Ruedas</label>
                                </div>
                            </th>
                        </tr>
                        <tr>
                            <th>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="1" name="molduras" id="molduras" checked>
                                    <label class="form-check-label" for="defaultCheck1">Molduras</label>
                                </div>
                            </th>
                        </tr>
                        <tr>
                            <th>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="1" name="tapa_gasolina" id="tapa_gasolina" checked>
                                    <label class="form-check-label" for="defaultCheck1">Tapa de Gasolina</label>
                                </div>
                            </th>
                        </tr>
                        <tr>
                            <th>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="1" name="stopp" id="stop" checked>
                                    <label class="form-check-label" for="defaultCheck1">Stop</label>
                                </div>
                            </th>
                        </tr>
                        <tr>
                            <th>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="1" name="luz_tras_izq" id="luz_tras_izq" checked>
                                    <label class="form-check-label" for="defaultCheck1">Luz Tras. Izq.</label>
                                </div>
                            </th>
                        </tr>
                        <tr>
                            <th>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="1" name="luz_tras_der" id="luz_tras_der" checked>
                                    <label class="form-check-label" for="defaultCheck1">Luz Tras. Der.</label>
                                </div>
                            </th>
                        </tr>
                        <tr>
                            <th>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="1" name="direccional_tras_izq" id="direccional_tras_izq" checked>
                                    <label class="form-check-label" for="defaultCheck1">Direccional Tras. Izq</label>
                                </div>
                            </th>
                        </tr>
                        <tr>
                            <th>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="1" name="direccional_tras_der" id="direccional_tras_der" checked>
                                    <label class="form-check-label" for="defaultCheck1">Direccional Tras. Der</label>
                                </div>
                            </th>
                        </tr>
                        <tr>
                            <th>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="1" name="luz_placa" id="luz_placa" checked>
                                    <label class="form-check-label" for="defaultCheck1">Luz Placa</label>
                                </div>
                            </th>
                        </tr>
                        <tr>
                            <th>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="1" name="luz_cajuela" id="luz_cajuela" checked>
                                    <label class="form-check-label" for="defaultCheck1">Luz de Cajuela</label>
                                </div>
                            </th>
                        </tr>
                    </tbody>
                </table>
                
            </div>
            <div class="col-md-3">
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="row">Interior</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <th>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="1" name="luz_tablero" id="luztablero" checked>
                                    <label class="form-check-label" for="defaultCheck1">Luz de Tablero</label>
                                </div>
                            </th>
                        </tr>
                        <tr>
                            <th>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="1" name="instrumentos_tablero" id="instrumentostablero" checked>
                                    <label class="form-check-label" for="defaultCheck1">Instrumentos de Tablero</label>
                                </div>
                            </th>
                        </tr>
                        <tr>
                            <th>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="1" name="llaves" id="llaves" checked>
                                    <label class="form-check-label" for="defaultCheck1">Llaves</label>
                                </div>
                            </th>
                        </tr>
                        <tr>
                            <th>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="1" name="limpia_parabrisas_fron" id="limpiaparabrisasfront" checked>
                                    <label class="form-check-label" for="defaultCheck1">Limpiaparabrisas Frontal</label>
                                </div>
                            </th>
                        </tr>
                        <tr>
                            <th>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="1" name="limpia_parabrisas_tras" id="limpiaparabrisastras" checked>
                                    <label class="form-check-label" for="defaultCheck1">Limpiaparabrisas Trasero</label>
                                </div>
                            </th>
                        </tr>
                        <tr>
                            <th>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="1" name="estereo" id="estereo" checked>
                                    <label class="form-check-label" for="defaultCheck1">Estereo</label>
                                </div>
                            </th>
                        </tr>
                        <tr>
                            <th>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="1" name="bocinas_fron" id="bocinasfront" checked>
                                    <label class="form-check-label" for="defaultCheck1">Bocinas Frontales</label>
                                </div>
                            </th>
                        </tr>
                        <tr>
                            <th>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="1" name="bocinas_tras" id="bocinastras" checked>
                                    <label cliobservacionesass="form-check-label" for="defaultCheck1">Bocinas Traseras</label>
                                </div>
                            </th>
                        </tr>
                        <tr>
                            <th>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="1" name="encendedor" id="encendedor" checked>
                                    <label class="form-check-label" for="defaultCheck1">Encendedor</label>
                                </div>
                            </th>
                        </tr>
                        <tr>
                            <th>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="1" name="espejo_retrovisor" id="espejoretro" checked>
                                    <label class="form-check-label" for="defaultCheck1">Espejo Retrovisor</label>
                                </div>
                            </th>
                        </tr>
                        <tr>
                            <th>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="1" name="cenicero" id="cenicero" checked>
                                    <label class="form-check-label" for="defaultCheck1">Cenicero</label>
                                </div>
                            </th>
                        </tr>
                        <tr>
                            <th>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="1" name="cinturones" id="cinturones" checked>
                                    <label class="form-check-label" for="defaultCheck1">Cinturones</label>
                                </div>
                            </th>
                        </tr>
                        <tr>
                            <th>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="1" name="luz_int" id="luzinterior" checked>
                                    <label class="form-check-label" for="defaultCheck1">Luz de Interior</label>
                                </div>
                            </th>
                        </tr>
                        <tr>
                            <th>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="1" name="parasol_izq" id="parasolizq" checked>
                                    <label class="form-check-label" for="defaultCheck1">Parasol Izq.</label>
                                </div>
                            </th>
                        </tr>
                        <tr>
                            <th>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="1" name="parasol_der" id="parasolder" checked>
                                    <label class="form-check-label" for="defaultCheck1">Parasol Der.</label>
                                </div>
                            </th>
                        </tr>
                        <tr>
                            <th>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="1" name="vestiduras_tela" id="vestidurastela" checked>
                                    <label class="form-check-label" for="defaultCheck1">Vestiduras de Tela</label>
                                </div>
                            </th>
                        </tr>
                        <tr>
                            <th>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="1" name="vestiduras_piel" id="vestiduraspiel" checked>
                                    <label class="form-check-label" for="defaultCheck1">Vestiduras de Piel</label>
                                </div>
                            </th>
                        </tr>
                        <tr>
                            <th>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="1" name="testigos_tablero" id="testigostablero" checked>
                                    <label class="form-check-label" for="defaultCheck1">Testigos de Tablero</label>
                                </div>
                            </th>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="col-md-3">
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="row">Accesorios</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <th>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="1" name="refaccion" id="refaccion" checked>
                                    <label class="form-check-label" for="defaultCheck1">Refaccion</label>
                                </div>
                            </th>
                        </tr>
                        <tr>
                            <th>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="1" name="dado_seguridad" id="dadoseguridad" checked>
                                    <label class="form-check-label" for="defaultCheck1">Dado de Seguridad</label>
                                </div>
                            </th>
                        </tr>
                        <tr>
                            <th>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="1" name="gato" id="gato" checked>
                                    <label class="form-check-label" for="defaultCheck1">Gato</label>
                                </div>
                            </th>
                        </tr>
                        <tr>
                            <th>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="1" name="maneral" id="maneral" checked>
                                    <label class="form-check-label" for="defaultCheck1">Maneral</label>
                                </div>iobservaciones
                            </th>
                        </tr>
                        <tr>
                            <th>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="1" name="herramientas" id="herramientas" checked>
                                    <label class="form-check-label" for="defaultCheck1">Herramientas</label>
                                </div>
                            </th>
                        </tr>
                        <tr>
                            <th>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="1" name="triangulos" id="triangulo" checked>
                                    <label class="form-check-label" for="defaultCheck1">Triangulo</label>
                                </div>
                            </th>
                        </tr>
                        <tr>
                            <th>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="1" name="botiquin" id="botiquin" checked>
                                    <label class="form-check-label" for="defaultCheck1">Botiquin</label>
                                </div>
                            </th>
                        </tr>
                        <tr>
                            <th>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="1" name="extintor" id="extintor" checked>
                                    <label class="form-check-label" for="defaultCheck1">Extintor</label>
                                </div>
                            </th>
                        </tr>
                        <tr>
                            <th>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="1" name="cables" id="cables" checked>
                                    <label class="form-check-label" for="defaultCheck1">Cables</label>
                                </div>
                            </th>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="col-md-3">
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="row">Componentes Mecanicos</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <th>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="1" name="claxon" id="claxon" checked>
                                    <label class="form-check-label" for="defaultCheck1">Claxon</label>
                                </div>
                            </th>
                        </tr>
                        <tr>
                            <th>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="1" name="tapon_aceite" id="taponaceite" checked>
                                    <label class="form-check-label" for="defaultCheck1">Tapon Aceite</label>
                                </div>
                            </th>
                        </tr> 
                        <tr>
                            <th>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="1" name="tapon_gasolina" id="tapongasolin" checked>
                                    <label class="form-check-label" for="defaultCheck1">Tapon de Gasolina</label>
                                </div>
                            </th>
                        </tr>
                        <tr>
                            <th>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="1" name="tapon_radiador" id="taponradiador" checked>
                                    <label class="form-check-label" for="defaultCheck1">Tapon de Radiador</label>
                                </div>
                            </th>
                        </tr>
                        <tr>
                            <th>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="1" name="vayoneta_aceite" id="vayoneta" checked>
                                    <label class="form-check-label" for="defaultCheck1">Vayoneta de Aceite</label>
                                </div>
                            </th>
                        </tr>
                        <tr>
                            <th>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="1" name="bateria" id="bateria" checked>
                                    <label class="form-check-label" for="defaultCheck1">Bateria</label>
                                </div>
                            </th>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <label for="">Combustible</label>
                <select name="combustible" id="sgasolina" class="form-control" required>
                    <option value="0">Seleccione el nivel de Combustible:</option>
                    <option value="1">0</option>
                    <option value="2">1/4</option>
                    <option value="3">1/2</option>
                    <option value="4">3/4</option>
                    <option value="5">1</option>
                </select>
            </div>
            <div class="col-md-6">
                <label for="">Kilometraje</label>
                <input type="text" name="kilometraje" id="ikilometraje" class="form-control" required>
            </div>
        </div>
        <br>
        <div class="row">
            <div class="col">
                <label for="">Observaciones</label>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <textarea name="observaciones" id="iobservaciones" cols="100" rows="10" class="form-control" placeholder="Documentar daños y daños preexistentes" required></textarea>
            </div>
        </div>
        <br>
        <div class="row">
            <div class="col-md-4"><input type="text" name="expediente" class="form-control" id="iexpediente2" required hidden readonly></div>
            <div class="col-md-4">
                <label for=""></label>
                <button type="button" class="btn btn-primary btn-lg btn-block" id="btn_registrar">Registrar</button>
            </div>
            <div class="col-md-4"></div>
        </div>
        <br>
    </form>
</div>
@endsection
@push('custom_script')
<script src="{{ asset('js/recepcion/checklist/checklist.js') }}"></script>
<script src="{{ asset('libs/jsPDF/jspdf.debug.js') }}"></script>   
@endpush