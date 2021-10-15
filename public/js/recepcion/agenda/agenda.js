document.addEventListener('DOMContentLoaded', function() {
    var calendarEl = document.getElementById('agenda');
    var calendar = new FullCalendar.Calendar(calendarEl, {
        initialView: 'dayGridMonth',
        locale: 'es',
        headerToolbar: {
            left: 'prev,next today',
            center: 'title',
            right: 'dayGridMonth,timeGridWeek,listWeek'
        },
        events: "/agenda_show",
        dateClick: function(info){
            $("#title").val('');
            $("#motivo").val('');
            $("#start").val('');
            $("#end").val('');
            $("#start").val(info.dateStr);
            $("#end").val(info.dateStr);
            $("#evento").modal('show');
        },
        eventClick: function(info){
            
            axios.post('/agenda_edit/'+info.event.id).then(
                (response) => {
                    $("#id").val(response.data.id);
                    $("#title").val(response.data.title);
                    $("#motivo").val(response.data.motivo);
                    let start = response.data.start.split(' ');
                    $("#start").val(start[0]);
                    $("#start2").val(start[1]);
                    let end = response.data.end.split(' ');
                    $("#end").val(end[0]);
                    $("#end2").val(end[1]);
                    $("#evento").modal('show');
                }
            ).catch(
                e => {
                    console.log(e.response);
                }
            );
        }
    });
    calendar.render();

    document.getElementById('cerrar').addEventListener('click', function(){
        $("#title").val('');
        $("#motivo").val('');
        $("#start").val('');
        $("#start2").val('');
        $("#end").val('');
        $("#end2").val('');
        $("#evento").modal('hide');
    });

    document.getElementById('btn_save').addEventListener('click', function(){
        if ($("#title").val() == '') {
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: 'Ingresa el titulo del evento',
            })

            $("#title").val('');

            return false
        }

        if ($("#motivo").val() == 0) {
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: 'Seleccion un motivo por el cual se genera el evento',
            })

            $("#motivo").val('');

            return false
        }

        if ($("#start").val() == '') {
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: 'Ingresa la fecha de inicio del evento',
            })

            $("#start").val('');

            return false
        }

        if ($("#start2").val() == '') {
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: 'Ingresa la hora de inicio del evento',
            })

            $("#start").val('');

            return false
        }

        if ($("#end").val() == '') {
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: 'Ingresa la fecha de termino del evento',
            })

            $("#end").val('');

            return false
        }

        if ($("#end2").val() == '') {
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: 'Ingresa la hora de termino del evento',
            })

            $("#end").val('');

            return false
        }

        const datos = $("#modal_form").serialize();
        axios.post('/agenda', datos).then(
            (response) => {
                if (response.data == 1) {
                    calendar.refetchEvents();
                    Swal.fire({
                        icon: 'success',
                        title: 'Correcto',
                        text: 'Evento registrado',
                    });
                    $("#title").val('');
                    $("#motivo").val('');
                    $("#start").val('');
                    $("#end").val('');
                    $("#evento").modal('hide');
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: 'Algo salio evento no registrado',
                    })
                }
            }
        ).catch(
            e => {
                console.log(e.response);
            }
        );
    });

    document.getElementById('btn_update').addEventListener('click', function(){
        const datos = $("#modal_form").serialize();
        axios.post('/agenda_update/'+$("#id").val(), datos).then(
            (response) => {
                if (response.data == 1) {
                    calendar.refetchEvents();
                    Swal.fire({
                        icon: 'success',
                        title: 'Correcto',
                        text: 'Evento actualizado',
                    });
                    $("#title").val('');
                    $("#motivo").val('');
                    $("#start").val('');
                    $("#start2").val('');
                    $("#end").val('');
                    $("#end2").val('');
                    $("#evento").modal('hide');
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: 'Algo salio evento no actualizado',
                    })
                }
            }
        ).catch(
            e => {
                console.log(e.response);
            }
        );
    });

    document.getElementById('btn_delete').addEventListener('click', function(){
        axios.post('/agenda_delete/'+$("#id").val()).then(
            (response) => {
                if (response.data == true) {
                    calendar.refetchEvents();
                    Swal.fire({
                        icon: 'success',
                        title: 'Correcto',
                        text: 'Evento eliminado',
                    });
                    $("#title").val('');
                    $("#motivo").val('');
                    $("#start").val('');
                    $("#start2").val('');
                    $("#end").val('');
                    $("#end2").val('');
                    $("#evento").modal('hide');
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: 'Algo salio evento no eliminado',
                    })
                }
            }
        ).catch(
            e => {
                console.log(e.response);
            }
        );
    });
});