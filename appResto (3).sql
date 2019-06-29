-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jun 28, 2019 at 09:04 PM
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
(62, 'Daniel', '37185071', 'gurpreet@abc.gob.ar', '', 1, '2019-06-22 15:26:17', '2019-06-22 15:26:40'),
(63, 'asdasd', '244', 'sdasdadadasd@asdsad.com', '', 0, '2019-06-27 20:12:47', '2019-06-27 20:12:47'),
(64, 'dfsf', '44', 'fsfsfd@das.com', '', 0, '2019-06-27 20:29:45', '2019-06-27 20:29:45'),
(65, 'a', '33332', 'adsasdas@asd.com', '', 0, '2019-06-27 21:35:22', '2019-06-27 21:35:22'),
(66, 'Julian', '', '', '', 1, '2019-06-28 07:19:28', '2019-06-28 07:19:28'),
(67, 'aaaaa', '44444', 'asdasd@dasd.com', '', 0, '2019-06-28 16:06:19', '2019-06-28 16:06:19'),
(68, 'juanito pinto', '2394746', 'asdasd@ads.com', '', 0, '2019-06-28 22:21:57', '2019-06-28 22:21:57'),
(69, 'daro pruebas', '12345', 'daro@prueba.com', '', 1, '2019-06-28 22:45:05', '2019-06-28 23:50:35'),
(70, 'Fulano', '', '', '', 1, '2019-06-28 23:10:25', '2019-06-28 23:10:25'),
(71, 'Daro', '', '', '', 1, '2019-06-29 00:35:46', '2019-06-29 00:35:46'),
(72, 'guachin 1', '', '', '', 1, '2019-06-29 00:44:37', '2019-06-29 00:44:37'),
(73, 'Felipe', '', '', '', 1, '2019-06-29 00:45:57', '2019-06-29 00:45:57'),
(74, 'ggg', '', '', '', 1, '2019-06-29 00:59:18', '2019-06-29 00:59:18');

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
(49, 63, 2, '2019-06-27', 3, 4, '2019-06-27 20:12:47', '2019-06-27 20:12:47', 0),
(50, 64, 1, '2019-06-27', 1, 4, '2019-06-27 20:29:45', '2019-06-27 20:29:45', 0),
(51, 65, 3, '2019-06-27', 4, 4, '2019-06-27 21:35:22', '2019-06-27 21:35:22', 0),
(52, 67, 5, '2019-06-28', 1, 4, '2019-06-28 16:06:19', '2019-06-28 16:06:19', 0),
(53, 68, 2, '2019-06-28', 3, 4, '2019-06-28 22:21:57', '2019-06-28 22:21:57', 0),
(54, 69, 2, '2019-06-28', 1, 4, '2019-06-28 22:45:05', '2019-06-28 22:45:05', 0),
(55, 71, 6, '2019-06-28', 2, -1, '2019-06-29 00:36:43', '2019-06-29 00:36:43', 0),
(56, 72, 10, '2019-06-28', 2, -1, '2019-06-29 00:45:51', '2019-06-29 00:45:51', 0),
(57, 73, 9, '2019-06-28', 2, -1, '2019-06-29 00:46:17', '2019-06-29 00:46:17', 0);

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
(4, '4d0dc654-a722-4dc9-a9c6-471c71c2d2a6', '', '2019-06-24 18:34:20'),
(4, '4d0dc654-a722-4dc9-a9c6-471c71c2d2a6', '', '2019-06-28 16:46:52'),
(3, '4d0dc654-a722-4dc9-a9c6-471c71c2d2a6', '', '2019-06-28 16:47:14'),
(3, '4d0dc654-a722-4dc9-a9c6-471c71c2d2a6', '', '2019-06-28 17:04:28'),
(18, 'd59fb17f-0b6c-42b1-b9d2-9d41530f72b7', '', '2019-06-28 22:29:17');

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
(6, 'pagando'),
(7, 'algo listo / faltan cosas');

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
(5, 'cancelado'),
(7, 'listo/en preparacion');

-- --------------------------------------------------------

--
-- Table structure for table `facturacion`
--

