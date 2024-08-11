<?php
include('../modelo/servicio.php');

if (isset($_POST['id'])) {
    $servicio = new servicio();
    $datos = $servicio->mostrarServicioId($_POST['id']);
    $contenido = '';

    $contenido = '<div class="mb-3">
    <label class="form-label">Número de Servicio</label>
    <input id="servicioDesactivar" class="form-control" type="text" value="' . $datos[0]["IDSERVICIO"] . '" aria-label="Disabled input example" disabled readonly>
</div>
<div class="mb-3">
    <label class="form-label">Cédula del Propietario</label>
    <input id="cliente" class="form-control" type="text" value="' . $datos[0]["IDCLIENTE"] . '" aria-label="Disabled input example" disabled readonly>
</div>';

    $selectedIbarra = $datos[0]["CIUDAD"] == "ibarra" ? 'selected' : '';
    $selectedPimampiro = $datos[0]["CIUDAD"] == "pimampiro" ? 'selected' : '';

    $contenido .= '<div class="mb-3">
    <label class="form-label">Ciudad</label>
    <select class="form-select" name="ciudadModal" id="ciudadModal" aria-label="Disabled select example" disabled>
        <option value="ibarra" ' . $selectedIbarra . '>Ibarra</option>
        <option value="pimampiro" ' . $selectedPimampiro . '>Pimampiro</option>
    </select>
</div>';

    $contenido .= '<div class="mb-3">
    <label class="form-label">Calle Principal</label>
    <input id="principalModal" class="form-control" type="text" value="' . $datos[0]["CALLEPRINCIPAL"] . '" aria-label="Disabled input example" disabled readonly">
</div>
<div class="mb-3">
    <label class="form-label">Calle Secundaria</label>
    <input id="secundariaModal" class="form-control" type="text" value="' . $datos[0]["CALLESECUNDARIA"] . '" aria-label="Disabled input example" disabled readonly">
</div>
<div class="mb-3">
    <label class="form-label">Referencia del domicilio</label>
    <input id="referenciaModal" class="form-control" type="text" value="' . $datos[0]["REFERENCIA"] . '" placeholder="Un número de casa o una estructura cerca del domicilio" aria-label="Disabled input example" disabled readonly">
</div>';
    $tipoServicio = $datos[0]["TIPOSERVICIO"];

    $selectedFibra = $tipoServicio == "fibra" ? 'selected' : '';
    $selectedInalambrico = $tipoServicio == "inalambrico" ? 'selected' : '';

    $contenido .= '<div class="mb-3">
    <label class="form-label">Tipo de Servicio</label>
    <select class="form-select" name="tipoServicioModal" id="tipoServicioModal" aria-label="Disabled select example" disabled>
        <option value="fibra" ' . $selectedFibra . '>Fibra Óptica</option>
        <option value="inalambrico" ' . $selectedInalambrico . '>Inalámbrico</option>
    </select>
</div>';

    echo $contenido;
}
