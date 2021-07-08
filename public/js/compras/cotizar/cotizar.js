$(document).ready(function (){
    var inf;
    //
    $("#btn_buscar").on('click', function(){
        //
        if ($("#iexpediente").val() == "") {
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: 'Ingresa el Numero de Expediente',
            })
              
            return false
        }
        
        $.ajax({
            url: '/e_cost',
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
                    $("#btn_agregar").attr('disabled', false);
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
                            text: 'Presupuesto ya creado',
                        })
                        document.getElementById("formdataa").reset();
                    }
                    
                }
            }
        })
    });

    $("#btn_calcular").on('click', function(){

        if ($("#iexpediente").val() == "") {
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: 'Ingresa el Numero de Expediente',
            })
              
            return false
        }

        if ($("#tcantidad").val() == "") {
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: 'Ingresa las Cantidades de cada Concepto',
            })
              
            return false
        }

        if ($("#nprovedor1").val() == "") {
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: 'Ingresa el nombre del proveedpr 1',
            })
              
            return false
        }

        if ($("#nprovedor2").val() == "") {
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: 'Ingresa el nombre del proveedpr 2',
            })
              
            return false
        }

        if ($("#nprovedor3").val() == "") {
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: 'Ingresa el nombre del proveedor 3',
            })
              
            return false
        }

        if ($("#tproveedor1").val() == "") {
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: 'Ingresa los Precios de Premier',
            })
              
            return false
        }

        if ($("#tproveedor2").val() == "") {
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: 'Ingresa los Precios de Roto',
            })
              
            return false
        }

        if ($("#tproveedor3").val() == "") {
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: 'Ingresa los Precios de Aldo',
            })
              
            return false
        }

        //console.log($("#tconcepto").val())
        //saco los datos y valores de cada una de las cosas
        concepto = $("#tconcepto").val()
        //concepto = concepto.replace("\n", '')
        concepto = concepto.split('\n')
        concepto.pop();
        //console.log(concepto)
        cantidad = $("#tcantidad").val()
        //concepto = concepto.replace("\n", '')
        cantidad = cantidad.split('\n')
        if (concepto.length != cantidad.length) {
            cantidad.pop()
        }
        //console.log(concepto)
        proveedor1 = $("#tproveedor1").val()
        //concepto = concepto.replace("\n", '')
        proveedor1 = proveedor1.split('\n')
        if (concepto.length != proveedor1.length) {
            proveedor1.pop()
        }
        //console.log(concepto)
        proveedor2 = $("#tproveedor2").val()
        //concepto = concepto.replace("\n", '')
        proveedor2 = proveedor2.split('\n')
        if (concepto.length != proveedor2.length) {
            proveedor2.pop()
        }
        //console.log(concepto)
        proveedor3 = $("#tproveedor3").val()
        //concepto = concepto.replace("\n", '')
        proveedor3 = proveedor3.split('\n')
        if (concepto.length != proveedor3.length) {
            proveedor3.pop()
        }
        //console.log(concepto, cantidad, proveedor1, proveedor2, proveedor3)
        //ahora si calculo las cosas para ponerlo en los totales
        sumap1 = 0.0
        sumap2 = 0.0
        sumap3 = 0.0

        for (let i = 0; i < proveedor1.length; i++) {
            proveedor1[i] = parseFloat(proveedor1[i]);
            sumap1+= proveedor1[i]
        }

        for (let i = 0; i < proveedor2.length; i++) {
            proveedor2[i] = parseFloat(proveedor2[i]);
            sumap2+= proveedor2[i]
        }

        for (let i = 0; i < proveedor3.length; i++) {
            proveedor3[i] = parseFloat(proveedor3[i]);
            sumap3+= proveedor3[i]
        }

        if (concepto.length == cantidad.length && concepto.length == proveedor1.length && concepto.length == proveedor2.length && concepto.length == proveedor3.length) {
            // le pongo los valores al precionar lo de los totales 
            document.getElementById('lpremier').innerHTML = "Total "+$("#nprovedor1").val()
            document.getElementById('lroto').innerHTML = "Total "+$("#nprovedor2").val()
            document.getElementById('laldo').innerHTML = "Total "+$("#nprovedor3").val()

            $("#tpremier").val(sumap1.toFixed(2))
            $("#troto").val(sumap2.toFixed(2))
            $("#taldo").val(sumap3.toFixed(2))
        } else {
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: 'Recuerda que todos los campos deben de tener el mismo tamaño',
            })
              
            return false
        }
    });

    $("#btn_calcular2").on('click', function(){

        if ($("#iexpediente").val() == "") {
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: 'Ingresa el Numero de Expediente',
            })
              
            return false
        }

        if ($("#tcantidad").val() == "") {
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: 'Ingresa las Cantidades de cada Concepto',
            })
              
            return false
        }

        if ($("#nprovedor1").val() == "") {
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: 'Ingresa el nombre del proveedpr 1',
            })
              
            return false
        }

        if ($("#nprovedor2").val() == "") {
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: 'Ingresa el nombre del proveedpr 2',
            })
              
            return false
        }

        if ($("#nprovedor3").val() == "") {
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: 'Ingresa el nombre del proveedpr 3',
            })
              
            return false
        }

        if ($("#tproveedor1").val() == "") {
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: 'Ingresa los Precios de Premier',
            })
              
            return false
        }

        if ($("#tproveedor2").val() == "") {
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: 'Ingresa los Precios de Roto',
            })
              
            return false
        }

        if ($("#tproveedor3").val() == "") {
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: 'Ingresa los Precios de Aldo',
            })
              
            return false
        }

        if ($("#tpremier").val() == "") {
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: 'Debes calcular el total de Premier',
            })
              
            return false
        }

        if ($("#troto").val() == "") {
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: 'Debes calcular el total de Roto',
            })
              
            return false
        }

        if ($("#taldo").val() == "") {
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: 'Debes calcular el total de Aldo',
            })
              
            return false
        }


        //console.log($("#tconcepto").val())
        //saco los datos y valores de cada una de las cosas
        concepto = $("#tconcepto").val()
        //concepto = concepto.replace("\n", '')
        concepto = concepto.split('\n')
        concepto.pop();
        //console.log(concepto)
        cantidad = $("#tcantidad").val()
        //concepto = concepto.replace("\n", '')
        cantidad = cantidad.split('\n')
        if (concepto.length != cantidad.length) {
            cantidad.pop()
        }
        //console.log(concepto)
        proveedor1 = $("#tproveedor1").val()
        //concepto = concepto.replace("\n", '')
        proveedor1 = proveedor1.split('\n')
        if (concepto.length != proveedor1.length) {
            proveedor1.pop()
        }
        //console.log(concepto)
        proveedor2 = $("#tproveedor2").val()
        //concepto = concepto.replace("\n", '')
        proveedor2 = proveedor2.split('\n')
        if (concepto.length != proveedor2.length) {
            proveedor2.pop()
        }
        //console.log(concepto)
        proveedor3 = $("#tproveedor3").val()
        //concepto = concepto.replace("\n", '')
        proveedor3 = proveedor3.split('\n')
        if (concepto.length != proveedor3.length) {
            proveedor3.pop()
        }
        //console.log(concepto, cantidad, proveedor1, proveedor2, proveedor3)
        //ahora si calculo las cosas para ponerlo en los totales
        sumap1 = 0.0
        sumap2 = 0.0
        sumap3 = 0.0

        for (let i = 0; i < proveedor1.length; i++) {
            proveedor1[i] = parseFloat(proveedor1[i]);
            sumap1+= proveedor1[i]
        }

        for (let i = 0; i < proveedor2.length; i++) {
            proveedor2[i] = parseFloat(proveedor2[i]);
            sumap2+= proveedor2[i]
        }

        for (let i = 0; i < proveedor3.length; i++) {
            proveedor3[i] = parseFloat(proveedor3[i]);
            sumap3+= proveedor3[i]
        }

        var prov = '';
        var cant = ''; 

        // le pongo los valores al precionar lo de los totales 
        for (let i = 0; i < concepto.length; i++) {
            apoyo = [proveedor1[i], proveedor2[i], proveedor3[i]].sort((a, b) => a - b)

            if (proveedor1.includes(apoyo[0])) {
                prov+=$("#nprovedor1").val()+'\n';
                cant+=''+apoyo[0]+'\n';
            } else if (proveedor2.includes(apoyo[0])) {
                prov+=$("#nprovedor2").val()+'\n';
                cant+=''+apoyo[0]+'\n';
            } else {
                prov+=$("#nprovedor3").val()+'\n';
                cant+=''+apoyo[0]+'\n';
            }
            
        }

        prov = prov.split('\n')
        cant = cant.split('\n')
        prov.pop()
        cant.pop()

        if (concepto.length == cantidad.length && concepto.length == proveedor1.length && concepto.length == proveedor2.length && concepto.length == proveedor3.length) {
            // le pongo los valores al precionar lo de los totales 
            var pfinal = '';
            var ctotales = '';
            var sumacto = 0.0;
            for (let i = 0; i < prov.length; i++) {
                pfinal+= prov[i]+'\n';
                ctotales+= cant[i]+'\n';  
            }

            ctotales2 = ctotales.split('\n');
            if (concepto.length != ctotales2.length) {
                ctotales2.pop()
            }

            for (let i = 0; i < ctotales2.length; i++) {
                ctotales2[i] = parseFloat(ctotales2[i]);
                sumacto+= ctotales2[i];
            }

            $("#tproveedorf").val(pfinal);
            $("#tcostos").val(ctotales);
            $("#tcostosf").val(sumacto.toFixed(2));
        } else {
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: 'Recuerda que todos los campos deben de tener el mismo tamaño',
            })
              
            return false
        }

        // le agrego las cosas en donde deben de ir

        //console.log(prov, cant, ctotales, ctotales2)
    });

    $("#btn_registrar").on('click', function (){
        if ($("#iexpediente").val() == "") {
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: 'Ingresa el Numero de Expediente',
            })
              
            return false
        }

        if ($("#tcantidad").val() == "") {
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: 'Ingresa las Cantidades de cada Concepto',
            })
              
            return false
        }

        if ($("#nprovedor1").val() == "") {
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: 'Ingresa el nombre del proveedor 1',
            })
              
            return false
        }

        if ($("#nprovedor2").val() == "") {
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: 'Ingresa el nombre del proveedor 2',
            })
              
            return false
        }

        if ($("#nprovedor3").val() == "") {
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: 'Ingresa el nombre del proveedor 3',
            })
              
            return false
        }

        if ($("#tproveedor1").val() == "") {
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: 'Ingresa los Precios del Proveedor 1',
            })
              
            return false
        }

        if ($("#tproveedor2").val() == "") {
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: 'Ingresa los Precios del Proveedor 2',
            })
              
            return false
        }

        if ($("#tproveedor3").val() == "") {
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: 'Ingresa los Precios del Proveedor 3',
            })
              
            return false
        }

        if ($("#tpremier").val() == "") {
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: 'Debes calcular el total de Premier',
            })
              
            return false
        }

        if ($("#troto").val() == "") {
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: 'Debes calcular el total de Roto',
            })
              
            return false
        }

        if ($("#taldo").val() == "") {
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: 'Debes calcular el total de Aldo',
            })
              
            return false
        }

        if ($("#tproveedorf").val() == "") {
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: 'Debes calcular primero los Totales de cada proveedor',
            })
              
            return false
        }

        if ($("#tcostos").val() == "") {
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: 'Debes calcular primero los Totales de cada proveedor',
            })
              
            return false
        }

        if ($("#tcostosf").val() == "") {
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: 'Debes calcular primero los Totales de cada proveedor',
            })
              
            return false
        }

        if ($("#tfechapromesa").val() == "") {
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: 'Debes ingresar las Fechas promesa',
            })
              
            return false
        }

        if ($("#tnumguia").val() == "") {
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: 'Debes ingresar los Numeros de guia',
            })
              
            return false
        }

        if ($("#tcomentarios").val() == "") {
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: 'Debes ingresar los Comentarios',
            })
              
            return false
        }

        //prepara la informacion con puros / y - para las fechas
        expediente = $("#iexpediente").val()
        concepto = $("#tconcepto").val().split('\n')
        var nconcepto = "";
        for (let i = 0; i < concepto.length; i++) {
            nconcepto+= concepto[i]+'/';           
        }
        var ncantidad = "";
        cantidad = $("#tcantidad").val().split('\n')
        for (let i = 0; i < cantidad.length; i++) {
            ncantidad+= cantidad[i]+'/';
        }
        nombreprov1 = $("#nprovedor1").val()
        nombreprov2 =  $("#nprovedor2").val()
        nombreprov3 = $("#nprovedor3").val()
        var nproveedor1 = "";
        proveedor1 = $("#tproveedor1").val().split('\n')
        for (let i = 0; i < proveedor1.length; i++) {
            nproveedor1+= proveedor1[i]+'/';          
        }
        var nproveedor2 = "";
        proveedor2 = $("#tproveedor2").val().split('\n')
        for (let i = 0; i < proveedor2.length; i++) {
            nproveedor2+= proveedor2[i]+'/';          
        }
        var nproveedor3 = "";
        proveedor3 = $("#tproveedor3").val().split('\n')
        for (let i = 0; i < proveedor3.length; i++) {
            nproveedor3+= proveedor3[i]+'/';          
        }
        tpremier = $("#tpremier").val(),
        troto = $("#troto").val(),
        taldo = $("#taldo").val(),
        ntproveedorf = "";
        tproveedorf = $("#tproveedorf").val().split('\n')
        for (let i = 0; i < tproveedorf.length; i++) {
            ntproveedorf+= tproveedorf[i]+'/';          
        }
        ntcostos = "";
        tcostos = $("#tcostos").val().split('\n')
        for (let i = 0; i < tcostos.length; i++) {
            ntcostos+= tcostos[i]+'/';   
        }
        tcostosf =  $("#tcostosf").val()
        ntfechapromesa = "";
        tfechapromesa = $("#tfechapromesa").val().split('\n')
        for (let i = 0; i < tfechapromesa.length; i++) {
            ntfechapromesa+= tfechapromesa[i]+'/';         
        }
        ntnumguia = "";
        tnumguia = $("#tnumguia").val().split('\n')
        for (let i = 0; i < tnumguia.length; i++) {
            ntnumguia+= tnumguia[i]+'/';           
        }
        ntcomentarios = "";
        tcomentarios = $("#tcomentarios").val().split('\n')
        for (let i = 0; i < tcomentarios.length; i++) {
            ntcomentarios+= tcomentarios[i]+'/';      
        }

        const doc = new jsPDF('l');
        doc.addImage('img/formato_cotrefacciones.jpg', 'jpg', 0, 0, 292, 225);
        doc.setFontSize(11);
        doc.text(31, 10, '' + $("#iexpediente").val());
        doc.text(207, 10, '' + inf[0]['clientes']['nombre']);
        doc.text(105, 10, '' + inf[0]['marcas']['marca'] + ' ' + inf[0]['submarcas']['submarca']);
        doc.text(103, 16.5, '' + inf[0]['modelo']);
        doc.text(23, 16.5, '' + inf[0]['color']);
        doc.text(105, 28, '' + nombreprov1);
        doc.text(118, 28, '' + nombreprov2);
        doc.text(131, 28, '' + nombreprov3);
        let f1 = new Date();
        let f2 = f1.getFullYear() + '-' +(f1.getMonth() +1) + "-" + f1.getDate();
        let con = 36;
        for (let i = 0; i < concepto.length; i++) {
            doc.text(15, con, '' + concepto[i]);
            con = con + 7;
        }
        let cant = 36;
        for (let i = 0; i < cantidad.length; i++) {
            doc.text(99, cant, '' + cantidad[i]);
            cant = cant + 7;
        }
        let prov1 = 36;
        for (let i = 0; i < proveedor1.length; i++) {
            doc.text(105, prov1, '' + proveedor1[i]);
            prov1 = prov1 + 7;
        }
        let prov2 = 36;
        for (let i = 0; i < proveedor2.length; i++) {
            doc.text(118, prov2, '' + proveedor2[i]);
            prov2 = prov2 + 7;
        }
        let prov3 = 36;
        for (let i = 0; i < proveedor3.length; i++) {
            doc.text(131, prov3, '' + proveedor3[i]);
            prov3 = prov3 + 7;
        }
        doc.text(105, 192, '' + tpremier);
        doc.text(118, 192, '' + troto);
        doc.text(131, 192, '' + taldo);
        let provf = 36;
        for (let i = 0; i < tproveedorf.length; i++) {
            doc.text(145, provf, '' + tproveedorf[i]);
            provf = provf + 7;
        }
        let costf = 36;
        for (let i = 0; i < tcostos.length; i++) {
            doc.text(158, costf, '' + tcostos[i]);
            costf = costf + 7;
        }
        doc.text(158, 192, '' + tcostosf);
        let fpro = 36;
        for (let i = 0; i < tfechapromesa.length; i++) {
            doc.text(171.5, fpro, '' + tfechapromesa[i]);
            fpro = fpro + 7;
        }
        let ngia = 36;
        for (let i = 0; i < tnumguia.length; i++) {
            doc.text(192.5, ngia, '' + tnumguia[i]);
            ngia = ngia + 7;
        }
        let com = 36;
        for (let i = 0; i < tcomentarios.length; i++) {
            doc.text(239.5, com, '' + tcomentarios[i]);
            com = com + 7;
        }
        doc.save('' + $("#iexpediente").val() +'_costeo_refacciones');
        // me creo el arreglo con el que guardare toda la informacion
        var data = {
            expediente: expediente,
            concepto: nconcepto,
            cantidad: ncantidad,
            nombreprov1: nombreprov1,
            nombreprov2: nombreprov2,
            nombreprov3: nombreprov3,
            proveedor1: nproveedor1,
            proveedor2: nproveedor2,
            proveedor3: nproveedor3,
            tpremier: tpremier,
            troto: troto,
            taldo: taldo,
            tproveedorf: ntproveedorf,
            tcostos: ntcostos,
            tcostosf: tcostosf,
            tfechapromesa: ntfechapromesa,
            tnumguia: ntnumguia,
            tcomentarios: ntcomentarios,
            fecha: f2

        }

        $.ajax({
            url: '/i_cotizacion',
            type: 'POST',
            data: data,
            success: function(result){
                if (result == 1) {
                    Swal.fire({
                        icon: 'success',
                        title: 'Correcto',
                        text: 'Costeo de Refacciones registrado',
                    })
                    $("#iexpediente").removeAttr("readonly");
                    document.getElementById("formdata").reset();
                    document.getElementById("formdataa").reset();
                    $("#info").text('');
                    $("#inf").fadeOut();
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: result,
                    })
                    $("#iexpediente").removeAttr("readonly");
                    document.getElementById("formdata").reset();
                    document.getElementById("formdataa").reset();
                    $("#info").text('');
                    $("#inf").fadeOut();
                }
            }
        })
    })
})