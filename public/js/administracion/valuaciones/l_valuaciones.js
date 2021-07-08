$(document).ready(function(){

    $('#list_valuaciones').DataTable({
        dom: 'Blfrtip',
        buttons: [{
                extend: 'excelHtml5',
                messageTop: 'Areas',
                text: "Excel",
                title: "Listado de Valuaciones",
            },
            {
                /*'csvHtml5',*/
                extend: 'csvHtml5',
                text: "CSV",
                title: "Listado de Valuaciones",
                messageTop: 'Listado de Valuaciones',
            },
            {
                extend: 'pdfHtml5',
                title: 'Listado de Valuaciones'
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
        pageLength: 100,
        rowCallback: function(nRow, aData){
            if (aData[14] >= 0 && aData[14] <= 13) {
                $(nRow).find('td:eq(14)').css('background-color', '#53ee7e');
            }

            if (aData[14] > 3) {
                $(nRow).find('td:eq(14)').css('background-color', '#F08080');
            }

            if (aData[14] == 0) {
                $(nRow).find('td:eq(14)').css('background-color', '#53ee7e');
            }

            //dudas de porque dice 19 
            //

            if (aData[24] != null || aDta[24] != 0) {
                if (aData[24] > 0.00 && aData[24] < 50.00) { 
                    $(nRow).find('td:eq(24)').css('background-color', '#F08080');  
                }else if (aData[24] >= 50.00) {
                    $(nRow).find('td:eq(24)').css('background-color', '#53ee7e'); 
                }
            }

            if(aData[25] != null){
                            
                if (aData[25] > 0.00 && aData[25] < 80.00) { 
                    $(nRow).find('td:eq(25)').css('background-color', '#F08080');  
                }else if (aData[25] >= 80.00) {
                    $(nRow).find('td:eq(25)').css('background-color', '#53ee7e'); 
                }
            }

            let estatus = aData[1].split('/');

            if (estatus[0] == 'Transito') {

                if (estatus[1] >= 0 && estatus[1] <= 20) {
                    $(nRow).find('td:eq(1)').css('background-color', '#53ee7e'); 
                }

                if (estatus[1] > 20) {
                    $(nRow).find('td:eq(1)').css('background-color', '#F08080');
                }
            }

            if (estatus[0] == 'Taller') {

                if (estatus[1] >= 0 && estatus[1] <= aData[2]) {
                    $(nRow).find('td:eq(1)').css('background-color', '#53ee7e'); 
                }

                if (estatus[1] > aData[2]) {
                    $(nRow).find('td:eq(1)').css('background-color', '#F08080');
                }

                if (aData[2] == 0 || aData[2] == "" || aData[2] == null) {
                    $(nRow).find('td:eq(1)').css('background-color', '#53ee7e'); 
                }
            }
        }
    });
})