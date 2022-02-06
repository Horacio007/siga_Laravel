$(document).ready(function(){

    $('#list_proceso').DataTable({
        dom: 'Blfrtip',
        buttons: [{
                extend: 'excelHtml5',
                messageTop: 'Areas',
                text: "Excel",
                title: "Listado de Proceso Administrativo",
            },
            {
                /*'csvHtml5',*/
                extend: 'csvHtml5',
                text: "CSV",
                title: "Listado de Proceso Administrativo",
                messageTop: 'Listado de Proceso Administrativo',
            },
            {
                extend: 'pdfHtml5',
                title: 'Listado de Proceso Administrativo'
            }
        ],
        responsive: true,
        destroy: true,
        order: [[10, "desc"], [12, "desc"], [14, "desc"], [16, "desc"]],
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
            if (aData[8] == 0) {
                $(nRow).find('td:eq(8)').css('background-color', '#53ee7e');
            }

            if (aData[9] >= 0 && aData[9] <= 2) {
                $(nRow).find('td:eq(9)').css('background-color', '#53ee7e'); 
            } else {
                $(nRow).find('td:eq(9)').css('background-color', '#F08080');
            }

            if (aData[10] == 'Autorizado') {
                $(nRow).find('td:eq(10)').css('background-color', '#53ee7e');
            } else {
                $(nRow).find('td:eq(10)').css('background-color', '#F9FFC9');
            }

            if (aData[11] >= 0 && aData[11] <= 3) {
                $(nRow).find('td:eq(11)').css('background-color', '#53ee7e');
            } else {
                $(nRow).find('td:eq(11)').css('background-color', '#F08080');
            }

            if (aData[12] == 'Autorizado') {
                $(nRow).find('td:eq(12)').css('background-color', '#53ee7e');
            } else {
                $(nRow).find('td:eq(12)').css('background-color', '#F9FFC9');
            }

            if (aData[13] >= 0 && aData[13] <= 4) {
                $(nRow).find('td:eq(13)').css('background-color', '#53ee7e');
            } else {
                $(nRow).find('td:eq(13)').css('background-color', '#F08080');
            }

            if (aData[14] == 'Autorizado') {
                $(nRow).find('td:eq(14)').css('background-color', '#53ee7e');
            } else {
                $(nRow).find('td:eq(14)').css('background-color', '#F9FFC9');
            }

            if (aData[15] >= 0 && aData[15] <= 7) {
                $(nRow).find('td:eq(15)').css('background-color', '#53ee7e');
            } else {
                $(nRow).find('td:eq(15)').css('background-color', '#F08080');
            }

            if (aData[16] == 'Autorizado') {
                $(nRow).find('td:eq(16)').css('background-color', '#53ee7e');
            } else {
                $(nRow).find('td:eq(16)').css('background-color', '#F9FFC9');
            }
        }
    });
})