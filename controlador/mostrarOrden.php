<?php
include('../modelo/orden.php');

$ordenes = new orden();
$listarDesordenada = $ordenes->detallesOrdenes();

$contenido = "";

foreach ($listarDesordenada as $dato) {
    $contenido .= 
    '<div class="container my-4">
    <div class="row mb-4">
        <div class="col">
            <h2 class="text-primary">Datos de la Orden de Trabajo</h2>
        </div>
    </div>

    <div class="row mb-4">
        <div class="col">
            <h3 class="text-secondary">Datos del Servicio</h3>
        </div>
    </div>

    <div class="row g-3">
        <div class="col-md-4">
            <label class="form-label">Propietario del Servicio</label>
            <input class="form-control" type="text" value="'.$dato['NOMBRE_CLIENTE'].'" disabled readonly>
        </div>
        <div class="col-md-4">
            <label class="form-label">Ciudad</label>
            <input class="form-control" type="text" value="'.$dato['CIUDAD'].'" disabled readonly>
        </div>
        <div class="col-md-4">
            <label class="form-label">Calle Principal</label>
            <input class="form-control" type="text" value="'.$dato['CALLEPRINCIPAL'].'" disabled readonly>
        </div>
    </div>

    <div class="row g-3 mt-3">
        <div class="col-md-4">
            <label class="form-label">Calle Secundaria</label>
            <input class="form-control" type="text" value="'.$dato['CALLESECUNDARIA'].'" disabled readonly>
        </div>
        <div class="col-md-4">
            <label class="form-label">Referencia</label>
            <input class="form-control" type="text" value="'.$dato['REFERENCIA'].'" disabled readonly>
        </div>
        <div class="col-md-4">
            <label class="form-label">Tipo de Servicio</label>
            <input class="form-control" type="text" value="'.$dato['TIPOSERVICIO'].'" disabled readonly>
        </div>
    </div>

    <div class="row mb-4 mt-5">
        <div class="col">
            <h3 class="text-secondary">Datos de la Solicitud</h3>
        </div>
    </div>

    <div class="row g-3">
        <div class="col-md-4">
            <label class="form-label">Nombre del Emisor</label>
            <input class="form-control" type="text" value="'.$dato['NOMBRE_SOPORTE'].'" disabled readonly>
        </div>
        <div class="col-md-4">
            <label class="form-label">Tipo de Trabajo</label>
            <input class="form-control" type="text" value="'.$dato['TIPODANO'].'" disabled readonly>
        </div>
        <div class="col-md-4">
            <label class="form-label">Descripción del Problema</label>
            <input class="form-control" type="text" value="'.$dato['DETALLE_SOLICITUD'].'" disabled readonly>
        </div>
    </div>

    <div class="row g-3 mt-3">
        <div class="col-md-4">
            <label class="form-label">Horario de Atención</label>
            <input class="form-control" type="text" value="'.$dato['HORARIOATENCION'].'" disabled readonly>
        </div>
        <div class="col-md-4">
            <label class="form-label">Relevancia</label>
            <input class="form-control" type="text" value="'.$dato['RELEVANCIA'].'" disabled readonly>
        </div>
        <div class="col-md-4">
            <label class="form-label">Comentario del Emisor</label>
            <input class="form-control" type="text" value="'.$dato['OBSERVACIONSOPORTE'].'" disabled readonly>
        </div>
    </div>

    <div class="row g-3 mt-5">
        <div class="col-md-4">
            <label class="form-label">Fecha de Emisión de Orden</label>
            <input class="form-control" type="text" value="'. $dato['FECHA_EMISION_ORDEN'].'" disabled readonly>
        </div>
        <div class="col-md-4">
            <label class="form-label">Fecha de Mantenimiento</label>
            <input class="form-control" type="text" value="'. $dato['FECHA_ELABORACION_ORDEN'].'" disabled readonly>
        </div>
        <div class="col-md-4">
            <label class="form-label">Fecha de Culminación</label>
            <input class="form-control" type="text" value="'.$dato['FECHA_FIN_ORDEN'].'" disabled readonly>
        </div>
    </div>

    <div class="row mt-4">
        <div class="col text-center">
            <button class="btn btn-primary" onclick="cerrarModal()">Cerrar</button>
        </div>
    </div>
</div>
';
}

echo $contenido;
