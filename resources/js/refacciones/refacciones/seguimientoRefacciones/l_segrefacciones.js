$(document).ready(function(){

    $('#list_segrefacciones').DataTable({
        dom: 'Blfrtip',
        buttons: [{
                extend: 'excelHtml5',
                messageTop: 'Checklist',
                text: "Excel",
                title: "Listado de Seguimiento de Refacciones Asignadas",
            },
            {
                /*'csvHtml5',*/
                extend: 'csvHtml5',
                text: "CSV",
                title: "Listado de Seguimiento de Refacciones Asignadas",
                messageTop: 'Listado de Seguimiento de Refacciones Asignadas',
            },
            {
                extend: 'pdfHtml5',
                title: 'Listado de Seguimiento de Refacciones Asignadas'
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
        pageLength:100,
        order: [[9, "asc" ]],
        rowCallback: function(nRow, aData) {
            //antes de dar entrada a las refacciones que faltan de llegar
            let f_p = new Date(aData[8]);
            let f1 = new Date();
            let f2 = f1.getFullYear() + '-' + (f1.getMonth() +1) + "-" +  f1.getDate();
            let f_a = new Date(f2);
            let milisegd = 24 * 60 * 60 * 1000;
            let milisegt = Math.abs(f_a.getTime() - f_p.getTime());
            let dias = Math.round(milisegt / milisegd)
            //
            let f_ll = new Date(aData[9]);
            let milisegdd = 24 * 60 * 60 * 1000;
            let milisegtt = Math.abs(f_ll.getTime() - f_p.getTime());
            let diassss = Math.round(milisegtt / milisegdd)
            
            //console.log(dias)
            if (f_a < f_p) {
                $(nRow).find('td:eq(8)').css('background-color', '#53ee7e');
            }
            
            if (dias == 2) {
                $(nRow).find('td:eq(8)').css('background-color', '#FFF890'); 
            }

            if (dias == 1) {
                $(nRow).find('td:eq(8)').css('background-color', '#FFF890'); 
            }

            if (f_a > f_p) {
                $(nRow).find('td:eq(8)').css('background-color', '#F08080');
            }

            if (dias == 0) {
                $(nRow).find('td:eq(8)').css('background-color', '#FFF890'); 
            }
        } 

    });

    $("#list_segrefacciones tbody").on('click', '.delete', function(){
        let area_id = $(this).attr('item_id');
        //let expediente = $(this).parents("tr").find('td').eq(1).html();
        let aseguradora =  $(this).parents("tr").find('td').eq(2).html();
        let descripcion =  $(this).parents("tr").find('td').eq(3).html();
        let marca =  $(this).parents("tr").find('td').eq(4).html();
        let linea =  $(this).parents("tr").find('td').eq(5).html();
        let modelo =  $(this).parents("tr").find('td').eq(6).html();
        let expediente =  $(this).parents("tr").find('td').eq(1).html();
        $("#iarea").val('');
        $("#iarea").val(aseguradora + ' -> ' + ' ' + descripcion + ' ' + marca + ' ' + linea + ' ' + modelo + ' ' + expediente);

        let old_url = $("#modal_delete").attr('action');
        let new_url = old_url.replace('delete_item', area_id);
        $('#modal_delete').attr('action', new_url);
    })

    $('#btn_delete').on('click', function(){
        $("#modal_delete").submit();
    })

    $("#cerrar").on('click', function(){
        $("#modalD").modal('hide')
    })
})