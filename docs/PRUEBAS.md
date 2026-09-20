# Pruebas Unitarias – Módulos del Sistema

## Prueba M-01: Crear Servicio
- Entrada: `{nombre:"Prueba", precio:10000}`
- Resultado esperado: ID generado > 0
- Estado: ✅ Pasó

## Prueba M-02: Validar Campos Obligatorios
- Entrada: `{nombre:"Solo nombre"}`
- Resultado esperado: Error "Precio es obligatorio"
- Estado: ✅ Pasó

## Prueba M-03: Crear Reserva
- Entrada: `{servicio_id:1, cliente:"Prueba", fecha:"2026-10-01", personas:2}`
- Resultado esperado: Número de reserva generado
- Estado: ✅ Pasó

## Prueba M-04: Listar Reservas con Relación
- Acción: Consultar lista de reservas
- Resultado esperado: Cada reserva incluye nombre_servicio y precio
- Estado: ✅ Pasó