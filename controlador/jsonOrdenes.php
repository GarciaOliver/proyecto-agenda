<?php
include('../modelo/orden.php');

$ordenes = new orden();
$listarDesordenada=$ordenes->mostrarOrdenes();

$listaOrdenada=array();

foreach ($listarDesordenada as $dato) {
    $listaOrdenada[]=[
        "id"=>$dato['IDORDEN'],
        "title"=>"Orden No: ".$dato['IDORDEN'].$dato['IDSOLICITUD'].$dato['IDTECNICO'],
        "descripcion"=>$dato['RELEVANCIA'],
        "textColor"=>"#FF0F0",
        "start"=>$dato['FECHAELABORACION'],
        "end"=>$dato['FECHAFIN']
    ];
}

echo json_encode($listaOrdenada);
?>