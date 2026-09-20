<?php
/**
 * Componente reutilizable: Formato de respuestas JSON
 * Aplicable a todos los endpoints
 */
class Respuesta {
    public function __construct() {
        header("Access-Control-Allow-Origin: *");
        header("Content-Type: application/json; charset=UTF-8");
    }

    public function exito($datos, $codigo = 200) {
        http_response_code($codigo);
        echo json_encode(["estado" => "exito"] + $datos);
        exit;
    }

    public function error($mensaje, $codigo = 400) {
        http_response_code($codigo);
        echo json_encode([
            "estado" => "error",
            "codigo" => $codigo,
            "mensaje" => $mensaje
        ]);
        exit;
    }
}
?>