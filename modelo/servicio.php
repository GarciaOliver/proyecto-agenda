<?php
require "../config/conf.php"; 

class servicio{
    public function __construct(){
		
	}

    public function insertarServicio($datos){

        session_start();
        $cedula=$datos['cedula'];
        $servicio=$datos['servicio'];
        $ciudad=$datos['ciudad'];
        $principal=$datos['principal'];
        $secundaria=$datos['secundaria'];
        $nrocasa=$datos['nrocasa'];
        $referencia=$datos['referencia'];

        $consulta = "call sp_insertarServicio('$cedula', '$ciudad', '$principal', '$secundaria', '$nrocasa', '$referencia', '$servicio');";
		
        if(ejecutarConsultaSP($consulta)){
            return true;
        }else{
            return false;
        }
		
    }

    public function mostrarServiciosTodos(){
        $consulta="call sp_mostrarServiciosTodos();";
        $resultado = ejecutarConsultaSP($consulta);
		if ($resultado->num_rows > 0) {
			$data = [];
			
			while ($fila = $resultado->fetch_assoc()) {
				$data['data'][] = $fila;
			}
			return $data;
		} else {
			return null;
		}
    }

    public function mostrarServiciosCliente($cedula){

        $consulta="call sp_mostrarServiciosCliente('$cedula');";
        $resultado = ejecutarConsultaSP($consulta);
		if ($resultado->num_rows > 0) {
			$data = [];
			
			while ($fila = $resultado->fetch_assoc()) {
				$data['data'][] = $fila;
			}
			return $data;
		} else {
			return null;
		}
    }
}
?>