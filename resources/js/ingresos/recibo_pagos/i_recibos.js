$(document).ready(function(){
    var inf;
    $('#list_vehiculos').DataTable({
        dom: 'Blfrtip',
        buttons: [{
                extend: 'excelHtml5',
                messageTop: 'Areas',
                text: "Excel",
                title: "Listado de Vehiculos Entregados",
            },
            {
                /*'csvHtml5',*/
                extend: 'csvHtml5',
                text: "CSV",
                title: "Listado de Vehiculos Entregados",
                messageTop: 'Listado de Vehiculos Entregados',
            },
            {
                extend: 'pdfHtml5',
                title: 'Listado de Vehiculos Entregados'
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

    $("#btn_buscar").on('click', function(){

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
                            $("#cliente").val(result[1]['id']);
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
                    }
                }
            }
        })
    })

    $("#btn_registrar").on('click', function(){
        if ($("#iexpediente").val() == "") {
            
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: 'Ingresa el Expediente',
            })

            return false
        }

        if ($("#fecha").val() == "") {
            
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: 'Ingresa la fecha',
            })

            return false
        }

        if ($("#cantidad").val() == "") {
            
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: 'Ingresa la cantidad',
            })

            return false
        }

        if ($("#cantidad").val() == "") {
            
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: 'Ingresa la cantidad',
            })

            return false
        }
        
        if ($("#tipo_pago").val()==0) {
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: 'Ingresa el tipo de pago',
            })
              
            return false
        }

        if ($("#concepto").val()==0) {
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: 'Ingresa el concepto',
            })
              
            return false
        }

        const doc = new jsPDF();
        doc.addImage('/img/recibo_depago.jpg', 'jpg', 0, 0, 210, 300);
        doc.setFontSize(12);
        let f1 = new Date();
        let f2 = f1.getDate() + "-" + (f1.getMonth() +1) + "-" + f1.getFullYear()
        doc.text(160, 58.5, f2)
        doc.text(160, 184, f2)
        doc.text(160, 63.8, $("#iexpediente").val());
        doc.text(160, 190, $("#iexpediente").val());
        if (inf[2] != null) {
            let folio = Number(inf[2]['id']) + 1;
            doc.text(160, 69, '' + folio);
            doc.text(160, 195, '' + folio);
            $("#folio").val(folio);
        } else {
            $("#folio").val(1);
            doc.text(160, 69, '1');
            doc.text(160, 195, '1');
        }
        doc.text(52, 77, inf[1]['nombre']);
        doc.text(52, 203, inf[1]['nombre']);
        doc.text(60, 83, '$' + $("#cantidad").val());
        doc.text(60, 209, '$' + $("#cantidad").val());
        doc.text(65, 90, inf[0]['marcas']['marca'] + ' ' + inf[0]['submarcas']['submarca'] + ' ' + inf[0]['modelo'] + ' ' + inf[0]['color'] + ' ' + inf[0]['placas']+ ' ' + inf[0]['clientes']['nombre']);
        doc.text(65, 215, inf[0]['marcas']['marca'] + ' ' + inf[0]['submarcas']['submarca'] + ' ' + inf[0]['modelo'] + ' ' + inf[0]['color'] + ' ' + inf[0]['placas']+ ' ' + inf[0]['clientes']['nombre']);
        if ($("#concepto").val() < 54) {
            doc.text(65, 95, $("#concepto").val());
        } else {
            let concepto = $("#concepto").val().slice(55);
            let concepto2 = $("#concepto").val().slice(0, 54);
            doc.text(65, 95, concepto2);
            doc.text(65, 100, concepto);
            doc.text(65, 220, concepto2);
            doc.text(65, 225, concepto);
        }
        doc.text(65, 117.5, $("#tipo_pago option:selected").text());
        doc.text(65, 238, $("#tipo_pago option:selected").text());
        doc.save('' + $("#iexpediente").val() +'_recibo_pago');
    })

})