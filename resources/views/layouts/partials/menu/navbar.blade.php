      <!-- Se grega el navbar -->
      <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <a class="navbar-brand" href="{{ route('menu') }}" id="dtrIndex" >DTR</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
      
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav ml-auto">
            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Recepcíon</a>
              <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                <a class="dropdown-item" href="{{ route('agendar') }}">Agenda</a>
                <a class="dropdown-item" href="{{ route('i_vehiculos') }}" id="altaVehiculo" >Alta del Vehículo</a>
                <a class="dropdown-item" href="{{ route('l_checklist') }}" id="checklistpdf">Listado Checklist</a>
                <a class="dropdown-item" href="{{ route('upload_evidenciar') }}">Evidencia Recepción</a>
            </li>
            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Costeo</a>
              <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                <a class="dropdown-item" href="{{ route('l_presupuestos') }}" id="presupuestopdf">Listado Presupuestos</a>
                <a class="dropdown-item" href="{{ route('upload_evidenciap') }}">Evidencia Presupuesto</a>
            </li> 
            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Compras</a>
              <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                <a class="dropdown-item" href="{{ route('l_compras') }}">Listado Compras</a>
                <a class="dropdown-item" href="{{ route('upload_evidenciacom') }}" id="evidenciarefacciones">Evidencia Compras</a>
            </li>
            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Refacciones</a>
              <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                <a class="dropdown-item" href="{{ route('l_refacciones') }}" id="listarefacciones">Listado de Refacciones en Almacen</a>
                <a class="dropdown-item" href="{{ route('l_segrefacciones') }}" id="actualizarrefacciones">Listado de Seguimiento Refacciones</a>
                <a class="dropdown-item" href="{{ route('l_entregdasrefacciones') }}" id="listaentregadas">Listado de Refacciones Entregadas</a>
                <a class="dropdown-item" href="{{ route('l_codigos') }}" id="barraqr">Codigos</a>
            </li>
            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Taller</a>
              <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                <a class="dropdown-item" id="listaordentrabajo" href="{{ route('l_ordenest') }}">Listado Ordenes de Trabajo</a>
                <a class="dropdown-item" id="listaordenmecanica" href="{{ route('l_ordenesm') }}">Listado Ordenes de Mecanica</a>
                <a class="dropdown-item" id="listaordenretrabajo" href="{{ route('l_ordenesrt') }}">Listado Ordenes de Retrabajo</a>
            </li>
            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Entrega</a>
              <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                <a class="dropdown-item" href="{{ route('l_clientes') }}" id="clientes" >Listado Clientes</a>
                <a class="dropdown-item" href="{{ route('l_docs') }}" id="documentosEntrega" >Documentación</a>
                <a class="dropdown-item" href="{{ route('l_cambiarEstatus') }}" id="estatus_vehiculo">Entrega Vehículo</a>
                <a class="dropdown-item" href="{{ route('l_ics') }}" id="isccliente">ISC</a>
                <a class="dropdown-item" href="{{ route('upload_evidenciae') }}" id="subir_archivo">Subir Archivos</a>
            </li>
            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Administración</a>
              <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                <a class="dropdown-item" href="{{ route('l_archivos') }}" id="verarchivos">Listado Archivos</a>
                <a class="dropdown-item" href="{{ route('l_valuaciones') }}" id="valuaciones">Bitacora</a>
                <a class="dropdown-item" href="{{ route('l_Brefacciones') }}" id="brefacciones">Listado Refacciones</a>
                <a class="dropdown-item" href="{{ route('l_asignacionPersonal') }}" id="asignacion_personal">Listado Asignacion de Personal</a>
                <a class="dropdown-item" href="{{ route('l_procesoAdministrativo') }}" id="procesoAdmon">Listado Proceso Administrativo</a>
                <a class="dropdown-item" href="{{ route('l_procesoTaller') }}" id="procesosegtaller">Listado Proceso Taller</a>
                <a class="dropdown-item" href="{{ route('recorrido') }}" target="_blank" id="recorrido">Recorrido</a>
                <a class="dropdown-item" href="{{ route('monitor') }}" id="procesosegtaller">Monitor Taller</a>
                <a class="dropdown-item" href="{{ route('monitorF') }}" id="procesosegtaller">Monitor Facturacion</a>
                <a class="dropdown-item" href="{{ route('metricos') }}" id="metricoss">Metricos</a>
            </li>
            @if (Auth::user()->id == 1 || Auth::user()->id == 2 || Auth::user()->id == 4 || Auth::user()->id == 5 || Auth::user()->id == 7)
              <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Catalogos</a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                  <a class="dropdown-item" href="{{ route('lista_marcas') }}" id="agregarMarca">Listado Marcas</a>
                  <a class="dropdown-item" href="{{ route('lista_submarcas') }}" id="agregarLinea">Listado Lineas</a>
                  <a class="dropdown-item" href="{{ route('lista_areas') }}" id="agregarArea">Listado Areas</a>
                  <a class="dropdown-item" href="{{ route('lista_aseguradoras') }}" id="agregarAseguradora">Listado Aseguradoras</a>
                  <a class="dropdown-item" href="{{ route('lista_asesores') }}" id="agregarAsesores">Listado Asesores</a>
                  <a class="dropdown-item" href="{{ route('lista_estatus') }}" id="agregarEstatus">Listado Ubicacion Vehiculo</a>
                  <a class="dropdown-item" href="{{ route('lista_estatusE') }}" id="agregarEstatus">Listado Proceso Vehiculo</a>
                  <a class="dropdown-item" href="{{ route('lista_estatusalm') }}" id="agregarEstatus">Listado Estatus Almacen</a>
                  <a class="dropdown-item" href="{{ route('l_estatusrefas') }}" id="agregarEstatus">Listado Estatus Refacciones</a>
                  <a class="dropdown-item" href="{{ route('l_estatusF') }}" id="agregarEstatus">Listado Estatus Facturas</a>
                  <a class="dropdown-item" href="{{ route('lista_niveldano') }}" id="agregarNivel">Listado Nivel Daño</a>
                  <a class="dropdown-item" href="{{ route('lista_formaarribo') }}" id="agregarForma">Listado Forma de Arribo</a>
                  <a class="dropdown-item" href="{{ route('l_personal') }}" id="agregarForma">Listado Personal</a>
                  <a class="dropdown-item" href="{{ route('l_tipopago') }}" id="agregarForma">Listado Tipo Pago</a>
                  <a class="dropdown-item" href="{{ route('l_tiposervicio') }}" id="agregarForma">Listado Tipo Servicio</a>
                  <a class="dropdown-item" href="{{ route('l_sino') }}" id="agregarForma">Listado Si/No</a>
                  <a class="dropdown-item" href="{{ route('l_conceptopago') }}" id="agregarForma">Listado Conceptos Pago</a>
                  <a class="dropdown-item" href="{{ route('l_formapago') }}" id="agregarForma">Listado Forma Pago</a>
              </li>
              <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Costos</a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                  <a class="dropdown-item" href="{{ route('l_recibo_pagos_pro') }}" id="gastos">Listado Recibo Pago Proveedores</a>
                  <a class="dropdown-item" href="{{ route('l_gastos') }}" id="gastos">Listado Gastos</a>
              </li>
              <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Ingresos</a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                  <a class="dropdown-item" href="{{ route('l_recibo_pagos') }}" id="ingr">Listado de Recibos de Cobro</a>
                  <a class="dropdown-item" href="{{ route('l_facturas') }}" id="afact">Listado Cobros</a>
              </li>
            @endif
            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Auditorias</a>
              <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                <a class="dropdown-item" href="{{ route('l_audlimpieza') }}" id="form_limpieza_edit">Listado Limpieza</a>
            </li>
            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Catalogo Servicios</a>
              <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                <a class="dropdown-item" href="{{ route('afinaciones') }}" id="afina">Afinaciones</a>
                <a class="dropdown-item" href="{{ route('frenos') }}" id="afrenos">Frenos</a>
            </li>
            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Formatos</a>
              <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                <a class="dropdown-item" href="{{ route('formatos') }}" id="afina">Formatos</a>
            </li>
            <li class="nav-item">
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <a role="button" class="nav-link" href="#" onclick="event.preventDefault();
                    this.closest('form').submit();">Cerrar Sesión</a>
                </form>
            </li>
          </ul>
        </div>
      </nav>