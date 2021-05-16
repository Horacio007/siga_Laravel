$(document).ready(function(){

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
})