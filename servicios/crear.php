<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

require_once "../config/conexion.php";
require_once "../modelos/Servicio.php";

$conexion = new Conexion();
$db = $conexion->conectar();

$servicio = new Servicio($db);

$entrada = json_decode(file_get_contents("php://input"), true);

$datos = [
    "nombre" => $entrada["nombre"] ?? "",
    "descripcion" => $entrada["descripcion"] ?? "",
    "precio" => $entrada["precio"] ?? 0,
    "duracion" => $entrada["duracion"] ?? "",
    "cupo_maximo" => $entrada["cupo_maximo"] ?? 0
];

$nuevo_id = $servicio->crear($datos);

if ($nuevo_id) {
    echo json_encode(["estado" => "exito", "mensaje" => "Servicio creado", "id" => $nuevo_id]);
} else {
    echo json_encode(["estado" => "error", "mensaje" => "No se pudo crear"]);
}

$db->close();
?>