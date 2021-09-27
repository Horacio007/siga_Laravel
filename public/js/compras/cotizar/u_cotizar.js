$(document).ready(function(){
    $("#nprovedor1").on('keyup', function(){
        $("#lprov1").html('Total -> '+$(this).val());
    })

    $("#nprovedor2").on('keyup', function(){
        $("#lprov2").html('Total -> '+$(this).val());
    })

    $("#nprovedor3").on('keyup', function(){
        $("#lprov3").html('Total -> '+$(this).val());
    })

    $("#btn_calcular").on('click', function(){
        let t_p1 = 0.0;
        let t_p2 = 0.0;
        let t_p3 = 0.0;

        for (let i = 1; i <= $("#t_ref").val(); i++) {
            t_p1+= parseFloat($("#tproveedor1_"+i).val());
            t_p2+= parseFloat($("#tproveedor2_"+i).val());
            t_p3+= parseFloat($("#tproveedor3_"+i).val());
        }

        $("#tprov1").val(t_p1.toFixed(2));
        $("#tprov2").val(t_p2.toFixed(2));
        $("#tprov3").val(t_p3.toFixed(2));
    })

    $("#btn_calcular2").on('click', function(){
        let total = 0.0;

        for (let i = 1; i <= $("#t_ref").val(); i++) {

            if (parseFloat($("#tproveedor1_"+i).val()) <= parseFloat($("#tproveedor2_"+i).val())) {
                if (parseFloat($("#tproveedor1_"+i).val()) <= parseFloat($("#tproveedor3_"+i).val())) {
                    $("#tproveedorf_"+i).val($("#nprovedor1").val());
                    $("#tcostosf_"+i).val($("#tproveedor1_"+i).val());
                    total+= parseFloat($("#tproveedor1_"+i).val());
                    console.log('el menor es a');
                } else {
                    $("#tproveedorf_"+i).val($("#nprovedor3").val());
                    $("#tcostosf_"+i).val($("#tproveedor3_"+i).val());
                    total+= parseFloat($("#tproveedor3_"+i).val());
                    console.log('el menor es c');
                }
            } else if (parseFloat($("#tproveedor2_"+i).val()) <= parseFloat($("#tproveedor3_"+i).val())){
                $("#tproveedorf_"+i).val($("#nprovedor2").val());
                $("#tcostosf_"+i).val($("#tproveedor2_"+i).val());
                total+= parseFloat($("#tproveedor2_"+i).val());
                console.log('el menor es b');
            } else {
                $("#tproveedorf_"+i).val($("#nprovedor3").val());
                $("#tcostosf_"+i).val($("#tproveedor3_"+i).val());
                total+= parseFloat($("#tproveedor3_"+i).val());
                console.log('el menor es c');
            }
        }

        $("#tcostosf").val(total.toFixed(2));
    })
})