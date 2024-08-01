<?php
include('../modelo/servicio.php');

$servicio=new servicio();

$data=$servicio->mostrarServiciosCliente('200');

echo json_encode($data,JSON_UNESCAPED_UNICODE);
?>