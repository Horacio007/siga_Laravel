$(document).ready(function(){
    $("#btn_calcular").on('click', function(){
        // valido que nada este vacio
        if ($("#iexpediente").val() == "") {
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: 'Ingresa el Numero de Expediente',
            })
              
            return false
        }

        if ($("#toperacion").val() == "") {
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: 'Ingresa las Operaciones',
            })
              
            return false
        }

        if ($("#tnivel").val() == "") {
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: 'Ingresa el Nivel de Daño',
            })
              
            return false
        }

        if ($("#tconcepto").val() == "") {
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: 'Ingresa los Conceptos',
            })
              
            return false
        }

        if ($("#tmomh").val() == "") {
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: 'Ingresa el costo de Mano de Obra Material y Hojalateria',
            })
              
            return false
        }

        if ($("#tmomp").val() == "") {
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: 'Ingresa el costo de Mano de Obra Material y Pintura',
            })
              
            return false
        }

        if ($("#tmomm").val() == "") {
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: 'Ingresa el costo de Mano de Obra Material y Mecanica',
            })
              
            return false
        }

        if ($("#ttot").val() == "") {
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: 'Ingresa el costo de Trabajos en otro Taller',
            })
              
            return false
        }

        if ($("#trefacciones").val() == "") {
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: 'Ingresa el costo de las Refacciones',
            })
              
            return false
        }

        //obtengo los valores separados por una /
        operacion = $("#toperacion").val().trim().toLowerCase();
        nivel = $("#tnivel").val().toLowerCase();
        concepto = $("#tconcepto").val().toLowerCase();
        momh = $("#tmomh").val().toLowerCase();
        momp = $("#tmomp").val().toLowerCase();
        momm = $("#tmomm").val().toLowerCase();
        tot = $("#ttot").val().toLowerCase();
        refaciones = $("#trefacciones").val().toLowerCase();
        operacion = operacion.split("/");
        nivel = nivel.split("/");
        concepto = concepto.split("/");
        momh = momh.split("/");
        momp = momp.split("/");
        momm = momm.split("/");
        tot = tot.split("/");
        refacciones = refaciones.split("/");

        // valido que todos tengan el mismo tamaño
        if (operacion.length == nivel.length && operacion.length == concepto.length && operacion.length == momh.length && operacion.length == momp.length && operacion.length == momm.length && operacion.length == tot.length && operacion.length == refacciones.length) {
            //creo las variables para guardar los valroes
            sumamomh = 0.0;
            sumamomp = 0.0;
            sumamomm = 0.0;
            sumatot = 0.0;
            sumarefacciones = 0.0;
            // transformo cada elemento de cada arreglo en float y de una vez lo sumo 
            for (let i = 0; i < momh.length; i++) {
                if (momh[i].trim()!="na") {
                    momh[i] = parseFloat(momh[i]);
                    sumamomh+= momh[i];
                }
            }
            for (let i = 0; i < momp.length; i++) {
                if (momp[i].trim()!="na") {
                    momp[i] = parseFloat(momp[i]);
                    sumamomp+= momp[i];
                }
        
            }
            for (let i = 0; i < momm.length; i++) {
                if (momm[i].trim()!="na") {
                    momm[i] = parseFloat(momm[i]);
                    sumamomm+= momm[i];
                }
                
            }
            for (let i = 0; i < tot.length; i++) {
                if (tot[i].trim()!="na") {
                    tot[i] = parseFloat(tot[i]);
                    sumatot+= tot[i];
                }
                
            }
            for (let i = 0; i < refacciones.length; i++) {
                if (refacciones[i].trim()!="na") {
                    refacciones[i] = parseFloat(refacciones[i]);
                    sumarefacciones+= refacciones[i];
                }
                
            }
            //console.log(sumamomh, sumamomp, sumamomm, sumatot, sumarefacciones);
            //le mando los valores a los lugares correspondientes
            $("#itmomh").val(sumamomh.toFixed(2));
            $("#itmomp").val(sumamomp.toFixed(2));
            $("#itmomm").val(sumamomm.toFixed(2));
            $("#ittot").val(sumatot.toFixed(2));
            $("#itrefacciones").val(sumarefacciones.toFixed(2));

        } else {
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: 'Recuerda que todos los campos deben de tener el mismo tamaño',
            })
              
        }

    });

     // calculo los totales de los totales
    $("#btn_calcular2").on('click', function(){
        // valido que nada este vacio
        if ($("#iexpediente").val() == "") {
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: 'Ingresa el Numero de Expediente',
            })
                
            return false
        }

        if ($("#toperacion").val() == "") {
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: 'Ingresa las Operaciones',
            })
                
            return false
        }

        if ($("#tnivel").val() == "") {
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: 'Ingresa el Nivel de Daño',
            })
                
            return false
        }

        if ($("#tconcepto").val() == "") {
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: 'Ingresa los Conceptos',
            })
                
            return false
        }

        if ($("#tmomh").val() == "") {
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: 'Ingresa el costo de Mano de Obra Material y Hojalateria',
            })
                
            return false
        }

        if ($("#tmomp").val() == "") {
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: 'Ingresa el costo de Mano de Obra Material y Pintura',
            })
                
            return false
        }

        if ($("#tmomm").val() == "") {
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: 'Ingresa el costo de Mano de Obra Material y Mecanica',
            })
                
            return false
        }

        if ($("#ttot").val() == "") {
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: 'Ingresa el costo de Trabajos en otro Taller',
            })
                
            return false
        }

        if ($("#trefacciones").val() == "") {
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: 'Ingresa el costo de las Refacciones',
            })
                
            return false
        }

        if ($("#itmomh").val() == "") {
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: 'Calcula el total de Mano de obra Material y Hojalateria',
            })
                
            return false
        }

        if ($("#itmomp").val() == "") {
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: 'Calcula el total de Mano de obra Material y Pintura',
            })
                
            return false
        }

        if ($("#itmomm").val() == "") {
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: 'Calcula el total de Mano de obra Material y Mecanica',
            })
                
            return false
        }

        if ($("#ittot").val() == "") {
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: 'Calcula el total de Trabajo en otro Taller',
            })
                
            return false
        }

        if ($("#itrefacciones").val() == "") {
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: 'Calcula el total de las Refacciones',
            })
                
            return false
        }

        

        totalmomh = parseFloat($("#itmomh").val());
        totalmomp = parseFloat($("#itmomp").val());
        totalmomm = parseFloat($("#itmomm").val());
        totaltot = parseFloat($("#ittot").val());
        totalrefacciones = parseFloat($("#itrefacciones").val());
        subtotal = totalmomh + totalmomp + totalmomm + totaltot + totalrefacciones;
        iva = subtotal * 0.16;
        total = subtotal + iva;
        
        
        $("#isubtotal").val(subtotal.toFixed(2));
        $("#iiva").val(iva.toFixed(2));
        $("#itotal").val(total.toFixed(2));
    });

    $("#btn_registrar").on('click', function(){
        $("#formdata").submit();
    })
})