<?php
include('../modelo/orden.php');

$ordenes = new orden();
$listarDesordenada = $ordenes->detallesOrdenes();

$contenido = "";

foreach ($listarDesordenada as $dato) {
    $contenido .= 
    '<div class="row align-items-start"><h2>Datos de la orden de trabajo</h2><h3>Datos del Servicio</h3>
        <div class="col">
            <label class="form-label">Propietario del Servicio</label>
            <input class="form-control" type="text" value="'.$dato['NOMBRE_CLIENTE'].'" aria-label="Disabled input example" disabled readonly>
        </div>
        <div class="col">
            <label class="form-label">Ciudad</label>
            <input class="form-control" type="text" value="'.$dato['CIUDAD'].'" aria-label="Disabled input example" disabled readonly>
        </div>
        <div class="col">
            <label class="form-label">Calle Principal</label>
            <input class="form-control" type="text" value="'.$dato['CALLEPRINCIPAL'].'" aria-label="Disabled input example" disabled readonly>
        </div>
    </div>

    <div class="row align-items-start">
        <div class="col">
            <label class="form-label">Calle Secundaria</label>
            <input class="form-control" type="text" value="'.$dato['CALLESECUNDARIA'].'" aria-label="Disabled input example" disabled readonly>
        </div>
        <div class="col">
            <label class="form-label">Referencia</label>
            <input class="form-control" type="text" value="'.$dato['REFERENCIA'].'" aria-label="Disabled input example" disabled readonly>
        </div>
        <div class="col">
            <label class="form-label">Tipo de Servicio</label>
            <input class="form-control" type="text" value="'.$dato['TIPOSERVICIO'].'" aria-label="Disabled input example" disabled readonly>
        </div>
    </div>

    <div class="row align-items-start"><h3>Datos de la solicitud</h3>
        <div class="col">
            <label class="form-label">Nombre del Emisor</label>
            <input class="form-control" type="text" value="'.$dato['NOMBRE_SOPORTE'].'" aria-label="Disabled input example" disabled readonly>
        </div>
        <div class="col">
            <label class="form-label">Tipo de Trabajo</label>
            <input class="form-control" type="text" value="'.$dato['TIPODANO'].'" aria-label="Disabled input example" disabled readonly>
        </div>
        <div class="col">
            <label class="form-label">Descripción del Problema</label>
            <input class="form-control" type="text" value="'.$dato['DETALLE_SOLICITUD'].'" aria-label="Disabled input example" disabled readonly>
        </div>
    </div>

    <div class="row align-items-start">
        <div class="col">
            <label class="form-label">Horario de Atención</label>
            <input class="form-control" type="text" value="'.$dato['HORARIOATENCION'].'" aria-label="Disabled input example" disabled readonly>
        </div>
        <div class="col">
            <label class="form-label">Relevancia</label>
            <input class="form-control" type="text" value="'.$dato['RELEVANCIA'].'" aria-label="Disabled input example" disabled readonly>
        </div>
        <div class="col">
            <label class="form-label">Comentario del Emisor</label>
            <input class="form-control" type="text" value="'.$dato['OBSERVACIONSOPORTE'].'" aria-label="Disabled input example" disabled readonly>
        </div>
    </div>

    <div class="row align-items-start">
        <div class="col">
            <label class="form-label">Fecha de Emisión de Orden</label>
            <input class="form-control" type="text" value="'.$dato['FECHA_EMISION_ORDEN'].'" aria-label="Disabled input example" disabled readonly>
        </div>
        <div class="col">
            <label class="form-label">Fecha de Mantenimiento</label>
            <input class="form-control" type="text" value="'.$dato['FECHA_ELABORACION_ORDEN'].'" aria-label="Disabled input example" disabled readonly>
        </div>
        <div class="col">
            <label class="form-label">Fecha de Culminación</label>
            <input class="form-control" type="text" value="'.$dato['FECHA_FIN_ORDEN'].'" aria-label="Disabled input example" disabled readonly>
        </div>
    </div>

    <div class="row align-items-start">
        <div class="col">
            <button class="btn btn-primary mb-3" onclick="cerrarModal()">Cerrar</button>
        </div>
    </div>';
}

echo $contenido;
