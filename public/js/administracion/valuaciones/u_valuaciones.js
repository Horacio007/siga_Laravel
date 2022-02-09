$(document).ready(function(){
    $("#sestatus").on('change', function(){
        $.ajax({
            url: '/listado_estatusProceso',
            type: 'POST',
            data: {
                proceso_select: true,
                id_ubicacion: $(this).val()
            },
            success: function(result) {
                $('#sproceso').empty();
                $('#sproceso').prepend(result['proceso'])
            }
        })
    })
})