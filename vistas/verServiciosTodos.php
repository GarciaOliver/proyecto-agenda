<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Servicios</title>
    <link href="https://cdn.datatables.net/2.1.2/css/dataTables.bootstrap5.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/buttons/3.1.0/css/buttons.bootstrap5.min.css" rel="stylesheet">
    
    <!------Bootstrap------------>
    <link rel="stylesheet" href="../public/bootstrap-5.0.2-dist/css/bootstrap.min.css">
    <!------Font Awesome--------->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">
    
</head>
<body>
    <div class="container mt-5">
        <h1 class="text-center mb-4">Servicios Contratados</h1>
        <div id="tabla" name="tabla" class="table-responsive">
            <table id="tablaServicios" class="table table-striped table-bordered">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Propietario</th>
                        <th>Ciudad</th>
                        <th>Calle Principal</th>
                        <th>Calle Secundaria</th>
                        <th>Referencia</th>
                        <th>Tipo</th>
                        <th>Estado</th>
                        <th>Editar/Eliminar</th>
                    </tr>
                </thead>
                <tbody id="tbodyServicios">
                    <!-- Aquí se insertarán las filas dinámicamente -->
                </tbody>
            </table>
        </div>
    </div>

    <dialog id="modalEditar">
        <h1>Edición de servicios</h1>
        <input type="text" name="modalCiudad" id="modalCiudad">
        <input type="text" name="modalPrincipal" id="modalPrincipal">
        <input type="text" name="modalSecundaria" id="modalSecundaria">
        <input type="text" name="modalReferencia" id="modalReferencia">

        <input type="button" value="Cancelar" onclick="cerrarModal()">
        <input type="button" value="Guardar" onclick="cerrarModal()">
    </dialog>

    <!--------------JQuery--------------------------------->
    <script src="../public/jquery/jquery-3.7.1.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/2.1.2/js/dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/2.1.2/js/dataTables.bootstrap5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/3.1.0/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/3.1.0/js/buttons.bootstrap5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/3.1.0/js/buttons.colVis.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/3.1.0/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/3.1.0/js/buttons.print.min.js"></script>
    <!--------------Bootstrap------------------------------>
    <script src="../public/bootstrap-5.0.2-dist/js/bootstrap.bundle.min.js"></script>
    

    <script src="../js/verServiciosTodos.js"></script>
</body>
</html>