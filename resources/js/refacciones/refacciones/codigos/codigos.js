$(document).ready(function(){
    //creacion de codigo de barras
    $("#btn_cbarras").on('click', function(){

        if ($("#icontenido").val() == '') {

            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: 'Favor de Ingresar el Contendio del Codigo de Barras',
            })

            return false;

        } else {

            let valor = $("#icontenido").val();

            JsBarcode("#barcode",'' + valor, {
                height: 50,
                width: 1
            });
        }
        
    })

    $("#btn_cqr").on('click', function(){

        if ($("#icontenido").val() == '') {

            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: 'Favor de Ingresar el Contendio del Codigo de QR',
            })

            return false;

        } else {

            $("#qrcode").empty();
            let valor = $("#icontenido").val();
            var qr = new QRCode(document.getElementById("qrcode"), valor);
        }
        
    })
})