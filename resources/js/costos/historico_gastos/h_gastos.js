$(document).ready(function(){
    //console.log('jala')
    $.ajax({
        url: 'g_tipo_gasto_mes',
        type: 'GET',
        data: {
            tpgmes: true
        },
        success: function(result) {
            //console.log(result)
            var xy = JSON.parse(result);
            //console.log(Object.keys(xy[0]));
            /*
            xy.sort((a,b) => {
                return b.cantidad - a.cantidad
            })
            //console.log(xy)
            //console.table(this.xy.sort(((a, b) => b.cantidad - a.cantidad)));
            /*
            xy.sort(function (a, b) {
                if (a.cantidad > b.cantidad) {
                return 1;
                }
                if (a.cantidad < b.cantidad) {
                return -1;
                }
                // a must be equal to b
                return 0;
            });
             */
            //console.log(xy)
            //saco las fechas
            
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

            for(const [key, value] of Object.entries(xy)){
                //x.push(value[0]);
                y.push(value['cantidad']);
            }
            
            for (let i = 0; i < xy.length; i++) {
                x.push(ll[i][0])
                //y.push(ll[i][1])
            }  
           //console.log(x)

            //var x = [xy['trenta'], xy['timpuesto'], xy['tnomina'], xy['tequipo'], xy['tmatacaba'], xy['trefacciones'], xy['tservicios'], xy['tadministracion'], xy['ttot'], xy['tpapeleria'], xy['therramienta'], xy['tmiscelaneos'], xy['tlimpieza'], xy['tmateriales_proceso']];
            //var y = [xy['grenta'], xy['gimpuesto'], xy['gnomina'], xy['gequipo'], xy['gmatacaba'], xy['grefacciones'], xy['gservicios'], xy['gadministracion'], xy['gtot'], xy['gpapeleria'], xy['gherramienta'], xy['gmiscelaneos'], xy['glimpieza'], xy['gmateriales_proceso']];

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
                    title: 'MXN',
                },
                xaxis: {
                    title: 'Tipo de Gasto'
                }
                    
            };
            
            Plotly.newPlot('tgmes', data, layout, config);
            
        }
    })
})