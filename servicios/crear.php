<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");

require_once "../config/conexion.php";
$conexion = new Conexion();
$conn = $conexion->conectar();

$datos = json_decode(file_get_contents("php://input"), true);

// Validar campos obligatorios
if (empty($datos['nombre']) || empty($datos['precio'])) {
    echo json_encode(["estado" => "error", "mensaje" => "Nombre y precio son obligatorios"]);
    exit;
}

$nombre = $datos['nombre'];
$descripcion = $datos['descripcion'] ?? "";
$precio = $datos['precio'];
$duracion = $datos['duracion'] ?? "";
$cupo = $datos['cupo_maximo'] ?? 10;

$sql = "INSERT INTO servicios (nombre, descripcion, precio, duracion, cupo_maximo) VALUES (?, ?, ?, ?, ?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ssds i", $nombre, $descripcion, $precio, $duracion, $cupo);

if ($stmt->execute()) {
    echo json_encode([
        "estado" => "exito",
        "mensaje" => "Servicio registrado correctamente",
        "id_generado" => $conn->insert_id
    ]);
} else {
    echo json_encode(["estado" => "error", "mensaje" => "Error al registrar: " . $stmt->error]);
}

$stmt->close();
$conn->close();
?>