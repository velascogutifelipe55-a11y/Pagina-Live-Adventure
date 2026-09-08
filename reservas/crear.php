<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");

require_once "../config/conexion.php";
$conexion = new Conexion();
$conn = $conexion->conectar();

$datos = json_decode(file_get_contents("php://input"), true);

if (empty($datos['servicio_id']) || empty($datos['nombre_cliente']) || empty($datos['fecha_reserva'])) {
    echo json_encode(["estado" => "error", "mensaje" => "Faltan datos obligatorios"]);
    exit;
}

$servicio_id = $datos['servicio_id'];
$nombre_cliente = $datos['nombre_cliente'];
$fecha_reserva = $datos['fecha_reserva'];
$cantidad = $datos['cantidad_personas'] ?? 1;

$sql = "INSERT INTO reservas (servicio_id, nombre_cliente, fecha_reserva, cantidad_personas) VALUES (?, ?, ?, ?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("issi", $servicio_id, $nombre_cliente, $fecha_reserva, $cantidad);

if ($stmt->execute()) {
    echo json_encode([
        "estado" => "exito",
        "mensaje" => "Reserva realizada con éxito",
        "numero_reserva" => $conn->insert_id
    ]);
} else {
    echo json_encode(["estado" => "error", "mensaje" => "Error al reservar: " . $stmt->error]);
}

$stmt->close();
$conn->close();
?>