<?php
/**
 * Servicio Web de Registro e Inicio de Sesión
 * Componente: Construcción de API / Servicios Web con PHP
 */

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");

// Almacenamiento temporal de usuarios
$usuarios_registrados = [];

// Obtener los datos enviados
$datos = json_decode(file_get_contents("php://input"), true);

/**
 * Función para registrar un usuario
 */
function registrarUsuario($usuario, $contrasena) {
    global $usuarios_registrados;
    if (isset($usuarios_registrados[$usuario])) {
        return ["estado" => "error", "mensaje" => "El usuario ya existe"];
    }
    $usuarios_registrados[$usuario] = $contrasena;
    return ["estado" => "exito", "mensaje" => "Usuario registrado correctamente"];
}

/**
 * Función para iniciar sesión
 */
function iniciarSesion($usuario, $contrasena) {
    global $usuarios_registrados;
    if (!isset($usuarios_registrados[$usuario])) {
        return ["estado" => "error", "mensaje" => "Error en la autenticación: usuario no encontrado"];
    }
    if ($usuarios_registrados[$usuario] !== $contrasena) {
        return ["estado" => "error", "mensaje" => "Error en la autenticación: contraseña incorrecta"];
    }
    return ["estado" => "exito", "mensaje" => "✅ Autenticación satisfactoria ¡Bienvenido(a), $usuario!"];
}

// Validar parámetros recibidos
if (!isset($datos['accion']) || !isset($datos['usuario']) || !isset($datos['contrasena'])) {
    echo json_encode(["estado" => "error", "mensaje" => "Faltan parámetros: accion, usuario y contrasena"]);
    exit;
}

$accion = trim($datos['accion']);
$usuario = trim($datos['usuario']);
$contrasena = trim($datos['contrasena']);

if (empty($usuario) || empty($contrasena)) {
    echo json_encode(["estado" => "error", "mensaje" => "Usuario y contraseña no pueden estar vacíos"]);
    exit;
}

// Ejecutar acción solicitada
switch ($accion) {
    case 'registro':
        $respuesta = registrarUsuario($usuario, $contrasena);
        echo json_encode($respuesta);
        break;
    case 'login':
        $respuesta = iniciarSesion($usuario, $contrasena);
        echo json_encode($respuesta);
        break;
    default:
        echo json_encode(["estado" => "error", "mensaje" => "Acción inválida. Use 'registro' o 'login'"]);
        break;
}
?>