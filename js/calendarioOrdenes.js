$(document).ready(function(){
    $('#cambio').hide();


});

function cerrarModal(){
    $('#cambio').hide();
}

function verModal(numOrden){
    $('#cambio').show();
    $.ajax({
		type:"POST",
        data:{id:numOrden},
		url:"../controlador/mostrarOrden.php",
		success: function(datos) {
			$('#cambio').html(datos);
		}
	});
}

document.addEventListener('DOMContentLoaded', function() {
            var calendarEl = document.getElementById('calendar');
            var calendar = new FullCalendar.Calendar(calendarEl, {
                themeSystem: 'bootstrap5',
                initialView: 'dayGridMonth',
                events:'http://localhost/Proyecto_Agenda/controlador/jsonOrdenes.php',
                eventClick: function(info) {

                    verModal(info.event.id);
                    info.el.style.borderColor = 'blue';
                }
            });
            calendar.setOption('locale','Es')
            calendar.render();
});