<?php
/**
 * Clase: Servicio
 * Modelo que representa los servicios del parque
 * Diagrama de Clases: id, nombre, descripcion, precio, duracion, cupo_maximo
 */
class Servicio {
    private $id;
    private $nombre;
    private $descripcion;
    private $precio;
    private $duracion;
    private $cupo_maximo;
    private $conexion;

    public function __construct($db) {
        $this->conexion = $db;
    }

    // Métodos CRUD
    public function listar() {
        $sql = "SELECT * FROM servicios ORDER BY nombre";
        return $this->conexion->query($sql);
    }

    public function consultarPorId($id) {
        $stmt = $this->conexion->prepare("SELECT * FROM servicios WHERE id = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        return $stmt->get_result();
    }

   public function crear($datos) {
    $stmt = $this->conexion->prepare(
        "INSERT INTO servicios (nombre, descripcion, precio, duracion, cupo_maximo) 
         VALUES (?, ?, ?, ?, ?)"
    );
    // ✅ Cambia "ssdi" por "ssdis"
    $stmt->bind_param("ssdis", 
        $datos['nombre'],
        $datos['descripcion'],
        $datos['precio'],
        $datos['duracion'],
        $datos['cupo_maximo']
    );
    return $stmt->execute() ? $this->conexion->insert_id : false;
}

    public function eliminar($id) {
        $stmt = $this->conexion->prepare("DELETE FROM servicios WHERE id = ?");
        $stmt->bind_param("ssdis", $id);
        return $stmt->execute();
    }
}// Cierra la clase Servicio
?>