      <!-- Se grega el navbar -->
      <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <a class="navbar-brand" href="#" id="dtrIndex" >DTR</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
      
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav ml-auto">
            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Recepcíon</a>
              <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                <a class="dropdown-item" href="{{ route('i_vehiculos') }}" id="altaVehiculo" >Alta del Vehículo</a>
                <a class="dropdown-item" href="{{ asset('i_checklist') }}" id="altachecklist">Checklist</a>
                <a class="dropdown-item" href="{{ asset('l_checklist') }}" id="checklistpdf">Listado Checklist</a>
                <a class="dropdown-item" href="#" id="evidenciafirma">Evidencia y Firma</a>
            </li>
            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Costeo</a>
              <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                <a class="dropdown-item" href="#" id="presupuestoini">Presupuesto Inicial</a>
                <a class="dropdown-item" href="#" id="actualizarpresupuestoini">Actualizar Presupuesto</a>
                <a class="dropdown-item" href="#" id="presupuestopdf">Presupuesto PDF</a>
                <a class="dropdown-item" href="#" id="evidencipresupuesto">Subir Evidencia</a>
            </li> 
            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Compras</a>
              <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                <a class="dropdown-item" href="#" id="cotizarrefacciones">Cotizar Refacciones</a>
                <a class="dropdown-item" href="#" id="refaccionespd">Refacciones PDF</a>
                <a class="dropdown-item" href="#" id="listarefaccionespd">Listado de Refacciones PDF</a>
                <a class="dropdown-item" href="#" id="evidenciarefacciones">Subir Evidencia</a>
            </li>
            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Almacen</a>
              <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                <a class="dropdown-item" href="#" id="altarefacciones">Alta Refacciones</a>
                <a class="dropdown-item" href="#" id="actualizarrefacciones">Actualizacion Refacciones</a>
                <a class="dropdown-item" href="#" id="seguimientorefacciones">Seguimiento Refacciones</a>
                <a class="dropdown-item" href="#" id="recepcionrefacciones">Recepcion Refacciones</a>
                <a class="dropdown-item" href="#" id="bajarefacciones">Baja Refacciones</a>
                <a class="dropdown-item" href="#" id="listarefacciones">Listado de Refacciones</a>
                <a class="dropdown-item" href="#" id="listaentregadas">Listado de Refacciones Entregadas</a>
                <a class="dropdown-item" href="#" id="barraqr">Codigos</a>
            </li>
            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Taller</a>
              <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                <a class="dropdown-item" id="ordentrabajo" href="#">Orden de Trabajo</a>
                <a class="dropdown-item" id="listaordentrabajo" href="#">Listado Ordenes de Trabajo</a>
                <a class="dropdown-item" id="ordenmecanica" href="#">Orden de Mecanica</a>
                <a class="dropdown-item" id="listaordenmecanica" href="#">Listado Ordenes de Mecanica</a>
                <a class="dropdown-item" id="ordenretrabajo" href="#">Orden de Re-Trabajo</a>
                <a class="dropdown-item" id="listaordenretrabajo" href="#">Listado Ordenes de Re-Trabajo</a>
            </li>
            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Entrega</a>
              <div class="dropdown-menu" aria-labelledby="navbarDropdown">
              <a class="dropdown-item" href="#" id="clientes" >Clientes</a>
                <a class="dropdown-item" href="#" id="documentosEntrega" >Documentación</a>
                <a class="dropdown-item" href="#" id="estatus_vehiculo">Estatus Vehículo</a>
                <a class="dropdown-item" href="#" id="isccliente">ISC</a>
                <a class="dropdown-item" href="#" id="subir_archivo">Subir Archivos</a>
            </li>
            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Administración</a>
              <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                <a class="dropdown-item" href="#" id="verarchivos">Ver Archivos</a>
                <a class="dropdown-item" href="#" id="valuaciones">Valuaciones</a>
                <a class="dropdown-item" href="#" id="brefacciones">Refacciones</a>
                <a class="dropdown-item" href="#" id="asignacion_personal">Asignacion de Personal</a>
                <a class="dropdown-item" href="#" id="procesoTaller">Seguimiento Taller</a>
                <a class="dropdown-item" href="#" id="procesoAdmon">Proceso Administrativo</a>
                <a class="dropdown-item" href="#" id="procesosegtaller">Proceso Taller</a>
                <a class="dropdown-item" href="#" id="metricoss">Metricos</a>
            </li>
            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Catalogos</a>
              <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                <a class="dropdown-item" href="{{ route('lista_marcas') }}" id="agregarMarca">Listado Marcas</a>
                <a class="dropdown-item" href="{{ route('lista_submarcas') }}" id="agregarLinea">Listado Lineas</a>
                <a class="dropdown-item" href="{{ route('lista_areas') }}" id="agregarArea">Listado Areas</a>
                <a class="dropdown-item" href="{{ route('lista_aseguradoras') }}" id="agregarAseguradora">Listado Aseguradoras</a>
                <a class="dropdown-item" href="{{ route('lista_asesores') }}" id="agregarAsesores">Listado Asesores</a>
                <a class="dropdown-item" href="{{ route('lista_estatus') }}" id="agregarEstatus">Listado Estatus</a>
                <a class="dropdown-item" href="{{ route('lista_niveldano') }}" id="agregarNivel">Listado Nivel Daño</a>
                <a class="dropdown-item" href="{{ route('lista_formaarribo') }}" id="agregarForma">Listado Forma de Arribo</a>
            </li>
            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Costos</a>
              <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                <a class="dropdown-item" href="#" id="gastos">Cargar Gastos</a>
                <a class="dropdown-item" href="#" id="a_gastos">Resumen Gastos</a>
                <a class="dropdown-item" href="#" id="tipogmes">Tipo Gasto por Mes</a>
                <a class="dropdown-item" href="#" id="hisgastos">Historico de Gastos</a>
            </li>
            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Ingresos</a>
              <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                <a class="dropdown-item" href="#" id="fact">Cargar Facturas</a>
                <a class="dropdown-item" href="#" id="afact">Resumen Facturas</a>
                <a class="dropdown-item" href="#" id="ingr">Cargar Ingresos</a>
                <a class="dropdown-item" href="#" id="resingr">Resumen Ingresos</a>
            </li>
            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Auditorias</a>
              <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                <a class="dropdown-item" href="#" id="form_limpieza">Limpieza</a>
                <a class="dropdown-item" href="#" id="form_limpieza_edit">Historico de Limpieza</a>
            </li>
            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Catalogo Servicios</a>
              <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                <a class="dropdown-item" href="#" id="afina">Afinaciones</a>
                <a class="dropdown-item" href="#" id="afrenos">Frenos</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="">Cerrar Sesión</a>
            </li>
          </ul>
        </div>
      </nav>