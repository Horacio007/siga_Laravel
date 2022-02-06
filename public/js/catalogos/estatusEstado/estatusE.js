$(document).ready(function(){

    $('#list_estatus').DataTable({
        dom: 'Blfrtip',
        buttons: [{
                extend: 'excelHtml5',
                messageTop: 'Estatus',
                text: "Excel",
                title: "Listado de Estatus",
            },
            {
                /*'csvHtml5',*/
                extend: 'csvHtml5',
                text: "CSV",
                title: "Listado de Estatus",
                messageTop: 'Listado de Estatus',
            },
            {
                extend: 'pdfHtml5',
                title: 'Listado de Estatus'
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

    $("#list_estatus tbody").on('click', '.delete', function(){
        let estatus_id = $(this).attr('item_id');
        let estatus = $(this).parents("tr").find('td').eq(1).html();
        let estatus2 = $(this).parents("tr").find('td').eq(2).html();
        $("#iestatus").val(estatus+' -> '+estatus2);

        let old_url = $("#modal_delete").attr('action');
        let new_url = old_url.replace('delete_item', estatus_id);
        $('#modal_delete').attr('action', new_url);
    })

    $('#btn_delete').on('click', function(){
        $("#modal_delete").submit();
    })

    $("#cerrar").on('click', function(){
        $("#modalD").modal('hide')
    })
})