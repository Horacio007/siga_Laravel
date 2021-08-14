$(document).ready(function(){
    $("#ihoja1").on('keyup', function(){
        let suma = 0
        suma = (Number($("#ihoja1").val()) + Number($("#ihoja2").val()) + Number($("#ihoja3").val())) / 3;
        let r = suma;
        $("#ihoja").val(r.toFixed(2));
    })

    $("#ihoja2").on('keyup', function(){
        let suma = 0
        suma = (Number($("#ihoja1").val()) + Number($("#ihoja2").val()) + Number($("#ihoja3").val())) / 3;
        let r = suma;
        $("#ihoja").val(r.toFixed(2));
    })

    $("#ihoja3").on('keyup', function(){
        let suma = 0
        suma = (Number($("#ihoja1").val()) + Number($("#ihoja2").val()) + Number($("#ihoja3").val())) / 3;
        let r = suma;
        $("#ihoja").val(r.toFixed(2));
    })
})