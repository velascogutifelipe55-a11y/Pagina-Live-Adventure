<?php
/**
 * Controlador: ReservaControlador
 * Lógica de negocio para el módulo de Reservas
 */

require_once __DIR__ . "/../config/conexion.php";
require_once __DIR__ . "/../modelos/Reserva.php";
require_once __DIR__ . "/../utils/Respuesta.php";
require_once __DIR__ . "/../utils/Validar.php";

// Inicializar conexión y componentes
$conexion = (new Conexion())->conectar();
$reserva = new Reserva($conexion);
$respuesta = new Respuesta();
$validar = new Validar();

$metodo = $_SERVER['REQUEST_METHOD'];

switch ($metodo) {
    // Listar todas las reservas
    case 'GET':
        $resultado = $reserva->listar();
        $lista = $resultado->fetch_all(MYSQLI_ASSOC);
        $respuesta->exito([
            "cantidad" => count($lista),
            "reservas" => $lista
        ]);
        break;

    // Crear nueva reserva
    case 'POST':
        $datos = json_decode(file_get_contents("php://input"), true);

        // Validar campos obligatorios
        $error = Validar::requerido(
            ["servicio_id", "nombre_cliente", "fecha_reserva"],
            $datos
        );
        if ($error) {
            $respuesta->error($error, 400);
        }

        // Validar formato de fecha
        if (!Validar::esFechaValida($datos['fecha_reserva'])) {
            $respuesta->error("El formato de la fecha es inválido. Use AAAA-MM-DD", 400);
        }

        // Asignar valor por defecto si no se envía
        $datos['cantidad_personas'] = $datos['cantidad_personas'] ?? 1;

        // Intentar crear la reserva
        $nuevoId = $reserva->crear($datos);
        if ($nuevoId) {
            $respuesta->exito([
                "mensaje" => "Reserva realizada con éxito",
                "numero_reserva" => $nuevoId
            ], 201);
        } else {
            $respuesta->error("Error al registrar la reserva. Verifique que el servicio exista.", 500);
        }
        break;

    // Método no permitido
    default:
        $respuesta->error("Método no permitido", 405);
}

// Cerrar conexión
$conexion->close();
?>