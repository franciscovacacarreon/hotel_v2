-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1:3307
-- Tiempo de generación: 22-10-2023 a las 22:31:20
-- Versión del servidor: 10.4.22-MariaDB
-- Versión de PHP: 8.1.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `hotel_jaldin_bolivar`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `acceso`
--

CREATE TABLE `acceso` (
  `id_acceso` int(11) NOT NULL,
  `evento` varchar(100) COLLATE utf8_spanish_ci NOT NULL,
  `fecha` datetime NOT NULL,
  `ip` varchar(20) COLLATE utf8_spanish_ci NOT NULL,
  `id_usuario` int(11) UNSIGNED NOT NULL,
  `detalle` varchar(200) COLLATE utf8_spanish_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `acceso`
--

INSERT INTO `acceso` (`id_acceso`, `evento`, `fecha`, `ip`, `id_usuario`, `detalle`) VALUES
(1, 'Inicio de sesión', '2023-08-16 22:40:15', '::1', 1, 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Sa'),
(2, 'Cierre de sesión', '2023-08-16 22:44:48', '::1', 1, 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Safari/537.36'),
(3, 'Inicio de sesión', '2023-08-16 22:46:18', '::1', 1, 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Safari/537.36'),
(4, 'Cierre de sesión', '2023-08-17 02:05:58', '::1', 1, 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Safari/537.36'),
(5, 'Inicio de sesión', '2023-08-17 02:06:07', '::1', 6, 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Safari/537.36'),
(6, 'Cierre de sesión', '2023-08-17 02:09:17', '::1', 6, 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Safari/537.36'),
(7, 'Inicio de sesión', '2023-08-17 02:09:27', '::1', 1, 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Safari/537.36'),
(8, 'Inicio de sesión', '2023-08-17 04:30:26', '192.168.43.230', 1, 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Safari/537.36'),
(9, 'Inicio de sesión', '2023-08-17 04:35:34', '192.168.43.1', 1, 'Mozilla/5.0 (Linux; Android 10; K) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Mobile Safari/537.36'),
(10, 'Inicio de sesión', '2023-08-17 04:38:28', '192.168.43.1', 1, 'Mozilla/5.0 (Linux; Android 10; K) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Mobile Safari/537.36'),
(11, 'Cierre de sesión', '2023-08-17 04:41:50', '192.168.43.1', 1, 'Mozilla/5.0 (Linux; Android 10; K) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Mobile Safari/537.36'),
(12, 'Inicio de sesión', '2023-08-17 04:43:12', '192.168.43.1', 1, 'Mozilla/5.0 (Linux; Android 10; K) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Mobile Safari/537.36'),
(13, 'Inicio de sesión', '2023-08-17 04:58:25', '192.168.43.230', 1, 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Safari/537.36'),
(14, 'Inicio de sesión', '2023-08-17 05:57:05', '192.168.43.230', 1, 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Safari/537.36'),
(15, 'Inicio de sesión', '2023-08-22 06:54:38', '192.168.43.230', 1, 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Safari/537.36'),
(16, 'Inicio de sesión', '2023-08-22 21:26:48', '192.168.43.230', 1, 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Safari/537.36'),
(17, 'Inicio de sesión', '2023-08-23 02:06:25', '192.168.43.230', 1, 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Safari/537.36'),
(18, 'Inicio de sesión', '2023-08-23 05:26:00', '192.168.43.230', 1, 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Safari/537.36'),
(19, 'Inicio de sesión', '2023-08-23 20:51:58', '192.168.43.230', 1, 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Safari/537.36'),
(20, 'Inicio de sesión', '2023-08-24 05:38:28', '192.168.43.230', 1, 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Safari/537.36'),
(21, 'Inicio de sesión', '2023-08-24 20:22:16', '192.168.43.230', 1, 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Safari/537.36'),
(22, 'Inicio de sesión', '2023-08-25 02:11:43', '192.168.43.230', 1, 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Safari/537.36'),
(23, 'Inicio de sesión', '2023-08-25 05:43:28', '192.168.43.230', 1, 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Safari/537.36'),
(24, 'Inicio de sesión', '2023-08-25 05:49:24', '192.168.43.230', 1, 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Safari/537.36'),
(25, 'Inicio de sesión', '2023-08-25 20:19:18', '192.168.43.230', 1, 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Safari/537.36'),
(26, 'Inicio de sesión', '2023-08-26 02:58:21', '192.168.43.230', 1, 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Safari/537.36'),
(27, 'Inicio de sesión', '2023-08-26 05:05:51', '192.168.43.230', 1, 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Safari/537.36'),
(28, 'Inicio de sesión', '2023-08-26 20:44:00', '192.168.43.230', 1, 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Safari/537.36'),
(29, 'Inicio de sesión', '2023-08-27 03:57:54', '::1', 1, 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Safari/537.36'),
(30, 'Inicio de sesión', '2023-08-27 05:15:59', '::1', 1, 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Safari/537.36'),
(31, 'Inicio de sesión', '2023-08-28 01:34:41', '::1', 1, 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Safari/537.36'),
(32, 'Inicio de sesión', '2023-08-28 01:47:05', '::1', 1, 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Safari/537.36'),
(33, 'Inicio de sesión', '2023-08-28 01:52:56', '::1', 1, 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Safari/537.36'),
(34, 'Cierre de sesión', '2023-08-28 01:54:23', '::1', 1, 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Safari/537.36'),
(35, 'Inicio de sesión', '2023-08-28 01:58:39', '::1', 1, 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Safari/537.36'),
(36, 'Inicio de sesión', '2023-08-28 05:55:49', '::1', 1, 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Safari/537.36'),
(37, 'Inicio de sesión', '2023-08-29 01:22:55', '::1', 1, 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Safari/537.36'),
(38, 'Inicio de sesión', '2023-08-30 00:06:44', '::1', 1, 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Safari/537.36'),
(39, 'Inicio de sesión', '2023-08-30 03:34:03', '::1', 1, 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Safari/537.36'),
(40, 'Inicio de sesión', '2023-08-30 22:48:31', '::1', 1, 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Safari/537.36'),
(41, 'Inicio de sesión', '2023-08-31 20:30:20', '::1', 1, 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Safari/537.36'),
(42, 'Inicio de sesión', '2023-09-02 22:11:01', '::1', 1, 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Safari/537.36'),
(43, 'Inicio de sesión', '2023-09-02 22:27:18', '::1', 1, 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Safari/537.36'),
(44, 'Inicio de sesión', '2023-09-03 04:10:03', '::1', 1, 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Safari/537.36'),
(45, 'Cierre de sesión', '2023-09-03 05:08:29', '::1', 1, 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Safari/537.36'),
(46, 'Inicio de sesión', '2023-09-03 05:08:35', '::1', 6, 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Safari/537.36'),
(47, 'Cierre de sesión', '2023-09-03 05:09:19', '::1', 6, 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Safari/537.36'),
(48, 'Inicio de sesión', '2023-09-03 05:29:56', '::1', 1, 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Safari/537.36'),
(49, 'Inicio de sesión', '2023-09-03 06:33:30', '::1', 1, 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Safari/537.36'),
(50, 'Inicio de sesión', '2023-09-04 20:28:35', '::1', 1, 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Safari/537.36'),
(51, 'Inicio de sesión', '2023-09-04 22:55:08', '::1', 1, 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Safari/537.36'),
(52, 'Inicio de sesión', '2023-09-05 03:33:42', '::1', 1, 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Safari/537.36'),
(53, 'Inicio de sesión', '2023-09-05 03:57:57', '::1', 1, 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Safari/537.36'),
(54, 'Inicio de sesión', '2023-09-06 04:14:20', '::1', 1, 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Safari/537.36'),
(55, 'Inicio de sesión', '2023-09-07 01:06:44', '::1', 1, 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Safari/537.36'),
(56, 'Inicio de sesión', '2023-09-09 03:37:45', '::1', 1, 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Safari/537.36'),
(57, 'Inicio de sesión', '2023-09-09 19:54:44', '::1', 1, 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Safari/537.36'),
(58, 'Inicio de sesión', '2023-09-13 23:55:38', '::1', 1, 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Safari/537.36'),
(59, 'Inicio de sesión', '2023-09-16 21:08:51', '::1', 1, 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Safari/537.36'),
(60, 'Inicio de sesión', '2023-09-22 18:35:19', '::1', 1, 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/117.0.0.0 Safari/537.36'),
(61, 'Inicio de sesión', '2023-09-25 23:43:02', '::1', 1, 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/117.0.0.0 Safari/537.36'),
(62, 'Inicio de sesión', '2023-09-28 01:16:36', '::1', 1, 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/117.0.0.0 Safari/537.36'),
(63, 'Inicio de sesión', '2023-09-30 02:53:24', '::1', 1, 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/117.0.0.0 Safari/537.36');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categoria`
--

CREATE TABLE `categoria` (
  `id` int(11) NOT NULL,
  `precio` float NOT NULL,
  `nombre` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `descripcion` varchar(200) COLLATE utf8_spanish_ci NOT NULL,
  `fecha_ingreso` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `fecha_edit` timestamp NULL DEFAULT NULL,
  `fecha_baja` timestamp NULL DEFAULT NULL,
  `estado` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `categoria`
--

INSERT INTO `categoria` (`id`, `precio`, `nombre`, `descripcion`, `fecha_ingreso`, `fecha_edit`, `fecha_baja`, `estado`) VALUES
(1, 100, 'Doble', 'Habitacion matrimonial', '2023-08-08 07:43:05', '2023-08-08 11:43:05', NULL, 1),
(3, 300, 'Suite', 'Suite con Wifi + baño privado + desayuno', '2023-08-09 00:32:50', '2023-08-09 04:32:50', NULL, 1),
(4, 1000, 'Suite presidencial', 'Con mucha calidad', '2023-08-06 21:08:37', '2023-08-07 01:08:37', NULL, 1),
(20, 100, 'Triple', 'Con 3 camas', '2023-08-07 00:57:48', '2023-08-07 00:57:48', NULL, 1),
(21, 200, 'Cuadruple', 'Con cuatro camas + wifi', '2023-08-08 08:46:10', '2023-08-08 12:46:10', NULL, 0),
(22, 0, 'Eliminar', 'Eliminar', '2023-08-16 04:57:48', '2023-08-16 04:57:48', NULL, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cliente`
--

CREATE TABLE `cliente` (
  `id_cliente` int(10) UNSIGNED NOT NULL,
  `ci` int(11) NOT NULL,
  `telefono` varchar(15) COLLATE utf8_spanish_ci NOT NULL,
  `nombre` varchar(30) COLLATE utf8_spanish_ci NOT NULL,
  `paterno` varchar(30) COLLATE utf8_spanish_ci NOT NULL,
  `materno` varchar(30) COLLATE utf8_spanish_ci DEFAULT NULL,
  `fecha_nacimiento` date NOT NULL,
  `sexo` char(2) COLLATE utf8_spanish_ci NOT NULL,
  `fecha_ingreso` timestamp NOT NULL DEFAULT current_timestamp(),
  `fecha_edit` timestamp NOT NULL DEFAULT current_timestamp(),
  `fecha_baja` timestamp NOT NULL DEFAULT current_timestamp(),
  `estado` tinyint(4) NOT NULL,
  `id_responsable` int(10) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `cliente`
--

INSERT INTO `cliente` (`id_cliente`, `ci`, `telefono`, `nombre`, `paterno`, `materno`, `fecha_nacimiento`, `sexo`, `fecha_ingreso`, `fecha_edit`, `fecha_baja`, `estado`, `id_responsable`) VALUES
(1, 123, '692321', 'Antonio', 'Vaca', 'Vargas', '2023-07-18', 'M', '2023-07-22 11:34:36', '2023-07-22 11:47:47', '2023-07-22 07:34:36', 1, NULL),
(2, 1304, '12324', 'Adriana', 'Condori', 'Aguirre', '2000-06-12', 'F', '2023-07-22 11:48:20', '2023-07-22 11:48:20', '2023-07-22 07:48:20', 1, NULL),
(3, 1234, '73423123', 'Juancin', 'Hurtado', 'Perez', '2020-01-12', 'M', '2023-07-24 06:09:44', '2023-07-24 06:09:44', '2023-07-24 02:09:44', 1, NULL),
(4, 9, '693821234', 'Ronaldo', 'Flores', 'Suyo', '2000-01-20', 'M', '2023-07-31 03:36:31', '2023-08-08 13:43:58', '2023-07-30 23:36:31', 1, NULL),
(5, 14456313, '688842821', 'Ricardo ', 'Vargas', 'Campos', '2001-02-22', 'O', '2023-08-08 13:46:46', '2023-08-08 13:53:16', '2023-08-08 09:46:46', 0, NULL),
(6, 123456, '65324567', 'Pedro', 'Arancibia', 'Mendoza', '1998-09-09', 'M', '2023-08-14 10:55:56', '2023-08-14 10:55:56', '2023-08-14 06:55:56', 1, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `configuracion`
--

CREATE TABLE `configuracion` (
  `id_configuracion` int(11) NOT NULL,
  `hotel_nombre` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `hotel_rfc` varchar(100) COLLATE utf8_spanish_ci NOT NULL,
  `hotel_telefono` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `hotel_email` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `hotel_direccion` varchar(200) COLLATE utf8_spanish_ci NOT NULL,
  `leyenda_nota` varchar(50) COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `configuracion`
--

INSERT INTO `configuracion` (`id_configuracion`, `hotel_nombre`, `hotel_rfc`, `hotel_telefono`, `hotel_email`, `hotel_direccion`, `leyenda_nota`) VALUES
(1, 'HOTEL JALDIN BOLIVAR', 'xxxxxx00xxxxx', '69049247', 'jaldinBolivar@gmail.com', 'Barrio San Jose; Calle Luis Gius entre calles 3 y 4, prolongación Oruro', 'Gracias por su preferencia!');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detallehospedaje`
--

CREATE TABLE `detallehospedaje` (
  `id_notaHospedaje` int(10) UNSIGNED NOT NULL,
  `nro_habitacion` int(11) NOT NULL,
  `cantidad_dias` int(11) DEFAULT NULL,
  `sub_monto` decimal(10,0) DEFAULT NULL,
  `id_cliente` int(10) UNSIGNED DEFAULT NULL,
  `fecha_ingreso` timestamp NOT NULL DEFAULT current_timestamp(),
  `fecha_edit` timestamp NULL DEFAULT NULL,
  `fecha_baja` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `detallehospedaje`
--

INSERT INTO `detallehospedaje` (`id_notaHospedaje`, `nro_habitacion`, `cantidad_dias`, `sub_monto`, `id_cliente`, `fecha_ingreso`, `fecha_edit`, `fecha_baja`) VALUES
(2, 13, 1, '1000', 1, '2023-07-30 10:35:01', NULL, NULL),
(3, 15, 2, '200', 2, '2023-07-30 10:36:46', NULL, NULL),
(4, 13, 1, '1000', 3, '2023-07-30 10:41:09', NULL, NULL),
(4, 15, 7, '700', 3, '2023-07-30 10:41:09', NULL, NULL),
(10, 13, 1, '1000', 1, '2023-07-30 10:56:11', NULL, NULL),
(11, 15, 1, '100', 3, '2023-07-30 11:13:12', NULL, NULL),
(12, 15, 12, '1200', 2, '2023-07-30 11:15:34', NULL, NULL),
(13, 15, 1, '100', 1, '2023-07-30 11:29:27', NULL, NULL),
(14, 15, 1, '100', 1, '2023-07-30 11:30:04', NULL, NULL),
(15, 15, 1, '100', 2, '2023-07-30 11:34:41', NULL, NULL),
(16, 16, 1, '100', 3, '2023-07-31 03:32:54', NULL, NULL),
(17, 17, 1, '100', 4, '2023-07-31 04:46:08', NULL, NULL),
(18, 18, 2, '200', 4, '2023-07-31 08:42:41', NULL, NULL),
(19, 19, 1, '300', 4, '2023-08-01 01:05:01', NULL, NULL),
(20, 22, 27, '2700', 3, '2023-08-06 10:25:57', NULL, NULL),
(21, 21, 4, '400', 1, '2023-08-07 00:56:34', NULL, NULL),
(22, 23, 1, '100', 1, '2023-08-07 00:59:04', NULL, NULL),
(24, 26, 5, '500', 2, '2023-08-09 03:29:08', NULL, NULL),
(24, 27, 5, '500', 2, '2023-08-09 03:29:08', NULL, NULL),
(25, 24, 2, '200', 1, '2023-08-09 03:56:29', NULL, NULL),
(26, 30, 4, '1200', 1, '2023-08-09 03:59:02', NULL, NULL),
(27, 19, 13, '3900', 4, '2023-08-09 04:11:17', NULL, NULL),
(28, 21, 19, '1900', 1, '2023-08-11 04:25:31', NULL, NULL),
(29, 15, 2, '200', 6, '2023-08-17 08:45:30', NULL, NULL),
(29, 21, 2, '200', 6, '2023-08-17 08:45:30', NULL, NULL),
(30, 15, 1, '100', 1, '2023-08-27 08:04:09', NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detallereserva`
--

CREATE TABLE `detallereserva` (
  `id_notaReserva` int(10) UNSIGNED NOT NULL,
  `nro_habitacion` int(11) NOT NULL,
  `cantidad_dias` int(11) DEFAULT NULL,
  `sub_monto` decimal(10,0) DEFAULT NULL,
  `id_cliente` int(10) UNSIGNED DEFAULT NULL,
  `fecha_ingreso` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `detallereserva`
--

INSERT INTO `detallereserva` (`id_notaReserva`, `nro_habitacion`, `cantidad_dias`, `sub_monto`, `id_cliente`, `fecha_ingreso`) VALUES
(9, 20, 3, '300', 4, '2023-08-01 02:51:21'),
(10, 13, 11, '11000', 1, '2023-08-07 10:06:55');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detallerolpermiso`
--

CREATE TABLE `detallerolpermiso` (
  `id_rol` int(10) UNSIGNED NOT NULL,
  `id_permiso` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `detallerolpermiso`
--

INSERT INTO `detallerolpermiso` (`id_rol`, `id_permiso`) VALUES
(1, 2),
(1, 6),
(1, 7),
(1, 8),
(1, 9),
(1, 12),
(1, 13),
(1, 14),
(1, 21),
(1, 22),
(1, 23),
(1, 25),
(1, 26),
(1, 27),
(1, 28),
(1, 29),
(1, 30),
(1, 31),
(1, 32),
(1, 33),
(1, 34),
(1, 35),
(1, 36),
(1, 37),
(1, 38),
(1, 39),
(1, 40),
(1, 41),
(1, 42),
(1, 43),
(1, 44),
(1, 45),
(1, 46),
(1, 47),
(1, 48),
(1, 49),
(1, 50),
(1, 51),
(1, 52),
(1, 53),
(1, 54),
(1, 55),
(1, 56),
(1, 57),
(1, 58),
(1, 59),
(1, 63),
(1, 64),
(1, 65),
(1, 66),
(1, 67),
(1, 68),
(1, 69),
(1, 70);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalleservicio`
--

CREATE TABLE `detalleservicio` (
  `id_notaServicio` int(10) UNSIGNED NOT NULL,
  `id_servicio` int(10) UNSIGNED NOT NULL,
  `cantidad_servicio` int(11) DEFAULT NULL,
  `sub_monto` float DEFAULT NULL,
  `fecha_ingreso` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `detalleservicio`
--

INSERT INTO `detalleservicio` (`id_notaServicio`, `id_servicio`, `cantidad_servicio`, `sub_monto`, `fecha_ingreso`) VALUES
(37, 1, 1, 10, '2023-07-30 13:02:40'),
(38, 1, 2, 20, '2023-07-30 23:11:58'),
(38, 3, 1, 10.11, '2023-07-30 23:11:58'),
(39, 1, 1, 10, '2023-07-31 08:44:00'),
(40, 2, 1, 50, '2023-08-02 10:50:09'),
(41, 2, 1, 50, '2023-08-02 11:02:45'),
(42, 2, 1, 50, '2023-08-08 14:39:24'),
(43, 1, 1, 10, '2023-08-08 23:52:23'),
(43, 3, 1, 10.11, '2023-08-08 23:52:23'),
(44, 1, 1, 10, '2023-08-09 01:48:13'),
(45, 1, 1, 10, '2023-08-10 03:41:38'),
(46, 1, 1, 10, '2023-08-12 09:48:07'),
(46, 2, 5, 250, '2023-08-12 09:48:07'),
(47, 1, 1, 10, '2023-08-17 10:02:39'),
(47, 2, 1, 50, '2023-08-17 10:02:39');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `habitacion`
--

CREATE TABLE `habitacion` (
  `nro_habitacion` int(11) NOT NULL,
  `estado_habitacion` varchar(30) COLLATE utf8_spanish_ci DEFAULT NULL,
  `numero_camas` int(11) DEFAULT NULL,
  `id_categoria` int(11) DEFAULT NULL,
  `estado` tinyint(4) NOT NULL,
  `fecha_ingreso` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `fecha_edit` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `fecha_baja` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `habitacion`
--

INSERT INTO `habitacion` (`nro_habitacion`, `estado_habitacion`, `numero_camas`, `id_categoria`, `estado`, `fecha_ingreso`, `fecha_edit`, `fecha_baja`) VALUES
(13, 'Disponible', NULL, 4, 1, '2023-08-09 06:06:49', '2023-08-09 06:06:49', NULL),
(14, 'En mantenimiento', NULL, 1, 0, '2023-08-08 09:13:53', '2023-08-08 13:13:53', NULL),
(15, 'Disponible', NULL, 1, 1, '2023-09-03 04:56:25', '2023-09-03 04:56:25', NULL),
(16, 'Ocupada', NULL, 1, 1, '2023-08-08 07:26:35', '2023-08-08 07:26:35', NULL),
(17, 'Disponible', NULL, 1, 1, '2023-08-26 05:58:28', '2023-08-26 05:58:28', NULL),
(18, 'Disponible', NULL, 1, 1, '2023-08-26 06:02:23', '2023-08-26 06:02:23', NULL),
(19, 'Ocupada', NULL, 3, 1, '2023-08-09 00:11:17', '2023-08-09 04:11:17', NULL),
(20, 'Reservada', NULL, 1, 1, '2023-08-08 09:13:43', '2023-08-08 13:13:43', NULL),
(21, 'Disponible', NULL, 1, 1, '2023-08-26 06:04:32', '2023-08-26 06:04:32', NULL),
(22, 'Ocupada', NULL, 1, 1, '2023-08-08 07:26:35', '2023-08-08 07:26:35', NULL),
(23, 'Disponible', NULL, 20, 1, '2023-08-09 07:09:04', '2023-08-09 07:09:04', NULL),
(24, 'Disponible', NULL, 20, 1, '2023-08-09 07:10:11', '2023-08-09 07:10:11', NULL),
(25, 'Disponible', NULL, 20, 1, '2023-08-08 07:26:35', '2023-08-08 07:26:35', NULL),
(26, 'Disponible', NULL, 1, 1, '2023-08-17 06:00:43', '2023-08-17 06:00:43', NULL),
(27, 'Disponible', NULL, 1, 1, '2023-08-17 06:00:43', '2023-08-17 06:00:43', NULL),
(28, 'Disponible', NULL, 1, 0, '2023-08-08 09:13:56', '2023-08-08 13:13:56', NULL),
(29, 'Disponible', NULL, 20, 0, '2023-08-08 09:14:18', '2023-08-08 13:14:18', NULL),
(30, 'Disponible', NULL, 3, 1, '2023-08-09 00:08:15', '2023-08-09 00:08:15', NULL),
(31, 'Disponible', NULL, 20, 1, '2023-08-15 08:33:39', '2023-08-15 08:33:39', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `modulo`
--

CREATE TABLE `modulo` (
  `id_modulo` int(10) UNSIGNED NOT NULL,
  `nombre` varchar(50) COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `modulo`
--

INSERT INTO `modulo` (`id_modulo`, `nombre`) VALUES
(1, 'Gestionar Hospedaje'),
(2, 'Gestionar Servicios'),
(3, 'Gestionar Habitaciones'),
(4, 'Gestionar Clientes'),
(5, 'Gestionar Recepcionistas'),
(6, 'Reportes'),
(7, 'Configuración');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `notahospedaje`
--

CREATE TABLE `notahospedaje` (
  `id_notaHospedaje` int(10) UNSIGNED NOT NULL,
  `fechaEntrada` date NOT NULL,
  `fechaSalida` date NOT NULL,
  `fechaRealSalida` date DEFAULT NULL,
  `cant_habitaciones` int(11) NOT NULL,
  `monto_total` float NOT NULL,
  `estado_hospedaje` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `tipoPago` varchar(100) COLLATE utf8_spanish_ci DEFAULT NULL,
  `fecha_ingreso` timestamp NOT NULL DEFAULT current_timestamp(),
  `fecha_edit` timestamp NOT NULL DEFAULT current_timestamp(),
  `fecha_baja` timestamp NOT NULL DEFAULT current_timestamp(),
  `estado` tinyint(4) NOT NULL DEFAULT 1,
  `id_reserva` int(10) UNSIGNED DEFAULT NULL,
  `id_recepcionista` int(10) UNSIGNED DEFAULT NULL,
  `id_cliente` int(10) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `notahospedaje`
--

INSERT INTO `notahospedaje` (`id_notaHospedaje`, `fechaEntrada`, `fechaSalida`, `fechaRealSalida`, `cant_habitaciones`, `monto_total`, `estado_hospedaje`, `tipoPago`, `fecha_ingreso`, `fecha_edit`, `fecha_baja`, `estado`, `id_reserva`, `id_recepcionista`, `id_cliente`) VALUES
(2, '2023-07-30', '2023-07-31', '2023-08-10', 0, 1000.13, 'Finalizado', NULL, '2023-07-30 10:35:01', '2023-07-30 10:35:01', '2023-07-30 06:35:01', 1, 0, 1, 1),
(3, '2023-07-30', '2023-08-01', NULL, 0, 200, 'Finalizado', NULL, '2023-07-30 10:36:46', '2023-07-30 10:36:46', '2023-07-30 06:36:46', 1, 0, 1, 2),
(4, '2023-07-30', '2023-08-06', NULL, 0, 1700.13, 'Finalizado', NULL, '2023-07-30 10:41:09', '2023-07-30 10:41:09', '2023-07-30 06:41:09', 1, 0, 1, 3),
(10, '2023-07-30', '2023-07-31', NULL, 0, 1000.13, 'Finalizado', NULL, '2023-07-30 10:56:11', '2023-07-30 10:56:11', '2023-07-30 06:56:11', 1, 0, 1, 1),
(11, '2023-07-30', '2023-07-31', NULL, 0, 100, 'Finalizado', NULL, '2023-07-30 11:13:12', '2023-07-30 11:13:12', '2023-07-30 07:13:12', 1, 0, 1, 3),
(12, '2023-07-19', '2023-07-31', NULL, 0, 1200, 'Finalizado', NULL, '2023-07-30 11:15:34', '2023-07-30 11:15:34', '2023-07-30 07:15:34', 1, 0, 1, 2),
(13, '2023-07-30', '2023-07-31', NULL, 0, 100, 'Finalizado', NULL, '2023-07-30 11:29:27', '2023-07-30 11:29:27', '2023-07-30 07:29:27', 1, 0, 1, 1),
(14, '2023-07-30', '2023-07-31', NULL, 0, 100, 'Finalizado', NULL, '2023-07-30 11:30:04', '2023-07-30 11:30:04', '2023-07-30 07:30:04', 1, 0, 1, 1),
(15, '2023-07-30', '2023-07-31', NULL, 0, 100, 'Finalizado', NULL, '2023-07-30 11:34:41', '2023-07-30 11:34:41', '2023-07-30 07:34:41', 1, 0, 1, 2),
(16, '2023-07-30', '2023-07-31', NULL, 0, 100, 'En estadía', NULL, '2023-07-31 03:32:54', '2023-07-31 03:32:54', '2023-07-30 23:32:54', 1, 0, 1, 3),
(17, '2023-07-30', '2023-07-31', '2023-08-26', 0, 100, 'Finalizado', NULL, '2023-07-31 04:46:08', '2023-07-31 04:46:08', '2023-07-31 00:46:08', 1, 0, 1, 4),
(18, '2023-07-31', '2023-08-02', '2023-08-26', 0, 200, 'Finalizado', NULL, '2023-07-31 08:42:41', '2023-07-31 08:42:41', '2023-07-31 04:42:41', 1, 0, 1, 4),
(19, '2023-07-31', '2023-08-01', NULL, 0, 300, 'Finalizado', NULL, '2023-08-01 01:05:01', '2023-08-01 01:05:01', '2023-07-31 21:05:01', 1, 0, 1, 4),
(20, '2023-08-01', '2023-08-28', NULL, 0, 2700, 'En estadía', NULL, '2023-08-06 10:25:57', '2023-08-06 10:25:57', '2023-08-06 06:25:57', 1, 0, 1, 3),
(21, '2023-08-06', '2023-08-10', NULL, 0, 400, 'Finalizado', NULL, '2023-08-07 00:56:34', '2023-08-07 00:56:34', '2023-08-06 20:56:34', 1, 0, 1, 1),
(22, '2023-08-06', '2023-08-07', '0000-00-00', 0, 100, 'Finalizado', NULL, '2023-08-07 00:59:04', '2023-08-07 00:59:04', '2023-08-06 20:59:04', 1, 0, 1, 1),
(24, '2023-08-08', '2023-08-13', '2023-08-17', 0, 1000, 'Finalizado', 'Efectivo', '2023-08-09 03:29:08', '2023-08-09 03:29:08', '2023-08-08 23:29:08', 1, 0, 1, 2),
(25, '2023-08-08', '2023-08-10', '2023-08-09', 0, 200, 'Finalizado', 'Efectivo', '2023-08-09 03:56:29', '2023-08-09 03:56:29', '2023-08-08 23:56:29', 1, 0, 1, 1),
(26, '2023-08-08', '2023-08-12', NULL, 0, 1200, 'Finalizado', 'Efectivo', '2023-08-09 03:59:02', '2023-08-09 03:59:02', '2023-08-08 23:59:02', 1, 0, 1, 1),
(27, '2023-08-08', '2023-08-21', NULL, 0, 3900, 'En estadía', 'Efectivo', '2023-08-09 04:11:17', '2023-08-09 04:11:17', '2023-08-09 00:11:17', 1, 0, 1, 4),
(28, '2023-08-10', '2023-08-29', '2023-08-16', 0, 1900, 'Finalizado', 'Efectivo', '2023-08-11 04:25:31', '2023-08-11 04:25:31', '2023-08-11 00:25:31', 1, 0, 1, 1),
(29, '2023-08-17', '2023-08-19', '2023-08-26', 0, 400, 'Finalizado', 'Efectivo', '2023-08-17 08:45:30', '2023-08-17 08:45:30', '2023-08-17 04:45:30', 1, 0, 1, 6),
(30, '2023-08-27', '2023-08-28', '2023-09-03', 0, 100, 'Finalizado', 'Efectivo', '2023-08-27 08:04:09', '2023-08-27 08:04:09', '2023-08-27 04:04:09', 1, 0, 1, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `notaservicio`
--

CREATE TABLE `notaservicio` (
  `id_notaServicio` int(10) UNSIGNED NOT NULL,
  `folio` varchar(200) COLLATE utf8_spanish_ci NOT NULL,
  `monto_total` float NOT NULL,
  `fecha_ingreso` timestamp NOT NULL DEFAULT current_timestamp(),
  `fecha_edit` timestamp NOT NULL DEFAULT current_timestamp(),
  `fecha_baja` timestamp NOT NULL DEFAULT current_timestamp(),
  `estado` tinyint(4) NOT NULL DEFAULT 1,
  `id_notaHospedaje` int(10) UNSIGNED DEFAULT NULL,
  `id_cliente` int(10) UNSIGNED DEFAULT NULL,
  `id_recepcionista` int(11) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `notaservicio`
--

INSERT INTO `notaservicio` (`id_notaServicio`, `folio`, `monto_total`, `fecha_ingreso`, `fecha_edit`, `fecha_baja`, `estado`, `id_notaHospedaje`, `id_cliente`, `id_recepcionista`) VALUES
(37, '', 10, '2023-07-30 13:02:40', '2023-07-30 13:02:40', '2023-07-30 09:02:40', 1, 0, 3, 1),
(38, '', 30.11, '2023-07-30 23:11:58', '2023-07-30 23:11:58', '2023-07-30 19:11:58', 1, 0, 1, 1),
(39, '', 10, '2023-07-31 08:44:00', '2023-07-31 08:44:00', '2023-07-31 04:44:00', 1, 0, 1, 1),
(40, '', 50, '2023-08-02 10:50:09', '2023-08-02 10:50:09', '2023-08-02 06:50:09', 1, 0, 3, 1),
(41, '', 50, '2023-08-02 11:02:45', '2023-08-02 11:02:45', '2023-08-02 07:02:45', 1, 11, 3, 1),
(42, '', 50, '2023-08-08 14:39:24', '2023-08-08 14:39:24', '2023-08-08 10:39:24', 1, 0, 1, 1),
(43, '', 20.11, '2023-08-08 23:52:23', '2023-08-08 23:52:23', '2023-08-08 19:52:23', 1, 0, 1, 1),
(44, '', 10, '2023-08-09 01:48:13', '2023-08-09 01:48:13', '2023-08-08 21:48:13', 1, 0, 1, 1),
(45, '', 10, '2023-08-10 03:41:38', '2023-08-10 03:41:38', '2023-08-09 23:41:38', 1, 0, 1, 1),
(46, '', 260, '2023-08-12 09:48:07', '2023-08-12 09:48:07', '2023-08-12 05:48:07', 1, 0, 1, 1),
(47, '', 60, '2023-08-17 10:02:39', '2023-08-17 10:02:39', '2023-08-17 06:02:39', 1, 0, 6, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `permiso`
--

CREATE TABLE `permiso` (
  `id_permiso` int(11) UNSIGNED NOT NULL,
  `nombre` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `id_tipoPermiso` int(11) UNSIGNED NOT NULL,
  `id_submodulo` int(10) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `permiso`
--

INSERT INTO `permiso` (`id_permiso`, `nombre`, `id_tipoPermiso`, `id_submodulo`) VALUES
(2, 'Recepción', 2, 1),
(6, 'Recepción Finalizar', 3, 1),
(7, 'Hospedaje', 2, 2),
(8, 'Hospedaje Detalle', 3, 2),
(9, 'Hospedaje Finalizar', 3, 2),
(12, 'Nuevo Hospedaje', 2, 2),
(13, 'Notas de servicio', 2, 3),
(14, 'Nueva nota servicio', 2, 3),
(21, 'Servicios', 2, 3),
(22, 'Agregar', 3, 3),
(23, 'Eliminados', 3, 3),
(24, 'Editar', 3, 3),
(25, 'Eliminar', 3, 3),
(26, 'Tipo de servicios', 2, 4),
(27, 'Agregar', 3, 4),
(28, 'Eliminados', 3, 4),
(29, 'Editar', 3, 4),
(30, 'Eliminar', 3, 4),
(31, 'Habitaciones', 2, 5),
(32, 'Agregar', 3, 5),
(33, 'Eliminados', 3, 5),
(34, 'Editar', 3, 5),
(35, 'Eliminar', 3, 5),
(36, 'Categorias', 2, 6),
(37, 'Agregar', 3, 6),
(38, 'Eliminados', 3, 6),
(39, 'Editar', 3, 6),
(40, 'Eliminar', 3, 6),
(41, 'Clientes', 2, 7),
(42, 'Agregar', 3, 7),
(43, 'Eliminados', 3, 7),
(44, 'Editar', 3, 7),
(45, 'Eliminar', 3, 7),
(46, 'Recepcionistas', 2, 8),
(47, 'Agregar', 3, 8),
(48, 'Eliminados', 3, 8),
(49, 'Editar', 3, 8),
(50, 'Eliminar', 3, 8),
(51, 'Reporte Hospedajes', 2, 9),
(52, 'Reporte de hospedajes', 3, 9),
(53, 'Reporte de categoria de habitaciones', 3, 9),
(54, 'Reporte Servicios', 2, 9),
(55, 'Configuración', 2, 10),
(56, 'Usuarios', 2, 11),
(57, 'Agregar', 3, 11),
(58, 'Eliminados', 3, 11),
(59, 'Editar', 3, 11),
(63, 'Eliminar', 3, 11),
(64, 'Roles', 2, 12),
(65, 'Agregar', 3, 12),
(66, 'Eliminados', 3, 12),
(67, 'Editar', 3, 12),
(68, 'Eliminar', 3, 12),
(69, 'Asignar', 3, 12),
(70, 'Permisos', 2, 13);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `recepcionista`
--

CREATE TABLE `recepcionista` (
  `id_recepcionista` int(10) UNSIGNED NOT NULL,
  `nombre` varchar(30) COLLATE utf8_spanish_ci NOT NULL,
  `paterno` varchar(30) COLLATE utf8_spanish_ci NOT NULL,
  `materno` varchar(30) COLLATE utf8_spanish_ci DEFAULT NULL,
  `telefono` varchar(10) COLLATE utf8_spanish_ci NOT NULL,
  `fecha_nacimiento` date NOT NULL,
  `sexo` char(1) COLLATE utf8_spanish_ci NOT NULL,
  `sueldo` float NOT NULL,
  `fecha_ingreso` timestamp NOT NULL DEFAULT current_timestamp(),
  `fecha_edit` timestamp NULL DEFAULT NULL,
  `fecha_baja` timestamp NULL DEFAULT NULL,
  `estado` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `recepcionista`
--

INSERT INTO `recepcionista` (`id_recepcionista`, `nombre`, `paterno`, `materno`, `telefono`, `fecha_nacimiento`, `sexo`, `sueldo`, `fecha_ingreso`, `fecha_edit`, `fecha_baja`, `estado`) VALUES
(1, 'Francisco', 'Vaca', 'Carreon', '8452312', '2000-07-14', 'M', 10, '2023-07-09 18:46:40', '2023-07-09 23:51:56', NULL, 1),
(2, 'Antonio', 'Pedro', 'Pedro', 'Pedro', '0000-00-00', 'M', 10, '2023-07-09 22:57:15', '2023-07-10 01:14:26', NULL, 1),
(3, 'Marco Antonio', 'Retamoso', 'Rodriguez', '542313678', '2000-07-27', 'M', 10000, '2023-07-10 01:13:16', '2023-07-10 01:14:17', NULL, 1),
(4, 'Roger', 'Rojas', 'Zambrana', '6542349231', '2021-02-27', 'M', 4000, '2023-07-10 02:02:45', '2023-07-10 02:02:59', NULL, 0),
(5, 'Roger', 'Rojas', 'Zambrana', '7453413', '2023-07-10', 'O', 100, '2023-07-11 23:10:53', '2023-07-11 23:10:53', NULL, 1),
(6, 'Pancracio', 'Perez', 'Parada', '65478392', '2000-01-01', 'M', 1000, '2023-08-08 15:18:16', '2023-08-08 15:18:16', NULL, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `reserva`
--

CREATE TABLE `reserva` (
  `id_notaReserva` int(10) UNSIGNED NOT NULL,
  `estado_reserva` varchar(30) COLLATE utf8_spanish_ci NOT NULL,
  `fechaEntrada` date NOT NULL,
  `fechaSalida` date NOT NULL,
  `fecha_caducidad` date DEFAULT NULL,
  `estadia` int(11) DEFAULT NULL,
  `cant_habitaciones` int(11) NOT NULL,
  `monto_total` decimal(10,2) NOT NULL,
  `estado` tinyint(4) NOT NULL DEFAULT 1,
  `fecha_ingreso` timestamp NOT NULL DEFAULT current_timestamp(),
  `fecha_edit` timestamp NOT NULL DEFAULT current_timestamp(),
  `fecha_baja` timestamp NOT NULL DEFAULT current_timestamp(),
  `id_cliente` int(10) UNSIGNED DEFAULT NULL,
  `id_recepcionista` int(10) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `reserva`
--

INSERT INTO `reserva` (`id_notaReserva`, `estado_reserva`, `fechaEntrada`, `fechaSalida`, `fecha_caducidad`, `estadia`, `cant_habitaciones`, `monto_total`, `estado`, `fecha_ingreso`, `fecha_edit`, `fecha_baja`, `id_cliente`, `id_recepcionista`) VALUES
(0, 'Sin reserva', '0000-00-00', '0000-00-00', '0000-00-00', 0, 0, '0.00', 1, '2023-07-30 06:54:13', '2023-07-30 06:54:13', '2023-07-30 06:54:13', NULL, NULL),
(2, 'En reserva', '2023-07-31', '2023-08-02', '0000-00-00', 0, 0, '200.00', 1, '2023-08-01 02:33:14', '2023-08-01 02:33:14', '2023-07-31 22:33:14', 1, 1),
(3, 'En reserva', '2023-07-31', '2023-08-03', '0000-00-00', 0, 0, '300.00', 1, '2023-08-01 02:38:52', '2023-08-01 02:38:52', '2023-07-31 22:38:52', 4, 1),
(4, 'En reserva', '2023-07-31', '2023-08-04', '0000-00-00', 0, 0, '400.00', 1, '2023-08-01 02:43:55', '2023-08-01 02:43:55', '2023-07-31 22:43:55', 4, 1),
(5, 'En reserva', '2023-07-31', '2023-08-04', '0000-00-00', 0, 0, '400.00', 1, '2023-08-01 02:46:10', '2023-08-01 02:46:10', '2023-07-31 22:46:10', 4, 1),
(6, 'En reserva', '2023-07-31', '2023-08-04', '0000-00-00', 0, 0, '400.00', 1, '2023-08-01 02:46:36', '2023-08-01 02:46:36', '2023-07-31 22:46:36', 4, 1),
(7, 'En reserva', '2023-07-31', '2023-08-03', '0000-00-00', 0, 0, '300.00', 1, '2023-08-01 02:46:57', '2023-08-01 02:46:57', '2023-07-31 22:46:57', 4, 1),
(8, 'En reserva', '2023-07-31', '2023-08-03', '0000-00-00', 0, 0, '300.00', 1, '2023-08-01 02:48:09', '2023-08-01 02:48:09', '2023-07-31 22:48:09', 4, 1),
(9, 'Cancelada', '2023-07-31', '2023-08-03', '0000-00-00', 0, 1, '300.00', 1, '2023-08-01 02:51:21', '2023-08-01 02:51:21', '2023-07-31 22:51:21', 4, 1),
(10, 'En reserva', '2023-08-07', '2023-08-18', '0000-00-00', 0, 0, '11000.00', 1, '2023-08-07 10:06:55', '2023-08-07 10:06:55', '2023-08-07 06:06:55', 1, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `rol`
--

CREATE TABLE `rol` (
  `id_rol` int(10) UNSIGNED NOT NULL,
  `nombre` varchar(20) COLLATE utf8_spanish_ci NOT NULL,
  `descripcion` varchar(100) COLLATE utf8_spanish_ci NOT NULL,
  `estado` tinyint(4) NOT NULL,
  `fecha_ingreso` timestamp NOT NULL DEFAULT current_timestamp(),
  `fecha_edit` timestamp NULL DEFAULT NULL,
  `fecha_baja` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `rol`
--

INSERT INTO `rol` (`id_rol`, `nombre`, `descripcion`, `estado`, `fecha_ingreso`, `fecha_edit`, `fecha_baja`) VALUES
(1, 'Administrador', 'El administrador del sistema', 1, '2023-07-10 02:46:29', NULL, NULL),
(2, 'Recepcionista', 'El recepcionista de los hospedajes', 1, '2023-08-08 11:10:03', NULL, NULL),
(3, 'Rol de prueba', 'rol de prueba', 1, '2023-08-16 10:40:14', '2023-08-16 11:16:45', NULL),
(4, 'tercer rol', 'eliminar tercer rol', 1, '2023-08-16 10:41:58', '2023-08-16 11:16:33', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `servicio`
--

CREATE TABLE `servicio` (
  `id_servicio` int(10) UNSIGNED NOT NULL,
  `nombre` varchar(30) COLLATE utf8_spanish_ci NOT NULL,
  `precio` float NOT NULL,
  `descripcion` varchar(200) COLLATE utf8_spanish_ci NOT NULL,
  `fecha_ingreso` timestamp NOT NULL DEFAULT current_timestamp(),
  `fecha_edit` timestamp NOT NULL DEFAULT current_timestamp(),
  `fecha_baja` timestamp NOT NULL DEFAULT current_timestamp(),
  `estado` tinyint(4) NOT NULL,
  `id_tipoServicio` int(10) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `servicio`
--

INSERT INTO `servicio` (`id_servicio`, `nombre`, `precio`, `descripcion`, `fecha_ingreso`, `fecha_edit`, `fecha_baja`, `estado`, `id_tipoServicio`) VALUES
(1, 'Cena', 10, 'Platos especiales', '2023-07-22 08:47:20', '2023-08-16 04:40:01', '2023-07-22 04:47:20', 1, 1),
(2, 'Piscina para niños', 50, 'Profundidad de 50 cm', '2023-07-22 09:05:13', '2023-08-16 04:40:06', '2023-07-22 05:05:13', 1, 2),
(3, 'Estacionamiento', 10.11, 'Garaje bajo techo', '2023-07-23 10:00:28', '2023-08-16 04:40:11', '2023-07-23 06:00:28', 1, 3);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `submodulo`
--

CREATE TABLE `submodulo` (
  `id_submodulo` int(10) UNSIGNED NOT NULL,
  `nombre` varchar(50) COLLATE utf8_spanish_ci DEFAULT NULL,
  `id_modulo` int(10) UNSIGNED NOT NULL,
  `estado` tinyint(4) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `submodulo`
--

INSERT INTO `submodulo` (`id_submodulo`, `nombre`, `id_modulo`, `estado`) VALUES
(1, 'Recepción', 1, 1),
(2, 'Hospedaje', 1, 1),
(3, 'Servicios', 2, 1),
(4, 'Tipo de servicios', 2, 1),
(5, 'Habitaciones', 3, 1),
(6, 'Categorias', 3, 1),
(7, 'Clientes', 4, 1),
(8, 'Recepcionistas', 5, 1),
(9, 'Reportes', 6, 1),
(10, 'Configuración', 7, 1),
(11, 'Usuarios', 7, 1),
(12, 'Roles', 7, 1),
(13, 'Permisos', 7, 1),
(14, 'Módulos y Submódulos', 7, 1),
(15, '...', 1, 1),
(16, '...', 7, 1),
(17, '...', 7, 1),
(18, '...', 7, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `temporalhospedaje`
--

CREATE TABLE `temporalhospedaje` (
  `id_temporalHospedaje` int(11) NOT NULL,
  `id_notaHospedaje` varchar(100) COLLATE utf8_spanish_ci NOT NULL,
  `nro_habitacion` int(11) NOT NULL,
  `nombre_categoria` varchar(100) COLLATE utf8_spanish_ci NOT NULL,
  `fechaEntrada` date NOT NULL,
  `precio` decimal(10,2) NOT NULL,
  `subtotal` decimal(10,2) NOT NULL,
  `fechaSalida` date NOT NULL,
  `id_cliente` int(11) NOT NULL,
  `id_reserva` int(11) NOT NULL,
  `cantidad_dias` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `temporalhospedaje`
--

INSERT INTO `temporalhospedaje` (`id_temporalHospedaje`, `id_notaHospedaje`, `nro_habitacion`, `nombre_categoria`, `fechaEntrada`, `precio`, `subtotal`, `fechaSalida`, `id_cliente`, `id_reserva`, `cantidad_dias`) VALUES
(1, '64c5ddeacafc5', 15, 'Doble', '0000-00-00', '100.00', '1400.00', '0000-00-00', 2, 0, 0),
(2, '64c5e49a8ac6f', 15, 'Doble', '0000-00-00', '100.00', '200.00', '0000-00-00', 2, 0, 0),
(3, '64c5e5a8930f6', 15, 'Doble', '0000-00-00', '100.00', '300.00', '0000-00-00', 1, 0, 0),
(4, '64c5e5a8930f6', 13, 'Suite presidencial', '0000-00-00', '1000.13', '1000.13', '0000-00-00', 1, 0, 0),
(5, '64c5e66948005', 13, 'Suite presidencial', '0000-00-00', '1000.13', '4000.52', '0000-00-00', 2, 0, 0),
(6, '64c5e75da580d', 13, 'Suite presidencial', '0000-00-00', '1000.13', '1000.13', '0000-00-00', 2, 0, 0),
(7, '64c5e75da580d', 15, 'Doble', '0000-00-00', '100.00', '500.00', '0000-00-00', 2, 0, 0),
(8, '64c5ea2e2306d', 15, 'Doble', '0000-00-00', '100.00', '100.00', '0000-00-00', 1, 0, 0),
(9, '64c5eb418323a', 15, 'Doble', '0000-00-00', '100.00', '100.00', '0000-00-00', 1, 0, 1),
(10, '64c5eb418323a', 13, 'Suite presidencial', '0000-00-00', '1000.13', '5000.65', '0000-00-00', 1, 0, 5),
(11, '64c5ef070e0f2', 13, 'Suite presidencial', '0000-00-00', '1000.13', '1000.13', '0000-00-00', 1, 0, 1),
(14, '64c603a44cee8', 13, 'Suite presidencial', '0000-00-00', '1000.13', '1000.13', '0000-00-00', 2, 0, 1),
(19, '64c6066f158e9', 13, 'Suite presidencial', '0000-00-00', '1000.13', '1000.13', '0000-00-00', 1, 0, 1),
(20, '64c60688a1aa6', 13, 'Suite presidencial', '0000-00-00', '1000.13', '1000.13', '0000-00-00', 1, 0, 1),
(21, '64c60865b90c9', 13, 'Suite presidencial', '0000-00-00', '1000.13', '2000.26', '0000-00-00', 2, 0, 2),
(23, '64c60b1467d27', 15, 'Doble', '0000-00-00', '100.00', '100.00', '0000-00-00', 3, 0, 1),
(24, '64c60df865f45', 15, 'Doble', '0000-00-00', '100.00', '1200.00', '0000-00-00', 2, 0, 12),
(25, '64c6113cca635', 15, 'Doble', '0000-00-00', '100.00', '100.00', '0000-00-00', 1, 0, 1),
(28, '64c624a00287f', 16, 'Doble', '0000-00-00', '100.00', '500.00', '0000-00-00', 2, 0, 5),
(29, '64c6971841bf2', 16, 'Doble', '0000-00-00', '100.00', '100.00', '0000-00-00', 1, 0, 1),
(30, '64c6b89724c76', 16, 'Doble', '0000-00-00', '100.00', '200.00', '0000-00-00', 1, 0, 2),
(31, '64c6b8f130d89', 16, 'Doble', '0000-00-00', '100.00', '0.00', '0000-00-00', 2, 0, 0),
(32, '64c6b91635ddb', 16, 'Doble', '0000-00-00', '100.00', '100.00', '0000-00-00', 1, 0, 1),
(33, '64c6b9651d8ab', 16, 'Doble', '0000-00-00', '100.00', '0.00', '0000-00-00', 3, 0, 0),
(34, '64c6b9fe87718', 16, 'Doble', '0000-00-00', '100.00', '0.00', '0000-00-00', 1, 0, 0),
(35, '64c6bd0500253', 16, 'Doble', '0000-00-00', '100.00', '100.00', '0000-00-00', 2, 0, 1),
(36, '64c6d697d4dfe', 16, 'Doble', '0000-00-00', '100.00', '1100.00', '0000-00-00', 1, 0, 11),
(37, '64c6d727642db', 16, 'Doble', '0000-00-00', '100.00', '500.00', '0000-00-00', 2, 0, 5),
(40, '64c71826d08fb', 18, 'Doble', '0000-00-00', '100.00', '100.00', '0000-00-00', 4, 0, 1),
(43, '64c869472a133', 13, 'Suite presidencial', '0000-00-00', '1000.13', '6000.78', '0000-00-00', 3, 0, 6),
(44, '64c869472a133', 22, 'Doble', '0000-00-00', '100.00', '600.00', '0000-00-00', 3, 0, 6),
(45, '64cf1e8ec2770', 15, 'Doble', '0000-00-00', '100.00', '2400.00', '0000-00-00', 2, 0, 24),
(46, '64cf1e8ec2770', 13, 'Suite presidencial', '0000-00-00', '1000.13', '24003.12', '0000-00-00', 2, 0, 24),
(55, '64d2d8fd7cc03', 19, 'Suite', '0000-00-00', '300.00', '1800.00', '0000-00-00', 4, 0, 6),
(56, '64d2d95ea71fd', 19, 'Suite', '0000-00-00', '300.00', '1500.00', '0000-00-00', 4, 0, 5);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `temporalreserva`
--

CREATE TABLE `temporalreserva` (
  `id_temporalReserva` int(11) NOT NULL,
  `id_notaReserva` varchar(100) COLLATE utf8_spanish_ci DEFAULT NULL,
  `nro_habitacion` int(11) DEFAULT NULL,
  `nombre_categoria` varchar(100) COLLATE utf8_spanish_ci DEFAULT NULL,
  `fechaEntrada` date DEFAULT NULL,
  `fechaSalida` date DEFAULT NULL,
  `precio` decimal(10,2) DEFAULT NULL,
  `subtotal` decimal(10,2) DEFAULT NULL,
  `id_cliente` int(11) DEFAULT NULL,
  `cantidad_dias` int(11) DEFAULT NULL,
  `nombre` varchar(100) COLLATE utf8_spanish_ci DEFAULT NULL,
  `email` varchar(200) COLLATE utf8_spanish_ci DEFAULT NULL,
  `nroAdultos` int(11) DEFAULT NULL,
  `nroNiños` int(11) DEFAULT NULL,
  `nroCuartos` int(11) DEFAULT NULL,
  `comentario` varchar(300) COLLATE utf8_spanish_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `temporalreserva`
--

INSERT INTO `temporalreserva` (`id_temporalReserva`, `id_notaReserva`, `nro_habitacion`, `nombre_categoria`, `fechaEntrada`, `fechaSalida`, `precio`, `subtotal`, `id_cliente`, `cantidad_dias`, `nombre`, `email`, `nroAdultos`, `nroNiños`, `nroCuartos`, `comentario`) VALUES
(1, '64c81cc3b80e5', 19, 'Suite', '0000-00-00', '0000-00-00', '300.00', '600.00', 1, 2, NULL, NULL, NULL, NULL, NULL, NULL),
(2, '64c81dc1eef31', 19, 'Suite', '0000-00-00', '0000-00-00', '300.00', '900.00', 1, 3, NULL, NULL, NULL, NULL, NULL, NULL),
(3, '64c81f4f80c87', 19, 'Suite', '0000-00-00', '0000-00-00', '300.00', '600.00', 2, 2, NULL, NULL, NULL, NULL, NULL, NULL),
(4, '64c81fbae0f22', 19, 'Suite', '0000-00-00', '0000-00-00', '300.00', '300.00', 1, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(5, '64c82caee2f10', 20, 'Doble', '0000-00-00', '0000-00-00', '100.00', '300.00', 4, 3, NULL, NULL, NULL, NULL, NULL, NULL),
(6, '64c82e98b0993', 21, 'Doble', '0000-00-00', '0000-00-00', '100.00', '200.00', 3, 2, NULL, NULL, NULL, NULL, NULL, NULL),
(8, '64c8367737b65', 20, 'Doble', '0000-00-00', '0000-00-00', '100.00', '200.00', 1, 2, NULL, NULL, NULL, NULL, NULL, NULL),
(9, '64c837ec9eede', 20, 'Doble', '0000-00-00', '0000-00-00', '100.00', '300.00', 4, 3, NULL, NULL, NULL, NULL, NULL, NULL),
(10, '64c8391575d7a', 20, 'Doble', '0000-00-00', '0000-00-00', '100.00', '400.00', 4, 4, NULL, NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `temporalservicio`
--

CREATE TABLE `temporalservicio` (
  `id_temporalServicio` int(11) NOT NULL,
  `id_notaServicio` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `id_servicio` int(11) NOT NULL,
  `nro_servicio` int(11) DEFAULT NULL,
  `nombre` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `cantidad` int(11) NOT NULL,
  `precio` decimal(11,2) NOT NULL,
  `subtotal` decimal(10,2) NOT NULL,
  `id_cliente` int(11) DEFAULT NULL,
  `id_notaHospedaje` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `temporalservicio`
--

INSERT INTO `temporalservicio` (`id_temporalServicio`, `id_notaServicio`, `id_servicio`, `nro_servicio`, `nombre`, `cantidad`, `precio`, `subtotal`, `id_cliente`, `id_notaHospedaje`) VALUES
(107, '64c5ca9756a8a', 1, 1, 'Cena', 15, '10.00', '150.00', 1, 0),
(108, '64c5cac11d8e1', 1, 1, 'Cena', 2, '10.00', '20.00', 1, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipopermiso`
--

CREATE TABLE `tipopermiso` (
  `id_tipoPermiso` int(11) UNSIGNED NOT NULL,
  `nombre` varchar(50) COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `tipopermiso`
--

INSERT INTO `tipopermiso` (`id_tipoPermiso`, `nombre`) VALUES
(1, 'Menú'),
(2, 'Submodulo'),
(3, 'Acción'),
(6, 'Prueba');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tiposervicio`
--

CREATE TABLE `tiposervicio` (
  `id_tipoServicio` int(10) UNSIGNED NOT NULL,
  `nombre` varchar(30) COLLATE utf8_spanish_ci NOT NULL,
  `descripcion` varchar(100) COLLATE utf8_spanish_ci NOT NULL,
  `fecha_ingreso` timestamp NOT NULL DEFAULT current_timestamp(),
  `fecha_edit` timestamp NOT NULL DEFAULT current_timestamp(),
  `fecha_baja` timestamp NOT NULL DEFAULT current_timestamp(),
  `estado` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `tiposervicio`
--

INSERT INTO `tiposervicio` (`id_tipoServicio`, `nombre`, `descripcion`, `fecha_ingreso`, `fecha_edit`, `fecha_baja`, `estado`) VALUES
(1, 'Restaurante', 'Todo tipo de comida', '2023-07-10 10:54:55', '2023-08-08 14:14:36', '2023-07-10 06:54:55', 1),
(2, 'Piscina', 'Piscina dentro del hotel', '2023-07-22 09:04:31', '2023-07-22 09:04:31', '2023-07-22 05:04:31', 1),
(3, 'Garaje', 'Para todo el público', '2023-07-23 10:01:04', '2023-08-09 05:21:49', '2023-07-23 06:01:05', 1),
(4, 'Limpieza', 'Aseo personalizado', '2023-08-08 14:14:05', '2023-08-09 05:23:36', '2023-08-08 10:14:05', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE `usuario` (
  `id_usuario` int(10) UNSIGNED NOT NULL,
  `usuario` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `password` varchar(150) COLLATE utf8_spanish_ci NOT NULL,
  `fecha_ingreso` timestamp NOT NULL DEFAULT current_timestamp(),
  `fecha_edit` timestamp NOT NULL DEFAULT current_timestamp(),
  `fecha_baja` timestamp NOT NULL DEFAULT current_timestamp(),
  `estado` tinyint(4) NOT NULL,
  `id_recepcionista` int(10) UNSIGNED DEFAULT NULL,
  `id_cliente` int(10) UNSIGNED DEFAULT NULL,
  `id_rol` int(10) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`id_usuario`, `usuario`, `password`, `fecha_ingreso`, `fecha_edit`, `fecha_baja`, `estado`, `id_recepcionista`, `id_cliente`, `id_rol`) VALUES
(1, 'admin', '$2y$10$nBkJA589PjgwG4kNEr4W9eHBUTqPVAA5vPpUH5cRYQZ2xOQh8vMXK', '2023-07-10 02:47:57', '2023-08-01 01:10:16', '2023-07-10 02:47:57', 1, 1, NULL, 1),
(2, 'franciscovaca', '$2y$10$h0XZ2PbLF6uE5QfT4zObuOSo5EhOovkyg3Q437vMQDtckn/wGNXSy', '2023-07-10 07:31:22', '2023-08-01 04:39:52', '2023-07-10 03:31:22', 1, 1, NULL, 1),
(3, 'ricardoVargashihop', '123', '2023-07-10 07:32:53', '2023-07-10 09:00:17', '2023-07-10 03:32:53', 1, 2, NULL, 1),
(4, 'Roger Rojas2', '12', '2023-07-10 09:00:43', '2023-07-10 09:01:00', '2023-07-10 05:00:43', 1, 3, NULL, 1),
(5, 'rogerRojas', '$2y$10$8uy4c5PEVGu5FRPQt6OPQuqfM9qFuL/YA2Ms3I5gyA0C6filjJJkG', '2023-07-11 23:11:17', '2023-08-01 05:11:18', '2023-07-11 19:11:17', 0, 5, NULL, 1),
(6, 'pancracio', '$2y$10$x2D0P/u2/Ao8BllJY7zgbuRAXni3.k93qpD2dw/7cvbgoHOc156j2', '2023-08-08 15:18:47', '2023-08-08 15:18:47', '2023-08-08 11:18:47', 1, 6, NULL, 2);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `acceso`
--
ALTER TABLE `acceso`
  ADD PRIMARY KEY (`id_acceso`),
  ADD KEY `fk_usuario_acceso` (`id_usuario`);

--
-- Indices de la tabla `categoria`
--
ALTER TABLE `categoria`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `cliente`
--
ALTER TABLE `cliente`
  ADD PRIMARY KEY (`id_cliente`),
  ADD KEY `id_responsable` (`id_responsable`);

--
-- Indices de la tabla `configuracion`
--
ALTER TABLE `configuracion`
  ADD PRIMARY KEY (`id_configuracion`);

--
-- Indices de la tabla `detallehospedaje`
--
ALTER TABLE `detallehospedaje`
  ADD PRIMARY KEY (`id_notaHospedaje`,`nro_habitacion`),
  ADD KEY `nro_habitacion` (`nro_habitacion`),
  ADD KEY `id_cliente` (`id_cliente`);

--
-- Indices de la tabla `detallereserva`
--
ALTER TABLE `detallereserva`
  ADD PRIMARY KEY (`id_notaReserva`,`nro_habitacion`),
  ADD KEY `nro_habitacion` (`nro_habitacion`),
  ADD KEY `id_cliente` (`id_cliente`);

--
-- Indices de la tabla `detallerolpermiso`
--
ALTER TABLE `detallerolpermiso`
  ADD PRIMARY KEY (`id_rol`,`id_permiso`),
  ADD KEY `id_permiso` (`id_permiso`);

--
-- Indices de la tabla `detalleservicio`
--
ALTER TABLE `detalleservicio`
  ADD PRIMARY KEY (`id_notaServicio`,`id_servicio`),
  ADD KEY `id_servicio` (`id_servicio`);

--
-- Indices de la tabla `habitacion`
--
ALTER TABLE `habitacion`
  ADD PRIMARY KEY (`nro_habitacion`),
  ADD KEY `id_categoria` (`id_categoria`);

--
-- Indices de la tabla `modulo`
--
ALTER TABLE `modulo`
  ADD PRIMARY KEY (`id_modulo`);

--
-- Indices de la tabla `notahospedaje`
--
ALTER TABLE `notahospedaje`
  ADD PRIMARY KEY (`id_notaHospedaje`),
  ADD KEY `id_reserva` (`id_reserva`),
  ADD KEY `id_recepcionista` (`id_recepcionista`),
  ADD KEY `id_cliente` (`id_cliente`);

--
-- Indices de la tabla `notaservicio`
--
ALTER TABLE `notaservicio`
  ADD PRIMARY KEY (`id_notaServicio`),
  ADD KEY `id_cliente` (`id_cliente`),
  ADD KEY `fk_notaServicio_recepcionista` (`id_recepcionista`);

--
-- Indices de la tabla `permiso`
--
ALTER TABLE `permiso`
  ADD PRIMARY KEY (`id_permiso`),
  ADD KEY `fk_permiso_tipoPermiso` (`id_tipoPermiso`),
  ADD KEY `fk_permiso_submodulo` (`id_submodulo`);

--
-- Indices de la tabla `recepcionista`
--
ALTER TABLE `recepcionista`
  ADD PRIMARY KEY (`id_recepcionista`);

--
-- Indices de la tabla `reserva`
--
ALTER TABLE `reserva`
  ADD PRIMARY KEY (`id_notaReserva`),
  ADD KEY `id_cliente` (`id_cliente`),
  ADD KEY `id_recepcionista` (`id_recepcionista`);

--
-- Indices de la tabla `rol`
--
ALTER TABLE `rol`
  ADD PRIMARY KEY (`id_rol`);

--
-- Indices de la tabla `servicio`
--
ALTER TABLE `servicio`
  ADD PRIMARY KEY (`id_servicio`),
  ADD KEY `id_tipoServicio` (`id_tipoServicio`);

--
-- Indices de la tabla `submodulo`
--
ALTER TABLE `submodulo`
  ADD PRIMARY KEY (`id_submodulo`),
  ADD KEY `fk_submodulo_modulo` (`id_modulo`);

--
-- Indices de la tabla `temporalhospedaje`
--
ALTER TABLE `temporalhospedaje`
  ADD PRIMARY KEY (`id_temporalHospedaje`);

--
-- Indices de la tabla `temporalreserva`
--
ALTER TABLE `temporalreserva`
  ADD PRIMARY KEY (`id_temporalReserva`);

--
-- Indices de la tabla `temporalservicio`
--
ALTER TABLE `temporalservicio`
  ADD PRIMARY KEY (`id_temporalServicio`);

--
-- Indices de la tabla `tipopermiso`
--
ALTER TABLE `tipopermiso`
  ADD PRIMARY KEY (`id_tipoPermiso`);

--
-- Indices de la tabla `tiposervicio`
--
ALTER TABLE `tiposervicio`
  ADD PRIMARY KEY (`id_tipoServicio`);

--
-- Indices de la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`id_usuario`),
  ADD KEY `id_recepcionista` (`id_recepcionista`),
  ADD KEY `id_cliente` (`id_cliente`),
  ADD KEY `id_rol` (`id_rol`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `acceso`
--
ALTER TABLE `acceso`
  MODIFY `id_acceso` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=64;

--
-- AUTO_INCREMENT de la tabla `categoria`
--
ALTER TABLE `categoria`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT de la tabla `cliente`
--
ALTER TABLE `cliente`
  MODIFY `id_cliente` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `configuracion`
--
ALTER TABLE `configuracion`
  MODIFY `id_configuracion` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `habitacion`
--
ALTER TABLE `habitacion`
  MODIFY `nro_habitacion` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT de la tabla `modulo`
--
ALTER TABLE `modulo`
  MODIFY `id_modulo` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `notahospedaje`
--
ALTER TABLE `notahospedaje`
  MODIFY `id_notaHospedaje` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT de la tabla `notaservicio`
--
ALTER TABLE `notaservicio`
  MODIFY `id_notaServicio` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=48;

--
-- AUTO_INCREMENT de la tabla `permiso`
--
ALTER TABLE `permiso`
  MODIFY `id_permiso` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=71;

--
-- AUTO_INCREMENT de la tabla `recepcionista`
--
ALTER TABLE `recepcionista`
  MODIFY `id_recepcionista` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `reserva`
--
ALTER TABLE `reserva`
  MODIFY `id_notaReserva` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de la tabla `rol`
--
ALTER TABLE `rol`
  MODIFY `id_rol` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `servicio`
--
ALTER TABLE `servicio`
  MODIFY `id_servicio` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `submodulo`
--
ALTER TABLE `submodulo`
  MODIFY `id_submodulo` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT de la tabla `temporalhospedaje`
--
ALTER TABLE `temporalhospedaje`
  MODIFY `id_temporalHospedaje` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=62;

--
-- AUTO_INCREMENT de la tabla `temporalreserva`
--
ALTER TABLE `temporalreserva`
  MODIFY `id_temporalReserva` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT de la tabla `temporalservicio`
--
ALTER TABLE `temporalservicio`
  MODIFY `id_temporalServicio` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=126;

--
-- AUTO_INCREMENT de la tabla `tipopermiso`
--
ALTER TABLE `tipopermiso`
  MODIFY `id_tipoPermiso` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `tiposervicio`
--
ALTER TABLE `tiposervicio`
  MODIFY `id_tipoServicio` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `usuario`
--
ALTER TABLE `usuario`
  MODIFY `id_usuario` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `acceso`
--
ALTER TABLE `acceso`
  ADD CONSTRAINT `fk_usuario_acceso` FOREIGN KEY (`id_usuario`) REFERENCES `usuario` (`id_usuario`);

--
-- Filtros para la tabla `cliente`
--
ALTER TABLE `cliente`
  ADD CONSTRAINT `cliente_ibfk_1` FOREIGN KEY (`id_responsable`) REFERENCES `cliente` (`id_cliente`);

--
-- Filtros para la tabla `detallehospedaje`
--
ALTER TABLE `detallehospedaje`
  ADD CONSTRAINT `detallehospedaje_ibfk_1` FOREIGN KEY (`id_notaHospedaje`) REFERENCES `notahospedaje` (`id_notaHospedaje`),
  ADD CONSTRAINT `detallehospedaje_ibfk_2` FOREIGN KEY (`nro_habitacion`) REFERENCES `habitacion` (`nro_habitacion`),
  ADD CONSTRAINT `detallehospedaje_ibfk_3` FOREIGN KEY (`id_cliente`) REFERENCES `cliente` (`id_cliente`);

--
-- Filtros para la tabla `detallereserva`
--
ALTER TABLE `detallereserva`
  ADD CONSTRAINT `detallereserva_ibfk_1` FOREIGN KEY (`id_notaReserva`) REFERENCES `reserva` (`id_notaReserva`),
  ADD CONSTRAINT `detallereserva_ibfk_2` FOREIGN KEY (`nro_habitacion`) REFERENCES `habitacion` (`nro_habitacion`),
  ADD CONSTRAINT `detallereserva_ibfk_3` FOREIGN KEY (`id_cliente`) REFERENCES `cliente` (`id_cliente`);

--
-- Filtros para la tabla `detallerolpermiso`
--
ALTER TABLE `detallerolpermiso`
  ADD CONSTRAINT `detallerolpermiso_ibfk_1` FOREIGN KEY (`id_rol`) REFERENCES `rol` (`id_rol`),
  ADD CONSTRAINT `detallerolpermiso_ibfk_2` FOREIGN KEY (`id_permiso`) REFERENCES `permiso` (`id_permiso`);

--
-- Filtros para la tabla `detalleservicio`
--
ALTER TABLE `detalleservicio`
  ADD CONSTRAINT `detalleservicio_ibfk_1` FOREIGN KEY (`id_notaServicio`) REFERENCES `notaservicio` (`id_notaServicio`),
  ADD CONSTRAINT `detalleservicio_ibfk_2` FOREIGN KEY (`id_servicio`) REFERENCES `servicio` (`id_Servicio`);

--
-- Filtros para la tabla `habitacion`
--
ALTER TABLE `habitacion`
  ADD CONSTRAINT `habitacion_ibfk_1` FOREIGN KEY (`id_categoria`) REFERENCES `categoria` (`id`);

--
-- Filtros para la tabla `notahospedaje`
--
ALTER TABLE `notahospedaje`
  ADD CONSTRAINT `notahospedaje_ibfk_1` FOREIGN KEY (`id_reserva`) REFERENCES `reserva` (`id_notaReserva`),
  ADD CONSTRAINT `notahospedaje_ibfk_2` FOREIGN KEY (`id_recepcionista`) REFERENCES `recepcionista` (`id_recepcionista`),
  ADD CONSTRAINT `notahospedaje_ibfk_3` FOREIGN KEY (`id_cliente`) REFERENCES `cliente` (`id_cliente`);

--
-- Filtros para la tabla `notaservicio`
--
ALTER TABLE `notaservicio`
  ADD CONSTRAINT `fk_notaServicio_recepcionista` FOREIGN KEY (`id_recepcionista`) REFERENCES `recepcionista` (`id_recepcionista`),
  ADD CONSTRAINT `notaservicio_ibfk_1` FOREIGN KEY (`id_cliente`) REFERENCES `cliente` (`id_cliente`);

--
-- Filtros para la tabla `permiso`
--
ALTER TABLE `permiso`
  ADD CONSTRAINT `fk_permiso_submodulo` FOREIGN KEY (`id_submodulo`) REFERENCES `submodulo` (`id_submodulo`),
  ADD CONSTRAINT `fk_permiso_tipoPermiso` FOREIGN KEY (`id_tipoPermiso`) REFERENCES `tipopermiso` (`id_tipoPermiso`);

--
-- Filtros para la tabla `reserva`
--
ALTER TABLE `reserva`
  ADD CONSTRAINT `reserva_ibfk_1` FOREIGN KEY (`id_cliente`) REFERENCES `cliente` (`id_cliente`),
  ADD CONSTRAINT `reserva_ibfk_2` FOREIGN KEY (`id_recepcionista`) REFERENCES `recepcionista` (`id_recepcionista`);

--
-- Filtros para la tabla `servicio`
--
ALTER TABLE `servicio`
  ADD CONSTRAINT `servicio_ibfk_1` FOREIGN KEY (`id_tipoServicio`) REFERENCES `tiposervicio` (`id_tipoServicio`);

--
-- Filtros para la tabla `submodulo`
--
ALTER TABLE `submodulo`
  ADD CONSTRAINT `fk_submodulo_modulo` FOREIGN KEY (`id_modulo`) REFERENCES `modulo` (`id_modulo`);

--
-- Filtros para la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD CONSTRAINT `usuario_ibfk_1` FOREIGN KEY (`id_recepcionista`) REFERENCES `recepcionista` (`id_recepcionista`),
  ADD CONSTRAINT `usuario_ibfk_2` FOREIGN KEY (`id_cliente`) REFERENCES `cliente` (`id_cliente`),
  ADD CONSTRAINT `usuario_ibfk_3` FOREIGN KEY (`id_rol`) REFERENCES `rol` (`id_rol`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
