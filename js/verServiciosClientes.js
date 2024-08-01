$(document).ready(function(){
    $('#tablaServicios').DataTable({
        lengthMenu: [5, 10, 20, 40, 80],
        pageLength: 3,
        language: {
            lengthMenu: "Mostrar _MENU_ registros por página",
            zeroRecords: "Ningún usuario encontrado",
            info: "Mostrando de _START_ a _END_ de un total de _TOTAL_ registros",
            infoEmpty: "Ningún usuario encontrado",
            infoFiltered: "(filtrados desde _MAX_ registros totales)",
            search: "Buscar:",
            loadingRecords: "Cargando...",
            paginate: {
                first: "Primero",
                last: "Último",
                next: ">",
                previous: "<"
            }
        },
        ajax:{
			"method":"POST",
			"url":"../controlador/verServiciosClienteControlador.php"
		},
        columns:[
			{"data":"IDSERVICIO"},
			{"data":"CIUDAD"},
			{"data":"CALLEPRINCIPAL"},
			{"data":"CALLESECUNDARIA"},
			{"data":"REFERENCIA"},
            {"data":"TIPOSERVICIO"},
            {"data":"ESTADO"}
		]
    });
});