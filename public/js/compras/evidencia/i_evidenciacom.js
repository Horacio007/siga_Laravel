$(document).ready(function(){
    $('#list_vehiculo').DataTable({
        dom: 'Blfrtip',
        buttons: [{
                extend: 'excelHtml5',
                messageTop: 'Checklist',
                text: "Excel",
                title: "Listado de Vehiculos",
            },
            {
                /*'csvHtml5',*/
                extend: 'csvHtml5',
                text: "CSV",
                title: "Listado de Vehiculos",
                messageTop: 'Listado de Vehiculos',
            },
            {
                extend: 'pdfHtml5',
                title: 'Listado de Vehiculos'
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
        "pageLength": 100,
    });

    $("#btn_subir").on('click', function(){

        if ($("#iexpediente").val()==0) {
            Swal.fire({
                icon: 'error',
                title: 'Oopps...',
                text: 'Rellena el campo de expediente',
            })
    
            return false
        }
    
        if ($("#izip").val()==0) {
            Swal.fire({
                icon: 'error',
                title: 'Oopps...',
                text: 'Selecciona un archivo',
            })
    
            return false
        }
        

        var data = new FormData(document.getElementById('formdata'));
        var wrapper = $('.wrapper');
        var progress_bar = $('.progress_bar');

        progress_bar.removeClass('bg-success bg-danger').addClass('bg-info');
        progress_bar.css('width', '0%');
        progress_bar.html('Preparando...')
        wrapper.fadeIn();

        $.ajax({
            xhr: function(){
                let xhr = new window.XMLHttpRequest();
                xhr.upload.addEventListener("progress", function(e){
                    if (e.lengthComputable) {
                        let percentComplete = Math.floor((e.loaded / e.total) * 100);

                        progress_bar.css('width', percentComplete + '%');
                        progress_bar.html(percentComplete + '%')
                    }
                }, false)

                return xhr;
            },
            url: '/upload_evidenciaCom',
            type: 'POST',
            data: data,
            processData: false,  // tell jQuery not to process the data
            contentType: false,
            //cache: false,
            beforeSend: () => {
                $("#btn_subir").attr('disabled', true)
            },
            success: function (result){
                if (result == 1) {
                    progress_bar.removeClass('bg-info').addClass('bg-success');
                    progress_bar.html('¡Listo Evidencia Almacenda!');
                    $("#btn_subir").attr('disabled', false);
                    document.getElementById("formdata").reset();
                    setTimeout(() => {
                        wrapper.fadeOut();
                        progress_bar.removeClass('bg-success bg-danger').addClass('bg-info');
                        progress_bar.css('width', '0%');
                    }, 3000);
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Oopps...',
                        text: 'Ocurrio un problema.',
                    })
                    document.getElementById("formdata").reset();
                }
            }
        });

    })
})