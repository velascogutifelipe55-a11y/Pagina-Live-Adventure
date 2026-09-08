<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

require_once "../config/conexion.php";
$conexion = new Conexion();
$conn = $conexion->conectar();

$sql = "SELECT r.*, s.nombre as nombre_servicio, s.precio 
        FROM reservas r 
        INNER JOIN servicios s ON r.servicio_id = s.id 
        ORDER BY fecha_reserva DESC";

$resultado = $conn->query($sql);
$reservas = [];
while ($fila = $resultado->fetch_assoc()) {
    $reservas[] = $fila;
}

echo json_encode([
    "estado" => "exito",
    "cantidad" => count($reservas),
    "reservas" => $reservas
]);

$conn->close();
?>