$(document).ready(function(){
    var inf;
    $("#btn_buscar").on('click', function(){

        if ($("#iexpediente").val() == "") {
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: 'Ingresa el Numero de Expediente',
            })
              
            return false
        }
        
        $.ajax({
            url: '/e_chv',
            type: 'GET',
            data: {
                id: $("#iexpediente").val()
            },
            success: function(result){
                if (result['vehiculo'] == 1) {
                    Swal.fire({
                        icon: 'success',
                        title: 'Correcto',
                        text: 'Vehiculo Encontrado',
                    })
                    $("#iexpediente").attr("readonly","readonly");
                        $.ajax({
                            url: '/mlmca',
                            type: 'GET',
                            data: {
                                id: $("#iexpediente").val()
                            },
                            success: function(result){
                                inf = result;
                                $("#inf").fadeIn();
                                $("#inf").css('border-radius', '5px');
                                $("#inf").css('background-color', '#53ee7e'); 
                                $("#info").text('Vehiculo: '+ result[0]['marcas']['marca'] + ' ' + result[0]['submarcas']['submarca'] + ' ' + result[0]['color'] + ' ' + result[0]['modelo'] + ' ' + result[0]['clientes']['nombre']);
                                $("#iexpediente2").val($("#iexpediente").val());
                            }
                        })         
                } else {
                    if (result['vehiculo'] == 0) {
                        Swal.fire({
                            icon: 'error',
                            title: 'Oops...',
                            text: 'Vehiculo no encontrado y/o registrado',
                        })
                        document.getElementById("formdataa").reset();
                    } else if (result['vehiculo'] == 00) {
                        Swal.fire({
                            icon: 'error',
                            title: 'Oops...',
                            text: 'Checklist ya creado',
                        })
                        document.getElementById("formdataa").reset();
                    }
                    
                }
            }
        })
    })

    $("#btn_registrar").on('click', function(){
        const doc = new jsPDF();
        doc.addImage('/img/checklist.jpg', 'jpg', 0, 0, 210, 300);
        doc.text(160, 15, $("#iexpediente").val());
        doc.setFontSize(12);
        let f1 = new Date();
        let f2 = f1.getDate() + "       " + (f1.getMonth() +1) + "        " + f1.getFullYear()
        doc.text(160, 35, f2)
        doc.text(35, 55, '' + inf[1]['nombre']);
        doc.text(37, 63.5, '' + inf[1]['telefono']);
        doc.text(35, 72, '' + inf[1]['correo']);
        doc.text(110, 54, '' + inf[0]['marcas']['marca']);
        doc.text(115, 62, '' + inf[0]['submarcas']['submarca']);
        doc.text(113, 70, '' + inf[0]['modelo']);
        doc.text(111, 78, '' + inf[0]['color']);
        doc.text(112, 86, '' + inf[0]['placas']);
        if (inf[0]['clientes']['nombre'] == 'Particular') {
            doc.text(169.5, 71, 'X');
        } else {
            doc.text(160, 59, '' + inf[0]['clientes']['nombre']);
        }
        
        doc.save('' + $("#iexpediente").val() +'_checklist');
        //$("#formdata").submit();
    })
    
})