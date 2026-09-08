<?php
/**
 * Conexión a la base de datos del Parque Aventura
 */
class Conexion {
    private $servidor = "localhost";
    private $usuario = "root";
    private $clave = "";
    private $base_datos = "parque_aventura";
    public $conexion;

    public function conectar() {
        $this->conexion = new mysqli(
            $this->servidor,
            $this->usuario,
            $this->clave,
            $this->base_datos
        );

        if ($this->conexion->connect_error) {
            die(json_encode([
                "estado" => "error",
                "mensaje" => "Error de conexión: " . $this->conexion->connect_error
            ]));
        }

        $this->conexion->set_charset("utf8");
        return $this->conexion;
    }
}
?>