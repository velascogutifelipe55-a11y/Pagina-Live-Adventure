<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

require_once "../config/conexion.php";
require_once "../modelos/Reserva.php";

$conexion = new Conexion();
$db = $conexion->conectar();

$reserva = new Reserva($db);
$resultado = $reserva->listar();

$lista = [];
while ($fila = $resultado->fetch_assoc()) {
    $lista[] = $fila;
}

echo json_encode([
    "estado" => "exito",
    "cantidad" => count($lista),
    "reservas" => $lista
]);

$db->close();
?>