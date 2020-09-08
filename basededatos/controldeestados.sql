-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 08-09-2020 a las 22:08:35
-- Versión del servidor: 10.4.11-MariaDB
-- Versión de PHP: 7.4.5

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `controldeestados`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `dispositivosiot`
--

CREATE TABLE `dispositivosiot` (
  `iddispositivoIoT` int(11) NOT NULL,
  `modulo` int(11) NOT NULL,
  `tipodispositivoIoT` int(11) NOT NULL,
  `created_at` datetime DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `dispositivosiot`
--

INSERT INTO `dispositivosiot` (`iddispositivoIoT`, `modulo`, `tipodispositivoIoT`, `created_at`, `updated_at`, `deleted_at`, `status`) VALUES
(1, 2, 2, '2020-09-04 19:26:15', NULL, NULL, 1),
(2, 1, 1, '2020-09-04 19:25:30', NULL, NULL, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `estados`
--

CREATE TABLE `estados` (
  `idestado` int(11) NOT NULL,
  `estado` varchar(20) COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `estados`
--

INSERT INTO `estados` (`idestado`, `estado`) VALUES
(1, 'entrandoorden'),
(2, 'validando'),
(3, 'contando'),
(4, 'enpausa'),
(5, 'error'),
(6, 'terminado');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `modulos`
--

CREATE TABLE `modulos` (
  `idmodulo` int(11) NOT NULL,
  `nombremodulo` varchar(40) COLLATE utf8_spanish_ci NOT NULL,
  `descripcion` varchar(200) COLLATE utf8_spanish_ci NOT NULL,
  `estado` int(11) NOT NULL DEFAULT 1,
  `ordendeprod` varchar(20) COLLATE utf8_spanish_ci NOT NULL,
  `itemaproducir` varchar(25) COLLATE utf8_spanish_ci NOT NULL,
  `unidadesesperadas` int(11) NOT NULL,
  `tiempocicloesperado` float NOT NULL,
  `minutosprogramados` float NOT NULL,
  `productoshechos` int(11) NOT NULL DEFAULT 0,
  `momentodeinicio` int(11) NOT NULL,
  `tiemporegistro` int(11) NOT NULL,
  `tiemporegistroanterior` int(11) NOT NULL,
  `ultimotiempodeproduccion` float NOT NULL,
  `tiempoacumulado` int(11) NOT NULL DEFAULT 0,
  `tiempopausado` int(11) NOT NULL DEFAULT 0,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `uptdated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `modulos`
--

INSERT INTO `modulos` (`idmodulo`, `nombremodulo`, `descripcion`, `estado`, `ordendeprod`, `itemaproducir`, `unidadesesperadas`, `tiempocicloesperado`, `minutosprogramados`, `productoshechos`, `momentodeinicio`, `tiemporegistro`, `tiemporegistroanterior`, `ultimotiempodeproduccion`, `tiempoacumulado`, `tiempopausado`, `created_at`, `uptdated_at`, `deleted_at`, `status`) VALUES
(1, '', '', 1, '1', '1', 1, 1, 1, 0, 1599585634, 0, 0, 0, 0, 0, '2020-09-04 17:55:23', NULL, NULL, 1),
(2, '', '', 6, '1', '1', 1, 1, 1, 0, 1599584687, 0, 0, 0, 0, 0, '2020-09-04 17:55:23', NULL, NULL, 1),
(3, '', '', 1, '', '', 210, 2, 420, 0, 190931, 0, 0, 0, 0, 0, '2020-09-04 17:55:23', NULL, NULL, 1),
(4, '', '', 1, '', '', 2, 1, 2, 0, 190944, 0, 0, 0, 0, 0, '2020-09-04 17:55:23', NULL, NULL, 1),
(5, '', '', 1, '', '', 1, 10, 10, 0, 190910, 0, 0, 0, 0, 0, '2020-09-04 17:55:23', NULL, NULL, 1),
(6, '', '', 1, '', '', 2, 2, 4, 0, 190929, 0, 0, 0, 0, 0, '2020-09-04 17:55:23', NULL, NULL, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `registrotiempos`
--

CREATE TABLE `registrotiempos` (
  `idregistro` int(11) NOT NULL,
  `ordendeprod` varchar(20) COLLATE utf8_spanish_ci NOT NULL,
  `itemaproducir` varchar(25) COLLATE utf8_spanish_ci NOT NULL,
  `horaderegistro` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `registrotiempos`
--

INSERT INTO `registrotiempos` (`idregistro`, `ordendeprod`, `itemaproducir`, `horaderegistro`) VALUES
(1, 'casa', 'polo', '2020-09-07 17:02:28'),
(2, '121212', 'camisas pancho', '2020-09-07 18:33:32'),
(3, '121212', 'camisas pancho', '2020-09-07 18:34:06'),
(4, '121212', 'camisas pancho', '2020-09-07 18:34:23'),
(5, '121212', 'camisas pancho', '2020-09-07 18:34:27'),
(6, '121212', 'camisas pancho', '2020-09-07 18:34:41'),
(7, '121212', 'camisas pancho', '2020-09-07 18:34:42'),
(8, '121212', 'camisas pancho', '2020-09-07 18:34:42'),
(9, '121212', 'camisas pancho', '2020-09-07 18:34:43'),
(10, '121212', 'camisas pancho', '2020-09-07 18:34:43'),
(11, '121212', 'camisas pancho', '2020-09-07 18:34:43'),
(12, '121212', 'camisas pancho', '2020-09-07 18:35:58'),
(13, '121212', 'camisas pancho', '2020-09-07 18:36:04'),
(14, '121212', 'camisas pancho', '2020-09-07 18:36:30'),
(15, '121212', 'camisas pancho', '2020-09-07 18:39:29'),
(16, '121212', 'camisas pancho', '2020-09-07 18:41:44'),
(17, '121212', 'camisas pancho', '2020-09-07 18:41:45'),
(18, '121212', 'camisas pancho', '2020-09-07 18:41:46'),
(19, '121212', 'camisas pancho', '2020-09-07 18:41:47'),
(20, '121212', 'camisas pancho', '2020-09-07 18:41:47'),
(21, '121212', 'camisas pancho', '2020-09-07 18:41:47'),
(22, '121212', 'camisas pancho', '2020-09-07 18:41:47'),
(23, '121212', 'camisas pancho', '2020-09-07 18:41:48'),
(24, '121212', 'camisas pancho', '2020-09-07 18:42:23'),
(25, '121212', 'camisas pancho', '2020-09-07 18:42:30'),
(26, '121212', 'camisas pancho', '2020-09-07 18:42:34'),
(27, '121212', 'camisas pancho', '2020-09-07 18:42:35'),
(28, '121212', 'camisas pancho', '2020-09-07 18:42:45'),
(29, '10', 'asas', '2020-09-07 19:00:43'),
(30, '10', 'asas', '2020-09-07 19:03:10'),
(31, '10', 'asas', '2020-09-07 20:33:25'),
(32, '1234', 'baberos', '2020-09-07 21:12:29'),
(33, '1234', 'baberos', '2020-09-07 21:13:39'),
(34, '1234', 'baberos', '2020-09-07 21:14:51'),
(35, '1234', 'baberos', '2020-09-07 21:16:46'),
(36, '1234', 'baberos', '2020-09-07 21:18:31'),
(37, '1234', 'baberos', '2020-09-07 21:19:07'),
(38, '1234', 'baberos', '2020-09-07 21:20:32'),
(39, '1234', 'baberos', '2020-09-07 21:21:06'),
(40, '1234', 'baberos', '2020-09-07 21:21:35'),
(41, '1234', 'baberos', '2020-09-07 21:22:07'),
(42, '1234', 'baberos', '2020-09-07 21:22:13'),
(43, '1234', 'baberos', '2020-09-07 21:22:39'),
(44, '20', '212121', '2020-09-07 21:24:18'),
(45, '20', '212121', '2020-09-07 21:24:31'),
(46, '20', '212121', '2020-09-07 21:25:23'),
(47, '20', '212121', '2020-09-07 21:25:44'),
(48, '20', '212121', '2020-09-07 21:25:48'),
(49, '20', '212121', '2020-09-07 21:25:50'),
(50, '20', '212121', '2020-09-07 21:25:54'),
(51, '20', '212121', '2020-09-07 21:26:01'),
(52, '20', '212121', '2020-09-07 21:26:12'),
(53, '20', '212121', '2020-09-07 21:26:18'),
(54, '20', '212121', '2020-09-07 21:26:24'),
(55, '20', '212121', '2020-09-07 21:26:32'),
(56, '20', '212121', '2020-09-07 21:26:39'),
(57, '20', '212121', '2020-09-07 21:26:47'),
(58, '20', '212121', '2020-09-07 21:26:56'),
(59, '20', '212121', '2020-09-07 21:27:04'),
(60, '20', '212121', '2020-09-07 21:27:13'),
(61, '20', '212121', '2020-09-07 21:27:32'),
(62, '20', '212121', '2020-09-07 21:27:50'),
(63, '20', '212121', '2020-09-07 21:28:09'),
(64, 'reret', 'ewweew', '2020-09-07 21:44:27'),
(65, 'reret', 'ewweew', '2020-09-07 21:45:31'),
(66, 'reret', 'ewweew', '2020-09-07 21:47:15'),
(67, 'reret', 'ewweew', '2020-09-07 21:47:38'),
(68, 'reret', 'ewweew', '2020-09-07 21:47:49'),
(69, 'reret', 'ewweew', '2020-09-07 21:47:59'),
(70, 'reret', 'ewweew', '2020-09-07 21:48:14'),
(71, 'reret', 'ewweew', '2020-09-07 21:48:56'),
(72, 'reret', 'ewweew', '2020-09-07 21:49:33'),
(73, 'fdjhgdk', 'sdfsfs', '2020-09-07 21:51:28'),
(74, 'fdjhgdk', 'sdfsfs', '2020-09-07 21:52:45'),
(75, 'fdjhgdk', 'sdfsfs', '2020-09-07 21:52:59'),
(76, '5', '5', '2020-09-07 22:03:15'),
(77, '5', '5', '2020-09-07 22:03:33'),
(78, '5', '5', '2020-09-07 22:03:44'),
(79, '5', '5', '2020-09-07 22:11:06'),
(80, '5', '5', '2020-09-07 22:11:22'),
(81, 'gfghhf', 'fghfgh', '2020-09-07 22:12:16'),
(82, 'gfghhf', 'fghfgh', '2020-09-07 22:12:24'),
(83, 'gfghhf', 'fghfgh', '2020-09-07 22:12:40'),
(84, 'gfghhf', 'fghfgh', '2020-09-07 22:13:08'),
(85, 'gfghhf', 'fghfgh', '2020-09-07 22:13:50'),
(86, 'gfghhf', 'fghfgh', '2020-09-07 22:15:00'),
(87, 'gfghhf', 'fghfgh', '2020-09-07 22:16:32'),
(88, 'gfghhf', 'fghfgh', '2020-09-07 22:19:50'),
(89, 'gfghhf', 'fghfgh', '2020-09-07 22:28:35'),
(90, '2', '33', '2020-09-07 22:40:41'),
(91, '2', '33', '2020-09-07 22:40:54'),
(92, 'Casas', '254', '2020-09-08 10:07:10'),
(93, 'Casas', '254', '2020-09-08 10:29:26'),
(94, 'Casas', '254', '2020-09-08 10:29:34'),
(95, 'Casas', '254', '2020-09-08 10:29:40'),
(96, '3456', 'ratones', '2020-09-08 10:48:45'),
(97, '3456', 'ratones', '2020-09-08 10:48:53'),
(98, '2222', '21212', '2020-09-08 11:00:58'),
(99, '2', '2', '2020-09-08 11:02:37'),
(100, '2', '2', '2020-09-08 11:02:45');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tiposdispositivosiot`
--

CREATE TABLE `tiposdispositivosiot` (
  `idtipodispositivoiot` int(11) NOT NULL,
  `tipodispositivoIoT` varchar(20) COLLATE utf8_spanish_ci NOT NULL,
  `descripcion` varchar(200) COLLATE utf8_spanish_ci NOT NULL,
  `created_at` datetime DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `tiposdispositivosiot`
--

INSERT INTO `tiposdispositivosiot` (`idtipodispositivoiot`, `tipodispositivoIoT`, `descripcion`, `created_at`, `updated_at`, `deleted_at`, `status`) VALUES
(1, 'BPE-01', 'Caja para registrar de paso de producto terminado y ejecutar paro en linea por acción de operarios.', '2020-09-04 19:16:59', NULL, NULL, 1),
(2, 'BPEI-1', 'Caja con botones Paso/Paro/medición de corriente', '2020-09-04 19:19:45', NULL, NULL, 1),
(3, 'BPEIR-1', 'Botonera con botones de paso y error con medicion de corriente y relay para control de màquinas', '2020-09-04 19:22:15', NULL, NULL, 1);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `dispositivosiot`
--
ALTER TABLE `dispositivosiot`
  ADD PRIMARY KEY (`iddispositivoIoT`),
  ADD KEY `idmodulo` (`modulo`),
  ADD KEY `tipodispositivoIoT` (`tipodispositivoIoT`);

--
-- Indices de la tabla `estados`
--
ALTER TABLE `estados`
  ADD PRIMARY KEY (`idestado`);

--
-- Indices de la tabla `modulos`
--
ALTER TABLE `modulos`
  ADD PRIMARY KEY (`idmodulo`),
  ADD KEY `idestado` (`estado`);

--
-- Indices de la tabla `registrotiempos`
--
ALTER TABLE `registrotiempos`
  ADD PRIMARY KEY (`idregistro`);

--
-- Indices de la tabla `tiposdispositivosiot`
--
ALTER TABLE `tiposdispositivosiot`
  ADD PRIMARY KEY (`idtipodispositivoiot`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `estados`
--
ALTER TABLE `estados`
  MODIFY `idestado` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `modulos`
--
ALTER TABLE `modulos`
  MODIFY `idmodulo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `registrotiempos`
--
ALTER TABLE `registrotiempos`
  MODIFY `idregistro` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=101;

--
-- AUTO_INCREMENT de la tabla `tiposdispositivosiot`
--
ALTER TABLE `tiposdispositivosiot`
  MODIFY `idtipodispositivoiot` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `dispositivosiot`
--
ALTER TABLE `dispositivosiot`
  ADD CONSTRAINT `dispositivosiot_ibfk_2` FOREIGN KEY (`tipodispositivoIoT`) REFERENCES `tiposdispositivosiot` (`idtipodispositivoiot`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `dispositivosiot_ibfk_3` FOREIGN KEY (`modulo`) REFERENCES `modulos` (`idmodulo`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `dispositivosiot_ibfk_4` FOREIGN KEY (`tipodispositivoIoT`) REFERENCES `tiposdispositivosiot` (`idtipodispositivoiot`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `modulos`
--
ALTER TABLE `modulos`
  ADD CONSTRAINT `modulos_ibfk_1` FOREIGN KEY (`estado`) REFERENCES `estados` (`idestado`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
