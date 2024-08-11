<?php
include('../modelo/servicio.php');

if (isset($_POST['id']) && isset($_POST['estado'])) {

    $id=$_POST['id'];
    $estado=$_POST['estado'];

    $servicio = new servicio();
    $datos = $servicio->cambiarEstadoServicio($id, $estado);
    
    if($datos){
        echo true;
    }else{
        echo false;
    }
}
?>z