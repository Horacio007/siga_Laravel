$(document).ready(function(){

    $('#list_ventregados').DataTable({
        dom: 'Blfrtip',
        buttons: [{
                extend: 'excelHtml5',
                messageTop: 'Areas',
                text: "Excel",
                title: "Listado de Vehiculos Entregados en el mes",
            },
            {
                /*'csvHtml5',*/
                extend: 'csvHtml5',
                text: "CSV",
                title: "Listado de Proceso Vehiculos Entregados en el mes",
                messageTop: 'Listado de Proceso Vehiculos Entregados en el mes',
            },
            {
                extend: 'pdfHtml5',
                title: 'Listado de Proceso Vehiculos Entregados en el mes'
            }
        ],
        responsive: true,
        destroy: true,
        language: {
            "sProcessing":     "Procesando...",
                        "sLengthMenu":     "Mostrar _MENU_ registros",
                        "sZeroRecords":    "No se encontraron resultados",
                        "sEmptyTable":     "Ningún dato disponible en esta tabla =(",
                        "sInfo":           "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
                        "sInfoEmpty":      "Mostrando registros del 0 al 0 de un total de 0 registros",
                        "sInfoFiltered":   "(filtrado de un total de _MAX_ registros)",
                        "sInfoPostFix":    "",
                        "sSearch":         "Buscar:",
                        "sUrl":            "",
                        "sInfoThousands":  ",",
                        "sLoadingRecords": "Cargando...",
                        "oPaginate": {
                            "sFirst":    "Primero",
                            "sLast":     "Último",
                            "sNext":     "Siguiente",
                            "sPrevious": "Anterior"
                        },
                        "oAria": {
                            "sSortAscending":  ": Activar para ordenar la columna de manera ascendente",
                            "sSortDescending": ": Activar para ordenar la columna de manera descendente"
                        },
                        "buttons": {
                            "copy": "Copiar",
                            "colvis": "Visibilidad"
                        }
        },
        select: true,
        pageLength: 100,
        rowCallback: function(nRow, aData){
            
        }
    });

    $('#list_vrecibidos').DataTable({
        dom: 'Blfrtip',
        buttons: [{
                extend: 'excelHtml5',
                messageTop: 'Areas',
                text: "Excel",
                title: "Listado de Vehiculos Recibidos en el mes",
            },
            {
                /*'csvHtml5',*/
                extend: 'csvHtml5',
                text: "CSV",
                title: "Listado de Proceso Vehiculos Recibidos en el mes",
                messageTop: 'Listado de Proceso Vehiculos Recibidos en el mes',
            },
            {
                extend: 'pdfHtml5',
                title: 'Listado de Proceso Vehiculos Recibidos en el mes'
            }
        ],
        responsive: true,
        destroy: true,
        language: {
            "sProcessing":     "Procesando...",
                        "sLengthMenu":     "Mostrar _MENU_ registros",
                        "sZeroRecords":    "No se encontraron resultados",
                        "sEmptyTable":     "Ningún dato disponible en esta tabla =(",
                        "sInfo":           "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
                        "sInfoEmpty":      "Mostrando registros del 0 al 0 de un total de 0 registros",
                        "sInfoFiltered":   "(filtrado de un total de _MAX_ registros)",
                        "sInfoPostFix":    "",
                        "sSearch":         "Buscar:",
                        "sUrl":            "",
                        "sInfoThousands":  ",",
                        "sLoadingRecords": "Cargando...",
                        "oPaginate": {
                            "sFirst":    "Primero",
                            "sLast":     "Último",
                            "sNext":     "Siguiente",
                            "sPrevious": "Anterior"
                        },
                        "oAria": {
                            "sSortAscending":  ": Activar para ordenar la columna de manera ascendente",
                            "sSortDescending": ": Activar para ordenar la columna de manera descendente"
                        },
                        "buttons": {
                            "copy": "Copiar",
                            "colvis": "Visibilidad"
                        }
        },
        select: true,
        pageLength: 100,
        rowCallback: function(nRow, aData){
            
        }
    });

    //entregados g
    $.ajax({
        url: '/g_ventregados',
        type: 'GET',
        data: {
            catalago_ventregados: true
        },
        success: function(result) {
            //console.log(result)
            var xy = JSON.parse(result);
            //console.log(xy[0])
            //console.log(key, values)
            var x = [];
            var y = [];
            var ll = [];
            for (let i = 0; i < xy.length; i++) {
                ll.push(Object.keys(xy[i]))
                //y.push(Object.value(xy[i]))
            }
            var f = new Date();
            var meses = new Array ("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");
            //saco la info con un json

            for (let i = 0; i < xy[0].length; i++) {
                x.push(xy[0][i]);   
            }

            for (let i = 0; i < xy[1].length; i++) {
                y.push(xy[1][i]);   
            }
  
            //console.log(x)

            var data = [
                {
                x: x,
                y: y,
                type: 'bar',
                text: y.map(String),
                textposition: 'auto',
                hoverinfo: 'none',
                }
            ];
            
            var config = {responsive: true}

            var layout = {
                title: 'Mes de ' + (meses[f.getMonth()]),
                yaxis: {
                    title: 'Vehiculos',
                },
                xaxis: {
                    title: 'Compañia'
                }
                    
            };
            
            Plotly.newPlot('vem', data, layout, config);
            
        }
    })
    //

    //recibidos g
    $.ajax({
        url: '/g_vrecibidos',
        type: 'GET',
        data: {
            catalago_vrecibidos: true
        },
        success: function(result) {
            //console.log(result[0])
            var xy = JSON.parse(result);
            //console.log(xy[0])
            //console.log(key, values)
            var x = [];
            var y = [];
            var ll = [];
            for (let i = 0; i < xy.length; i++) {
                ll.push(Object.keys(xy[i]))
                //y.push(Object.value(xy[i]))
            }
            var f = new Date();
            var meses = new Array ("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");
            //saco la info con un json

            for (let i = 0; i < xy[0].length; i++) {
                x.push(xy[0][i]);   
            }

            for (let i = 0; i < xy[1].length; i++) {
                y.push(xy[1][i]);   
            }
  
            //console.log(x)

            var data = [
                {
                x: x,
                y: y,
                type: 'bar',
                text: y.map(String),
                textposition: 'auto',
                hoverinfo: 'none',
                }
            ];
            
            var config = {responsive: true}

            var layout = {
                title: 'Mes de ' + (meses[f.getMonth()]),
                yaxis: {
                    title: 'Vehiculos',
                },
                xaxis: {
                    title: 'Compañia'
                }
                    
            };
            
            Plotly.newPlot('rem', data, layout, config);
            
        }
    })

    //le agrego lo de la seleccion de las fechas
    $("#btn_buscar").on('click', function(){
        //primero saco el entregados
        if ($("#ifecha").val() == 0) {
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: 'Selecciona un fecha',
            })

            return ;
        }
        //entregados g
        $.ajax({
            url: 'g_ventregadosselect',
            type: 'GET',
            data: {
                catalago_ventregados: true,
                mes: $("#ifecha").val()
            },
            success: function(result) {
                console.log(result)
                var xy = JSON.parse(result);
                //console.log(xy[0])
                //console.log(key, values)
                var x = [];
                var y = [];
                var ll = [];
                for (let i = 0; i < xy.length; i++) {
                    ll.push(Object.keys(xy[i]))
                    //y.push(Object.value(xy[i]))
                }
                var f = new Date($("#ifecha").val());
                var meses = new Array ("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");
                //saco la info con un json

                for (let i = 0; i < xy[0].length; i++) {
                    x.push(xy[0][i]);   
                }

                for (let i = 0; i < xy[1].length; i++) {
                    y.push(xy[1][i]);   
                }
    
                //console.log(x)

                var data = [
                    {
                    x: x,
                    y: y,
                    type: 'bar',
                    text: y.map(String),
                    textposition: 'auto',
                    hoverinfo: 'none',
                    }
                ];
                
                var config = {responsive: true}

                var layout = {
                    title: 'Mes de ' + (meses[f.getMonth()]),
                    yaxis: {
                        title: 'Vehiculos',
                    },
                    xaxis: {
                        title: 'Compañia'
                    }
                        
                };
                
                Plotly.newPlot('vemselect', data, layout, config);
                
            }
        })

        //recividos g
        /*
        $.ajax({
            url: '/siga/controlador/g_vrecibidosselect.php',
            type: 'POST',
            data: {
                catalago_vrecibidos: true,
                mes: $("#ifecha").val()
            },
            success: function(result) {
                //console.log(result[0])
                var xy = JSON.parse(result);
                //console.log(xy[0])
                //console.log(key, values)
                var x = [];
                var y = [];
                var ll = [];
                for (let i = 0; i < xy.length; i++) {
                    ll.push(Object.keys(xy[i]))
                    //y.push(Object.value(xy[i]))
                }
                var f = new Date($("#ifecha").val());
                var meses = new Array ("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");
                //saco la info con un json
    
                for (let i = 0; i < xy[0].length; i++) {
                    x.push(xy[0][i]);   
                }
    
                for (let i = 0; i < xy[1].length; i++) {
                    y.push(xy[1][i]);   
                }
      
                //console.log(x)
    
                var data = [
                    {
                    x: x,
                    y: y,
                    type: 'bar',
                    text: y.map(String),
                    textposition: 'auto',
                    hoverinfo: 'none',
                    }
                ];
                
                var config = {responsive: true}
    
                var layout = {
                    title: 'Mes de ' + (meses[f.getMonth()]),
                    yaxis: {
                        title: 'Vehiculos',
                    },
                    xaxis: {
                        title: 'Compañia'
                    }
                        
                };
                
                Plotly.newPlot('remselect', data, layout, config);
                
            }
        })
        */
    })

})