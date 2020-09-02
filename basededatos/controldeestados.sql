-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 03-09-2020 a las 01:49:23
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
-- Estructura de tabla para la tabla `controldeestados`
--

CREATE TABLE `controldeestados` (
  `idmodulo` int(11) NOT NULL,
  `idestado` int(11) NOT NULL DEFAULT 1,
  `unidadesesperadas` int(11) NOT NULL,
  `tiempocicloesperado` int(11) NOT NULL,
  `minutosprogramados` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `controldeestados`
--

INSERT INTO `controldeestados` (`idmodulo`, `idestado`, `unidadesesperadas`, `tiempocicloesperado`, `minutosprogramados`) VALUES
(1, 3, 220, 2, 440),
(2, 1, 0, 0, 0),
(3, 1, 0, 0, 0),
(4, 1, 0, 0, 0),
(5, 1, 0, 0, 0),
(6, 1, 0, 0, 0);

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

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `controldeestados`
--
ALTER TABLE `controldeestados`
  ADD PRIMARY KEY (`idmodulo`),
  ADD KEY `idestado` (`idestado`);

--
-- Indices de la tabla `estados`
--
ALTER TABLE `estados`
  ADD PRIMARY KEY (`idestado`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `controldeestados`
--
ALTER TABLE `controldeestados`
  MODIFY `idmodulo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `estados`
--
ALTER TABLE `estados`
  MODIFY `idestado` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `controldeestados`
--
ALTER TABLE `controldeestados`
  ADD CONSTRAINT `controldeestados_ibfk_1` FOREIGN KEY (`idestado`) REFERENCES `estados` (`idestado`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
