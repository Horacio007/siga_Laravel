$(document).ready(function(){
    $("#btn_registrar").attr('disabled', true);
    $('#list_vehiculo').DataTable({
        dom: 'Blfrtip',
        buttons: [{
                extend: 'excelHtml5',
                messageTop: 'Checklist',
                text: "Excel",
                title: "Listado de Vehiculos",
            },
            {
                /*'csvHtml5',*/
                extend: 'csvHtml5',
                text: "CSV",
                title: "Listado de Vehiculos",
                messageTop: 'Listado de Vehiculos',
            },
            {
                extend: 'pdfHtml5',
                title: 'Listado de Vehiculos'
            }
        ],
        responsive: true,
        destroy: true,
        language: {
            "sProcessing":     "Procesando...",
                        "sLengthMenu":     "Mostrar _MENU_ registros",
                        "sZeroRecords":    "No se encontraron resultados",
                        "sEmptyTable":     "Ningún dato disponible en esta tabla =(",
                        "sInfo":           "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
                        "sInfoEmpty":      "Mostrando registros del 0 al 0 de un total de 0 registros",
                        "sInfoFiltered":   "(filtrado de un total de _MAX_ registros)",
                        "sInfoPostFix":    "",
                        "sSearch":         "Buscar:",
                        "sUrl":            "",
                        "sInfoThousands":  ",",
                        "sLoadingRecords": "Cargando...",
                        "oPaginate": {
                            "sFirst":    "Primero",
                            "sLast":     "Último",
                            "sNext":     "Siguiente",
                            "sPrevious": "Anterior"
                        },
                        "oAria": {
                            "sSortAscending":  ": Activar para ordenar la columna de manera ascendente",
                            "sSortDescending": ": Activar para ordenar la columna de manera descendente"
                        },
                        "buttons": {
                            "copy": "Copiar",
                            "colvis": "Visibilidad"
                        }
        },
        select: true,
        pageLength:100 

    });

    $("#btn_buscar").on('click', function(){
        //
        if ($("#iexpediente").val() == "") {
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: 'Ingresa el Numero de Expediente',
            })
              
            return false
        }
        
        $.ajax({
            url: '/e_ve',
            type: 'GET',
            data: {
                id: $("#iexpediente").val()
            },
            success: function(result){
                if (result['vehiculo'] == 1) {
                    Swal.fire({
                        icon: 'success',
                        title: 'Correcto',
                        text: 'Vehiculo Encontrado',
                    })
                    $("#iexpediente").attr("readonly","readonly");
                    $("#btn_agregar").attr('disabled', false);
                    $("#add_ref").addClass('add_refaccion');
                    $.ajax({
                        url: '/mlmca',
                        type: 'GET',
                        data: {
                            id: $("#iexpediente").val()
                        },
                        success: function(result){
                            inf = result;
                            $("#inf").fadeIn();
                            $("#inf").css('border-radius', '5px');
                            $("#inf").css('background-color', '#53ee7e'); 
                            $("#info").text('Vehiculo: '+ result[0]['marcas']['marca'] + ' ' + result[0]['submarcas']['submarca'] + ' ' + result[0]['color'] + ' ' + result[0]['modelo'] + ' ' + result[0]['clientes']['nombre']);
                            $("#iexpediente2").val($("#iexpediente").val());
                            $("#aseguradora").val(result[0]['clientes']['nombre'])
                        }
                    })         
                } else {
                    if (result['vehiculo'] == 0) {
                        Swal.fire({
                            icon: 'error',
                            title: 'Oops...',
                            text: 'Vehiculo no encontrado y/o registrado',
                        })
                        document.getElementById("formdataa").reset();
                    } else if (result['vehiculo'] == 00) {
                        Swal.fire({
                            icon: 'error',
                            title: 'Oops...',
                            text: 'Presupuesto ya creado',
                        })
                        document.getElementById("formdataa").reset();
                    }
                    
                }
            }
        })
    });

    var con = 1;
    var ultimo;
    let componente_template = $("div.refaccion_consecutivo").html();
    $("#refaccion_consecutivo").remove();

    $(document).on('click', 'a.add_refaccion', function(e){
        $("#section_refacciones").append( 
            componente_template.replaceAll( "consecutivo" , con) );

        con++;
        $("#cont").val(con);
        $("#btn_registrar").attr('disabled', false);
    })

    $(document).on('click','a.remove_refaccion',function(e) {
        //alert('entra');
        let item_id = $(this).attr('item_id');
        //console.log(item_id);
        $("#refaccion_"+item_id).remove();
    });


})