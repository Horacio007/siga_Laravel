$(document).ready(function(){

    $("#inf").css('border-radius', '5px');
    $("#inf").css('background-color', '#00FEDB'); 

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
        $.ajax({
            url: 'g_vrecibidosselect',
            type: 'GET',
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
    })

    //ultimas 10 semanaas entregados en tabla
    $('#list_ventregados10').DataTable({
        dom: 'Blfrtip',
        buttons: [{
                extend: 'excelHtml5',
                messageTop: 'Areas',
                text: "Excel",
                title: "Listado de Vehiculos Entregados en las ultimas 10 semanas",
            },
            {
                /*'csvHtml5',*/
                extend: 'csvHtml5',
                text: "CSV",
                title: "Listado de Proceso Vehiculos Entregados en las ultimas 10 semanas",
                messageTop: 'Listado de Proceso Vehiculos Entregados en las ultimas 10 semanas',
            },
            {
                extend: 'pdfHtml5',
                title: 'Listado de Proceso Vehiculos Entregados en las ultimas 10 semanas'
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

    //ultimas 10 semanaas recibidos en tabla
    $('#list_vrecibidos10').DataTable({
        dom: 'Blfrtip',
        buttons: [{
                extend: 'excelHtml5',
                messageTop: 'Areas',
                text: "Excel",
                title: "Listado de Vehiculos Recibidos en las ultimas 10 semanas",
            },
            {
                /*'csvHtml5',*/
                extend: 'csvHtml5',
                text: "CSV",
                title: "Listado de Proceso Vehiculos Recibidos en las ultimas 10 semanas",
                messageTop: 'Listado de Proceso Vehiculos Recibidos en las ultimas 10 semanas',
            },
            {
                extend: 'pdfHtml5',
                title: 'Listado de Proceso Vehiculos Recibidos en las ultimas 10 semanas'
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

    //ultimas 10 semanaas entregados en grafica
    $.ajax({
        url: 'g_diesentregados',
        type: 'GET',
        data: {
            catalago_ventregados: true
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
                    title: 'Semana'
                }
                    
            };
            
            Plotly.newPlot('diesem', data, layout, config);
            
        }
    })

    //ultimas 10 semanaas recibidos en tabla
    $.ajax({
        url: 'g_diesrecibidos',
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
                hoverinfo: 'none'
                }
            ];
            
            var config = {responsive: true}

            var layout = {
                title: 'Mes de ' + (meses[f.getMonth()]),
                yaxis: {
                    title: 'Vehiculos',
                },
                xaxis: {
                    title: 'Semana'
                }
                    
            };
            
            Plotly.newPlot('diesreci', data, layout, config);
            
        }
    })

    //entregados c/u por semana 
    $.ajax({
        url: 'g_isccu',
        type: 'GET',
        data: {
            catalago_isccu: true
        },
        success: function(result) {
            //console.log(result)
            var xy = JSON.parse(result);
            //console.log(xy);
            
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

            for (let i = 0; i < xy['linea'].length; i++) {
                x.push(xy['linea'][i]);   
            }

            for (let i = 0; i < xy['total'].length; i++) {
                y.push(xy['total'][i]);   
            }
  
            //console.log(x)

            var data = [
                {
                x: x,
                y: y,
                type: 'bar',
                text: y.map(String),
                textposition: 'auto',
                hoverinfo: 'none'
                }
            ];
            
            var config = {responsive: true}

            var layout = {
                title: 'Semana '+ xy['semana'] +' del Mes de ' + (meses[f.getMonth()]),
                yaxis: {
                    title: 'ISC',
                },
                xaxis: {
                    title: 'Vehiculo'
                }
                    
            };
            
            Plotly.newPlot('iscsem', data, layout, config);
            
        }
    })

    //entregados c/u por semana total
    $.ajax({
        url: 'g_isccutotal',
        type: 'GET',
        data: {
            catalago_isccutotal: true
        },
        success: function(result) {
            //console.log(result)
            var xy = JSON.parse(result);
            //console.log(xy);
            
            //console.log(xy[0])
            //console.log(key, values)
            var x = [];
            var y = [];

            var f = new Date();
            var meses = new Array ("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");
            //saco la info con un json y agrego las semanas 
            x.push('Semana ' + xy['semana-3']['semana-3'],'Semana ' + xy['semana-2']['semana-2'], 'Semana ' + xy['semana-1']['semana-1'], 'Semana ' + xy['semanaA']['semanaA']);
            //console.log(x);
            //saco lo de la semana -3
            var suma3 = 0;
            for (let i = 0; i < xy['semana-3']['total-3'].length; i++) {
                suma3 = suma3 + parseInt(xy['semana-3']['total-3'][i]);
                //y.push(xy['total'][i]);   
            }
            
            //console.log(suma)
            var total3 = suma3 / xy['semana-3']['total-3'].length;
            y.push(total3.toFixed(2));
            //termina la semana -3
            //saco la semana -2
            var suma2 = 0;
            for (let i = 0; i < xy['semana-2']['total-2'].length; i++) {
                suma2 = suma2 + parseInt(xy['semana-2']['total-2'][i]);
                //y.push(xy['total'][i]);   
            }
            
            //console.log(suma)
            var total2 = suma2 / xy['semana-2']['total-2'].length;
            y.push(total2.toFixed(2));
            //termina la semana -2
            //saco lo de la segunda semana -1
            var suma1 = 0;
            for (let i = 0; i < xy['semana-1']['total-1'].length; i++) {
                suma1 = suma1 + parseInt(xy['semana-1']['total-1'][i]);
                //y.push(xy['total'][i]);   
            }
            
            //console.log(suma)
            var total1 = suma1 / xy['semana-1']['total-1'].length;
            y.push(total1.toFixed(2));
            //termino la primer semana
            //aqui saco la semana actaul
            var suma = 0;
            for (let i = 0; i < xy['semanaA']['totalA'].length; i++) {
                suma = suma + parseInt(xy['semanaA']['totalA'][i]);
                //y.push(xy['total'][i]);   
            }
            
            //console.log(suma)
            var total = suma / xy['semanaA']['totalA'].length;
            y.push(total.toFixed(2));
            //termina le semana actual
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
                title: 'Ultimas 4 Semanas',
                yaxis: {
                    title: 'ISC',
                },
                xaxis: {
                    title: 'Semana'
                }
                    
            };
            
            Plotly.newPlot('isctotal', data, layout, config);
            
        }
    })

    //promedio del mes anterior de las auditorias de limpieza
    $.ajax({
        url: 'g_aud_limpieza',
        type: 'GET',
        data: {
            aud_limpiza: true
        },
        success: function(result) {
            //console.log(result)
            var xy = JSON.parse(result);
            //console.log(xy);
            
            //console.log(xy[0])
            //console.log(key, values)
            var x = [];
            var y = [];

            var f = new Date();
            var meses = new Array ("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");
            //saco la info con un json y agrego la info del mes anterior
            for (let i = 0; i < xy['area'].length; i++) {
                x.push(xy['area'][i]);
                y.push(xy['total'][i]);
                
            }
            
            //console.log(x);
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
                title: '' + meses[xy['mes']],
                yaxis: {
                    title: 'Promedio',
                },
                xaxis: {
                    title: 'Areas'
                }
                    
            };
            
            Plotly.newPlot('promareanterior', data, layout, config);
        
        }
        
    })

    //promedio del mes actual de las auditorias de limpieza
    $.ajax({
        url: 'g_aud_limpieza_actual',
        type: 'GET',
        data: {
            aud_limpiza: true
        },
        success: function(result) {
            //console.log(result)
            var xy = JSON.parse(result);
            //console.log(xy);
            
            //console.log(xy[0])
            //console.log(key, values)
            var x = [];
            var y = [];

            var f = new Date();
            var meses = new Array ("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");
            //saco la info con un json y agrego la info del mes anterior
            for (let i = 0; i < xy['area'].length; i++) {
                x.push(xy['area'][i]);
                y.push(xy['total'][i]);
                
            }
            
            //console.log(x);
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
                title: '' + meses[xy['mes']],
                yaxis: {
                    title: 'Promedio',
                },
                xaxis: {
                    title: 'Areas'
                }
                    
            };
            
            Plotly.newPlot('promareactual', data, layout, config);
        
        }
        
    })

    //promedio del mes anterior de las auditorias de limpieza por empleado
    $.ajax({
        url: 'g_aud_limpieza_encargado',
        type: 'GET',
        data: {
            aud_limpiza: true
        },
        success: function(result) {
            //console.log(result)
            var xy = JSON.parse(result);
            //console.log(xy);
            
            //console.log(xy[0])
            //console.log(key, values)
            var x = [];
            var y = [];

            var f = new Date();
            var meses = new Array ("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");
            //saco la info con un json y agrego la info del mes anterior
            for (let i = 0; i < xy['area / personal'].length; i++) {
                x.push(xy['area / personal'][i]);
                y.push(xy['total'][i]);
                
            }
            
            //console.log(x);
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
                title: '' + meses[xy['mes']],
                yaxis: {
                    title: 'Promedio',
                },
                xaxis: {
                    title: 'Areas / Personal'
                }
                    
            };
            
            Plotly.newPlot('promareanteriorempleado', data, layout, config);
        
        }
        
    })

    //pongo lo del mes anterior con lo de los personales jaja
    $.ajax({
        url: 'g_aud_limpieza_actual_personal',
        type: 'GET',
        data: {
            aud_limpiza: true
        },
        success: function(result) {
            //console.log(result)
            var xy = JSON.parse(result);
            //console.log(xy);
            
            //console.log(xy[0])
            //console.log(key, values)
            var x = [];
            var y = [];

            var f = new Date();
            var meses = new Array ("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");
            //saco la info con un json y agrego la info del mes anterior
            for (let i = 0; i < xy['area / personal'].length; i++) {
                x.push(xy['area / personal'][i]);
                y.push(xy['total'][i]);
                
            }
            
            //console.log(x);
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
                title: '' + meses[xy['mes']],
                yaxis: {
                    title: 'Promedio',
                },
                xaxis: {
                    title: 'Areas / Personal'
                }
                    
            };
            
            Plotly.newPlot('promareactualempleado', data, layout, config);
        
        }
        
    })

})