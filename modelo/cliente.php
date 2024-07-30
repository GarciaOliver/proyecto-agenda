<?php
require "../config/conf.php"; 

class cliente{
    public function __construct(){
		
	}

    public function insertarCliente($cedula,$nombre,$nrotelefono,$correo,$contrasena){
        $consulta="call sp_insertarCliente('$cedula', '$nombre', '$nrotelefono', '$correo', '$contrasena');";

        if(ejecutarConsultaSP($consulta)){
            return true;
        }else{
            return false;
        }
    }

    public function mostrarClientes(){
        $consulta="call sp_mostrarClientes();";
        $resultado = ejecutarConsultaSP($consulta);

        if ($resultado->num_rows > 0) {
			$datos = [];
			
			while ($fila = $resultado->fetch_assoc()) {
				$datos[] = $fila;
			}
			return $datos;
		} else {

			echo "Error en la recepción de datos.";
			return null;
		}
    }
    
}