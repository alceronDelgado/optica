-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 23-03-2025 a las 20:09:30
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

CREATE TABLE `estratos` (
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
(1, 'Seleccione una opción'),
(2, 'Femenino'),
(3, 'Masculino'),
(4, 'No-Binario'),
(5, 'Otro');

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

--
-- Volcado de datos para la tabla `historias`
--

INSERT INTO `historias` (`hist_id`, `hist_esfod`, `hist_cilod`, `hist_ejeod`, `hist_diaod`, `hist_esfoi`, `hist_ciloi`, `hist_ejeoi`, `hist_diaoi`, `hist_recom`, `hist_motv`, `pac_id`) VALUES
(1, '234234', '4234', '42342', '21324', '234234', '35234', '235234', '234234', 'informacion', 'control de optometria, controles de covid al 100%', 886),
(2, '48', '482', '482', '57234', '428', '82', '482', '4782919', 'idasfnasdf', 'sadubasd', 886),
(3, '345345', '345345', '345345', '345345', '345345', '345345', '345', '345345', 'sdfdsf', '345345', 123),
(4, '345345', '345345', '345345', '345345', '345345', '345345', '345', '345345', 'sdfdsf', '345345', 123);

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
  `estr_id` int(11) DEFAULT NULL,
  `est_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `paciente`
--

INSERT INTO `paciente` (`pac_docum`, `pac_nombre`, `pac_apellido`, `pac_direccion`, `pac_telefono`, `pac_email`, `gen_id`, `estr_id`, `est_id`) VALUES
(32, 'alejandro', 'gomez', '323#32 -32', 52132, '32n3e@gmail.com', 1, 2, 2),
(63, 'paciente', 'hola', 'calle 3 numero paciente # -3 92', 3254234, 'doe@gmail.com', 1, 2, 2),
(89, 'elizabeth', 'DOE', 'calle 2 oeste # 83 - 120', 5234234, 'alceron294@gmail.com', 1, 6, 2),
(123, 'alejandro fer', 'ceron', 'calle 2 od 0este # 73 e 02', 1412312, 'al@gmail.com', 4, 4, 1),
(444, 'PAOLA', '323', 'calle 2 oeste # 83 - 120', 1234123, 'alceron294@gmail.com', 1, 5, 2),
(555, 'patricia', 'DOE', 'calle 2 oeste # 83 - 120', 1234123, 'alceron294@gmail.com', 1, 2, 2),
(886, 'jhonatan', 'DOE', 'calle 2 oeste # 83 - 120', 1234123, 'alceron294@gmail.com', 4, 4, 1),
(3123, 'jhonatan', 'DOE', 'calle 2 oeste # 83 - 120', 1234123, 'alceron294@gmail.com', 2, 1, 1),
(5344, 'jhon doe', 'doe doe', 'doe #32 -32 ', 52132, 'doe@gmail.com', 2, 1, 1),
(45425, 'pruieba', 'formular32io234', 'calle 2 d oeste # 74 e 02', 1234332, 'lalejandrocd1@gmail.com', 5, 4, 1),
(75656, 'pruieba23423', 'formular32io234', 'calle 2 d oeste # 74 e 02', 1234332, 'lalejandrocd1@gmail.com', 2, 6, 1),
(234324, 'alejandro', 'gfasd', '234234', 23423, 'ifonasdfui@gmail.com', 3, 5, 1),
(345345, 'pruieba', 'formulario2', 'calle 2 d oeste # 74 e 02', 31241234, 'lalejandrocd1@gmail.com', 4, 4, 1),
(346345, '345345', '53453', '34254325', 4252345, 'luis_aceron@soy.sena.edu.co', 4, 4, 1),
(546745, 'imaginacionlandia', 'hello world', '4523 call3 42', 235324, 'email@gmail.com', 3, 6, 1),
(572347, 'jhon doe', 'doe doe', 'doe #32 -32 ', 52132, 'doe@gmail.com', 3, 1, 1),
(634543, 'pruieba', 'formular32io234', '34', 31241234, 'luis_aceron@soy.sena.edu.co', 4, 4, 1),
(745456, 'pruieba', 'formular32io234', 'calle 2 d oeste # 74 e 02', 1234332, 'lalejandrocd1@gmail.com', 4, 4, 1),
(1234123, '23432423', '234234', '234234', 234234, 'luis_aceron@soy.sena.edu.co', 2, 4, 1),
(5234234, 'MSDUASBD', 'BASUDBASDYU', 'BASUDYBASDBNAUSD', 234234, 'email@gmail.com', 3, 3, 1),
(5234324, 'fernando', 'gonzales gutierres manuera', 'calle 3 #95 -32', 52342323, 'manu@gmail.com', 3, 2, 2),
(45674657, 'information', 'prueba', 'hsnadiasd # 42 -32', 34234, 'lalejandrocd1@gmail.com', 2, 4, 1),
(2147483647, 'mariana', 'arias ceron', 'calle 3 #23-63', 52342, 'marianaAr@gmail.com', 1, 4, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `paciente_estados`
--

CREATE TABLE `paciente_estados` (
  `est_id` int(11) NOT NULL,
  `est_nombre` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `paciente_estados`
--

INSERT INTO `paciente_estados` (`est_id`, `est_nombre`) VALUES
(1, 'Activo'),
(2, 'Inactivo');

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
(11, 123, 5),
(13, 3123, 1),
(14, 3123, 3),
(15, 3123, 6),
(16, 444, 1),
(17, 444, 3),
(18, 444, 5),
(19, 555, 1),
(20, 555, 5),
(21, NULL, 2),
(22, NULL, 4),
(23, 234324, 1),
(24, 234324, 5),
(25, 886, 2),
(26, 886, 6),
(27, 123, 2);

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
  ADD KEY `estr_id_fk` (`estr_id`),
  ADD KEY `est_id` (`est_id`);

--
-- Indices de la tabla `paciente_estados`
--
ALTER TABLE `paciente_estados`
  ADD PRIMARY KEY (`est_id`);

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
  MODIFY `gen_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `historias`
--
ALTER TABLE `historias`
  MODIFY `hist_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `hobbies`
--
ALTER TABLE `hobbies`
  MODIFY `hob_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `paciente_estados`
--
ALTER TABLE `paciente_estados`
  MODIFY `est_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `paciente_hobbies`
--
ALTER TABLE `paciente_hobbies`
  MODIFY `pac_hob_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

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
  ADD CONSTRAINT `est_id_fk` FOREIGN KEY (`est_id`) REFERENCES `paciente_estados` (`est_id`) ON DELETE SET NULL ON UPDATE CASCADE,
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
