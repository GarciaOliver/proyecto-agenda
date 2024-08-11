<?php
include('../modelo/cliente.php');

$clientes=new cliente();
$lista=$clientes->mostrarClientes();
$opciones="";
foreach ($lista as &$valor) {
    $opciones.="<option value='".$valor['CEDULA']."'>".$valor['CEDULA']."-".$valor['NOMBRE']."</option>";
}
echo $opciones;
?>