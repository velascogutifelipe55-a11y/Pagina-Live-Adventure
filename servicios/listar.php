<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

require_once "../config/conexion.php";
$conexion = new Conexion();
$conn = $conexion->conectar();

$sql = "SELECT * FROM servicios ORDER BY nombre";
$resultado = $conn->query($sql);

$servicios = [];
while ($fila = $resultado->fetch_assoc()) {
    $servicios[] = $fila;
}

echo json_encode([
    "estado" => "exito",
    "cantidad" => count($servicios),
    "servicios" => $servicios
]);

$conn->close();
?>