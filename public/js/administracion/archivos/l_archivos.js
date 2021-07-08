$(document).ready(function(){

    $('#list_archivos').DataTable({
        dom: 'Blfrtip',
        buttons: [{
                extend: 'excelHtml5',
                messageTop: 'Areas',
                text: "Excel",
                title: "Listado de Archivos",
            },
            {
                /*'csvHtml5',*/
                extend: 'csvHtml5',
                text: "CSV",
                title: "Listado de Archivos",
                messageTop: 'Listado de Archivos',
            },
            {
                extend: 'pdfHtml5',
                title: 'Listado de Archivos'
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

    });

    $("#list_archivos tbody tr").on('click', '.delete', function(){
        let area_id = $(this).attr('item_id');
        let expediente = $(this).parents("tr").find('td').eq(1).html();
        let marca = $(this).parents("tr").find('td').eq(2).html();
        let linea = $(this).parents("tr").find('td').eq(3).html();
        let color = $(this).parents("tr").find('td').eq(4).html();
        let modelo = $(this).parents("tr").find('td').eq(5).html();
        let archivo = $(this).parents("tr").find('td').eq(7).html();
        $("#iarea").val(expediente + ' -> ' + marca + ' ' + linea + ' ' + color + ' ' + modelo + 'Archivo -> ' + archivo);

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