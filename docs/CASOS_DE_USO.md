# Casos de Uso — Sistema de Reservas Parque Aventura

## CU-01: Registrar Servicio
- **Actor:** Administrador
- **Descripción:** Ingresa un nuevo servicio con nombre, descripción, precio, duración y cupo
- **Precondición:** Autenticación del administrador
- **Postcondición:** Servicio disponible en el catálogo

## CU-02: Consultar Servicio
- **Actor:** Cliente / Administrador
- **Descripción:** Visualiza los datos de un servicio específico por su ID

## CU-03: Registrar Reserva
- **Actor:** Cliente
- **Descripción:** Selecciona un servicio, indica fecha y cantidad de personas
- **Reglas:** La fecha no puede ser anterior a hoy

## CU-04: Listar Reservas
- **Actor:** Administrador
- **Descripción:** Visualiza todas las reservas con datos del servicio asociado