<?php
/**
 * Servicio Web de Registro e Inicio de Sesión
 * Versión con persistencia en archivo para pruebas
 */

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");

// Archivo donde se guardarán los usuarios
$archivo_usuarios = __DIR__ . DIRECTORY_SEPARATOR . "usuarios.json";

// Crear el archivo si no existe
if (!file_exists($archivo_usuarios)) {
    file_put_contents($archivo_usuarios, json_encode([]));
}

// Cargar usuarios guardados
$usuarios_registrados = json_decode(file_get_contents($archivo_usuarios), true);

// Obtener los datos enviados
$datos = json_decode(file_get_contents("php://input"), true);

/**
 * Función para registrar un usuario
 */
function registrarUsuario($usuario, $contrasena, $archivo) {
    $usuarios = json_decode(file_get_contents($archivo), true);
    
    if (isset($usuarios[$usuario])) {
        return ["estado" => "error", "mensaje" => "El usuario ya existe"];
    }
    
    $usuarios[$usuario] = $contrasena;
    file_put_contents($archivo, json_encode($usuarios));
    
    return ["estado" => "exito", "mensaje" => "Usuario registrado correctamente"];
}

/**
 * Función para iniciar sesión
 */
function iniciarSesion($usuario, $contrasena, $archivo) {
    $usuarios = json_decode(file_get_contents($archivo), true);
    
    if (!isset($usuarios[$usuario])) {
        return ["estado" => "error", "mensaje" => "Error en la autenticación: usuario no encontrado"];
    }
    
    if ($usuarios[$usuario] !== $contrasena) {
        return ["estado" => "error", "mensaje" => "Error en la autenticación: contraseña incorrecta"];
    }
    
    return ["estado" => "exito", "mensaje" => "✅ Autenticación satisfactoria ¡Bienvenido(a), $usuario!"];
}

// === Validar parámetros ===
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

// === Ejecutar acción ===
switch ($accion) {
    case 'registro':
        $respuesta = registrarUsuario($usuario, $contrasena, $archivo_usuarios);
        echo json_encode($respuesta);
        break;
    case 'login':
        $respuesta = iniciarSesion($usuario, $contrasena, $archivo_usuarios);
        echo json_encode($respuesta);
        break;
    default:
        echo json_encode(["estado" => "error", "mensaje" => "Acción inválida. Use 'registro' o 'login'"]);
        break;
}
?>