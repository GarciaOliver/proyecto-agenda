<?php
include('../modelo/servicio.php');

$servicio=new servicio();

$data=$servicio->mostrarServiciosTodos();

echo json_encode($data,JSON_UNESCAPED_UNICODE);
?>