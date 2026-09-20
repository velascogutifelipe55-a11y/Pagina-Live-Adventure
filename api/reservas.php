<?php
/**
 * Endpoint: Reservas
 * Ruta de acceso público al módulo
 */

header("Access-Control-Allow-Methods: GET, POST, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type");

// Manejar solicitudes preflight de CORS
if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    http_response_code(200);
    exit;
}

require_once __DIR__ . "/../controladores/ReservaControlador.php";
?>