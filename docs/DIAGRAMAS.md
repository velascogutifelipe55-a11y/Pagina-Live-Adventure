# Diagramas del Sistema

## Diagrama de Clases
- **Servicio**: id, nombre, descripcion, precio, duracion, cupo_maximo
- **Reserva**: id, servicio_id, nombre_cliente, fecha_reserva, cantidad_personas
- Relación: 1 Servicio → N Reservas

## Diagrama de Capas
- Presentación → api/
- Controladores → controladores/
- Modelos → modelos/
- Configuración → config/
- Utilidades → utils/