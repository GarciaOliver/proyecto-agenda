<?php
require "../config/conf.php"; 
class persona{
    public function __construct(){
		
	}

    public function listarUsuarios($usuario, $clave){
        $consulta = "call sp_login('$usuario', '$clave');";
		$resultado = ejecutarConsultaSP($consulta);
		if($resultado->num_rows > 0){
            $resultadoOrdenado= $resultado->fetch_array();
            return $resultadoOrdenado;
        }else{
            return null;
        }
    }
}
?>