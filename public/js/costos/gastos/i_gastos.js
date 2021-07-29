$(document).ready(function(){

    Swal.fire({
        icon: 'warning',
        title: 'Oops...',
        text: 'Recuerda el No. Expediente aplica con: Materiales de Acabado, Refacciones, T.O.T.\nSi no aplica es "N/A"',
    })

    $('#list_vehiculosgastos').DataTable({
        dom: 'Blfrtip',
        buttons: [{
                extend: 'excelHtml5',
                messageTop: 'Areas',
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
        pageLength: 100
    });

    $("#articulo").on('keyup', function() {
        let data = $(this).val();

        if (data == 'pintura') {
            $("#sfpago").val(3);
            $("#sfactura").val(1);
            $("#cpago").val(5);
            $("#proveedor").val('Global Centro');
        }
    })

    $("#articulo").on('keyup', function(){
        let data = $(this).val();
        if (data == 'Prestamo' || data == 'Préstamo') {
            $("#sfpago").val(2);
            $("#sfactura").val(2);
            $("#cpago").val(3);
            $("#proveedor").val('Empleados DTR');
            $("#expediente").val('N/A');
        }
    })

    $("#expediente").on('keyup', function(){
        var dataa = $(this).val();
        //console.log(dataa)
        $.ajax({
            url: '/siga/controlador/get_idV.php',
            type: 'POST',
            data: {
                id: dataa
            },
            success: function(result){
                //console.log(result);
                $("#expp").fadeIn();
                if (result == 'N/A') {
                    $("#exp").text('No aplica');
                    $("#expp").css('border-radius', '5px');
                    $("#expp").css('background-color', '#53ee7e'); 
                } else {
                    $.ajax({
                        url: '/siga/controlador/existe_vehiculo_gastos.php',
                        type: 'POST',
                        data: {
                            id: dataa
                        },
                        success: function(result){
                            //console.log(result);
                            let arr = JSON.parse(result);

                            if (arr['resultado'] == 0) {
                                $("#exp").text('Vehiculo No Encontrado');
                                $("#expp").css('border-radius', '5px');
                                $("#expp").css('background-color', '#F08080');  
                            } else {
                                $("#exp").text('Vehiculo Encontrado -> ' + arr['marca'] + ' ' + arr['linea'] + ' ' + arr['modelo']);
                                $("#expp").css('border-radius', '5px');
                                $("#expp").css('background-color', '#53ee7e'); 
                            }
                        }
                    })
                }
            }
        })
    })


})