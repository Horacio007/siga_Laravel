$(document).ready(function(){
    $("#articulo").on('keyup', function() {
        let data = $(this).val();

        if (data == 'pintura') {
            $("#sfpago").val(3);
            $("#sfactura").val(1);
            $("#cpago").val(5);
            $("#proveedor").val('Global Centro');
        }
    })

    $("#articulo").on('keyup', function(){
        let data = $(this).val();
        if (data == 'Prestamo' || data == 'Préstamo') {
            $("#sfpago").val(2);
            $("#sfactura").val(2);
            $("#cpago").val(3);
            $("#proveedor").val('Empleados DTR');
            $("#expediente").val('N/A');
        }
    })

    if ($("#tgasto").val() != 6 || $("#tgasto").val() != 9) {
        $("#expediente").val('N/A');
        $("#info").text('No aplica');
        $("#inf").css('border-radius', '5px');
        $("#inf").css('background-color', '#53ee7e'); 
    }

    $("#expediente").on('keyup', function(){
        var dataa = $(this).val();
        
        if (dataa == 'N/A') {
            $("#info").text('No aplica');
            $("#inf").css('border-radius', '5px');
            $("#inf").css('background-color', '#53ee7e'); 
        } else {
            $.ajax({
                url: 'existe_vehiculo_gastos',
                type: 'GET',
                data: {
                    id: dataa
                },
                success: function(result){
                    //console.log(result)
                    if (result['resultado'] == 0) {
                        $("#exp").text('Vehiculo No Encontrado');
                        $("#expp").css('border-radius', '5px');
                        $("#expp").css('background-color', '#F08080');  
                    } else {
                        $("#inf").fadeIn();
                        $("#inf").css('border-radius', '5px');
                        $("#inf").css('background-color', '#53ee7e'); 
                        $("#info").text('Vehiculo: '+ result['marcas']['marca'] + ' ' + result['submarcas']['submarca'] + ' ' + result['color'] + ' ' + result['modelo'] + ' ' + result['clientes']['nombre']);
                        $("#iexpediente2").val($("#iexpediente").val()); 
                    }
                }
            })
        }
    })
})