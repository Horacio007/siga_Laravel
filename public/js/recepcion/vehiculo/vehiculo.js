$(document).ready(function(){
    //saco algo
    var componente_template = $("#d_incial").html();
    $("#d_incial").remove();

    //agrego la fecha del dia de hoy
    var d = new Date();
    var dia = d.getDate();
    var mes = d.getMonth() + 1;
    var ano = d.getFullYear();
    var strfecha = dia+"/"+mes+"/"+ano;
    $("#ifecha").val(strfecha);
    //

    //le agrego el nuevo registro
    $.ajax({
        url: '/ultimo_vehiculo_nuevo',
        type: 'GET',
        data:{
            noexpediente: true
        },
        success: function(result){
            $("#iexpediente").val(result['nuevo']);
        }
    })
    //

    //le agrego el ultimo registro
    $.ajax({
        url: '/ultimo_vehiculo',
        type: 'GET',
        data:{
            nouexpediente: true
        },
        success: function(result){
            $("#iuexpediente").val(result['ultimo'][0]['id']);
        }
    })
    //

    //agrego la marca sin tener que ponerla de manera manual
    $.ajax({
        url: '/listado_marcas',
        type: 'GET',
        data: {
            select_marca: true
        },
        success: function(result){
            $('#sautos').prepend(result['marcas'])
            //document.getElementById("select_marca").innerHTML = result;
        }
    })
    //

    //agrego la marca sin tener que ponerla de manera manual
    $("#sautos").on('change', function(){
        $.ajax({
            url: '/listado_submarcas',
            type: 'POST',
            data: {
                submarcas_select: true,
                id_marca: $(this).val()
            },
            success: function(result) {
                $('#sautoslinea').empty();
                $('#sautoslinea').prepend(result['submarcas'])
            }
        })
    })
    //

    //le agrego el asesor
    $.ajax({
        url: '/listado_asesores',
        type: 'GET',
        data: {
            select_asesor: true
        },
        success: function(result){
            $('#sasesor').empty();
            $('#sasesor').prepend(result['asesores'])
        }
    })
    //

    //le agredo las aseguradoras
    $.ajax({
        url: '/listado_aseguradoras',
        type: 'GET',
        data: {
            select_aseguradora: true
        },
        success: function(result){
            $('#saseguradora').empty();
            $('#saseguradora').prepend(result['aseguradora'])
            
        }
    })
    //

    //le agrego el estatus
    $.ajax({
        url: '/listado_estatus',
        type: 'GET',
        data: {
            select_estatus: true
        },
        success: function(result){
            $('#sestatus').empty();
            $('#sestatus').prepend(result['estatus'])
            
        }
    })
    //

    //le agrego el proceso
    $("#sestatus").on('change', function(){
        $.ajax({
            url: '/listado_estatusProceso',
            type: 'POST',
            data: {
                proceso_select: true,
                id_ubicacion: $(this).val()
            },
            success: function(result) {
                $('#sproceso').empty();
                $('#sproceso').prepend(result['proceso'])
            }
        })
    })
    //

    //le agrego el nivel de daño
    $.ajax({
        url: '/listado_niveldano',
        type: 'GET',
        data: {
            select_niveldano: true
        },
        success: function(result){
            $('#snivel').empty();
            $('#snivel').prepend(result['nivel'])
            
        }
    })
    //

    //le agrego el nivel de daño
    $.ajax({
        url: '/listado_formaarribo',
        type: 'GET',
        data: {
            select_formaarribo: true
        },
        success: function(result){
            $('#sarribo').empty();
            $('#sarribo').prepend(result['forma'])
            
        }
    })
    //

    //
    $("#isiniestro").on('click', function(){
        Swal.fire({
            icon: 'warning',
            title: 'Atención',
            text: 'Si es un trabajo particular poner "N/A", de lo contrario el No. de Siniestro',
        })
    })
    //

    //
    $("#saseguradora").on('change', function(){
        if ($(this).val() == 3) {
            $("#d_ini").append(componente_template);
            Swal.fire({
                icon: 'warning',
                title: 'Atención',
                text: 'Recuerda que tienes que explicar de forma general y concisa porque ingresa la unidad.',
            })
        }
    })

    $("#btn_registrar").on('click', function(){
        if ($("#inombre").val()=="") {
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: 'Rellena el campo de Nombre',
            })

            return false
        }

        if ($("#itel").val()=="") {
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: 'Rellena el campo de Telefono',
            })

            return false
        }

        if ($("#itel").val().length != 10) {
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: 'Un numero telefonico esta compuesto por 10 numeros',
            })

            $("#itel").val('');

            return false
        }

        if (isNaN($("#itel").val())) {
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: 'Un numero telefonico solo esta compuesto por numeros',
            })

            $("#itel").val('');

            return false
        }

        if ($("#icorreo").val()=="") {
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: 'Rellena el campo de Correo Electronico',
            })

            return false
        }

        //datos del vehiculo
        if ($("#sautos").val()==0) {
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: 'Seleccion una marca de vehículo',
            })

            return false
        }

        if ($("#sautoslinea").val()==0) {
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: 'Seleccion una linea de vehículo',
            })

            return false
        }

        if ($("#imodelo").val()==0) {
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: 'Rellena el campo modelo',
            })

            return false
        }

        if ($("#icolor").val()==0) {
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: 'Rellena el campo color',
            })

            return false
        }

        if ($("#iplacas").val()==0) {
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: 'Rellena el campo de placas',
            })

            return false
        }

        if ($("#isiniestro").val()==0) {
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: 'Rellena el campo de siniestro',
            })

            return false
        }

        if ($("#sasesor").val()==0) {
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: 'Seleccion un asesor',
            })

            return false
        }

        if ($("#saseguradora").val()==0) {
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: 'Seleccion una aseguradora',
            })

            return false
        }

        if ($("#sestatus").val()==0) {
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: 'Seleccion un estatus',
            })

            return false
        }

        if ($("#snivel").val()==0) {
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: 'Seleccion un nivel de daño',
            })

            return false
        }

        if ($("#sarribo").val()==0) {
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: 'Seleccion una forma de arribo',
            })

            return false
        }
    })
})