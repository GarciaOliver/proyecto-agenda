<?php
include('../modelo/usuario.php');

if(isset($_POST['usuario']) && isset($_POST['clave'])){
    
    $usuario = $_POST['usuario'];
    $clave = $_POST['clave'];

    $ingreso=new Usuario();
    $resultado=$ingreso->listarUsuarios($usuario, $clave);

    if($resultado){
        session_start();
        $_SESSION['user'] = $usuario;
        $_SESSION['clave'] = $clave;
        echo true;
    }else{
        echo false;
    }
}
?>