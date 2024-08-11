<?php
include('../modelo/servicio.php');

if (isset($_POST['id']) && isset($_POST['ciudad']) && isset($_POST['principal']) && isset($_POST['secundaria']) && isset($_POST['referencia']) && isset($_POST['tipo'])) {

    $id=$_POST['id'];
    $ciudad=$_POST['ciudad'];
    $principal=$_POST['principal'];
    $secundaria=$_POST['secundaria'];
    $referencia=$_POST['referencia'];
    $tiposervicio=$_POST['tipo'];

    $servicio = new servicio();
    $datos = $servicio->modificarDatosServicio($id,$ciudad,$principal,$secundaria,$referencia,$tiposervicio);
    
    if($datos){
        echo true;
    }else{
        echo false;
    }
}
?>