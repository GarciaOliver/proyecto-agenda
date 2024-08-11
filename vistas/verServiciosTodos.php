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
        <div class="btnAgregarServicio">
            <button type="button" class="btn btn-primary btn-sm mb-4" data-bs-toggle="modal" data-bs-target="#modalIngreso"><i class="fa-regular fa-square-plus"></i><b>&nbspAgregar Servicio</b></button>
        </div>
        <div id="tabla" name="tabla" class="table-responsive">
            <table id="tablaServicios" class="table table-striped table-bordered">
                <thead>
                    <tr>
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
    <!----------------------------------------- Modal insertar un nuevo servicio -------------------->
    <div class="modal fade" id="modalIngreso" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Creación de Servicio</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="js-example-basic-single">Cliente</label>
                        <select class="form-select" name="cliente" id="cliente">
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Ciudad</label>
                        <select class="form-select" name="ciudad" id="ciudad">
                            <option value="ibarra">Ibarra</option>
                            <option value="pimampiro">Pimampiro</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Calle Principal</label>
                        <input id="principal" class="form-control" type="text" aria-label="default input example">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Calle Secundaria</label>
                        <input id="secundaria" class="form-control" type="text" aria-label="default input example">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Referencia del domicilio</label>
                        <input id="referencia" class="form-control" type="text" placeholder="Un número de casa o una estructura cerca del domicilio" aria-label="default input example">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Ciudad</label>
                        <select class="form-select" name="ciudad" id="ciudad">
                            <option value="fibra">Fibra Óptica</option>
                            <option value="inalambrico">Inalámbrico</option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <button type="button" class="btn btn-primary">Ingresar Servicio</button>
                </div>

            </div>
        </div>
    </div>

    <!----------------------------------------- Modal modificación de un servicio -------------------->

    <div class="modal fade" id="modalModificacion" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Modificar Servicio</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label">Número de Servicio</label>
                        <input class="form-control" type="text" value="" aria-label="Disabled input example" disabled readonly>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Ciudad</label>
                        <select class="form-select" name="ciudad" id="ciudad">
                            <option value="ibarra">Ibarra</option>
                            <option value="pimampiro">Pimampiro</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Calle Principal</label>
                        <input id="principal" class="form-control" type="text" aria-label="default input example">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Calle Secundaria</label>
                        <input id="secundaria" class="form-control" type="text" aria-label="default input example">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Referencia del domicilio</label>
                        <input id="referencia" class="form-control" type="text" placeholder="Un número de casa o una estructura cerca del domicilio" aria-label="default input example">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Tipo de Servicio</label>
                        <select class="form-select" name="ciudad" id="ciudad">
                            <option value="fibra">Fibra Óptica</option>
                            <option value="inalambrico">Inalámbrico</option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <button type="button" class="btn btn-primary">Guardar Cambios</button>
                </div>

            </div>
        </div>
    </div>

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