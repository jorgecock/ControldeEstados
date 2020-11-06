-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 06-11-2020 a las 21:34:53
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
  `status` int(11) NOT NULL DEFAULT 1,
  `voltage` float NOT NULL,
  `prodhechosdespausaini` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `modulos`
--

INSERT INTO `modulos` (`idmodulo`, `nombremodulo`, `descripcion`, `estado`, `ordendeprod`, `itemaproducir`, `unidadesesperadas`, `tiempocicloesperado`, `minutosprogramados`, `productoshechos`, `momentodeinicio`, `tiemporegistro`, `tiemporegistroanterior`, `ultimotiempodeproduccion`, `tiempoacumulado`, `tiempopausado`, `created_at`, `uptdated_at`, `deleted_at`, `status`, `voltage`, `prodhechosdespausaini`) VALUES
(1, '', '', 3, '12345432', 'Camisas Polo', 600, 2.7, 1620, 0, 1604677829, 0, 0, 0, 0, 0, '2020-09-04 17:55:23', NULL, NULL, 1, 0, 0),
(2, '', '', 1, '1', '1', 1, 1, 1, 0, 1599584687, 0, 0, 0, 0, 0, '2020-09-04 17:55:23', NULL, NULL, 1, 0, 0),
(3, '', '', 1, '', '', 210, 2, 420, 0, 190931, 0, 0, 0, 0, 0, '2020-09-04 17:55:23', NULL, NULL, 1, 0, 0),
(4, '', '', 1, '', '', 2, 1, 2, 0, 190944, 0, 0, 0, 0, 0, '2020-09-04 17:55:23', NULL, NULL, 1, 0, 0),
(5, '', '', 1, '', '', 1, 10, 10, 0, 190910, 0, 0, 0, 0, 0, '2020-09-04 17:55:23', NULL, NULL, 1, 0, 0),
(6, '', '', 1, '', '', 2, 2, 4, 0, 190929, 0, 0, 0, 0, 0, '2020-09-04 17:55:23', NULL, NULL, 1, 0, 0);

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
(100, '2', '2', '2020-09-08 11:02:45'),
(101, '1234', '1', '2020-09-08 20:07:25'),
(102, '1234', '1', '2020-09-08 20:07:37'),
(103, '1234', '1', '2020-09-08 20:07:43'),
(104, '1234', '1', '2020-09-08 20:07:51'),
(105, '1234', '1', '2020-09-08 20:07:59'),
(106, '1234', '1', '2020-09-08 20:08:31'),
(107, '1234', '1', '2020-09-08 20:16:57'),
(108, '1234', '1', '2020-09-08 20:17:08'),
(109, '1234', '1', '2020-09-08 20:17:23'),
(110, '1234', '1', '2020-09-08 20:21:59'),
(111, '1234', '1', '2020-09-08 20:22:06'),
(112, '1234', '1', '2020-09-08 20:22:13'),
(113, '12345', 'Camisas Polo', '2020-09-08 20:30:31'),
(114, '12345', 'Camisas Polo', '2020-09-08 20:30:52'),
(115, '12345', 'Camisas Polo', '2020-09-08 20:32:17'),
(116, '12345', 'Camisas Polo', '2020-09-08 20:32:49'),
(117, '12345', 'Camisas Polo', '2020-09-08 20:32:51'),
(118, '12345', 'Camisas Polo', '2020-09-08 20:32:58'),
(119, '12345', 'Camisas Polo', '2020-09-08 20:33:03'),
(120, '12345', 'Camisas Polo', '2020-09-08 20:33:08'),
(121, '12345', 'Camisas Polo', '2020-09-08 20:33:14'),
(122, '12345', 'Camisas Polo', '2020-09-08 20:33:19'),
(123, '29999', 'Camisas davi', '2020-09-09 10:17:58'),
(124, '29999', 'Camisas davi', '2020-09-09 10:26:24'),
(125, '1234', 'Polo', '2020-09-09 10:54:38'),
(126, '1234', 'Polo', '2020-09-09 10:54:55'),
(127, '1234', 'Polo', '2020-09-09 10:55:23'),
(128, '1234', 'Polo', '2020-09-09 10:56:06'),
(129, '12345g', 'apatos', '2020-11-02 19:29:28'),
(130, '12345g', 'apatos', '2020-11-02 19:29:36'),
(131, '12345g', 'apatos', '2020-11-02 19:30:36'),
(132, '12345g', 'apatos', '2020-11-02 23:20:27'),
(133, '12345g', 'apatos', '2020-11-02 23:22:35'),
(134, '12345g', 'apatos', '2020-11-02 23:22:50'),
(135, '12345g', 'apatos', '2020-11-02 23:22:59'),
(136, '12345g', 'apatos', '2020-11-02 23:23:15'),
(137, 'aaa', 'aaaaaa', '2020-11-02 23:36:44'),
(138, 'aaa', 'aaaaaa', '2020-11-02 23:37:14'),
(139, 'aaa', 'aaaaaa', '2020-11-02 23:37:41'),
(140, 'aaa', 'aaaaaa', '2020-11-02 23:38:15'),
(141, 'aaa', 'aaaaaa', '2020-11-02 23:38:42'),
(142, 'aaa', 'aaaaaa', '2020-11-02 23:39:18'),
(143, 'aaa', 'aaaaaa', '2020-11-02 23:40:12'),
(144, 'aaa', 'aaaaaa', '2020-11-02 23:42:11'),
(145, 'aaa', 'aaaaaa', '2020-11-02 23:43:12'),
(146, 'aaa', 'aaaaaa', '2020-11-03 00:08:52'),
(147, 'aaa', 'aaaaaa', '2020-11-03 00:09:26'),
(148, '1234', 'Camisas Polo', '2020-11-03 00:18:29'),
(149, '1234', 'Camisas Polo', '2020-11-03 00:19:01'),
(150, '1234', 'Camisas Polo', '2020-11-03 00:19:07'),
(151, '1234', 'Camisas Polo', '2020-11-03 00:19:26'),
(152, '1234', 'Camisas Polo', '2020-11-03 00:19:56'),
(153, '1234', 'Camisas Polo', '2020-11-02 23:24:25'),
(154, '1234', 'Camisas Polo', '2020-11-02 23:26:36'),
(155, '1234', 'Camisas Polo', '2020-11-02 23:26:51'),
(156, '1234', 'Camisas Polo', '2020-11-02 23:30:27'),
(157, '1234', 'Camisas Polo', '2020-11-02 23:30:47'),
(158, '1234', 'Camisas Polo', '2020-11-02 23:31:17'),
(159, '1234', 'Camisas Polo', '2020-11-02 23:31:47'),
(160, '1234', 'Camisas Polo', '2020-11-02 23:32:12'),
(161, '1234', 'Camisas Polo', '2020-11-02 23:32:32'),
(162, '1234', 'Camisas Polo', '2020-11-02 23:32:51'),
(163, '1234', 'Camisas Polo', '2020-11-02 23:33:26'),
(164, '1234', 'Camisas Polo', '2020-11-03 00:39:44'),
(165, '1234', 'Camisas Polo', '2020-11-03 00:41:41'),
(166, '1234', 'Camisas Polo', '2020-11-03 01:00:51'),
(167, '1234', 'Camisas Polo', '2020-11-03 01:01:30'),
(168, '1234', 'Camisas Polo', '2020-11-03 01:04:07'),
(169, '1234', 'Camisas Polo', '2020-11-03 01:04:14'),
(170, '1234', 'Camisas Polo', '2020-11-03 01:13:49'),
(171, '1234', 'Camisas Polo', '2020-11-03 01:13:56'),
(172, '1234', 'Camisas Polo', '2020-11-03 01:14:29'),
(173, '1234', 'Camisas Polo', '2020-11-03 01:14:38'),
(174, '1234', 'Camisas Polo', '2020-11-03 01:15:07'),
(175, '1234', 'Camisas Polo', '2020-11-03 01:15:15'),
(176, '1234', 'Camisas Polo', '2020-11-03 01:15:22'),
(177, '1234', 'Camisas Polo', '2020-11-03 01:22:32'),
(178, '1234', 'Camisas Polo', '2020-11-03 01:22:41'),
(179, '1234', 'Camisas Polo', '2020-11-03 01:22:53'),
(180, '1234', 'Camisas Polo', '2020-11-03 00:43:30'),
(181, '1234', 'Camisas Polo', '2020-11-03 00:43:54'),
(182, '1234', 'Camisas Polo', '2020-11-03 00:45:46'),
(183, '1234', 'Camisas Polo', '2020-11-03 00:46:02'),
(184, '1234', 'Camisas Polo', '2020-11-03 00:46:14'),
(185, '1234', 'Camisas Polo', '2020-11-03 00:48:14'),
(186, '1234', 'Camisas Polo', '2020-11-03 00:48:46'),
(187, '1234', 'Camisas Polo', '2020-11-03 00:48:51'),
(188, '1234', 'Camisas Polo', '2020-11-03 00:49:18'),
(189, '1234', 'Camisas Polo', '2020-11-03 00:49:27'),
(190, '1234', 'Camisas Polo', '2020-11-03 00:49:32'),
(191, '1234', 'Camisas Polo', '2020-11-03 00:49:55'),
(192, '1234', '20', '2020-11-03 00:59:31'),
(193, '1234', '20', '2020-11-03 00:59:56'),
(194, '1234', '20', '2020-11-03 01:04:22'),
(195, '1234', '20', '2020-11-03 01:10:48'),
(196, '1234', '20', '2020-11-03 01:10:58'),
(197, '2345', '1123', '2020-11-06 10:55:22'),
(198, '2345', '1123', '2020-11-06 10:55:42'),
(199, '2345', '1123', '2020-11-06 10:55:58'),
(200, '2345', '1123', '2020-11-06 10:56:04'),
(201, '2345', '1123', '2020-11-06 10:56:18'),
(202, '2345', '1123', '2020-11-06 10:56:33'),
(203, '2345', '1123', '2020-11-06 10:56:52'),
(204, '2345', '1123', '2020-11-06 10:57:18'),
(205, '2345', '1123', '2020-11-06 11:03:57'),
(206, '123454321', 'Camisas Polo', '2020-11-06 10:41:45'),
(207, '123454321', 'Camisas Polo', '2020-11-06 10:42:13'),
(208, '123454321', 'Camisas Polo', '2020-11-06 10:42:28'),
(209, '123454321', 'Camisas Polo', '2020-11-06 10:31:56'),
(210, '123454321', 'Camisas Polo', '2020-11-06 10:32:16'),
(211, '123454321', 'Camisas Polo', '2020-11-06 10:34:14');

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
  MODIFY `idregistro` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=212;

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
