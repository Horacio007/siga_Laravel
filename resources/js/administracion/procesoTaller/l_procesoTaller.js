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
        order: [[8, "desc"], [9, "desc"], [10, "desc"], [11, "desc"]],
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
                $(nRow).find('td:eq(8)').css('background-color', '#FBC89A'); 
            }
            
            var asg_hoja = aData[8].split('/');

            if (asg_hoja[0] == 1){ 
                $(nRow).find('td:eq(8)').css('background-color', '#53ee7e');  
            } else if (asg_hoja[0] == 2) {
                $(nRow).find('td:eq(8)').css('background-color', '#F9FFC9'); 
            }
            
            if (aData[9] == 0) {
                $(nRow).find('td:eq(9)').css('background-color', '#FBC89A'); 
            }

            var asg_pin = aData[9].split('/');

            if (aData[9] == 1){ 
                $(nRow).find('td:eq(9)').css('background-color', '#53ee7e');  
            } else if (aData[9] == 2) {
                $(nRow).find('td:eq(9)').css('background-color', '#F9FFC9'); 
            }
            
            if (aData[10] == 0) {
                $(nRow).find('td:eq(10)').css('background-color', '#FBC89A');
            }
            
            var asg_armado = aData[10].split('/');

            if (aData[10] == 1){ 
                $(nRow).find('td:eq(10)').css('background-color', '#53ee7e');  
            } else if (aData[10] == 2) {
                $(nRow).find('td:eq(10)').css('background-color', '#F9FFC9'); 
            }

            if (aData[11] == 0) {
                $(nRow).find('td:eq(11)').css('background-color', '#FBC89A'); 
            }
            
            var asg_deta = aData[11].split('/');

            if (aData[11] == 1){ 
                $(nRow).find('td:eq(11)').css('background-color', '#53ee7e');  
            } else if (aData[11] == 2) {
                $(nRow).find('td:eq(11)').css('background-color', '#F9FFC9'); 
            }

            if (aData[12] == 0) {
                $(nRow).find('td:eq(12)').css('background-color', '#FBC89A'); 
            }
            
            var asg_mec = aData[12].split('/');

            if (aData[12] == 1){ 
                $(nRow).find('td:eq(12)').css('background-color', '#53ee7e');  
            } else if (aData[12] == 2) {
                $(nRow).find('td:eq(12)').css('background-color', '#F9FFC9'); 
            }

            if (aData[13] == 0) {
                $(nRow).find('td:eq(13)').css('background-color', '#FBC89A'); 
            }
            
            var asg_lav = aData[13].split('/');

            if (aData[13] == 1){ 
                $(nRow).find('td:eq(13)').css('background-color', '#53ee7e');  
            } else if (aData[13]  == 2) {
                $(nRow).find('td:eq(13)').css('background-color', '#F9FFC9'); 
            }

            if (aData[14] == 0) {
                $(nRow).find('td:eq(14)').css('background-color', '#FBC89A');
            }
            
            if (aData[14] == 1){ 
                $(nRow).find('td:eq(14)').css('background-color', '#53ee7e');  
            } else if (aData[14] == 2) {
                $(nRow).find('td:eq(14)').css('background-color', '#F9FFC9'); 
            }
        }
    });
})