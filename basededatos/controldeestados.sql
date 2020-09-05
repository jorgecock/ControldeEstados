-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 05-09-2020 a las 23:13:11
-- Versión del servidor: 10.4.13-MariaDB
-- Versión de PHP: 7.4.8

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
  `unidadesesperadas` int(11) NOT NULL,
  `tiempocicloesperado` int(11) NOT NULL,
  `minutosprogramados` int(11) NOT NULL,
  `productoshechos` int(11) NOT NULL DEFAULT 0,
  `horadeinicio` time NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `uptdated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `modulos`
--

INSERT INTO `modulos` (`idmodulo`, `nombremodulo`, `descripcion`, `estado`, `unidadesesperadas`, `tiempocicloesperado`, `minutosprogramados`, `productoshechos`, `horadeinicio`, `created_at`, `uptdated_at`, `deleted_at`, `status`) VALUES
(1, '', '', 1, 10, 1, 10, 4, '16:09:44', '2020-09-04 17:55:23', NULL, NULL, 1),
(2, '', '', 2, 100, 1, 100, 0, '00:00:00', '2020-09-04 17:55:23', NULL, NULL, 1),
(3, '', '', 6, 210, 2, 420, 0, '19:09:31', '2020-09-04 17:55:23', NULL, NULL, 1),
(4, '', '', 4, 2, 1, 2, 0, '19:09:44', '2020-09-04 17:55:23', NULL, NULL, 1),
(5, '', '', 6, 1, 10, 10, 0, '19:09:10', '2020-09-04 17:55:23', NULL, NULL, 1),
(6, '', '', 3, 2, 2, 4, 0, '19:09:29', '2020-09-04 17:55:23', NULL, NULL, 1);

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
