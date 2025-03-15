-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 26-02-2025 a las 19:44:58
-- Versión del servidor: 10.4.32-MariaDB
-- Versión de PHP: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `clinicavision`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `estratos`
--

CREATE TABLE IF NOT EXISTS `estratos` (
  `estr_id` int(11) NOT NULL,
  `estr_nombre` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `estratos`
--

INSERT INTO `estratos` (`estr_id`, `estr_nombre`) VALUES
(1, 'Estrato 1'),
(2, 'Estrato 2'),
(3, 'Estrato 3'),
(4, 'Estrato 4'),
(5, 'Estrato 5'),
(6, 'Estrato 6');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `generos`
--

CREATE TABLE `generos` (
  `gen_id` int(11) NOT NULL,
  `gen_nombre` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `generos`
--

INSERT INTO `generos` (`gen_id`, `gen_nombre`) VALUES
(1, 'Masculino'),
(2, 'Femenino'),
(3, 'No binario'),
(4, 'Otro');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `historias`
--

CREATE TABLE `historias` (
  `hist_id` int(11) NOT NULL,
  `hist_esfod` varchar(50) NOT NULL,
  `hist_cilod` varchar(50) NOT NULL,
  `hist_ejeod` varchar(50) NOT NULL,
  `hist_diaod` varchar(50) NOT NULL,
  `hist_esfoi` varchar(50) NOT NULL,
  `hist_ciloi` varchar(50) NOT NULL,
  `hist_ejeoi` varchar(50) NOT NULL,
  `hist_diaoi` varchar(50) NOT NULL,
  `hist_recom` text DEFAULT NULL,
  `hist_motv` text DEFAULT NULL,
  `pac_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `hobbies`
--

CREATE TABLE `hobbies` (
  `hob_id` int(11) NOT NULL,
  `hob_nombre` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `hobbies`
--

INSERT INTO `hobbies` (`hob_id`, `hob_nombre`) VALUES
(1, 'Cine'),
(2, 'Playa'),
(3, 'Video Juegos'),
(4, 'Comer'),
(5, 'Bolos'),
(6, 'Bailar');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `paciente`
--

CREATE TABLE `paciente` (
  `pac_docum` int(11) NOT NULL,
  `pac_nombre` varchar(50) NOT NULL,
  `pac_apellido` varchar(50) NOT NULL,
  `pac_direccion` varchar(50) NOT NULL,
  `pac_telefono` bigint(20) UNSIGNED NOT NULL,
  `pac_email` varchar(30) NOT NULL,
  `gen_id` int(11) DEFAULT NULL,
  `estr_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `paciente`
--

INSERT INTO `paciente` (`pac_docum`, `pac_nombre`, `pac_apellido`, `pac_direccion`, `pac_telefono`, `pac_email`, `gen_id`, `estr_id`) VALUES
(1, 'Juan', 'Pérez', 'Calle Falsa 123', 1234567890, '', 1, 1),
(2, 'María', 'González', 'Avenida Libertad 456', 9876543210, '', 2, 2),
(3, 'Carlos', 'Ramírez', 'Calle El Sol 789', 1122334455, '', 1, 3),
(4, 'Ana', 'Martínez', 'Calle 45 Norte 321', 2233445566, '', 2, 1),
(5, 'Pedro', 'López', 'Boulevard 2 Sur 654', 5566778899, '', 1, 2),
(2147483647, 'alejandro', 'ceron delgado', 'calle 2 oeste # 83 - 120', 1234123, 'alceron294@gmail.com', 1, 6);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `paciente_hobbies`
--

CREATE TABLE `paciente_hobbies` (
  `pac_hob_id` int(11) NOT NULL,
  `pac_id` int(11) DEFAULT NULL,
  `hob_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `paciente_hobbies`
--

INSERT INTO `paciente_hobbies` (`pac_hob_id`, `pac_id`, `hob_id`) VALUES
(1, 3, 5);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `roles`
--

CREATE TABLE `roles` (
  `rol_id` int(11) NOT NULL,
  `rol_nombre` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `roles`
--

INSERT INTO `roles` (`rol_id`, `rol_nombre`) VALUES
(1, '---'),
(2, 'Optometra'),
(3, 'Oftalmólogo'),
(4, 'Recepcionista');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `usu_id` int(11) NOT NULL,
  `usu_nombre` varchar(50) NOT NULL,
  `usu_docum` int(11) NOT NULL,
  `usu_clave` text NOT NULL,
  `rol_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`usu_id`, `usu_nombre`, `usu_docum`, `usu_clave`, `rol_id`) VALUES
(1, 'Jhon doe', 29114652, '$2y$10$nL9a1gOc.nsik1xkhfbjuOmZZwulSk75vZsmmgwLs/U6bH9B/642a', 2),
(2, 'Jhon doe', 14362442, '$2y$10$Mz1ri.ulkEUCNqONbB.PC.6jw6QhCv7G.h2MsB60O8b9Te/CAGkXC', 3),
(3, 'Jhon doe', 63453452, '$2y$10$tqcVNWpiMj0Ls7sL01fQx.XPVHRWx7jM75.v9klt1lfKnK92eEJGO', 4);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `estratos`
--
ALTER TABLE `estratos`
  ADD PRIMARY KEY (`estr_id`);

--
-- Indices de la tabla `generos`
--
ALTER TABLE `generos`
  ADD PRIMARY KEY (`gen_id`);

--
-- Indices de la tabla `historias`
--
ALTER TABLE `historias`
  ADD PRIMARY KEY (`hist_id`),
  ADD KEY `pac_id_fk` (`pac_id`);

--
-- Indices de la tabla `hobbies`
--
ALTER TABLE `hobbies`
  ADD PRIMARY KEY (`hob_id`);

--
-- Indices de la tabla `paciente`
--
ALTER TABLE `paciente`
  ADD PRIMARY KEY (`pac_docum`),
  ADD KEY `gen_id_fk` (`gen_id`),
  ADD KEY `estr_id_fk` (`estr_id`);

--
-- Indices de la tabla `paciente_hobbies`
--
ALTER TABLE `paciente_hobbies`
  ADD PRIMARY KEY (`pac_hob_id`),
  ADD KEY `pac_id` (`pac_id`),
  ADD KEY `hob_id` (`hob_id`);

--
-- Indices de la tabla `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`rol_id`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`usu_id`),
  ADD KEY `rol_id_cnst` (`rol_id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `estratos`
--
ALTER TABLE `estratos`
  MODIFY `estr_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `generos`
--
ALTER TABLE `generos`
  MODIFY `gen_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `historias`
--
ALTER TABLE `historias`
  MODIFY `hist_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `hobbies`
--
ALTER TABLE `hobbies`
  MODIFY `hob_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `paciente_hobbies`
--
ALTER TABLE `paciente_hobbies`
  MODIFY `pac_hob_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `roles`
--
ALTER TABLE `roles`
  MODIFY `rol_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `usu_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `historias`
--
ALTER TABLE `historias`
  ADD CONSTRAINT `pac_id_fk` FOREIGN KEY (`pac_id`) REFERENCES `paciente` (`pac_docum`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Filtros para la tabla `paciente`
--
ALTER TABLE `paciente`
  ADD CONSTRAINT `estr_id_fk` FOREIGN KEY (`estr_id`) REFERENCES `estratos` (`estr_id`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `gen_id_fk` FOREIGN KEY (`gen_id`) REFERENCES `generos` (`gen_id`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Filtros para la tabla `paciente_hobbies`
--
ALTER TABLE `paciente_hobbies`
  ADD CONSTRAINT `hob_id` FOREIGN KEY (`hob_id`) REFERENCES `hobbies` (`hob_id`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `pac_id` FOREIGN KEY (`pac_id`) REFERENCES `paciente` (`pac_docum`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Filtros para la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD CONSTRAINT `rol_id_cnst` FOREIGN KEY (`rol_id`) REFERENCES `roles` (`rol_id`) ON DELETE SET NULL ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
