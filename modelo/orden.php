<?php
require "../config/conf.php";

class orden{
    public function __construct(){
		
	}

    public function mostrarOrdenes(){
        $consulta="SELECT * FROM orden;";
        $resultado = ejecutarConsultaSP($consulta);

        if ($resultado->num_rows > 0) {
			$datos = array();
			
			while ($fila = $resultado->fetch_assoc()) {
				$datos[] = $fila;
			}
			return $datos;
		} else {

			echo "Error en la recepción de datos.";
			return null;
		}
    }

	public function detallesOrdenes(){
		$consulta="call sp_verDetallesOrden(6);";
        $resultado = ejecutarConsultaSP($consulta);

        if ($resultado->num_rows > 0) {
			$datos = array();
			
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
?>