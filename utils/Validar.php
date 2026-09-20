<?php
/**
 * Componente reutilizable: Validaciones de datos
 */
class Validar {

    // Verifica que los campos obligatorios no estén vacíos
    public static function requerido($campos, $datos) {
        foreach ($campos as $campo) {
            if (!isset($datos[$campo]) || trim($datos[$campo]) === "") {
                return "El campo '$campo' es obligatorio";
            }
        }
        return null;
    }

    // Verifica que una fecha tenga formato correcto: AAAA-MM-DD
    public static function esFechaValida($fecha) {
        $formato = DateTime::createFromFormat('Y-m-d', $fecha);
        return $formato && $formato->format('Y-m-d') === $fecha;
    }
}
?>