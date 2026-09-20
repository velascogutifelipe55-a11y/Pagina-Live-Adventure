<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

require_once "../config/conexion.php";
require_once "../modelos/Servicio.php";

$conexion = new Conexion();
$db = $conexion->conectar();

$servicio = new Servicio($db);

// ✅ Leer JSON que envías desde Postman
$entrada = json_decode(file_get_contents("php://input"), true);
$id = $entrada["id"] ?? 0;

if ($id == 0) {
    echo json_encode(["estado" => "error", "mensaje" => "Falta el ID"]);
    $db->close();
    exit;
}

if ($servicio->eliminar($id)) {
    echo json_encode(["estado" => "exito", "mensaje" => "Servicio eliminado"]);
} else {
    echo json_encode(["estado" => "error", "mensaje" => "No se pudo eliminar"]);
}

$db->close();
?>