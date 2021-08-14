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

    //Firma
    var wrapper = document.getElementById("signature-pad");
    var canvas = wrapper.querySelector("canvas");
    var signaturePad = new SignaturePad(canvas, {
        backgroundColor: 'rgb(255, 255, 255)'
    });
    
    function resizeCanvas() {
    
        var ratio =  Math.max(window.devicePixelRatio || 1, 1);
    
        canvas.width = canvas.offsetWidth * ratio;
        canvas.height = canvas.offsetHeight * ratio;
        canvas.getContext("2d").scale(ratio, ratio);
    
        signaturePad.clear();
    }
    
    window.onresize = resizeCanvas;
    resizeCanvas();

    $("#clear").on('click', function(){
        signaturePad.clear();
    })
    //endcliente

    var wrapper2 = document.getElementById("signature-pad2");
    var canvas2 = wrapper2.querySelector("canvas");
    var signaturePad2 = new SignaturePad(canvas2, {
        backgroundColor: 'rgb(255, 255, 255)'
    });
    
    function resizeCanvas2() {
    
        var ratio =  Math.max(window.devicePixelRatio || 1, 1);
    
        canvas2.width = canvas2.offsetWidth * ratio;
        canvas2.height = canvas2.offsetHeight * ratio;
        canvas2.getContext("2d").scale(ratio, ratio);
    
        signaturePad2.clear();
    }
    
    window.onresize = resizeCanvas2;
    resizeCanvas2();

    $("#clear2").on('click', function(){
        signaturePad2.clear();
    })
    //endFirma

    $("#btn_registrar").on('click', function(){

        if (signaturePad.isEmpty() && signaturePad2.isEmpty()) {
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: 'Solicita las firmas requeridas',
            })
              
            return false
        }

        if ($("#sgasolina").val()==0) {
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: 'Ingresa la cantidad de gasolina',
            })
              
            return false
        }

        $("#firma_c").val(signaturePad.toDataURL("image/jpeg"));
        $("#firma_a").val(signaturePad2.toDataURL("image/jpeg"));

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
         //exterior
         if( $("#lucesfrontales").prop('checked') ) {
            doc.text(54, 136.5, 'X');
        }else{
            doc.text(59, 136.5, 'X');
        }

        if( $("#cuartoluces").prop('checked') ) {
            doc.text(54, 142, 'X');
        }else{
            doc.text(59, 142, 'X');
        }

        if( $("#direccionalizq").prop('checked') ) {
            doc.text(54, 147.5, 'X');
        }else{
            doc.text(59, 147.5, 'X');
        }

        if( $("#direccionalder").prop('checked') ) {
            doc.text(54, 152.5, 'X');
        }else{
            doc.text(59, 152.5, 'X');
        }

        if( $("#espejoder").prop('checked') ) {
            doc.text(54, 157.5, 'X');
        }else{
            doc.text(59, 157.5, 'X');
        }

        if( $("#espejoizq").prop('checked') ) {
            doc.text(54, 162.5, 'X');
        }else{
            doc.text(59, 162.5, 'X');
        }

        if( $("#cristales").prop('checked') ) {
            doc.text(54, 167.5, 'X');
        }else{
            doc.text(59, 167.5, 'X');
        }

        if( $("#emblemas").prop('checked') ) {
            doc.text(54, 173.5, 'X');
        }else{
            doc.text(59, 173.5, 'X');
        }

        if( $("#llantas").prop('checked') ) {
            doc.text(54, 178, 'X');
        }else{
            doc.text(59, 178, 'X');
        }

        if( $("#tapon_ruedas").prop('checked') ) {
            doc.text(54, 183.3, 'X');
        }else{
            doc.text(59, 183.3, 'X');
        }

        if( $("#molduras").prop('checked') ) {
            doc.text(54, 188, 'X');
        }else{
            doc.text(59, 188, 'X');
        }

        if( $("#tapa_gasolina").prop('checked') ) {
            doc.text(54, 193.5, 'X');
        }else{
            doc.text(59, 193.5, 'X');
        }

        if( $("#stop").prop('checked') ) {
            doc.text(54, 198.5, 'X');
        }else{
            doc.text(59, 198.5, 'X');
        }

        if( $("#luz_tras_izq").prop('checked') ) {
            doc.text(54, 204, 'X');
        }else{
            doc.text(59, 204, 'X');
        }

        if( $("#luz_tras_der").prop('checked') ) {
            doc.text(54, 209.5, 'X');
        }else{
            doc.text(59, 209.5, 'X');
        }

        if( $("#direccional_tras_izq").prop('checked') ) {
            doc.text(54, 214.5, 'X');
        }else{
            doc.text(59, 214.5, 'X');
        }

        if( $("#direccional_tras_der").prop('checked') ) {
            doc.text(54, 219.5, 'X');
        }else{
            doc.text(59, 219.5, 'X');
        }

        if( $("#luz_placa").prop('checked') ) {
            doc.text(54, 224.5, 'X');
        }else{
            doc.text(59, 224.5, 'X');
        }

        if( $("#luz_cajuela").prop('checked') ) {
            doc.text(54, 229.5, 'X');
        }else{
            doc.text(59, 229.5, 'X');
        }
        //endexterior

        //interior
        if( $("#luztablero").prop('checked') ) {
            doc.text(109, 137.5, 'X');
        }else{
            doc.text(116, 137.5, 'X');
        }

        if( $("#instrumentostablero").prop('checked') ) {
            doc.text(109, 142.8, 'X');
        }else{
            doc.text(116, 142.8, 'X');
        }

        if( $("#llaves").prop('checked') ) {
            doc.text(109, 148.1, 'X');
        }else{
            doc.text(116, 148.1, 'X');
        }

        if( $("#limpiaparabrisasfront").prop('checked') ) {
            doc.text(109, 153.2, 'X');
        }else{
            doc.text(116, 153.2, 'X');
        }

        if( $("#limpiaparabrisastras").prop('checked') ) {
            doc.text(109, 158.4, 'X');
        }else{
            doc.text(116, 158.4, 'X');
        }

        if( $("#estereo").prop('checked') ) {
            doc.text(109, 163.7, 'X');
        }else{
            doc.text(116, 163.7, 'X');
        }

        if( $("#bocinasfront").prop('checked') ) {
            doc.text(109, 169, 'X');
        }else{
            doc.text(116, 169, 'X');
        }

        if( $("#bocinastras").prop('checked') ) {
            doc.text(109, 174.3, 'X');
        }else{
            doc.text(116, 174.3, 'X');
        }

        if( $("#encendedor").prop('checked') ) {
            doc.text(109, 179, 'X');
        }else{
            doc.text(116, 179, 'X');
        }

        if( $("#espejoretro").prop('checked') ) {
            doc.text(109, 184, 'X');
        }else{
            doc.text(116, 184, 'X');
        }

        if( $("#cenicero").prop('checked') ) {
            doc.text(109, 189, 'X');
        }else{
            doc.text(116, 189, 'X');
        }
        
        if( $("#cinturones").prop('checked') ) {
            doc.text(109, 194, 'X');
        }else{
            doc.text(116, 194, 'X');
        }

        if( $("#luzinterior").prop('checked') ) {
            doc.text(109, 200, 'X');
        }else{
            doc.text(116, 200, 'X');
        }

        if( $("#parasolizq").prop('checked') ) {
            doc.text(109, 205, 'X');
        }else{
            doc.text(116, 205, 'X');
        }

        if( $("#parasolder").prop('checked') ) {
            doc.text(109, 210, 'X');
        }else{
            doc.text(116, 210, 'X');
        }

        if( $("#vestidurastela").prop('checked') ) {
            doc.text(109, 215, 'X');
        }else{
            doc.text(116, 215, 'X');
        }

        if( $("#vestiduraspiel").prop('checked') ) {
            doc.text(109, 220, 'X');
        }else{
            doc.text(116, 220, 'X');
        }

        if( $("#testigostablero").prop('checked') ) {
            doc.text(109, 225, 'X');
        }else{
            doc.text(116, 225, 'X');
        }
        //endinterior

        //accesorios
        if( $("#refaccion").prop('checked') ) {
            doc.text(163.5, 139, 'X');
        }else{
            doc.text(169.5, 139, 'X');
        }

        if( $("#dadoseguridad").prop('checked') ) {
            doc.text(163.5, 145, 'X');
        }else{
            doc.text(169.5, 145, 'X');
        }

        if( $("#gato").prop('checked') ) {
            doc.text(163.5, 150, 'X');
        }else{
            doc.text(169.5, 150, 'X');
        }

        if( $("#maneral").prop('checked') ) {
            doc.text(163.5, 156, 'X');
        }else{
            doc.text(169.5, 156, 'X');
        }

        if( $("#herramientas").prop('checked') ) {
            doc.text(163.5, 162, 'X');
        }else{
            doc.text(169.5, 162, 'X');
        }

        if( $("#triangulo").prop('checked') ) {
            doc.text(163.5, 168, 'X');
        }else{
            doc.text(169.5, 168, 'X');
        }

        if( $("#botiquin").prop('checked') ) {
            doc.text(163.5, 174, 'X');
        }else{
            doc.text(169.5, 174, 'X');
        }

        if( $("#extintor").prop('checked') ) {
            doc.text(163.5, 180, 'X');
        }else{
            doc.text(169.5, 180, 'X');
        }

        if( $("#cables").prop('checked') ) {
            doc.text(163.5, 185, 'X');
        }else{
            doc.text(169.5, 185, 'X');
        }
        //endaccesorios

        //componentesmecanicos
        if( $("#claxon").prop('checked') ) {
            doc.text(167, 198, 'X');
        }else{
            doc.text(173, 198, 'X');
        }

        if( $("#taponaceite").prop('checked') ) {
            doc.text(167, 203, 'X');
        }else{
            doc.text(173, 203, 'X');
        }

        if( $("#tapongasolin").prop('checked') ) {
            doc.text(167, 208, 'X');
        }else{
            doc.text(173, 208, 'X');
        }

        if( $("#taponradiador").prop('checked') ) {
            doc.text(167, 213, 'X');
        }else{
            doc.text(173, 213, 'X');
        }

        if( $("#vayoneta").prop('checked') ) {
            doc.text(167, 218.5, 'X');
        }else{
            doc.text(173, 218.5, 'X');
        }

        if( $("#bateria").prop('checked') ) {
            doc.text(167, 224, 'X');
        }else{
            doc.text(173, 224, 'X');
        }
        //endcomponentesmecanicos

        doc.setFontSize(15);
        //gasolina
        if ($("#sgasolina").val() == 1) {
            doc.text(158, 237.5, '|');
        }

        if ($("#sgasolina").val() == 2) {
            doc.text(166, 240, '|');
        }

        if ($("#sgasolina").val() == 3) {
            doc.text(175, 241, '|');
        }

        if ($("#sgasolina").val() == 4) {
            doc.text(184, 241, '|');
        }

        if ($("#sgasolina").val() == 5) {
            doc.text(193, 238, '|');
        }
        //endgasolina

        //km
        doc.text(170, 276, '' + $("#ikilometraje").val());
        //endkm
        doc.setFontSize(12);
        //observaciones
        let obs = $("#iobservaciones").val();
        let obss = obs.split('/');
        let y = 240;
        if (obss.length > 6) {
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: 'No puedes registrar mas de 6 observaciones',
            })
              
            return false
        } else {
            for (let i = 0; i < obss.length; i++) {
                doc.text(16.5, y, '' + obss[i]);
                y = y + 5;
            }
        }
        //endobersvaciones

        //elaboro
        doc.text(106, 277, '' + inf[0]['asesores']['nombre'] + ' ' + inf[0]['asesores']['a_paterno'] + ' ' + inf[0]['asesores']['a_materno']);
        doc.text(25, 276, '' + inf[1]['nombre']);
        //endelaboro
        
        doc.save('' + $("#iexpediente").val() +'_checklist');
        $("#formdata").submit();
    })
    
})