$(document).ready(function(){
    var inf = [];
    $("#btn_crear").attr('disabled', true);
    $("#btn_agregar").attr('disabled', true);
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
                            if (result[0]['clientes'] == 3) {
                                $("#info").text('Vehiculo: '+ result[0]['marcas']['marca'] + ' ' + result[0]['submarcas']['submarca'] + ' ' + result[0]['color'] + ' ' + result[0]['modelo'] + ' ' + result[0]['clientes']['nombre'] + ' Diagnostico Inicial -> ' + result[0]['proveedor_1']);
                            } else {
                                $("#info").text('Vehiculo: '+ result[0]['marcas']['marca'] + ' ' + result[0]['submarcas']['submarca'] + ' ' + result[0]['color'] + ' ' + result[0]['modelo'] + ' ' + result[0]['clientes']['nombre']);
                            }
                            $("#iexpediente2").val($("#iexpediente").val());
                            $("#btn_agregar").attr('disabled', false);  
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

    var diagnostico = [];
    $("#btn_agregar").on('click', function(){
        // saco la informacion
        if ($("#idiagnostico").val() == '') {
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: 'Ingresa la Obervacion del cliente.',
            })
              
            return false
        }

        diagnostico.push($("#idiagnostico").val());

        //le quito el no jalar cuando tiene un vslor de mas de uno 
        if (diagnostico[0] != '') {
            $("#btn_crear").attr('disabled', false);
        } 

        //le reinicio la informacion :v
        $("#idiagnostico").val('') 

        if (diagnostico.length == 10) {
            Swal.fire({
                icon: 'warning',
                title: 'Oopps...',
                text: 'Sobrepasaste 10 conceptos, debe crear una nueva Orden de Mecanica',
            })
        }

        $("#idiagnostico").focus();
    })

    $("#btn_crear").on('click', function(){
        // Default export is a4 paper, portrait, using millimeters for units
        const doc = new jsPDF();
        doc.addImage('/img/orden_mecanica.jpg', 'jpg', 0, 0, 210, 300)
        doc.setFontSize(12)
        let f1 = new Date();
        let f2 = f1.getDate() + "/" + (f1.getMonth() +1) + "/" + f1.getFullYear()
        doc.text(25, 12, f2)
        doc.text(25, 16.8, inf[0]['marcas']['marca']);
        doc.text(25, 21.5, inf[0]['submarcas']['submarca']);
        doc.text(25, 25.8, inf[0]['modelo']);
        doc.text(25, 30.5, inf[0]['color']);
        doc.text(25, 35, inf[0]['placas']);
        doc.text(92, 16.8, $("#iexpediente").val());
        doc.text(92, 21.5, inf[0]['clientes']['nombre']);
        var y = 48.5;
        var yy = 48.5;
        for (let i = 0; i < diagnostico.length; i++) {
            if (diagnostico.length > 70) {
                let l1 = diagnostico[i].slice(0, 67)
                let l2 = diagnostico[i].slice(67, 134)
                doc.text(25, y, l1);
                y = y + 4.5;
                doc.text(25, y, l2);
                y = y + 4.5;
            } else {
                doc.text(25, yy, diagnostico[i]);
                yy = yy + 4.5;
            }
        }
        
        doc.save($("#iexpediente").val() + "_orden_mecanica.pdf");

        var data = {
            id: $("#iexpediente").val(),
            fecha: f2,
            diagnostico: diagnostico,
            elaboro: inf[0]['asesores']['id']
        }

        $.ajax({
            url: '/i_ordenesm',
            type: 'POST',
            data : data,
            success: function (result) {
                if (result == 1) {
                    Swal.fire({
                        icon: 'success',
                        title: 'Correcto',
                        text: 'Orden de Mecanica registrada',
                    })
                    document.getElementById("formdata").reset();
                    document.getElementById("formdataa").reset();
                    $("#info").text('');
                    $("#inf").fadeOut();
                    $("#iexpediente").removeAttr("readonly");
                    $("#btn_crear").attr('disabled', true);
                    $("#btn_agregar").attr('disabled', true);
                    diagnostico.length = 0;
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: result,
                    })
                    document.getElementById("formdata").reset();
                    document.getElementById("formdataa").reset();
                    $("#info").text('');
                    $("#inf").fadeOut();
                    $("#iexpediente").removeAttr("readonly");
                    $("#btn_crear").attr('disabled', true);
                    $("#btn_agregar").attr('disabled', true);
                    diagnostico.length = 0;
                }
            }
        })
    })
})