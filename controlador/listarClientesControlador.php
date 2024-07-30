<?php
include('../modelo/cliente.php');

$clientes=new cliente();

$lista=[];
$lista=$clientes->mostrarClientes();

if($lista!=null){
    $texto='';
    foreach ($lista as $usuario) {
		$texto=$texto.'<tr>
                <td>'.$usuario['CEDULA'].'</td>
                <td>'.$usuario['NOMBRE'].'</td>
                <td>'.$usuario['NROTELEFONO'].'</td>
				<td>'.$usuario['CONTRASENIA'].'</td>
				<td>'.$usuario['CORREO'].'</td>
				<td>'.$usuario['ESTADO'].'</td>
                <td><button>Hola</button></td>
            </tr>';
    }
    echo $texto;
}
?>