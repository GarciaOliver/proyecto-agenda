<!doctype html>
<html>

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Formulario de Servicio</title>
    
    <script src="../public/jquery/jquery-3.7.1.js"></script>
    <script src="../js/regsitroCliente.js"></script>

    <!------BOOTSTRAP------>
    <link href="../public/bootstrap-5.0.2-dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="../public/bootstrap-5.0.2-dist/js/bootstrap.bundle.min.js"></script>
    
    <!------JQuery--------->
    <script src="../public/jquery/jquery-3.7.1.js"></script>

    <!------DataTable------>
    <script src="https://cdn.datatables.net/2.1.2/js/dataTables.js"></script>
    <script src="https://cdn.datatables.net/2.1.2/js/dataTables.bootstrap5.min.js"></script>
    <link href="https://cdn.datatables.net/2.1.2/css/dataTables.bootstrap5.min.css" rel="stylesheet">
</head>

<body class="text-center">
    <div class="container mt-5">
        <div id="dataTableClientes" name="dataTableClientes" class="table-responsive">
            <table id="tablaClientes" class="table table-striped table-bordered">
                <thead>
                    <tr>
                        <th>Cédula</th>
                        <th>Nombre</th>
                        <th>Teléfono</th>
                        <th>Correo Electrónico</th>
                        <th>Estado</th>
                        <th>Contraseña</th>
                        <th>Opciones</th>
                    </tr>
                </thead>
                <tbody id="datosTabla">
                    
                </tbody>
            </table>
        </div>
    </div>

</body>

<script src="../js/listarCliente.js"></script>

</html>