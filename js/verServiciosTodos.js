//Funciones de la ventana emergente ELIMINACIÓN SERVICIO-------------------------------------------------------------------------

function modalDesactivarServicio(numServicio){
	$.ajax({
		type:"POST",
        data:{id:numServicio},
		url:"../controlador/mostrarServicioLimitado.php",
		success: function(datos) {
			$('#cuerpoDesactivar').html(datos);
		}
	});
}

function desactivarServicio(){
    var id=$('#servicioDesactivar').val();

    $.ajax({
		type:"POST",
        data:{id:id,
            estado:"APAGADO"
        },
		url:"../controlador/modificarEstadoServicio.php",
		success: function(datos) {
			if(datos=true){
                alert("Se modificó el servicio correctamente");
            }else{
                alert("Error");
            }
		}
	});
}

//Funciones de la ventana emergente EDITAR SERVICIO-------------------------------------------------------------------------

function modalEditarServicio(numServicio){
    $.ajax({
		type:"POST",
        data:{id:numServicio},
		url:"../controlador/mostrarServicio.php",
		success: function(datos) {
			$('#cuerpoModificar').html(datos);
		}
	});
}

function guardarCambios(){
    var id=$('#servicio').val();
    var ciudad=$('#ciudadModal').val();
    var principal=$('#principalModal').val();
    var secundaria=$('#secundariaModal').val();
    var referencia=$('#referenciaModal').val();
    var tipo=$('#tipoServicioModal').val();


    $.ajax({
		type:"POST",
        data:{id:id,
            ciudad:ciudad,
            principal:principal,
            secundaria:secundaria,
            referencia:referencia,
            tipo:tipo
        },
		url:"../controlador/modificarServicio.php",
		success: function(datos) {
			if(datos=true){
                alert("Se modificó el servicio correctamente");
            }else{
                alert("Error");
            }
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
        {"data":"ESTADO","render":function(data){
            if(data=="ACTIVO"){
                return '<i class="fa-solid fa-circle-check" style="color: #38ff59; font-size: 32px;"></i>'
            }else{
                return '<i class="fa-solid fa-circle-xmark" style="color: #c20000; font-size: 32px;"></i>'
            }
        }},
        {"data":"IDSERVICIO","render":function(data){
            return '<p><button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalModificacion" onClick="modalEditarServicio('+data+')"><i class="fa-solid fa-pen-to-square"></i></button>&nbsp;<button class="btn btn-danger" onClick="modalDesactivarServicio('+data+')"data-bs-toggle="modal" data-bs-target="#modalDesactivacion"><i class="fa-solid fa-trash-can"></i></button></p>'
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

