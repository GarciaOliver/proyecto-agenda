<?php
include('../modelo/servicio.php');

if(isset($_POST['cedula']) && isset($_POST['servicio']) && isset($_POST['ciudad']) && isset($_POST['principal']) && isset($_POST['secundaria']) && isset($_POST['nrocasa']) && isset($_POST['referencia'])){

    $datos = [
        "cedula" => $_POST['cedula'],
        "servicio" => $_POST['servicio'],
        "ciudad" => $_POST['ciudad'],
        "principal" => $_POST['principal'],
        "secundaria" => $_POST['secundaria'],
        "nrocasa" => $_POST['nrocasa'],
        "referencia" => $_POST['referencia']
    ];

    $ingreso=new servicio();
    $resultado=$ingreso->insertarServicio($datos);

    if($resultado=true){
        echo true;
    }else{
        echo false;
    }
    

}else{
    echo "Error en la comunicación de datos";
}
?>