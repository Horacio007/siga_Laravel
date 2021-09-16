$(document).ready(function(){

    //aqui va la seccion de agregar nueva pieza y borrarla
    var con = Number($("#cont").val());
    var ultimo;
    let componente_template = $("div.pieza_consecutivo").html();
    $("#pieza_consecutivo").remove();

    if (con > 30) {
        Swal.fire({
            icon: 'warning',
            title: 'Oops...',
            text: 'Solo se pueden agregar 30 pzs por presupuesto',
        })
    } else {
        $(document).on('click', 'a.add_pieza', function(e){
            $("#section_piezas").append( 
                componente_template.replaceAll( "consecutivo" , con) );
    
            con++;
            $("#cont2").val(con);
        })
    }
   
    $(document).on('click','a.remove_pieza',function(e) {
        //alert('entra');
        let item_id = $(this).attr('item_id');
        //console.log(item_id);
        $("#pieza_"+item_id).remove();
    });

    $("#btn_calcular").on('click', function(){

        let sumamomh = 0.0;
        let sumamomp = 0.0;
        let sumamomm = 0.0;
        let sumatot = 0.0;
        let sumarefacciones = 0.0;
        con2 = con;
        
        for (let i = 1; i < con2; i++) {
            sumamomh+= parseFloat($("#tmomh_" + i).val());
            sumamomp+= parseFloat($("#tmomp_" + i).val());
            sumamomm+= parseFloat($("#tmomm_" + i).val());
            sumatot+= parseFloat($("#ttot_" + i).val());
            sumarefacciones+= parseFloat($("#trefacciones_" + i).val());
        }

        $("#itmomh").val(sumamomh.toFixed(2));
        $("#itmomp").val(sumamomp.toFixed(2));
        $("#itmomm").val(sumamomm.toFixed(2));
        $("#ittot").val(sumatot.toFixed(2));
        $("#itrefacciones").val(sumarefacciones.toFixed(2));

    });

     // calculo los totales de los totales
    $("#btn_calcular2").on('click', function(){
        let totalmomp = parseFloat($("#itmomp").val());
        let totalmomm = parseFloat($("#itmomm").val());
        let totalmomh = parseFloat($("#itmomh").val());
        let totaltot = parseFloat($("#ittot").val());
        let totalrefacciones = parseFloat($("#itrefacciones").val());
        let subtotal = totalmomh + totalmomp + totalmomm + totaltot + totalrefacciones;
        let iva = subtotal * 0.30;
        let total = subtotal + iva;
        
        $("#isubtotal").val(subtotal.toFixed(2));
        $("#iiva").val(iva.toFixed(2));
        $("#itotal").val(total.toFixed(2));

    });

})