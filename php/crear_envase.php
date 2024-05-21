<?php
require_once "../inc/session_start.php";
require_once "main.php";

$data = json_decode(file_get_contents("php://input"), true);
$ml = limpiar_cadena($data['ml']);
$tipo = limpiar_cadena($data['tipo']);
$color = limpiar_cadena($data['color']);

$conexion = conexion();
$query = $conexion->prepare("INSERT INTO envase (envase_ml, envase_tipo, envase_color) VALUES (:ml, :tipo, :color)");
$query->bindParam(":ml", $ml);
$query->bindParam(":tipo", $tipo);
$query->bindParam(":color", $color);
$query->execute();

$envase_id = $conexion->lastInsertId();
echo json_encode(["envase_id" => $envase_id]);
?>
