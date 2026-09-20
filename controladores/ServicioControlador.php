<?php
require_once __DIR__ . "/../config/conexion.php";
require_once __DIR__ . "/../modelos/Servicio.php";
require_once __DIR__ . "/../utils/Respuesta.php";
require_once __DIR__ . "/../utils/Validar.php";

$conexion = (new Conexion())->conectar();
$servicio = new Servicio($conexion);
$respuesta = new Respuesta();

$metodo = $_SERVER['REQUEST_METHOD'];

switch ($metodo) {
    case 'GET':
        $resultado = $servicio->listar();
        $lista = $resultado->fetch_all(MYSQLI_ASSOC);
        $respuesta->exito(["cantidad" => count($lista), "servicios" => $lista]);
        break;

    case 'POST':
    $datos = json_decode(file_get_contents("php://input"), true);

    // ✅ Validar campos obligatorios
    $error = Validar::requerido(["nombre", "precio"], $datos);
    if ($error) {
        $respuesta->error($error, 400);
        exit;
    }

    // ✅ Si llega fecha, validar formato
    if (!empty($datos["fecha_reserva"])) {
        if (!Validar::esFechaValida($datos["fecha_reserva"])) {
            $respuesta->error("La fecha no es válida. Usa formato: AAAA-MM-DD", 400);
            exit;
        }
    }

    // ✅ Si todo está bien → crear el servicio
    $nuevoId = $servicio->crear($datos);
    
    if ($nuevoId) {
        $respuesta->exito(["mensaje" => "Servicio registrado", "id" => $nuevoId], 201);
    } else {
        $respuesta->error("Error al registrar", 500);
    }
    break;

    // Aquí después agregaremos PUT y DELETE

    default:
        $respuesta->error("Método no permitido", 405);
}

$conexion->close();
?>