<?php
include('../modelo/persona.php');

if(isset($_POST['usuario']) && isset($_POST['clave'])){
    
    $usuario = $_POST['usuario'];
    $clave = $_POST['clave'];

    $ingreso=new persona();
    $resultado=$ingreso->listarUsuarios($usuario, $clave);

    if($resultado!=null && $resultado!=false){
        session_start();

        $datos = [
            "cedula" => $resultado[0],
            "nombre" => $resultado[1],
            "apellido" => $resultado[2],
            "telefono" => $resultado[3],
            "ocupacion" => $resultado[5],
            "correo" => $resultado[6],
            "estado" => $resultado[7]
        ];

        $_SESSION['datos'] = $datos;
        echo true;
    }else{
        echo false;
    }
}
?>