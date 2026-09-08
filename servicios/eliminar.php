<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");

require_once "../config/conexion.php";
$conexion = new Conexion();
$conn = $conexion->conectar();

$datos = json_decode(file_get_contents("php://input"), true);

if (empty($datos['id'])) {
    echo json_encode(["estado" => "error", "mensaje" => "El ID es obligatorio"]);
    exit;
}

$id = $datos['id'];

// Verificar si tiene reservas asociadas
$verificar = $conn->prepare("SELECT id FROM reservas WHERE servicio_id = ?");
$verificar->bind_param("i", $id);
$verificar->execute();
if ($verificar->get_result()->num_rows > 0) {
    echo json_encode(["estado" => "error", "mensaje" => "No se puede eliminar: tiene reservas"]);
    exit;
}

$sql = "DELETE FROM servicios WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $id);

if ($stmt->execute()) {
    echo json_encode(["estado" => "exito", "mensaje" => "Servicio eliminado correctamente"]);
} else {
    echo json_encode(["estado" => "error", "mensaje" => "Error al eliminar"]);
}

$stmt->close();
$conn->close();
?>