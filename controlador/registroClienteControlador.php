<?php
include('../modelo/cliente.php');

if(isset($_POST['cedula']) && isset($_POST['nombre']) && isset($_POST['nrotelefono']) && isset($_POST['correo']) && isset($_POST['contrasena'])){

    $cedula=$_POST['cedula'];
    $nombre=$_POST['nombre'];
    $nrotelefono=$_POST['nrotelefono'];
    $correo=$_POST['correo'];
    $contrasena=$_POST['contrasena'];

    $cliente=new cliente();

    $resultado=$cliente->insertarCliente($cedula,$nombre,$nrotelefono,$correo,$contrasena);

    if($resultado==true){
        echo true;
    }else{
        echo false;
    }

}
?>