CREATE TABLE `facturacion` (
  `id` int(11) NOT NULL,
  `cuenta` decimal(30,2) NOT NULL,
  `id_mesa` int(11) NOT NULL,
  `porcentaje_propina` int(11) NOT NULL,
  `id_mozo` int(11) DEFAULT NULL,
  `satisfaccion` int(11) NOT NULL,
  `date_created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `last_modified` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `facturacion`
--

INSERT INTO `facturacion` (`id`, `cuenta`, `id_mesa`, `porcentaje_propina`, `id_mozo`, `satisfaccion`, `date_created`, `last_modified`) VALUES
(1, '43420.32', 5, 15, 4, 5, '2019-06-29 00:11:18', '2019-06-29 00:11:18');

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
(2, 3, 5, 1, 1),
(3, 4, 3, 1, 1),
(4, 4, 0, 1, 1),
(5, 4, 7, 1, 1),
(6, 3, 5, 1, 1),
(7, 3, 0, 2, 1),
(8, 5, 0, 2, 1),
(9, 6, 1, 2, 1),
(10, 3, 1, 2, 1),
(11, 3, 0, 2, 1),
(12, 3, 0, 2, 1),
(13, 2, 0, 1, 1),
(14, 6, 0, 1, 1),
(15, 2, 0, 1, 1),
(16, 2, 0, 0, 1),
(17, 2, 0, 1, 1);

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
(85, 2, 49, '2019-06-27 17:13:42', 3, '2019-06-27 17:13:42', '2019-06-27 17:13:42'),
(86, 2, 49, '2019-06-27 17:14:41', 3, '2019-06-27 17:14:41', '2019-06-27 17:14:41'),
(87, 2, 49, '2019-06-27 17:15:21', 3, '2019-06-27 17:15:21', '2019-06-27 17:15:21'),
(88, 2, 49, '2019-06-27 17:16:27', 3, '2019-06-27 17:16:27', '2019-06-27 17:16:27'),
(89, 2, 49, '2019-06-27 17:17:32', 3, '2019-06-27 17:17:32', '2019-06-27 17:17:32'),
(90, 2, 49, '2019-06-27 17:18:20', 3, '2019-06-27 17:18:20', '2019-06-27 17:18:20'),
(91, 2, 49, '2019-06-27 17:18:46', 3, '2019-06-27 17:18:46', '2019-06-27 17:18:46'),
(92, 2, 49, '2019-06-27 17:19:40', 3, '2019-06-27 17:19:40', '2019-06-27 17:19:40'),
(93, 2, 49, '2019-06-27 17:21:34', 3, '2019-06-27 17:21:34', '2019-06-27 17:21:34'),
(94, 2, 49, '2019-06-27 17:25:10', 3, '2019-06-27 17:25:10', '2019-06-27 17:25:10'),
(95, 2, 49, '2019-06-27 17:29:33', 3, '2019-06-27 17:30:33', '2019-06-27 17:29:33'),
(96, 1, 50, '2019-06-27 17:29:58', 3, '2019-06-27 17:29:58', '2019-06-27 17:29:58'),
(97, 1, 50, '2019-06-27 17:32:00', 3, '2019-06-27 17:32:00', '2019-06-27 17:32:00'),
(98, 1, 50, '2019-06-27 18:24:35', 3, '2019-06-27 18:24:35', '2019-06-27 18:24:35'),
(99, 1, 50, '2019-06-27 18:26:49', 3, '2019-06-27 18:26:49', '2019-06-27 18:26:49'),
(100, 1, 50, '2019-06-27 18:27:00', 3, '2019-06-27 18:28:00', '2019-06-27 18:27:00'),
(101, 1, 50, '2019-06-27 18:27:18', 3, '2019-06-27 18:27:18', '2019-06-27 18:27:18'),
(102, 3, 51, '2019-06-27 18:35:33', 3, '2019-06-27 18:35:33', '2019-06-27 18:35:33'),
(103, 3, 51, '2019-06-27 18:57:55', 7, '2019-06-27 18:58:55', '2019-06-27 18:57:55'),
(104, 5, 52, '2019-06-28 13:06:29', 7, '2019-06-28 13:07:29', '2019-06-28 13:06:30'),
(105, 2, 53, '2019-06-28 19:22:22', 3, '2019-06-28 19:23:22', '2019-06-28 19:22:22'),
(106, 2, 54, '2019-06-28 19:45:33', 3, '2019-06-28 19:45:33', '2019-06-28 19:45:33'),
(107, 2, 54, '2019-06-28 19:45:42', 7, '2019-06-28 19:46:42', '2019-06-28 19:45:42');

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
(85, 1, 1, '2019-06-27 20:13:42', '2019-06-27 21:23:51', 1),
(85, 2, 2, '2019-06-27 20:13:42', '2019-06-27 21:23:51', 1),
(85, 3, 2, '2019-06-27 20:13:42', '2019-06-27 21:22:35', 1),
(85, 4, 2, '2019-06-27 20:13:42', '2019-06-27 21:22:35', 1),
(85, 5, 2, '2019-06-27 20:13:42', '2019-06-27 21:22:35', 1),
(85, 6, 3, '2019-06-27 20:13:42', '2019-06-27 21:22:35', 1),
(85, 9, 1, '2019-06-27 20:13:42', '2019-06-27 21:23:51', 1),
(85, 10, 1, '2019-06-27 20:13:42', '2019-06-27 21:23:51', 1),
(85, 11, 1, '2019-06-27 20:13:42', '2019-06-27 21:22:35', 1),
(85, 12, 3, '2019-06-27 20:13:42', '2019-06-27 21:22:35', 1),
(86, 1, 1, '2019-06-27 20:14:41', '2019-06-27 20:51:16', 1),
(86, 2, 2, '2019-06-27 20:14:41', '2019-06-27 20:51:16', 1),
(86, 3, 2, '2019-06-27 20:14:41', '2019-06-27 20:35:03', 1),
(86, 4, 2, '2019-06-27 20:14:41', '2019-06-27 20:35:03', 1),
(86, 5, 2, '2019-06-27 20:14:41', '2019-06-27 20:35:03', 1),
(86, 6, 3, '2019-06-27 20:14:41', '2019-06-27 20:35:03', 1),
(86, 9, 1, '2019-06-27 20:14:41', '2019-06-27 20:51:16', 1),
(86, 10, 1, '2019-06-27 20:14:41', '2019-06-27 20:51:16', 1),
(86, 11, 1, '2019-06-27 20:14:41', '2019-06-27 20:35:03', 1),
(86, 12, 3, '2019-06-27 20:14:41', '2019-06-27 20:35:03', 1),
(87, 1, 1, '2019-06-27 20:15:21', '2019-06-27 20:46:32', 1),
(87, 2, 2, '2019-06-27 20:15:21', '2019-06-27 20:46:32', 1),
(87, 3, 2, '2019-06-27 20:15:21', '2019-06-27 21:19:53', 1),
(87, 4, 2, '2019-06-27 20:15:21', '2019-06-27 21:19:53', 1),
(87, 5, 2, '2019-06-27 20:15:21', '2019-06-27 21:19:53', 1),
(87, 6, 3, '2019-06-27 20:15:21', '2019-06-27 21:19:53', 1),
(87, 9, 1, '2019-06-27 20:15:21', '2019-06-27 20:46:32', 1),
(87, 10, 1, '2019-06-27 20:15:21', '2019-06-27 20:46:32', 1),
(87, 11, 1, '2019-06-27 20:15:21', '2019-06-27 21:19:53', 1),
(87, 12, 3, '2019-06-27 20:15:21', '2019-06-27 21:19:53', 1),
(88, 1, 1, '2019-06-27 20:16:27', '2019-06-27 21:20:44', 1),
(88, 2, 2, '2019-06-27 20:16:27', '2019-06-27 21:20:44', 1),
(88, 3, 2, '2019-06-27 20:16:27', '2019-06-27 21:20:24', 1),
(88, 4, 2, '2019-06-27 20:16:27', '2019-06-27 21:20:24', 1),
(88, 5, 2, '2019-06-27 20:16:27', '2019-06-27 21:20:24', 1),
(88, 6, 3, '2019-06-27 20:16:27', '2019-06-27 21:20:24', 1),
(88, 9, 1, '2019-06-27 20:16:27', '2019-06-27 21:20:44', 1),
(88, 10, 1, '2019-06-27 20:16:27', '2019-06-27 21:20:44', 1),
(88, 11, 1, '2019-06-27 20:16:27', '2019-06-27 21:20:24', 1),
(88, 12, 3, '2019-06-27 20:16:27', '2019-06-27 21:20:24', 1),
(89, 1, 1, '2019-06-27 20:17:32', '2019-06-27 21:09:23', 1),
(89, 2, 2, '2019-06-27 20:17:32', '2019-06-27 21:09:23', 1),
(89, 3, 2, '2019-06-27 20:17:32', '2019-06-27 21:20:12', 1),
(89, 4, 2, '2019-06-27 20:17:32', '2019-06-27 21:20:12', 1),
(89, 5, 2, '2019-06-27 20:17:32', '2019-06-27 21:20:12', 1),
(89, 6, 3, '2019-06-27 20:17:32', '2019-06-27 21:20:12', 1),
(89, 9, 1, '2019-06-27 20:17:32', '2019-06-27 21:09:23', 1),
(89, 10, 1, '2019-06-27 20:17:32', '2019-06-27 21:09:23', 1),
(89, 11, 1, '2019-06-27 20:17:32', '2019-06-27 21:20:12', 1),
(89, 12, 3, '2019-06-27 20:17:32', '2019-06-27 21:20:12', 1),
(90, 1, 1, '2019-06-27 20:18:20', '2019-06-27 21:20:50', 1),
(90, 2, 2, '2019-06-27 20:18:20', '2019-06-27 21:20:50', 1),
(90, 3, 2, '2019-06-27 20:18:20', '2019-06-27 21:19:50', 1),
(90, 4, 2, '2019-06-27 20:18:20', '2019-06-27 21:19:50', 1),
(90, 5, 2, '2019-06-27 20:18:20', '2019-06-27 21:19:50', 1),
(90, 6, 3, '2019-06-27 20:18:20', '2019-06-27 21:19:50', 1),
(90, 9, 1, '2019-06-27 20:18:20', '2019-06-27 21:20:50', 1),
(90, 10, 1, '2019-06-27 20:18:20', '2019-06-27 21:20:50', 1),
(90, 11, 1, '2019-06-27 20:18:20', '2019-06-27 21:19:50', 1),
(90, 12, 3, '2019-06-27 20:18:20', '2019-06-27 21:19:50', 1),
(91, 1, 1, '2019-06-27 20:18:46', '2019-06-27 21:16:41', 1),
(91, 2, 2, '2019-06-27 20:18:46', '2019-06-27 21:16:41', 1),
(91, 3, 2, '2019-06-27 20:18:46', '2019-06-27 21:19:35', 1),
(91, 4, 2, '2019-06-27 20:18:46', '2019-06-27 21:19:35', 1),
(91, 5, 2, '2019-06-27 20:18:46', '2019-06-27 21:19:35', 1),
(91, 6, 3, '2019-06-27 20:18:46', '2019-06-27 21:19:35', 1),
(91, 9, 1, '2019-06-27 20:18:46', '2019-06-27 21:16:41', 1),
(91, 10, 1, '2019-06-27 20:18:46', '2019-06-27 21:16:41', 1),
(91, 11, 1, '2019-06-27 20:18:46', '2019-06-27 21:19:35', 1),
(91, 12, 3, '2019-06-27 20:18:46', '2019-06-27 21:19:35', 1),
(92, 1, 1, '2019-06-27 20:19:40', '2019-06-27 21:10:49', 1),
(92, 2, 2, '2019-06-27 20:19:40', '2019-06-27 21:10:49', 1),
(92, 3, 2, '2019-06-27 20:19:40', '2019-06-27 21:11:08', 1),
(92, 4, 2, '2019-06-27 20:19:40', '2019-06-27 21:11:08', 1),
(92, 5, 2, '2019-06-27 20:19:40', '2019-06-27 21:11:08', 1),
(92, 6, 3, '2019-06-27 20:19:40', '2019-06-27 21:11:08', 1),
(92, 9, 1, '2019-06-27 20:19:40', '2019-06-27 21:10:49', 1),
(92, 10, 1, '2019-06-27 20:19:40', '2019-06-27 21:10:49', 1),
(92, 11, 1, '2019-06-27 20:19:40', '2019-06-27 21:11:08', 1),
(92, 12, 3, '2019-06-27 20:19:40', '2019-06-27 21:11:08', 1),
(93, 1, 1, '2019-06-27 20:21:34', '2019-06-27 21:20:49', 1),
(93, 2, 2, '2019-06-27 20:21:34', '2019-06-27 21:20:49', 1),
(93, 3, 2, '2019-06-27 20:21:34', '2019-06-27 21:21:00', 1),
(93, 4, 2, '2019-06-27 20:21:34', '2019-06-27 21:21:00', 1),
(93, 5, 2, '2019-06-27 20:21:34', '2019-06-27 21:21:00', 1),
(93, 6, 3, '2019-06-27 20:21:34', '2019-06-27 21:21:00', 1),
(93, 9, 1, '2019-06-27 20:21:34', '2019-06-27 21:20:49', 1),
(93, 10, 1, '2019-06-27 20:21:34', '2019-06-27 21:20:49', 1),
(93, 11, 1, '2019-06-27 20:21:34', '2019-06-27 21:21:00', 1),
(93, 12, 3, '2019-06-27 20:21:34', '2019-06-27 21:21:00', 1),
(94, 1, 1, '2019-06-27 20:25:10', '2019-06-27 21:16:48', 1),
(94, 2, 2, '2019-06-27 20:25:10', '2019-06-27 21:16:48', 1),
(94, 3, 2, '2019-06-27 20:25:10', '2019-06-27 21:19:47', 1),
(94, 4, 2, '2019-06-27 20:25:10', '2019-06-27 21:19:47', 1),
(94, 5, 2, '2019-06-27 20:25:10', '2019-06-27 21:19:47', 1),
(94, 6, 3, '2019-06-27 20:25:10', '2019-06-27 21:19:47', 1),
(94, 9, 1, '2019-06-27 20:25:10', '2019-06-27 21:16:48', 1),
(94, 10, 1, '2019-06-27 20:25:10', '2019-06-27 21:16:48', 1),
(94, 11, 1, '2019-06-27 20:25:10', '2019-06-27 21:19:47', 1),
(94, 12, 3, '2019-06-27 20:25:10', '2019-06-27 21:19:47', 1),
(95, 2, 1, '2019-06-27 20:29:33', '2019-06-27 21:09:27', 1),
(95, 3, 2, '2019-06-27 20:29:33', '2019-06-27 21:10:14', 1),
(95, 13, 1, '2019-06-27 20:29:33', '2019-06-27 21:09:27', 1),
(96, 11, 3, '2019-06-27 20:29:58', '2019-06-27 21:19:44', 1),
(97, 3, 3, '2019-06-27 20:32:00', '2019-06-27 21:21:03', 1),
(97, 2, 1, '2019-06-27 20:32:00', '2019-06-27 21:18:48', 1),
(98, 1, 1, '2019-06-27 21:24:35', '2019-06-27 21:25:27', 1),
(98, 3, 1, '2019-06-27 21:24:35', '2019-06-27 21:24:42', 1),
(99, 4, 1, '2019-06-27 21:26:49', '2019-06-27 21:31:22', 1),
(99, 5, 1, '2019-06-27 21:26:49', '2019-06-27 21:31:22', 1),
(99, 8, 1, '2019-06-27 21:26:49', '2019-06-27 21:31:22', 1),
(100, 13, 1, '2019-06-27 21:27:00', '2019-06-27 21:31:56', 1),
(101, 3, 2, '2019-06-27 21:27:18', '2019-06-27 21:34:17', 1),
(102, 3, 5, '2019-06-27 21:35:33', '2019-06-27 21:35:40', 1),
(102, 2, 1, '2019-06-27 21:35:33', '2019-06-27 22:02:27', 1),
(103, 27, 1, '2019-06-27 21:57:55', '2019-06-27 22:02:24', 1),
(103, 26, 3, '2019-06-27 21:57:55', '2019-06-27 21:57:55', 0),
(104, 26, 1, '2019-06-28 16:06:30', '2019-06-28 22:35:45', 1),
(104, 12, 1, '2019-06-28 16:06:30', '2019-06-28 16:06:30', 0),
(105, 1, 2, '2019-06-28 22:22:22', '2019-06-28 23:04:32', 1),
(105, 40, 3, '2019-06-28 22:22:22', '2019-06-28 23:25:39', 1),
(105, 39, 1, '2019-06-28 22:22:22', '2019-06-28 23:25:39', 1),
(106, 1, 1, '2019-06-28 22:45:33', '2019-06-28 23:06:29', 1),
(106, 4, 1, '2019-06-28 22:45:33', '2019-06-28 23:03:27', 1),
(107, 3, 1, '2019-06-28 22:45:42', '2019-06-28 22:45:42', 0),
(107, 39, 1, '2019-06-28 22:45:42', '2019-06-28 23:08:55', 1),
(107, 38, 1, '2019-06-28 22:45:42', '2019-06-28 22:45:42', 0);

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
(25, 'Nachos2', 'Con queso', 5, '240', 1, 1, '', '2019-06-22 14:21:31', '2019-06-22 14:21:44'),
(26, 'sanguchitos', 'de mortadela', 5, '80', 1, 1, NULL, '2019-06-27 21:56:34', '2019-06-27 22:09:29'),
(27, 'pizza napo', 'napoooo', 5, '220', 1, 1, NULL, '2019-06-27 21:57:39', '2019-06-27 21:57:39'),
(30, 'Pancho', 'Jdjddjjddjd ', 5, '345', 1, 1, '', '2019-06-28 17:09:15', '2019-06-28 17:09:15'),
(31, 'Pancho', 'Jdjddjjddjd ', 5, '345', 1, 1, '', '2019-06-28 17:13:58', '2019-06-28 17:13:58'),
(32, 'Pancho', 'Jdjddjjddjd ', 5, '345', 1, 1, '', '2019-06-28 17:14:17', '2019-06-28 17:14:17'),
(33, 'Pancho', 'Jdjddjjddjd ', 5, '345', 1, 1, '', '2019-06-28 17:14:17', '2019-06-28 17:14:17'),
(34, 'Pancho', 'Jdjddjjddjd ', 5, '345', 1, 1, '', '2019-06-28 17:14:17', '2019-06-28 17:14:17'),
(35, 'Pancho', 'Jdjddjjddjd ', 5, '345', 1, 1, '', '2019-06-28 17:14:18', '2019-06-28 17:14:18'),
(36, 'Pancho', 'Jdjddjjddjd ', 5, '345', 1, 1, '', '2019-06-28 17:14:18', '2019-06-28 17:14:18'),
(37, 'Pancho', 'Jdjddjjddjd ', 5, '345', 1, 1, '', '2019-06-28 17:14:18', '2019-06-28 17:14:18'),
(38, 'Pancho', 'Jdjddjjddjd ', 5, '345', 1, 1, '', '2019-06-28 17:14:19', '2019-06-28 17:14:19'),
(39, 'cerveza ipa', NULL, 4, '120', 1, 1, '', '2019-06-28 17:17:44', '2019-06-28 23:38:21'),
(40, 'cerveza randal', NULL, 4, '135', 1, 1, 'img/productos/-foto_producto-40-2019-06-28--14.18.20.png', '2019-06-28 17:18:20', '2019-06-28 23:38:25');

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
-- Indexes for table `facturacion`
--
ALTER TABLE `facturacion`
  ADD PRIMARY KEY (`id`);

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
  MODIFY `id_cliente` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=75;

--
-- AUTO_INCREMENT for table `cliente_visita`
--
ALTER TABLE `cliente_visita`
  MODIFY `id_cliente_visita` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=58;

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
-- AUTO_INCREMENT for table `facturacion`
--
ALTER TABLE `facturacion`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=108;

--
-- AUTO_INCREMENT for table `productos`
--
ALTER TABLE `productos`
  MODIFY `id_producto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT for table `reservas`
--
ALTER TABLE `reservas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
