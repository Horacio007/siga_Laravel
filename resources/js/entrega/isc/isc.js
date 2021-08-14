$(document).ready(function(){
    var inf = [];
    $("#btn_registrar").attr('disabled', true);

    $('#list_vehiculo').DataTable({
        dom: 'Blfrtip',
        buttons: [{
                extend: 'excelHtml5',
                messageTop: 'Checklist',
                text: "Excel",
                title: "Listado de Refacciones Asignadas",
            },
            {
                /*'csvHtml5',*/
                extend: 'csvHtml5',
                text: "CSV",
                title: "Listado de Refacciones Asignadas",
                messageTop: 'Listado de Refacciones Asignadas',
            },
            {
                extend: 'pdfHtml5',
                title: 'Listado de Refacciones Asignadas'
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
                            $("#icliente").val(result[1]['nombre']);
                            $("#iexpediente").attr('disabled', true);
                            $("#btn_registrar").attr('disabled', false);
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

    $("#btn_registrar").on('click', function(){
        //checo que no este vacio 
        if ($("#iatendio").val() == 0) {
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: 'Ingresa el Nombre de quien lo Atendio',
            })

            return false
        }

        if ($("#ifecha").val() == 0) {
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: 'Ingresa la Fecha en que se realizo la encuesta',
            })

            return false
        }

        if ($("#pr1").val() == 0) {
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: 'Responde la primer pregunta',
            })

            return false
        }

        if ($("#pr2").val() == 0) {
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: 'Responde la segunda pregunta',
            })

            return false
        }

        if ($("#pr3").val() == 0) {
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: 'Responde la tercer pregunta',
            })

            return false
        }

        if ($("#pr4").val() == 0) {
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: 'Responde la cuarta pregunta',
            })

            return false
        }

        if ($("#pr5").val() == 0) {
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: 'Responde la quinta pregunta',
            })

            return false
        }

        if ($("#pr6").val() == 0) {
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: 'Responde la sexta pregunta',
            })

            return false
        }

        if ($("#pr7").val() == 0) {
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: 'Responde la septima pregunta',
            })

            return false
        }

        //pongo toda la info en un arreglo y le checo las coasas par ver el total de lo que se junto
        var p1;
        var p2;
        var p3;
        var p4;
        var p5;
        var p6;
        var p7;
        var suma;

        if ($("#pr1").val() == 1) {
            p1 = 20;
        } else if ($("#pr1").val() == 2){
            p1 = 10;
        } else {
            p1 = 0;
        }

        if ($("#pr2").val() == 1) {
            p2 = 20;
        } else if ($("#pr2").val() == 2){
            p2 = 10;
        } else {
            p2 = 0;
        }

        if ($("#pr3").val() == 1) {
            p3 = 10;
        } else {
            p3 = 0;
        }

        if ($("#pr4").val() == 1) {
            p4 = 20;
        } else if ($("#pr4").val() == 2) {
            p4 = 10;
        } else {
            p4 = 0;
        }

        if ($("#pr5").val() == 1) {
            p5 = 10;
        } else {
            p5 = 0;
        }
        /*
        if ($("#pr6").val() == 1) {
            p6 = 14;
        } else {
            p6 = 0;
        }
        */
        if ($("#pr7").val() == 1) {
            p7 = 20;
        } else if ($("#pr7").val() == 2) {
            p7 = 10;
        } else {
            p7 = 0;
        }

        suma = p1 + p2 + p3 + p4 + p5 + p7;

        var data = {
            id: $("#iexpediente").val(),
            n_cliente: inf[1]['nombre'],
            id_c: inf[1]['id'],
            atendio: $("#iatendio").val(),
            fecha: $("#ifecha").val(),
            p1: p1,
            p2: p2,
            p3: p3,
            p4: p4,
            p5: p5,
            p7: p7,
            total: suma
        }
        
        $.ajax({
            url: '/i_ics',
            type: 'POST',
            data: data,
            success: function(result) {
                if (result == 1) {
                    Swal.fire({
                        icon: 'success',
                        title: 'Correcto',
                        text: 'Encuesta Registrada',
                    })
                    document.getElementById('formdata').reset();
                    document.getElementById('formdataa').reset();
                    $("#iexpediente").attr('disabled', false);
                    $("#btn_registrar").attr('disabled', true);
                    $("#info").text('');
                    $("#inf").fadeOut();
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: result,
                    })
                    document.getElementById('formdata').reset();
                    document.getElementById('formdataa').reset();   
                    $("#iexpediente").attr('disabled', false);
                    $("#btn_registrar").attr('disabled', true);
                    $("#info").text('');
                    $("#inf").fadeOut();
                }
            }
        })
        
    })
})