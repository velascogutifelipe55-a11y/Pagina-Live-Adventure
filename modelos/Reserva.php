<?php
/**
 * Clase: Reserva
 * Modelo que representa las reservas de servicios
 * Diagrama de Clases: id, servicio_id, nombre_cliente, fecha_reserva, cantidad_personas
 */
class Reserva {
    private $id;
    private $servicio_id;
    private $nombre_cliente;
    private $fecha_reserva;
    private $cantidad_personas;
    private $conexion;

    public function __construct($db) {
        $this->conexion = $db;
    }

    // Listar todas las reservas con nombre del servicio
    public function listar() {
        $sql = "SELECT r.*, s.nombre as nombre_servicio, s.precio
                FROM reservas r
                INNER JOIN servicios s ON r.servicio_id = s.id
                ORDER BY r.fecha_reserva DESC";
        
        return $this->conexion->query($sql);
    }

    // Crear una reserva nueva
    public function crear($datos) {
        $stmt = $this->conexion->prepare("INSERT INTO reservas 
            (servicio_id, nombre_cliente, fecha_reserva, cantidad_personas) 
            VALUES (?, ?, ?, ?)");
        
        // ✅ Tipos: i=entero, s=texto, s=texto, i=entero → "issi"
        $stmt->bind_param("issi",
            $datos['servicio_id'],
            $datos['nombre_cliente'],
            $datos['fecha_reserva'],
            $datos['cantidad_personas']
        );

        return $stmt->execute() ? $this->conexion->insert_id : false;
    }
}
?>