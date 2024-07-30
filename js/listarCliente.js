let dataTable;
let dataTableisInitialized = false;

const dataTableOptions = {
    lengthMenu: [5, 10, 20, 40, 80],
    pageLength: 3,
    destroy: true,
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
            next: "Siguiente",
            previous: "Anterior"
        }
    }
};

const initDataTable = async () => {
    if (dataTableisInitialized) {
        dataTable.destroy();
        $('#tablaClientes').empty();  // Limpia el contenido de la tabla
    }

    await datosAjax();

    dataTable = $('#tablaClientes').DataTable(dataTableOptions);

    dataTableisInitialized = true;
};

const datosAjax = async () => {
    $.ajax({
        type: "POST",
        url: "../controlador/listarClientesControlador.php",
        success: function (datos) {
            $('#datosTabla').html(datos);  // Asegúrate de que esto esté apuntando al contenedor correcto de los datos
        }
    });
};

window.addEventListener("load", async () => {
    await initDataTable();
});
