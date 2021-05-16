$(document).ready(function(){
    $('#list_asesores').DataTable({
        dom: 'Blfrtip',
        buttons: [{
                extend: 'excelHtml5',
                messageTop: 'Asesores',
                text: "Excel",
                title: "Listado de Asesores",
            },
            {
                /*'csvHtml5',*/
                extend: 'csvHtml5',
                text: "CSV",
                title: "Listado de Asesores",
                messageTop: 'Listado de Asesores',
            },
            {
                extend: 'pdfHtml5',
                title: 'Listado de Asesores'
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
    


    $("#list_asesores tbody tr").on('click', '.delete', function(){
        let asesor_id = $(this).attr('item_id');
        console.log(asesor_id)
        let aseguradora = $(this).parents("tr").find('td').eq(1).html();
        let nombre = $(this).parents("tr").find('td').eq(2).html();
        let ap = $(this).parents("tr").find('td').eq(3).html();
        let am = $(this).parents("tr").find('td').eq(4).html();
        let nc = nombre + ' ' + ap + ' ' + am;
        $("#iaseguradora").val(aseguradora)
        $("#inombre").val(nc);

        let old_url = $("#modal_delete").attr('action');
        let new_url = old_url.replace('delete_item', asesor_id);
        $('#modal_delete').attr('action', new_url);
    })

    $('#btn_delete').on('click', function(){
        console.log('entra');
        $("#modal_delete").submit();
    })
    
    $("#cerrar").on('click', function(){
        $("#modalD").modal('hide')
    })
})