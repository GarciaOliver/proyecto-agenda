<?php
include('../modelo/servicio.php');

/*if (isset($_POST['id'])) {
    $id=

    $servicio = new servicio($id);
    $datos = $servicio->mostrarServicioId();

    echo $lista;
}*/
$servicio = new servicio();
    $datos = $servicio->mostrarServicioId(4);
    
    echo $datos[0];
