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
    ],
    columnDefs: [
        {orderable: false, target: [1,2,3]},
        {searchable: false, target: []},
        {width: "5%", target: [0,1,6]},
        {width: "10%", target: [5]},
        {width: "30%", target: [4]}
    ]
};

$(document).ready(function(){
    $('#tablaServicios').DataTable(dataTableOpciones);
});