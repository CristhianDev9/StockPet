<?php
require_once "../inc/session_start.php";
require_once "main.php";

$data = json_decode(file_get_contents("php://input"), true);
$ml = limpiar_cadena($data['ml']);
$tipo = limpiar_cadena($data['tipo']);
$color = limpiar_cadena($data['color']);

$conexion = conexion();
$query = $conexion->prepare("SELECT envase_id FROM envase WHERE envase_ml = :ml AND envase_tipo = :tipo AND envase_color = :color");
$query->bindParam(":ml", $ml);
$query->bindParam(":tipo", $tipo);
$query->bindParam(":color", $color);
$query->execute();

$result = $query->fetch(PDO::FETCH_ASSOC);
if($result){
    echo json_encode(["envase_id" => $result['envase_id']]);
} else {
    echo json_encode(["envase_id" => null]);
}
?>
