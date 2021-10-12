$(document).ready(function(){
    var con = Number($("#cont").val());
    var ultimo;
    let componente_template = $("div.diagnostico_consecutivo").html();
    $("#diagnostico_consecutivo").remove();

    if (con > 20) {
        Swal.fire({
            icon: 'warning',
            title: 'Oops...',
            text: 'Solo se pueden agregar 20 reparaciones por orden',
        })
    } else {
        $(document).on('click', 'a.add_reparacion', function(e){
            if (con == 10) {
                Swal.fire({
                    icon: 'warning',
                    title: 'Oopps...',
                    text: 'Sobrepasaste 10 conceptos, debe crear una nueva Orden de Mecanica',
                })

                return false;
            } else {
                $("#section_diagnostico").append( 
                    componente_template.replaceAll( "consecutivo" , con) );
        
                con++;
                $("#cont2").val(con);
                $("#btn_crear").attr('disabled', false);
            }
        })
    }

    $(document).on('click','a.remove_diagnostico',function(e) {
        //alert('entra');
        let item_id = $(this).attr('item_id');
        //console.log(item_id);
        $("#diagnostico_"+item_id).remove();
    });
})