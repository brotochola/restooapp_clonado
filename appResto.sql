-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jun 25, 2019 at 12:23 AM
-- Server version: 5.7.26-0ubuntu0.16.04.1
-- PHP Version: 7.1.29-1+ubuntu16.04.1+deb.sury.org+1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `appResto`
--

-- --------------------------------------------------------

--
-- Table structure for table `clientes`
--

CREATE TABLE `clientes` (
  `id_cliente` int(11) NOT NULL,
  `nombre_completo` varchar(100) NOT NULL,
  `dni` varchar(11) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `foto` text NOT NULL,
  `habilitado` int(11) NOT NULL DEFAULT '0',
  `date_created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `last_modified` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `clientes`
--

INSERT INTO `clientes` (`id_cliente`, `nombre_completo`, `dni`, `email`, `foto`, `habilitado`, `date_created`, `last_modified`) VALUES
(2, 'Emilio Perez Reverte', '11111111', 'esteban@cliente.com', '', 1, '2019-06-04 01:25:46', '2019-06-22 04:20:52'),
(3, 'Juan Carlos Z.', '4344433', 'bla@a.com', '', 1, '2019-06-04 01:25:46', '2019-06-04 01:25:46'),
(4, 'Juan Ramirez', NULL, NULL, '', 0, '2019-06-04 01:25:46', '2019-06-04 01:25:46'),
(5, 'Emilia Estefan', NULL, 'emilia@e.com', '', 0, '2019-06-04 01:25:46', '2019-06-04 01:25:46'),
(6, 'Maria Laura', '30123456', 'maria@gmail.com', '', 0, '2019-06-04 01:25:46', '2019-06-22 00:35:41'),
(7, 'facu', '1234', 'juan@cliente.com', 'as asd sa ads asd', 0, '2019-06-04 01:25:46', '2019-06-04 01:25:46'),
(27, 'Fredi Mercuri', '12345678', 'fredi@gmail.com', '', 0, '2019-06-22 02:31:15', '2019-06-22 02:31:15'),
(28, 'asdasdads', '5445343534', 'adadasddas@asd.com', '', 0, '2019-06-22 02:42:07', '2019-06-22 02:42:07'),
(29, 'juanelo godines', '666', 'juanelogodines@gmail.com', '', 0, '2019-06-22 02:43:13', '2019-06-22 02:43:13'),
(30, 'Fabián', '', '', '', 1, '2019-06-22 03:27:58', '2019-06-22 03:27:58'),
(31, 'Juan', '', '', '', 1, '2019-06-22 03:29:07', '2019-06-22 03:29:07'),
(32, 'Guille', '', '', '', 1, '2019-06-22 04:11:23', '2019-06-22 04:11:23'),
(33, 'Raúl', '', '', '', 1, '2019-06-22 04:11:34', '2019-06-22 04:11:34'),
(36, 'Pdpffjfnbd', '11223344', 'Vohajegino@emailtex.com', '', 1, '2019-06-22 04:25:26', '2019-06-22 04:26:31'),
(37, 'Fabricio', '', '', '', 1, '2019-06-22 05:47:14', '2019-06-22 05:47:14'),
(38, 'Antonio', '', '', '', 1, '2019-06-22 05:47:34', '2019-06-22 05:47:34'),
(39, 'Batman', '', '', '', 1, '2019-06-22 05:56:58', '2019-06-22 05:56:58'),
(40, 'asdasasd', '', '', '', 1, '2019-06-22 06:03:36', '2019-06-22 06:03:36'),
(41, 'Pli plin', '', '', '', 1, '2019-06-22 06:11:18', '2019-06-22 06:11:18'),
(42, 'Prueba meda', '12345678', 'prueba@gmail.com', '', 1, '2019-06-22 06:23:57', '2019-06-22 06:39:28'),
(43, 'Germán', '', '', '', 1, '2019-06-22 06:58:22', '2019-06-22 06:58:22'),
(45, 'Juan Carlos', '', '', '', 1, '2019-06-22 07:10:22', '2019-06-22 07:10:22'),
(46, 'Pepe Pom', '342835499', 'pepe@cliente.net', '', 0, '2019-06-22 07:16:56', '2019-06-22 07:16:56'),
(47, 'Franco', '', '', '', 1, '2019-06-22 07:24:22', '2019-06-22 07:24:22'),
(48, 'Pepe', '', '', '', 1, '2019-06-22 07:24:57', '2019-06-22 07:24:57'),
(49, 'German', '', '', '', 1, '2019-06-22 07:37:53', '2019-06-22 07:37:53'),
(50, 'Daniel', '37185076', 'gurpreets808@gmail.com', '', 1, '2019-06-22 08:06:47', '2019-06-22 08:07:06'),
(51, 'Pablo', '', '', '', 1, '2019-06-22 08:47:49', '2019-06-22 08:47:49'),
(52, 'Lucía', '', '', '', 1, '2019-06-22 11:51:29', '2019-06-22 11:51:29'),
(53, 'Lautaro', '', '', '', 1, '2019-06-22 11:52:10', '2019-06-22 11:52:10'),
(54, 'Tiburcio', '', '', '', 1, '2019-06-22 12:53:12', '2019-06-22 12:53:12'),
(55, 'Franco', '', '', '', 1, '2019-06-22 13:06:20', '2019-06-22 13:06:20'),
(56, 'Yolanda', '', '', '', 1, '2019-06-22 13:20:15', '2019-06-22 13:20:15'),
(57, 'Lauti', '', '', '', 1, '2019-06-22 13:50:19', '2019-06-22 13:50:19'),
(58, 'Javi', '', '', '', 1, '2019-06-22 13:58:47', '2019-06-22 13:58:47'),
(59, 'Daro', '', '', '', 1, '2019-06-22 14:10:00', '2019-06-22 14:10:00'),
(60, 'Damián', '', '', '', 1, '2019-06-22 14:23:02', '2019-06-22 14:23:02'),
(61, 'Piola', '12312312', 'dario.olinuck@gmail.com', '', 0, '2019-06-22 14:35:53', '2019-06-22 14:35:53'),
(62, 'Daniel', '37185071', 'gurpreet@abc.gob.ar', '', 1, '2019-06-22 15:26:17', '2019-06-22 15:26:40');

-- --------------------------------------------------------

--
-- Table structure for table `cliente_visita`
--

CREATE TABLE `cliente_visita` (
  `id_cliente_visita` int(11) NOT NULL,
  `id_cliente` int(11) NOT NULL,
  `id_mesa` int(11) NOT NULL,
  `fecha` date NOT NULL,
  `comensales` int(11) NOT NULL,
  `mozo` int(3) NOT NULL,
  `date_created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `last_modified` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `cerrado` int(1) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `cliente_visita`
--

INSERT INTO `cliente_visita` (`id_cliente_visita`, `id_cliente`, `id_mesa`, `fecha`, `comensales`, `mozo`, `date_created`, `last_modified`, `cerrado`) VALUES
(38, 50, 2, '2019-06-22', 2, 4, '2019-06-22 08:08:38', '2019-06-24 18:25:18', 0),
(39, 54, 8, '2019-06-22', 2, 4, '2019-06-22 12:56:18', '2019-06-24 18:25:24', 0),
(40, 67, 4, '2019-06-22', 2, 4, '2019-06-22 13:06:05', '2019-06-24 18:25:24', 0),
(41, 55, 5, '2019-06-22', 2, 4, '2019-06-22 13:06:47', '2019-06-24 18:25:24', 0),
(42, 57, 9, '2019-06-22', 2, 4, '2019-06-22 13:50:36', '2019-06-24 18:25:24', 0),
(43, 58, 3, '2019-06-22', 2, 4, '2019-06-22 13:58:58', '2019-06-24 18:25:24', 0),
(44, 56, 7, '2019-06-22', 2, 4, '2019-06-22 14:04:15', '2019-06-24 18:25:24', 0),
(45, 59, 2, '2019-06-22', 2, 4, '2019-06-22 14:14:24', '2019-06-24 18:25:24', 0),
(46, 60, 6, '2019-06-22', 2, 4, '2019-06-22 14:24:18', '2019-06-24 18:25:24', 0),
(47, 2, 13, '2019-06-22', 2, 4, '2019-06-22 14:40:27', '2019-06-22 14:40:27', 0),
(48, 62, 10, '2019-06-22', 2, 4, '2019-06-22 15:29:17', '2019-06-24 18:25:24', 0);

-- --------------------------------------------------------

--
-- Table structure for table `empleados`
--

CREATE TABLE `empleados` (
  `id_empleado` int(11) NOT NULL,
  `usuario` varchar(50) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `nombre_completo` varchar(100) DEFAULT NULL,
  `fecha_nac` timestamp NULL DEFAULT NULL,
  `dni` int(11) NOT NULL,
  `id_rol` int(11) NOT NULL,
  `fecha_ingreso` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `fecha_egreso` timestamp NULL DEFAULT NULL,
  `sueldo` decimal(10,0) DEFAULT NULL,
  `clave` varchar(50) DEFAULT NULL,
  `habilitado` int(11) DEFAULT NULL,
  `foto` longtext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `empleados`
--

INSERT INTO `empleados` (`id_empleado`, `usuario`, `email`, `nombre_completo`, `fecha_nac`, `dni`, `id_rol`, `fecha_ingreso`, `fecha_egreso`, `sueldo`, `clave`, `habilitado`, `foto`) VALUES
(1, '', 'dolinuck@gmail.com', 'Daro', '1980-05-05 04:00:00', 343434343, 1, '2019-06-12 03:00:00', '2019-06-05 04:00:00', '34', '1234', 1, 'img/28/28-foto_empleado-2019-06-22--01.03.14.png'),
(2, 'Juancho', 'juancho@gmail.com', 'juancho godines', '1980-05-05 04:00:00', 242, 4, '2019-06-12 03:00:00', '2019-06-05 04:00:00', '98349434', '1234', 1, 'img/28/28-foto_empleado-2019-06-22--01.03.14.png'),
(3, '', 'fsaiegh@gmail.com', 'Facundo Saiegh', '1980-05-05 04:00:00', 31662281, 1, '2019-06-04 03:00:00', '2019-06-05 04:00:00', '25000', '1234', 1, 'img/usuariox.jpg'),
(4, 'male', 'male@gmail.com', 'Malena Garcia', '1980-05-05 04:00:00', 12456123, 2, '2019-06-12 03:00:00', '2019-06-05 04:00:00', '5656', '1234', 1, 'img/usuariox.jpg'),
(16, 'Raul Castro', 'rcastro@gmail.com', 'Raul Castro', '1980-05-05 04:00:00', 23423424, 3, '2019-06-12 03:00:00', '2019-06-05 04:00:00', '3144', '1234', 1, 'img/28/28-foto_empleado-2019-06-22--01.03.14.png'),
(17, 'eric_estrada', 'sdad@asdd.com', 'eric estrada', '1980-05-05 04:00:00', 444443, 2, '2019-06-12 03:00:00', '2019-06-05 04:00:00', '0', '1234', 1, 'img/28/28-foto_empleado-2019-06-22--01.03.14.png'),
(18, 'mario', 'mario@baracus.com', 'mario baracus', '1980-05-05 04:00:00', 34433434, 5, '2019-06-12 03:00:00', '2019-06-05 04:00:00', '32000', '1234', 1, 'img/28/28-foto_empleado-2019-06-22--01.03.14.png'),
(27, 'Pimpollo', 'adasads@dasd.com', 'pimpollo hernandez', '2019-06-20 04:00:00', 43874783, 5, '2019-06-12 03:00:00', NULL, NULL, NULL, NULL, 'img/28/28-foto_empleado-2019-06-22--01.03.14.png'),
(28, 'usuario', 'm@maail.com', 'Marcos P', '2019-06-21 03:00:00', 12345678, 4, '2019-06-12 03:00:00', '2019-06-20 03:00:00', '50000', '1234', 1, 'img/28/28-foto_empleado-2019-06-22--01.03.14.png'),
(29, NULL, 'chicob@gmail.com', 'Chico Buarque', '2019-06-22 03:00:00', 12345678, 4, '2019-06-12 03:00:00', NULL, '123', '1234', 1, 'img/28/28-foto_empleado-2019-06-22--01.03.14.png'),
(31, NULL, 'metre@a.com', 'Julián weich', '2019-06-21 03:00:00', 12345678, 8, '2019-06-12 03:00:00', NULL, '1', '1234', 1, 'img/28/28-foto_empleado-2019-06-22--01.03.14.png'),
(32, NULL, 'Qwer@gmail.com', 'Qwer', '2019-06-21 03:00:00', 12345678, 5, '2019-06-12 03:00:00', NULL, '123', '1234', 1, 'img/28/28-foto_empleado-2019-06-22--01.03.14.png'),
(33, NULL, 'malewdf@gmail.com', 'Aaaa', '1980-05-05 03:00:00', 359449, 5, '2019-06-12 03:00:00', NULL, '0', '1234', 1, 'img/usuariox.jpg'),
(34, NULL, 'Ddddk@gmail.com', 'Kdkddk', '1980-05-05 03:00:00', 656494, 1, '2019-06-22 03:00:00', NULL, '0', '1234', 1, 'img/34/34-foto_empleado-2019-06-22--10.58.46.png'),
(35, NULL, 'Ddk@gmail.com', 'Kddjdjjd', '1980-05-05 03:00:00', 649448, 1, '2019-06-22 03:00:00', NULL, '1', '1234', 1, 'img/35/35-foto_empleado-2019-06-22--11.02.16.png'),
(36, NULL, 'Dhdk@gmail.com', 'Alala', '1980-05-05 03:00:00', 6464, 1, '2019-06-22 03:00:00', NULL, '0', '1234', 1, 'img/36/36-foto_empleado-2019-06-22--11.06.35.png'),
(37, NULL, 'daro@gmail.com', 'Daro Admin', '2019-06-06 03:00:00', 12345678, 1, '2019-06-22 03:00:00', NULL, '566', '1234', 1, 'img/37/37-foto_empleado-2019-06-22--11.31.30.png');

-- --------------------------------------------------------

--
-- Table structure for table `empleados_onesignal`
--

CREATE TABLE `empleados_onesignal` (
  `id_empleado` int(11) NOT NULL,
  `player_id` varchar(200) NOT NULL,
  `push_token` varchar(200) DEFAULT NULL,
  `date_created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `empleados_onesignal`
--

INSERT INTO `empleados_onesignal` (`id_empleado`, `player_id`, `push_token`, `date_created`) VALUES
(4, '54', '', '2019-06-24 18:02:49'),
(4, '54', '', '2019-06-24 18:03:52'),
(16, '4d0dc654-a722-4dc9-a9c6-471c71c2d2a6', '', '2019-06-24 18:07:17'),
(16, '4d0dc654-a722-4dc9-a9c6-471c71c2d2a6', '', '2019-06-24 18:07:59'),
(4, '4d0dc654-a722-4dc9-a9c6-471c71c2d2a6', '', '2019-06-24 18:16:49'),
(4, '4d0dc654-a722-4dc9-a9c6-471c71c2d2a6', '', '2019-06-24 18:34:20');

-- --------------------------------------------------------

--
-- Table structure for table `empleados_relevo`
--

CREATE TABLE `empleados_relevo` (
  `id` int(11) NOT NULL,
  `id_empleado` int(11) NOT NULL,
  `id_sector` int(11) NOT NULL,
  `fecha` date NOT NULL,
  `limpieza` int(11) NOT NULL,
  `orden` int(11) NOT NULL,
  `stock` int(11) NOT NULL,
  `residuos` int(11) NOT NULL,
  `puntualidad` int(11) NOT NULL,
  `foto` varchar(400) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `empleados_relevo`
--

INSERT INTO `empleados_relevo` (`id`, `id_empleado`, `id_sector`, `fecha`, `limpieza`, `orden`, `stock`, `residuos`, `puntualidad`, `foto`) VALUES
(1, 1, 2, '2050-02-23', 9, 9, 9, 9, 9, 'img/1/2/-foto_relevo-2019-06-25--01.22.53.png'),
(2, 1, 2, '2050-02-23', 8, 8, 8, 8, 8, 'img/1/2/-foto_relevo-2019-06-25--01.23.20.png');

-- --------------------------------------------------------

--
-- Table structure for table `encuestas`
--

CREATE TABLE `encuestas` (
  `id_encuesta` int(11) NOT NULL,
  `id_comanda` varchar(5) NOT NULL,
  `nota_mozo` int(11) NOT NULL,
  `nota_mesa` int(11) NOT NULL,
  `nota_cocinero` int(11) NOT NULL,
  `nota_restaurante` int(11) NOT NULL,
  `comentario` varchar(66) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `estado_mesa`
--

CREATE TABLE `estado_mesa` (
  `id_estadomesa` int(11) NOT NULL,
  `nombre_estado` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `estado_mesa`
--

INSERT INTO `estado_mesa` (`id_estadomesa`, `nombre_estado`) VALUES
(0, 'libre'),
(1, 'ocupada sin pedido'),
(2, 'esperando pedido'),
(3, 'pedido listo'),
(4, 'comiendo'),
(5, 'esperando cuenta'),
(6, 'pagando');

-- --------------------------------------------------------

--
-- Table structure for table `estado_pedidos`
--

CREATE TABLE `estado_pedidos` (
  `id_estado_pedido` int(11) NOT NULL,
  `nombre_estado` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `estado_pedidos`
--

INSERT INTO `estado_pedidos` (`id_estado_pedido`, `nombre_estado`) VALUES
(1, 'pendiente'),
(2, 'en preparacion'),
(3, 'listo para servir'),
(4, 'servido'),
(5, 'cancelado');

-- --------------------------------------------------------

--
-- Table structure for table `logueos`
--

CREATE TABLE `logueos` (
  `numero` int(11) NOT NULL,
  `id_empleado` int(11) NOT NULL,
  `fecha` datetime NOT NULL,
  `tarea` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `mesas`
--

CREATE TABLE `mesas` (
  `id_mesa` int(11) NOT NULL,
  `sillas` int(11) NOT NULL,
  `estado_mesa` int(11) NOT NULL,
  `zona` int(11) NOT NULL,
  `habilitada` int(11) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `mesas`
--

INSERT INTO `mesas` (`id_mesa`, `sillas`, `estado_mesa`, `zona`, `habilitada`) VALUES
(1, 4, 3, 1, 1),
(2, 3, 3, 1, 1),
(3, 4, 3, 1, 1),
(4, 4, 3, 1, 1),
(5, 4, 3, 1, 1),
(6, 3, 3, 1, 1),
(7, 3, 3, 2, 1),
(8, 5, 3, 2, 1),
(9, 6, 3, 2, 1),
(10, 3, 3, 2, 1),
(11, 3, 3, 2, 1),
(12, 3, 3, 2, 1),
(13, 2, 3, 1, 1),
(14, 6, 3, 1, 1),
(15, 2, 3, 1, 1),
(16, 2, 3, 0, 1),
(17, 2, 3, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `pedidos`
--

CREATE TABLE `pedidos` (
  `id` int(11) NOT NULL,
  `id_mesa` int(11) NOT NULL,
  `id_cliente_visita` int(11) NOT NULL,
  `fecha_alta` datetime NOT NULL,
  `estado_pedido` int(11) NOT NULL DEFAULT '1',
  `hora_estimada` datetime NOT NULL,
  `hora_listo` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pedidos`
--

INSERT INTO `pedidos` (`id`, `id_mesa`, `id_cliente_visita`, `fecha_alta`, `estado_pedido`, `hora_estimada`, `hora_listo`) VALUES
(60, 2, 38, '2019-06-22 05:12:06', 3, '2019-06-22 05:12:06', '2019-06-22 05:12:06'),
(61, 2, 38, '2019-06-22 05:34:14', 3, '2019-06-22 05:34:14', '2019-06-22 05:34:14'),
(62, 2, 38, '2019-06-22 06:12:57', 1, '2019-06-22 06:12:57', '2019-06-22 06:12:57'),
(63, 5, 41, '2019-06-22 10:07:48', 1, '2019-06-22 10:07:48', '2019-06-22 10:07:48'),
(64, 8, 39, '2019-06-22 10:16:02', 1, '2019-06-22 10:16:02', '2019-06-22 10:16:02'),
(65, 9, 42, '2019-06-22 10:50:48', 3, '2019-06-22 10:50:48', '2019-06-22 10:50:48'),
(66, 3, 43, '2019-06-22 10:59:06', 1, '2019-06-22 10:59:06', '2019-06-22 10:59:06'),
(67, 3, 43, '2019-06-22 10:59:25', 1, '2019-06-22 10:59:25', '2019-06-22 10:59:25'),
(68, 7, 44, '2019-06-22 11:04:27', 1, '2019-06-22 11:04:27', '2019-06-22 11:04:27'),
(69, 7, 44, '2019-06-22 11:04:36', 1, '2019-06-22 11:04:36', '2019-06-22 11:04:36'),
(70, 2, 45, '2019-06-22 11:15:32', 3, '2019-06-22 11:15:32', '2019-06-22 11:15:32'),
(71, 4, 40, '2019-06-22 11:24:32', 3, '2019-06-22 11:24:32', '2019-06-22 11:24:32'),
(72, 6, 46, '2019-06-22 11:24:39', 1, '2019-06-22 11:24:39', '2019-06-22 11:24:39'),
(73, 3, 43, '2019-06-22 11:24:43', 1, '2019-06-22 11:24:43', '2019-06-22 11:24:43'),
(74, 2, 45, '2019-06-22 11:33:52', 1, '2019-06-22 11:33:52', '2019-06-22 11:33:52'),
(75, 2, 45, '2019-06-22 11:37:23', 1, '2019-06-22 11:37:23', '2019-06-22 11:37:23'),
(76, 2, 45, '2019-06-22 11:37:23', 1, '2019-06-22 11:37:23', '2019-06-22 11:37:23'),
(77, 10, 48, '2019-06-22 12:30:20', 1, '2019-06-22 12:30:20', '2019-06-22 12:30:20'),
(78, 1, 19, '2019-06-24 15:10:13', 1, '2019-06-24 15:10:13', '2019-06-24 15:10:13'),
(79, 1, 19, '2019-06-24 15:10:40', 1, '2019-06-24 15:10:40', '2019-06-24 15:10:40'),
(80, 1, 19, '2019-06-24 15:11:35', 1, '2019-06-24 15:11:35', '2019-06-24 15:11:35'),
(81, 1, 19, '2019-06-24 15:12:44', 1, '2019-06-24 15:12:44', '2019-06-24 15:12:44'),
(82, 1, 19, '2019-06-24 15:13:00', 1, '2019-06-24 15:13:00', '2019-06-24 15:13:00'),
(83, 1, 19, '2019-06-24 15:14:32', 1, '2019-06-24 15:14:32', '2019-06-24 15:14:32');

-- --------------------------------------------------------

--
-- Table structure for table `pedidos_borrados`
--

CREATE TABLE `pedidos_borrados` (
  `id_comanda` varchar(50) NOT NULL,
  `id_producto` int(11) NOT NULL,
  `cantidad_producto` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `pedidos_detalles`
--

CREATE TABLE `pedidos_detalles` (
  `id` int(11) NOT NULL,
  `id_producto` int(11) NOT NULL,
  `cantidad` int(11) NOT NULL DEFAULT '1',
  `date_created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `last_modified` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `listo` int(11) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pedidos_detalles`
--

INSERT INTO `pedidos_detalles` (`id`, `id_producto`, `cantidad`, `date_created`, `last_modified`, `listo`) VALUES
(45, 1, 1, '2019-06-22 02:42:36', '2019-06-22 02:42:36', 0),
(45, 2, 2, '2019-06-22 02:42:36', '2019-06-22 02:42:36', 0),
(45, 3, 2, '2019-06-22 02:42:36', '2019-06-22 02:42:36', 0),
(46, 1, 6, '2019-06-22 02:43:46', '2019-06-22 02:43:46', 0),
(46, 3, 3, '2019-06-22 02:43:47', '2019-06-22 02:43:47', 0),
(46, 2, 2, '2019-06-22 02:43:47', '2019-06-22 02:43:47', 0),
(47, 1, 3, '2019-06-22 02:44:02', '2019-06-22 02:44:02', 0),
(47, 4, 2, '2019-06-22 02:44:02', '2019-06-22 02:44:02', 0),
(47, 12, 2, '2019-06-22 02:44:02', '2019-06-22 02:44:02', 0),
(47, 13, 5, '2019-06-22 02:44:02', '2019-06-22 02:44:02', 0),
(48, 3, 2, '2019-06-22 03:55:33', '2019-06-22 03:55:33', 0),
(48, 2, 4, '2019-06-22 03:55:33', '2019-06-22 03:55:33', 0),
(49, 11, 1, '2019-06-22 03:59:33', '2019-06-22 03:59:33', 0),
(49, 8, 1, '2019-06-22 03:59:33', '2019-06-22 03:59:33', 0),
(49, 7, 1, '2019-06-22 03:59:33', '2019-06-22 03:59:33', 0),
(49, 10, 1, '2019-06-22 03:59:33', '2019-06-22 03:59:33', 0),
(49, 9, 4, '2019-06-22 03:59:33', '2019-06-22 03:59:33', 0),
(50, 1, 1, '2019-06-22 06:32:05', '2019-06-22 06:32:05', 0),
(50, 2, 1, '2019-06-22 06:32:05', '2019-06-22 06:32:05', 0),
(50, 3, 3, '2019-06-22 06:32:05', '2019-06-22 06:32:05', 0),
(51, 3, 3, '2019-06-22 06:35:20', '2019-06-22 06:35:20', 0),
(51, 2, 2, '2019-06-22 06:35:20', '2019-06-22 06:35:20', 0),
(52, 2, 2, '2019-06-22 06:38:04', '2019-06-22 06:38:04', 0),
(52, 3, 2, '2019-06-22 06:38:04', '2019-06-22 06:38:04', 0),
(52, 4, 2, '2019-06-22 06:38:04', '2019-06-22 06:38:04', 0),
(53, 3, 1, '2019-06-22 06:39:35', '2019-06-22 06:39:35', 0),
(53, 4, 3, '2019-06-22 06:39:35', '2019-06-22 06:39:35', 0),
(54, 6, 4, '2019-06-22 06:43:18', '2019-06-22 06:43:18', 0),
(55, 3, 2, '2019-06-22 07:01:48', '2019-06-22 07:01:48', 0),
(56, 10, 2, '2019-06-22 07:04:50', '2019-06-22 07:04:50', 0),
(56, 1, 1, '2019-06-22 07:04:50', '2019-06-22 07:04:50', 0),
(56, 2, 1, '2019-06-22 07:04:50', '2019-06-22 07:04:50', 0),
(56, 3, 1, '2019-06-22 07:04:50', '2019-06-22 07:04:50', 0),
(56, 4, 1, '2019-06-22 07:04:50', '2019-06-22 07:04:50', 0),
(56, 5, 1, '2019-06-22 07:04:50', '2019-06-22 07:04:50', 0),
(56, 6, 1, '2019-06-22 07:04:50', '2019-06-22 07:04:50', 0),
(56, 7, 1, '2019-06-22 07:04:50', '2019-06-22 07:04:50', 0),
(56, 8, 1, '2019-06-22 07:04:50', '2019-06-22 07:04:50', 0),
(56, 9, 1, '2019-06-22 07:04:50', '2019-06-22 07:04:50', 0),
(56, 11, 1, '2019-06-22 07:04:50', '2019-06-22 07:04:50', 0),
(56, 12, 1, '2019-06-22 07:04:50', '2019-06-22 07:04:50', 0),
(56, 13, 1, '2019-06-22 07:04:50', '2019-06-22 07:04:50', 0),
(57, 5, 7, '2019-06-22 07:38:28', '2019-06-22 07:38:28', 0),
(57, 4, 1, '2019-06-22 07:38:28', '2019-06-22 07:38:28', 0),
(57, 3, 1, '2019-06-22 07:38:28', '2019-06-22 07:38:28', 0),
(58, 6, 2, '2019-06-22 07:47:54', '2019-06-22 07:47:54', 0),
(59, 5, 4, '2019-06-22 07:57:36', '2019-06-22 07:57:36', 0),
(60, 1, 1, '2019-06-22 08:12:06', '2019-06-22 08:12:06', 0),
(60, 5, 1, '2019-06-22 08:12:06', '2019-06-22 08:12:06', 0),
(61, 3, 2, '2019-06-22 08:34:14', '2019-06-22 08:34:14', 0),
(62, 5, 1, '2019-06-22 09:12:57', '2019-06-22 09:12:57', 0),
(63, 1, 1, '2019-06-22 13:07:48', '2019-06-22 13:07:48', 0),
(64, 4, 4, '2019-06-22 13:16:02', '2019-06-22 13:16:02', 0),
(65, 5, 2, '2019-06-22 13:50:48', '2019-06-22 13:50:48', 0),
(66, 2, 1, '2019-06-22 13:59:06', '2019-06-22 13:59:06', 0),
(67, 5, 1, '2019-06-22 13:59:25', '2019-06-22 13:59:25', 0),
(68, 10, 1, '2019-06-22 14:04:27', '2019-06-22 14:04:27', 0),
(68, 9, 1, '2019-06-22 14:04:27', '2019-06-22 14:04:27', 0),
(69, 12, 1, '2019-06-22 14:04:36', '2019-06-22 14:04:36', 0),
(70, 3, 1, '2019-06-22 14:15:32', '2019-06-22 14:15:32', 0),
(70, 10, 2, '2019-06-22 14:15:32', '2019-06-22 14:15:32', 0),
(71, 2, 1, '2019-06-22 14:24:32', '2019-06-22 14:24:32', 0),
(71, 3, 1, '2019-06-22 14:24:32', '2019-06-22 14:24:32', 0),
(71, 4, 1, '2019-06-22 14:24:32', '2019-06-22 14:24:32', 0),
(71, 5, 1, '2019-06-22 14:24:32', '2019-06-22 14:24:32', 0),
(71, 6, 1, '2019-06-22 14:24:32', '2019-06-22 14:24:32', 0),
(72, 12, 1, '2019-06-22 14:24:39', '2019-06-22 14:24:39', 0),
(73, 4, 1, '2019-06-22 14:24:43', '2019-06-22 14:24:43', 0),
(73, 5, 3, '2019-06-22 14:24:43', '2019-06-22 14:24:43', 0),
(74, 4, 1, '2019-06-22 14:33:52', '2019-06-22 14:33:52', 0),
(74, 2, 10, '2019-06-22 14:33:52', '2019-06-22 14:33:52', 0),
(75, 3, 1, '2019-06-22 14:37:23', '2019-06-22 14:37:23', 0),
(75, 4, 1, '2019-06-22 14:37:23', '2019-06-22 14:37:23', 0),
(75, 2, 3, '2019-06-22 14:37:23', '2019-06-22 14:37:23', 0),
(75, 1, 2, '2019-06-22 14:37:23', '2019-06-22 14:37:23', 0),
(76, 3, 1, '2019-06-22 14:37:23', '2019-06-22 14:37:23', 0),
(76, 4, 1, '2019-06-22 14:37:23', '2019-06-22 14:37:23', 0),
(76, 2, 3, '2019-06-22 14:37:23', '2019-06-22 14:37:23', 0),
(76, 1, 2, '2019-06-22 14:37:23', '2019-06-22 14:37:23', 0),
(77, 1, 1, '2019-06-22 15:30:20', '2019-06-22 15:30:20', 0),
(77, 3, 1, '2019-06-22 15:30:20', '2019-06-22 15:30:20', 0),
(78, 1, 1, '2019-06-24 18:10:13', '2019-06-24 18:10:13', 0),
(78, 2, 1, '2019-06-24 18:10:13', '2019-06-24 18:10:13', 0),
(78, 3, 1, '2019-06-24 18:10:13', '2019-06-24 18:10:13', 0),
(79, 1, 1, '2019-06-24 18:10:40', '2019-06-24 18:10:40', 0),
(79, 6, 1, '2019-06-24 18:10:40', '2019-06-24 18:10:40', 0),
(79, 3, 1, '2019-06-24 18:10:40', '2019-06-24 18:10:40', 0),
(80, 1, 1, '2019-06-24 18:11:35', '2019-06-24 18:11:35', 0),
(80, 6, 1, '2019-06-24 18:11:35', '2019-06-24 18:11:35', 0),
(80, 3, 1, '2019-06-24 18:11:35', '2019-06-24 18:11:35', 0),
(81, 1, 1, '2019-06-24 18:12:44', '2019-06-24 18:12:44', 0),
(81, 6, 1, '2019-06-24 18:12:44', '2019-06-24 18:12:44', 0),
(81, 3, 1, '2019-06-24 18:12:44', '2019-06-24 18:12:44', 0),
(82, 1, 1, '2019-06-24 18:13:00', '2019-06-24 18:13:00', 0),
(82, 6, 1, '2019-06-24 18:13:00', '2019-06-24 18:13:00', 0),
(82, 3, 1, '2019-06-24 18:13:00', '2019-06-24 18:13:00', 0),
(83, 1, 1, '2019-06-24 18:14:32', '2019-06-24 18:14:32', 0),
(83, 6, 1, '2019-06-24 18:14:32', '2019-06-24 18:14:32', 0),
(83, 3, 1, '2019-06-24 18:14:32', '2019-06-24 18:14:32', 0);

-- --------------------------------------------------------

--
-- Table structure for table `productos`
--

CREATE TABLE `productos` (
  `id_producto` int(11) NOT NULL,
  `nombre_producto` varchar(300) NOT NULL,
  `descripcion` varchar(400) DEFAULT NULL,
  `id_cocina` int(11) NOT NULL,
  `precio` decimal(10,0) DEFAULT NULL,
  `habilitado` int(11) NOT NULL DEFAULT '1',
  `minutos_preparacion` int(11) NOT NULL DEFAULT '1',
  `imagen` text,
  `date_created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `last_modified` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `productos`
--

INSERT INTO `productos` (`id_producto`, `nombre_producto`, `descripcion`, `id_cocina`, `precio`, `habilitado`, `minutos_preparacion`, `imagen`, `date_created`, `last_modified`) VALUES
(1, 'Risotto', 'plato italiano', 5, '100', 1, 0, '', '2019-05-27 01:16:34', '2019-06-24 18:18:05'),
(2, 'Hamburguesa Completa', 'Comida Rapida', 5, '100', 1, 0, '', '2019-05-27 01:16:34', '2019-06-24 18:18:12'),
(3, 'Sprite', 'Bebida sin alcohol', 3, '80', 1, 0, '', '2019-05-27 01:16:34', '2019-06-24 18:18:12'),
(4, 'Coca Cola', 'Bebida sin alcohol', 3, '80', 1, 0, '', '2019-05-27 01:16:34', '2019-06-24 18:18:12'),
(5, 'Dry Martini', 'Trago', 3, '120', 1, 0, '', '2019-05-27 01:16:34', '2019-06-24 18:18:12'),
(6, 'Mojito', 'Trago', 3, '120', 1, 0, '', '2019-05-27 01:16:34', '2019-06-24 18:18:12'),
(7, 'Margarita', 'Trago mexicano', 3, '170', 1, 5, '', '2019-05-27 01:16:34', '2019-06-07 18:02:34'),
(8, 'Frozen Margarita', 'Trago', 3, '222', 1, 0, '', '2019-05-27 01:16:34', '2019-06-24 18:18:12'),
(9, 'Locro', 'Plato argentino', 5, '110', 1, 0, '', '2019-05-27 01:16:34', '2019-06-24 18:18:12'),
(10, 'Picada', 'El producto de la casa', 5, '200', 1, 0, '', '2019-05-27 01:16:34', '2019-06-24 18:18:12'),
(11, 'Destornillador', 'Cocktail hecho de vokda y jugo de naranja.', 3, '200', 1, 0, '', '2019-05-27 01:16:34', '2019-06-24 18:18:12'),
(12, 'Paloma', 'Cocktail hecho con tequila y gaseosa de pomelo', 3, '150', 1, 0, '', '2019-05-27 01:16:34', '2019-06-24 18:18:12'),
(13, 'Papas Fritas', 'Papas llenas de aceite', 5, '90', 1, 1, '', '2019-06-20 21:34:42', '2019-06-24 18:18:12'),
(25, 'Nachos2', 'Con queso', 5, '240', 1, 1, '', '2019-06-22 14:21:31', '2019-06-22 14:21:44');

-- --------------------------------------------------------

--
-- Table structure for table `reservas`
--

CREATE TABLE `reservas` (
  `id` int(11) NOT NULL,
  `id_cliente` int(11) NOT NULL,
  `id_mesa` int(11) DEFAULT NULL,
  `fecha` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `fecha_alta` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `confirmada` int(11) NOT NULL DEFAULT '0',
  `comensales` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `reservas`
--

INSERT INTO `reservas` (`id`, `id_cliente`, `id_mesa`, `fecha`, `fecha_alta`, `confirmada`, `comensales`) VALUES
(25, 40, 1, '2019-06-22 06:10:55', '2019-06-22 06:10:55', 0, 2),
(26, 41, 1, '2019-06-22 06:20:24', '2019-06-22 06:20:24', 0, 2),
(27, 43, 1, '2019-06-22 06:58:39', '2019-06-22 06:58:39', 0, 2),
(28, 50, 1, '2019-06-22 08:08:04', '2019-06-22 08:08:04', 0, 2),
(29, 59, 1, '2019-06-22 14:11:04', '2019-06-22 14:11:04', 0, 2),
(30, 62, 1, '2019-06-22 15:28:00', '2019-06-22 15:28:00', 0, 2);

-- --------------------------------------------------------

--
-- Table structure for table `rol`
--

CREATE TABLE `rol` (
  `id_rol` int(11) NOT NULL,
  `nombre_rol` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `rol`
--

INSERT INTO `rol` (`id_rol`, `nombre_rol`) VALUES
(1, 'socio'),
(2, 'mozo'),
(3, 'bartender'),
(4, 'cervecero'),
(5, 'cocinero'),
(6, 'pastelera'),
(7, 'admin'),
(8, 'metre');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `clientes`
--
ALTER TABLE `clientes`
  ADD PRIMARY KEY (`id_cliente`);

--
-- Indexes for table `cliente_visita`
--
ALTER TABLE `cliente_visita`
  ADD PRIMARY KEY (`id_cliente_visita`);

--
-- Indexes for table `empleados`
--
ALTER TABLE `empleados`
  ADD PRIMARY KEY (`id_empleado`),
  ADD KEY `fk_id_roll` (`id_rol`);

--
-- Indexes for table `empleados_relevo`
--
ALTER TABLE `empleados_relevo`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `encuestas`
--
ALTER TABLE `encuestas`
  ADD PRIMARY KEY (`id_encuesta`);

--
-- Indexes for table `estado_mesa`
--
ALTER TABLE `estado_mesa`
  ADD PRIMARY KEY (`id_estadomesa`);

--
-- Indexes for table `estado_pedidos`
--
ALTER TABLE `estado_pedidos`
  ADD PRIMARY KEY (`id_estado_pedido`);

--
-- Indexes for table `logueos`
--
ALTER TABLE `logueos`
  ADD PRIMARY KEY (`numero`),
  ADD KEY `id_empleado` (`id_empleado`);

--
-- Indexes for table `mesas`
--
ALTER TABLE `mesas`
  ADD PRIMARY KEY (`id_mesa`);

--
-- Indexes for table `pedidos`
--
ALTER TABLE `pedidos`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `productos`
--
ALTER TABLE `productos`
  ADD PRIMARY KEY (`id_producto`),
  ADD KEY `id_cocina` (`id_cocina`);

--
-- Indexes for table `reservas`
--
ALTER TABLE `reservas`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `rol`
--
ALTER TABLE `rol`
  ADD PRIMARY KEY (`id_rol`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `clientes`
--
ALTER TABLE `clientes`
  MODIFY `id_cliente` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=63;

--
-- AUTO_INCREMENT for table `cliente_visita`
--
ALTER TABLE `cliente_visita`
  MODIFY `id_cliente_visita` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;

--
-- AUTO_INCREMENT for table `empleados_relevo`
--
ALTER TABLE `empleados_relevo`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `encuestas`
--
ALTER TABLE `encuestas`
  MODIFY `id_encuesta` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `logueos`
--
ALTER TABLE `logueos`
  MODIFY `numero` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `mesas`
--
ALTER TABLE `mesas`
  MODIFY `id_mesa` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `pedidos`
--
ALTER TABLE `pedidos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=84;

--
-- AUTO_INCREMENT for table `productos`
--
ALTER TABLE `productos`
  MODIFY `id_producto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `reservas`
--
ALTER TABLE `reservas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
