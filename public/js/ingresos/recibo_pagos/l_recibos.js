$(document).ready(function(){

    $('#list_areas').DataTable({
        dom: 'Blfrtip',
        buttons: [{
                extend: 'excelHtml5',
                messageTop: 'Areas',
                text: "Excel",
                title: "Listado de Areas",
            },
            {
                /*'csvHtml5',*/
                extend: 'csvHtml5',
                text: "CSV",
                title: "Listado de Areas",
                messageTop: 'Listado de Areas',
            },
            {
                extend: 'pdfHtml5',
                title: 'Listado de Areas'
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

    $("#list_areas tbody").on('click', '.delete', function(){
        let area_id = $(this).attr('item_id');
        let fecha = $(this).parents("tr").find('td').eq(1).html();
        let marca = $(this).parents("tr").find('td').eq(3).html();
        let linea = $(this).parents("tr").find('td').eq(6).html();
        let color = $(this).parents("tr").find('td').eq(7).html();
        let modelo = $(this).parents("tr").find('td').eq(8).html();
        let placas = $(this).parents("tr").find('td').eq(9).html();
        let cliente = $(this).parents("tr").find('td').eq(10).html();
        let cantidad = $(this).parents("tr").find('td').eq(12).html();
        let concepto = $(this).parents("tr").find('td').eq(13).html();
        $("#iarea").val(fecha+' Expediente -> '+marca+' '+linea+' '+color+' '+modelo+' '+placas+' '+cliente+' Cantidad -> $'+cantidad+' Concepto -> '+concepto);

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