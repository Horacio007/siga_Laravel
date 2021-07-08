$(document).ready(function(){

    $('#list_almacenref').DataTable({
        dom: 'Blfrtip',
        buttons: [{
                extend: 'excelHtml5',
                messageTop: 'Estatus Almacen',
                text: "Excel",
                title: "Listado de Estatus Almacen",
            },
            {
                /*'csvHtml5',*/
                extend: 'csvHtml5',
                text: "CSV",
                title: "Listado de Estatus Almacen",
                messageTop: 'Listado de Estatus Almacen',
            },
            {
                extend: 'pdfHtml5',
                title: 'Listado de Estatus Almacen'
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

    $("#list_almacenref tbody").on('click', '.delete', function(){
        let marca_id = $(this).attr('item_id');
        let marca = $(this).parents("tr").find('td').eq(1).html();
        $("#iarea").val(marca);

        let old_url = $("#modal_delete").attr('action');
        let new_url = old_url.replace('delete_item', marca_id);
        $('#modal_delete').attr('action', new_url);
    })

    $('#btn_delete').on('click', function(){
        $("#modal_delete").submit();
    })

    $("#cerrar").on('click', function(){
        $("#modalD").modal('hide')
    })
})