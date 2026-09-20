-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 20-09-2026 a las 19:15:27
-- Versión del servidor: 10.4.32-MariaDB
-- Versión de PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `parque_aventura`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `reservas`
--

CREATE TABLE `reservas` (
  `id` int(11) NOT NULL,
  `servicio_id` int(11) NOT NULL,
  `nombre_cliente` varchar(100) NOT NULL,
  `fecha_reserva` date NOT NULL,
  `cantidad_personas` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `reservas`
--

INSERT INTO `reservas` (`id`, `servicio_id`, `nombre_cliente`, `fecha_reserva`, `cantidad_personas`) VALUES
(1, 2, 'Felipe Velasco', '2026-09-20', 2),
(2, 2, 'Felipe Velasco', '2026-09-20', 2),
(3, 2, 'Felipe Velasco', '2026-09-20', 2),
(4, 2, 'Felipe Velasco', '2026-09-20', 2),
(5, 2, 'Felipe Velasco', '2026-09-20', 2),
(6, 11, 'María López', '2026-09-20', 4),
(7, 2, 'Felipe Velasco', '2026-09-25', 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `servicios`
--

CREATE TABLE `servicios` (
  `id` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `descripcion` text DEFAULT NULL,
  `precio` decimal(10,2) NOT NULL,
  `duracion` varchar(50) DEFAULT NULL,
  `cupo_maximo` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `servicios`
--

INSERT INTO `servicios` (`id`, `nombre`, `descripcion`, `precio`, `duracion`, `cupo_maximo`) VALUES
(1, 'Canopy / Tirolesa', 'Recorrido por cables en altura sobre el bosque', 45000.00, '45 min', 15),
(2, 'Paracaidismo', 'Salto tandem con instructor desde 3.000 metros', 350000.00, '2-3 hrs', 4),
(3, 'Senderismo', 'Recorrido guiado por senderos ecológicos', 25000.00, '3 hrs', 20),
(4, 'Ciclo Montañismo', 'Ruta en bicicleta por senderos de montaña', 35000.00, '2 hrs', 12),
(5, 'Piscina Surf', 'Olas artificiales para surf y diversión', 50000.00, '1 día', 50),
(7, 'Paracaidismo', 'Salto tandem con instructor certificado desde 3.000 metros de altura', 350000.00, '2-3 hrs', 4),
(8, 'Senderismo', 'Recorrido guiado por senderos ecológicos con explicación de la fauna y flora', 25000.00, '3 hrs', 20),
(9, 'Ciclo Montañismo', 'Ruta en bicicleta todo terreno por senderos de montaña y descensos', 35000.00, '2 hrs', 12),
(10, 'Piscina Surf', 'Olas artificiales para práctica de surf y recreación para toda la familia', 50000.00, '1 día', 50),
(11, 'Canopy / Tirolesa', 'Recorrido por cables en altura sobre el bosque con vistas panorámicas', 45000.00, '45 min', 15),
(12, 'Paracaidismo', 'Salto tandem con instructor certificado desde 3.000 metros de altura', 350000.00, '2-3 hrs', 4),
(13, 'Senderismo', 'Recorrido guiado por senderos ecológicos con explicación de la fauna y flora', 25000.00, '3 hrs', 20),
(14, 'Ciclo Montañismo', 'Ruta en bicicleta todo terreno por senderos de montaña y descensos', 35000.00, '2 hrs', 12),
(15, 'Piscina Surf', 'Olas artificiales para práctica de surf y recreación para toda la familia', 50000.00, '1 día', 50),
(16, 'Puente Colgante', 'Recorrido sobre cañón natural', 38000.00, '1', 10),
(17, 'Puente Colgante', 'Recorrido por puente sobre cañón natural', 38000.00, '1', 10),
(18, 'Puente Colgante', 'Recorrido por puente sobre cañón natural', 38000.00, '1', 10),
(19, 'Puente Colgante', 'Recorrido por puente sobre cañón natural', 38000.00, '1', 10),
(20, 'Parque Aventura Nuevo', 'Servicio de prueba', 35000.00, '60', 15),
(21, 'Puente Colgante', 'Recorrido sobre puentes entre árboles', 28000.00, '30', 10),
(22, 'Puente Colgante', 'Recorrido sobre puentes entre árboles', 28000.00, '30', 10);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `reservas`
--
ALTER TABLE `reservas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `servicio_id` (`servicio_id`);

--
-- Indices de la tabla `servicios`
--
ALTER TABLE `servicios`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `reservas`
--
ALTER TABLE `reservas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `servicios`
--
ALTER TABLE `servicios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `reservas`
--
ALTER TABLE `reservas`
  ADD CONSTRAINT `reservas_ibfk_1` FOREIGN KEY (`servicio_id`) REFERENCES `servicios` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
