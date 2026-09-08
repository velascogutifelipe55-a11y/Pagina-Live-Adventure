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
$sql = "SELECT * FROM servicios WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $id);
$stmt->execute();
$resultado = $stmt->get_result();

if ($resultado->num_rows === 0) {
    echo json_encode(["estado" => "error", "mensaje" => "Servicio no encontrado"]);
} else {
    $servicio = $resultado->fetch_assoc();
    echo json_encode(["estado" => "exito", "servicio" => $servicio]);
}

$stmt->close();
$conn->close();
?>