<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

require_once "../config/conexion.php";
require_once "../modelos/Reserva.php";

$conexion = new Conexion();
$db = $conexion->conectar();

$reserva = new Reserva($db);

$entrada = json_decode(file_get_contents("php://input"), true);

$datos = [
    "servicio_id" => $entrada["servicio_id"] ?? 0,
    "nombre_cliente" => $entrada["nombre_cliente"] ?? "",
    "fecha_reserva" => $entrada["fecha_reserva"] ?? "",
    "cantidad_personas" => $entrada["cantidad_personas"] ?? 0
];

$nueva_reserva = $reserva->crear($datos);

if ($nueva_reserva) {
    echo json_encode(["estado" => "exito", "mensaje" => "Reserva creada", "id" => $nueva_reserva]);
} else {
    echo json_encode(["estado" => "error", "mensaje" => "No se pudo crear la reserva"]);
}

$db->close();
?>