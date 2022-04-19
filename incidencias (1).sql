-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost
-- Tiempo de generación: 16-11-2021 a las 22:56:16
-- Versión del servidor: 10.4.21-MariaDB
-- Versión de PHP: 7.4.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `incidencias`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `incidencias`
--

CREATE TABLE `incidencias` (
  `id` int(11) NOT NULL,
  `titulo` varchar(100) NOT NULL,
  `descripcion` text NOT NULL,
  `creado_por` int(11) NOT NULL,
  `fecha` datetime NOT NULL,
  `prioridad` tinyint(4) NOT NULL,
  `estado` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `incidencias`
--

INSERT INTO `incidencias` (`id`, `titulo`, `descripcion`, `creado_por`, `fecha`, `prioridad`, `estado`) VALUES
(3, 'Nuevo titulo', 'Detalles', 2, '2021-11-15 22:49:12', 2, 1),
(4, 'asdasdasds', 'asdsadsadsad', 1, '2021-11-15 22:50:20', 1, 2),
(5, '', '', 1, '2021-11-16 17:20:55', 2, 1),
(6, '12345687dfsfsdf', 'asdasadasdsad', 2, '2021-11-16 17:25:16', 3, 3),
(7, 'titulo mayor a 10 digitos', 'detalles mayoresa a 10', 1, '2021-11-16 17:27:52', 3, 2),
(8, 'titulo mayor a 10 digitos', 'detalles mayoresa a 10', 1, '2021-11-16 17:28:38', 3, 1),
(9, 'asdasdasdasdasdasd', 'asdasdsadsadasdsad', 1, '2021-11-16 17:30:54', 3, 2),
(10, 'asdsadsdaasdsasssssss', 'asssssssssssssssssssssss', 1, '2021-11-16 17:31:38', 3, 3),
(11, 'sssssssssssssssssssssss', 'sssssssssssssssssssss', 1, '2021-11-16 17:32:07', 3, 1),
(12, 'assssssssssssssssssssssssssss', 'ssssssssssssssssssssssssssssssssss', 2, '2021-11-16 17:57:31', 3, 3),
(13, 'prueba final total', 'asdjaspdaspdaspodkp', 2, '2021-11-16 17:58:03', 1, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `inc_estado`
--

CREATE TABLE `inc_estado` (
  `est_id` int(11) NOT NULL,
  `est_nombre` varchar(32) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `inc_estado`
--

INSERT INTO `inc_estado` (`est_id`, `est_nombre`) VALUES
(1, 'Iniciado'),
(2, 'En proceso'),
(3, 'Finalizado');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `inc_prioridades`
--

CREATE TABLE `inc_prioridades` (
  `pri_id` int(11) NOT NULL,
  `pri_nombre` varchar(32) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `inc_prioridades`
--

INSERT INTO `inc_prioridades` (`pri_id`, `pri_nombre`) VALUES
(1, 'Alta'),
(2, 'Media'),
(3, 'Baja');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `user_areas`
--

CREATE TABLE `user_areas` (
  `id` int(11) NOT NULL,
  `area_nombre` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `user_areas`
--

INSERT INTO `user_areas` (`id`, `area_nombre`) VALUES
(1, 'Administracion'),
(2, 'Contablidad'),
(3, 'Sistemas'),
(4, 'Ninguna');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `user_niveles`
--

CREATE TABLE `user_niveles` (
  `id` int(11) NOT NULL,
  `nivel_nombre` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `user_niveles`
--

INSERT INTO `user_niveles` (`id`, `nivel_nombre`) VALUES
(1, 'Administrador'),
(2, 'Usuario normal'),
(3, 'Tecnico');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL,
  `email` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `estado` tinyint(1) NOT NULL,
  `nivel` tinyint(4) NOT NULL,
  `nombre` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `apellido` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `imagen` text COLLATE utf8_unicode_ci NOT NULL,
  `ultfechaacceso` datetime NOT NULL,
  `area` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id`, `email`, `password`, `estado`, `nivel`, `nombre`, `apellido`, `imagen`, `ultfechaacceso`, `area`) VALUES
(1, 'email@email.com', '81dc9bdb52d04dc20036dbd8313ed055', 1, 1, 'Karina', 'User', 'team/sue.jpg', '2021-11-16 18:28:08', 4),
(2, 'roberto@hotmail.com', '81dc9bdb52d04dc20036dbd8313ed055', 1, 2, 'Roberto', 'Celaya', 'team/team-1.jpg', '2021-11-16 18:55:46', 2),
(3, 'manuel@gmail.com', '81dc9bdb52d04dc20036dbd8313ed055', 1, 3, 'Manuel', 'Bruneti', 'team/team-1.jpg', '2021-11-16 18:55:04', 3);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `incidencias`
--
ALTER TABLE `incidencias`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `inc_estado`
--
ALTER TABLE `inc_estado`
  ADD PRIMARY KEY (`est_id`);

--
-- Indices de la tabla `inc_prioridades`
--
ALTER TABLE `inc_prioridades`
  ADD PRIMARY KEY (`pri_id`);

--
-- Indices de la tabla `user_areas`
--
ALTER TABLE `user_areas`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `user_niveles`
--
ALTER TABLE `user_niveles`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `incidencias`
--
ALTER TABLE `incidencias`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT de la tabla `inc_estado`
--
ALTER TABLE `inc_estado`
  MODIFY `est_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `inc_prioridades`
--
ALTER TABLE `inc_prioridades`
  MODIFY `pri_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `user_areas`
--
ALTER TABLE `user_areas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `user_niveles`
--
ALTER TABLE `user_niveles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
