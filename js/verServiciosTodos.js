//Funciones de la ventana emergente CREACIÓN SERVICIO-------------------------------------------------------------------------

function recargar(){
	
	
}

//Funciones de la ventana emergente EDITAR SERVICIO-------------------------------------------------------------------------

function editarServicio(numServicio){
    $.ajax({
		type:"POST",
        data:{id:numServicio},
		url:"../controlador/mostrarServicio.php",
		success: function(datos) {

			$('#cliente').html(datos);
		}
	});
}

//Configuración del Datatable---------------------------------------------------------------------------------

let dataTableOpciones={
    dom: "Bfrtilp",
    buttons: [
        {
            extend: "pdfHtml5",
            text:'<i class="fa-solid fa-file-pdf"></i>',
            title: "Exportar a PDF",
            className: "btn btn-danger" 
        },
        {
            extend: "print",
            text:'<i class="fa-solid fa-print"></i>',
            title: "Imprimir",
            className: "btn btn-primary" 
        }
    ],
    lengthMenu: [5, 10, 20, 40, 80],
    pageLength: 5,
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
    ajax:"../controlador/verServiciosTodosControlador.php",
    columns:[
        {"data":"PROPIETARIO"},
        {"data":"CIUDAD"},
        {"data":"CALLEPRINCIPAL"},
        {"data":"CALLESECUNDARIA"},
        {"data":"REFERENCIA"},
        {"data":"TIPOSERVICIO"},
        {"data":"ESTADO"},
        {"data":"IDSERVICIO","render":function(data){
            return '<p><button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalModificacion" onClick="editarServicio('+data+')"><i class="fa-solid fa-pen-to-square"></i></button>&nbsp;<button class="btn btn-danger" onClick="alertaPrueba2('+data+')"><i class="fa-solid fa-trash-can"></i></button></p>'
        }}
    ],
    columnDefs: [
        {orderable: false, target: [4,6,7]},
        {searchable: false, target: [5,6,7]},
        {width: "5%", target: [0,5]},
        {width: "20%", target: [2,3,4]},
    ]
};

$(document).ready(function(){
    $('#tabla').hide();
    $('#tablaServicios').DataTable(dataTableOpciones);
    $('#tabla').show();
});

