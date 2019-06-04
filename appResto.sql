-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 04-06-2019 a las 04:33:07
-- Versión del servidor: 10.1.37-MariaDB
-- Versión de PHP: 7.3.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `appresto`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `clientes`
--

CREATE TABLE `clientes` (
  `id_cliente` int(11) NOT NULL,
  `nombre_completo` varchar(100) NOT NULL,
  `dni` int(11) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `foto` text NOT NULL,
  `date_created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `last_modified` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `clientes`
--

INSERT INTO `clientes` (`id_cliente`, `nombre_completo`, `dni`, `email`, `foto`, `date_created`, `last_modified`) VALUES
(2, 'Emilio Perez Reverte', NULL, NULL, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(3, 'Juan Carlos Z.', 4344433, NULL, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(4, 'Juan Ramirez', NULL, NULL, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(5, 'Emilia Estefan', NULL, 'emilia@e.com', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(6, 'Maria Laura', NULL, NULL, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(7, 'facu', 42343242, 'facu@facu.facu', 'as asd sa ads asd', '2019-06-04 01:25:46', '2019-06-04 01:47:13'),
(8, 'sdasd', 433434, 'fa4cu@facu.facu', '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', '2019-06-04 01:30:03', '2019-06-04 01:30:03'),
(9, 'asdasdsada', 0, 'lalal@lala.com', 'iVBORw0KGgoAAAANSUhEUgAAABkAAAAZCAYAAADE6YVjAAAAGXRFWHRTb2Z0d2FyZQBBZG9iZSBJbWFnZVJlYWR5ccllPAAAAytJREFUeNqslu1LU1Ecx8+9u5ube+waKmZF4HOMUtJZaKZplCiB0htfKBUUhEUvqzf9BVFvehNBFkFEkj0goWWQQoi0+RBOMuesrVzNzT25uwfvvf0O3NEau3eV+8GH++L8zvd77jm/80CMt2xDElEFdAKNQAmwHaCAOPAT+Ay8BYYbx7w2MRFCxGQncAXoAQwoc7iAAeAGmK2lNpJpOnQIo7vwlwY4CoVBjU4cpRsymfQCj4Wp+Z+oBp6D0XExkzbgNpCLthY0cB+MalJNCgUDDcpO5GM9MNIkm1wGSlF2ox44naiuXfCdAgrSZQaqmlB+Q4dn3b4gizttet3COy60p4bkVFqCrm31hFwOSjlyR4e10nS3AodwzR8TMwAxVNTS5TG2dtLhNVd0euSZNxQJ0tig9tzVkEqr17gdK8yibWZTvTQlF9lnR7BJs9Q/7ygpz6G0BkKnNSj3Hm5jLZ4fger2U0S+sQ6PHvndrgjieVJCoh2blEmZTA895EyqXEa3u1SVV2ZU1/ecj+j2VCj5zRgKOe3RZfMky3OsTEKikhQqK21o7BaO+2rVWYafMDGfhyUoBcIGuC3osEWmnj4IB+cnacjjpTYqNlFKJODOPLM0ZyBl1O+F5XkkUyjJqHs1h2SCiTyxUGITv0QCyWlo9mD/dUaup0kuyggnHoFyC4oVpt6LvPpAmydDKfuxiVMigajsPhuiy/erYd6Rb+XThnlwwLPhXI4RlBzlVVariyqMWIOV0HDghf8INIllRJgwF3F/Z6MBX2x29EUsvDid5/9m95q6+zQESRLxWJQXjn+xMOPGEaBfLGNlbEi1ap0JyOQKPjI7TuvsFhSQUfr5iTc+djOO1q1mlTb9RsQRBV7iHQ85aALYJ5LIJR0/iQVOiIYynHejwAncGZfHTanFT16jlONDyoAVLjEuIfAIGMryAXkXeJ08yhhwCZjJkgG+Wa/BX/CpU+EU7vQPWzQYA/rAwCt2/S4Ir5N7GWo/bbUDt4AuMPhj71EiL48zwKDwmGjOcCXjwnmFb0IQH/+XJ1Fy1AEnARNQLBji0v0CvMcPBxCfkxL4JcAA4R4dVbacepQAAAAASUVORK5CYII=', '2019-06-04 01:33:33', '2019-06-04 01:33:33'),
(10, 'pepe', 4873, 'pepe@pepe.pepe', 'iVBORw0KGgoAAAANSUhEUgAAAB8AAABACAYAAADidqwbAAAAGXRFWHRTb2Z0d2FyZQBBZG9iZSBJbWFnZVJlYWR5ccllPAAAAqFJREFUeNrEmc1LG0EYxierp1J6laglB1u/UgjkIGnRYg89FPwMxGOEHnqwHizJtdg/IIEExIOeGnoLFIpYxHjwqGihOYigeIhKwT/Ai4L2fTezsIibzMy+M/PAQyBk+b2TnXlm3t1IMplkmuWAu8Ex8CB4nH8/06kJ+AQ8Bv4ETgf9iBIeAePfuAyeFLmgkwj6Bvwd3CdzYVj4C/AGv5dKk0FFWPQa+FQVrDryXvAhuItiGchoCnxBAZaFfwb/og4AEeHyWdGRPu00C/6mK/paqR/8U2fuBukZ+I/u0A9agvvgpzbg5TDhEQaO93mBGZDzyCbxmxnSQ/i47M5EBcdRrzOD8sOTJkf9EL7MDMvxnbkmbcHfqVycSCRYPp8PDf+ocnG9Xme1Wk25AIfP8rRq9VhAo9FgmUxGCd4T9t5Vq1X3U7YAh3cSjKKAWCzmzgMZ+Cuq2VsoFFg2mxUuAOGjlMsnl8u5BYjCh6jXLxZQLBaF4L06AkSkAIfqDK5SgMM0q1KpBIYQwq90wjGE4vF4IPxSJxxHXSqVAuHHusCYeBi9OPog+J4usD96g+B/qcGYcBi1rcBec9CgHjGCMWpFHg78o4SnUil3fYvG6x1VM4iBIgr2h8wP02A/fNs02A+/Bm+phghGqIoivmevI7wtllpSXoSqyP8o7IA1nzQ9l8ltqo7lHjxvq11C7YLPbMFx9NO24Kgj8KotOOqL7kNGK/gNX3pW4Khz8JwtuHsWAC/qgndEo9F2vzngYfTW9Mg9fQUv2YKjytRzQLZpqPKW+soG3FsFuPms24CjblnzbeFAmL0gbK92An4Jfs+3Y6NwbzPa4XPhtcyJiLJLvefdzwfWfEkw0a4QXW+R8Uy4ye29wsbbM4xHe9Z84pn+L8AAOUqROYAIQpIAAAAASUVORK5CYII=', '2019-06-04 01:37:01', '2019-06-04 01:37:01');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cliente_visita`
--

CREATE TABLE `cliente_visita` (
  `id_cliente_visita` int(11) NOT NULL,
  `id_cliente` int(11) NOT NULL,
  `id_mesa` int(11) NOT NULL,
  `fecha` date NOT NULL,
  `comensales` int(11) NOT NULL,
  `mozo` int(3) NOT NULL,
  `date_created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `last_modified` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `cliente_visita`
--

INSERT INTO `cliente_visita` (`id_cliente_visita`, `id_cliente`, `id_mesa`, `fecha`, `comensales`, `mozo`, `date_created`, `last_modified`) VALUES
(1, 3, 1, '2019-05-25', 1, 3, '2019-05-27 01:25:53', '2019-05-28 17:46:59'),
(2, 4, 5, '0000-00-00', 4, 2, '2019-05-29 02:23:34', '2019-05-29 02:23:47'),
(3, 9, 2, '2019-06-03', 1, 4, '2019-06-04 01:34:21', '2019-06-04 01:34:21'),
(4, 10, 3, '2019-06-03', 1, 4, '2019-06-04 01:37:01', '2019-06-04 01:37:01'),
(5, 7, 6, '2019-06-03', 1, 4, '2019-06-04 01:46:44', '2019-06-04 01:46:44'),
(6, 7, 15, '2019-06-03', 1, 4, '2019-06-04 01:49:00', '2019-06-04 01:49:00'),
(7, 7, 8, '2019-06-03', 5, 4, '2019-06-04 02:00:29', '2019-06-04 02:00:29');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cocina`
--

CREATE TABLE `cocina` (
  `id_cocina` int(11) NOT NULL,
  `nombre_cocina` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `cocina`
--

INSERT INTO `cocina` (`id_cocina`, `nombre_cocina`) VALUES
(1, 'barra_tragos'),
(2, 'barra_choppera'),
(3, 'cocina'),
(4, 'candy_bar');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `empleados`
--

CREATE TABLE `empleados` (
  `id_empleado` int(11) NOT NULL,
  `usuario` varchar(50) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `nombre_completo` varchar(100) DEFAULT NULL,
  `fecha_nac` date DEFAULT NULL,
  `dni` int(11) NOT NULL,
  `id_rol` int(11) NOT NULL,
  `fecha_ingreso` date NOT NULL,
  `fecha_egreso` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `sueldo` decimal(10,0) DEFAULT NULL,
  `clave` varchar(50) DEFAULT NULL,
  `habilitado` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `empleados`
--

INSERT INTO `empleados` (`id_empleado`, `usuario`, `email`, `nombre_completo`, `fecha_nac`, `dni`, `id_rol`, `fecha_ingreso`, `fecha_egreso`, `sueldo`, `clave`, `habilitado`) VALUES
(2, 'ejimenez', 'ejimene@gmail.com', 'Emilio Jimenez', '0000-00-00', 30111222, 2, '2018-07-25', '0000-00-00 00:00:00', '20000', '1234', 1),
(3, 'fsaiegh', 'fsaiegh@gmail.com', 'Facundo Saiegh', '0000-00-00', 0, 1, '2018-07-14', NULL, '25000', '1234', 1),
(4, 'male', 'male@gmail.com', 'male prueba', '2018-12-31', 12456123, 2, '0000-00-00', '0000-00-00 00:00:00', '5656', '1234', 1),
(14, 'qweqw qwe qwe', 'asdasdasd@dasd.com', 'sdasd', '0000-00-00', 343434343, 2, '0000-00-00', '0000-00-00 00:00:00', '34', '1234', 1),
(15, 'qweqw qwe qwe', 'asdasdasd@dasd.com', 'asd asd asd ads asd 4', '0434-03-31', 343434, 2, '2019-05-26', '0000-00-00 00:00:00', '0', '1234', 1),
(16, '', 'chicho@chichicch.com', 'chicho22', '4343-02-28', 23423424, 3, '0000-00-00', '0000-00-00 00:00:00', '3144', '1234', 1),
(17, 'eric_estrada', 'sdad@asdd.com', 'eric estrada', '0000-00-00', 444443, 0, '2019-05-26', '0000-00-00 00:00:00', '0', '1234', 1),
(18, 'mario', 'mario@baracus.com', 'mario baracus', '2000-12-12', 34433434, 5, '2019-05-29', '0000-00-00 00:00:00', '32000', '1234', 1),
(21, 'd asd asd asd', 'mario@baracus.com', 'asd asd asd adsas', '2000-12-12', 0, 0, '2019-05-29', '0000-00-00 00:00:00', '0', '1234', 1),
(22, 'd asd asd asd', 'mario@baracus.com', 'asd asd asd adsas', '2000-12-11', 0, 0, '0000-00-00', '0000-00-00 00:00:00', '0', '1234', 0),
(24, '', '', '', '0000-00-00', 0, 0, '2019-05-29', '0000-00-00 00:00:00', '0', '1234', 1),
(25, 'adfadfa', 'adfadfdaf', 'adfadf', '0000-00-00', 2147483647, 6, '0000-00-00', '0000-00-00 00:00:00', '2424', '1234', 0),
(26, 'adfadfa', 'adfadfdaf', 'adfadf', '0000-00-00', 2147483647, 6, '2019-05-29', '0000-00-00 00:00:00', '2424', '1234', 1),
(27, 'ñeleo', 'asd@dasd.com', 'lelo lelel', '0000-00-00', 0, 0, '2019-05-29', '0000-00-00 00:00:00', '0', '1234', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `encuestas`
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
-- Estructura de tabla para la tabla `estado_mesa`
--

CREATE TABLE `estado_mesa` (
  `id_estadomesa` int(11) NOT NULL,
  `nombre_estado` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `estado_mesa`
--

INSERT INTO `estado_mesa` (`id_estadomesa`, `nombre_estado`) VALUES
(1, 'libre'),
(2, 'ocupada sin pedido'),
(3, 'esperando pedido'),
(4, 'pedido listo'),
(5, 'comiendo'),
(6, 'esperando cuenta'),
(7, 'pagando');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `estado_pedidos`
--

CREATE TABLE `estado_pedidos` (
  `id_estado_pedido` int(11) NOT NULL,
  `nombre_estado` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `estado_pedidos`
--

INSERT INTO `estado_pedidos` (`id_estado_pedido`, `nombre_estado`) VALUES
(1, 'pendiente'),
(2, 'en preparacion'),
(3, 'listo para servir'),
(4, 'servido'),
(5, 'cancelado');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `logueos`
--

CREATE TABLE `logueos` (
  `numero` int(11) NOT NULL,
  `id_empleado` int(11) NOT NULL,
  `fecha` datetime NOT NULL,
  `tarea` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `mesas`
--

CREATE TABLE `mesas` (
  `id_mesa` int(11) NOT NULL,
  `sillas` int(11) NOT NULL,
  `estado_mesa` int(11) NOT NULL,
  `zona` int(11) NOT NULL,
  `habilitada` int(11) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `mesas`
--

INSERT INTO `mesas` (`id_mesa`, `sillas`, `estado_mesa`, `zona`, `habilitada`) VALUES
(1, 4, 2, 1, 1),
(2, 3, 2, 1, 1),
(3, 4, 2, 1, 1),
(4, 4, 0, 1, 1),
(5, 4, 5, 1, 1),
(6, 3, 2, 1, 1),
(7, 3, 0, 2, 1),
(8, 5, 2, 2, 1),
(9, 6, 0, 2, 1),
(10, 3, 0, 2, 1),
(11, 3, 0, 2, 1),
(12, 3, 0, 2, 1),
(13, 2, 0, 1, 1),
(14, 6, 0, 1, 1),
(15, 2, 2, 1, 1),
(16, 2, 0, 1, 1),
(17, 2, 0, 1, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pedidos`
--

CREATE TABLE `pedidos` (
  `id` int(11) NOT NULL,
  `id_mesa` int(11) NOT NULL,
  `id_cliente_visita` int(11) NOT NULL,
  `fecha_alta` datetime NOT NULL,
  `estado_pedido` int(11) NOT NULL DEFAULT '1',
  `hora_estimada` datetime NOT NULL,
  `hora_listo` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `pedidos`
--

INSERT INTO `pedidos` (`id`, `id_mesa`, `id_cliente_visita`, `fecha_alta`, `estado_pedido`, `hora_estimada`, `hora_listo`) VALUES
(10, 1, 1, '2019-05-25 12:06:00', 1, '2019-05-25 12:11:00', '2019-05-25 12:11:00'),
(11, 1, 1, '2019-05-25 12:10:28', 5, '2019-05-25 12:15:28', '2019-05-25 13:32:23'),
(12, 1, 3, '2019-05-26 21:26:56', 1, '2019-05-26 21:26:56', '0000-00-00 00:00:00'),
(13, 5, 2, '2019-05-26 21:28:59', 1, '2019-05-26 21:33:59', '0000-00-00 00:00:00'),
(14, 5, 2, '2019-05-26 21:29:17', 3, '2019-05-26 21:34:17', '2019-05-26 22:12:47'),
(15, 5, 2, '2019-05-26 21:33:22', 1, '2019-05-26 21:38:22', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pedidos_borrados`
--

CREATE TABLE `pedidos_borrados` (
  `id_comanda` varchar(50) NOT NULL,
  `id_producto` int(11) NOT NULL,
  `cantidad_producto` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pedidos_detalles`
--

CREATE TABLE `pedidos_detalles` (
  `id` int(11) NOT NULL,
  `id_producto` int(11) NOT NULL,
  `cantidad` int(11) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `pedidos_detalles`
--

INSERT INTO `pedidos_detalles` (`id`, `id_producto`, `cantidad`) VALUES
(10, 7, 4),
(10, 1, 1),
(10, 2, 1),
(11, 7, 4),
(11, 4, 1),
(12, 0, 4),
(13, 7, 4),
(14, 7, 4),
(14, 6, 2),
(15, 7, 4),
(15, 6, 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productos`
--

CREATE TABLE `productos` (
  `id` int(11) NOT NULL,
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
-- Volcado de datos para la tabla `productos`
--

INSERT INTO `productos` (`id`, `id_producto`, `nombre_producto`, `descripcion`, `id_cocina`, `precio`, `habilitado`, `minutos_preparacion`, `imagen`, `date_created`, `last_modified`) VALUES
(1, 1, 'Risotto', 'plato italiano', 3, '100', 1, 0, 'iVBORw0KGgoAAAANSUhEUgAAAOEAAADhCAMAAAAJbSJIAAAAOVBMVEXz9Pa5vsq2u8jN0dnV2N/o6u7w8fTi5OnFydO+ws3f4ee6v8vY2+H29/jy9Pbu7/LJztbCx9HR1ty/NMEIAAAC8ElEQVR4nO3b67ZrMBiFYaSh1HHd/8XuFap1SFolXb7s8T4/18EwOyNCiSIAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAACryrezAy2kulR+lVl6dqip7Jr412Zyeizj7yjODjYqvhRQTMQm/1rC/OxsvapIht3xehDeN1lIOBSrtt+ZW+t1Kh02GrciEvaDNLl4Ph1e+hqvEk4Z94SZ580WchJGJNyHhH/JlrDR+uC+iU6Yqf7c2JXNga0KTlj/xOP5ujuwdpabML0mz1VXUu7eqtyEP5OAvysdvXerYhMWs4C/a+e9uyg1YXVdXh7sXTtLTagXFcaJ2rlVqQmXgzSOu5f76J5shSasylXC/NVJUbknW6kJLx8lNPNu6WhRaMKPRmmtzB+7WpSasNk+09TjmdPeotSEVbfs0HW7LFXjh2FvUWrC1Z1F1yCt1aRtW4tiE0ZqPk4dp4NUzYaypUW5CaNuGtExjdSLz8HSouCEjRqvnuLcceE/b9D+UQhOGFWZys093e7S2IfoqkFbi5ITRv1NDN24ds7SoKVF4QlfsTa4bjHchOmPI+AiYrgJXQ0uB2qoCWt3g4sWQ034qsF5i4EkbBY3ol43OGsxjIT6luvp7NG+DfhsMYSElc7jpHteAL85BhcthpBQ38zPny1uadD8x3C9JT+habD/RXdfu21rsP822fy5/IR9g/GjxXpjg+ZSKoiEY4OPFrc2GEzCR4O9XL87D4aWcNrgEHFzvkASzhv8UAAJVw3+dwkPNRhAwoMNBpDwYIPiEx5uUHzCww1KT1htX7qEmnD9/SEJSXhutgEJSUjC8/lOKPs+jfla7ajh/qPUhP6Q8C+RcJdKUML7W0HK75vA9+/hrmenM8bHgr/y7pqS8O7a43nEb7x/6Pvo3iddPa3njYx3SKMoO37rwu4mo8LIPJB4fLG2lggZoz3d5l6PQuPWahHTzEgXF79KQQUCAAAAAAAAAAAAAAAAAAAAAAAAAAAAp/gHLTI30QIHnooAAAAASUVORK5CYII=', '2019-05-27 01:16:34', '2019-05-27 01:17:04'),
(2, 2, 'Hamburguesa Completa', 'Comida Rapida', 3, '100', 1, 0, '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', '2019-05-27 01:16:34', '2019-05-27 01:16:34'),
(3, 3, 'Sprite', 'Bebida sin alcohol', 1, '80', 1, 0, '/9j/4AAQSkZJRgABAQAAAQABAAD/2wBDAAUDBAQEAwUEBAQFBQUGBwwIBwcHBw8LCwkMEQ8SEhEPERETFhwXExQaFRERGCEYGh0dHx8fExciJCIeJBweHx7/2wBDAQUFBQcGBw4ICA4eFBEUHh4eHh4eHh4eHh4eHh4eHh4eHh4eHh4eHh4eHh4eHh4eHh4eHh4eHh4eHh4eHh4eHh7/wAARCAAtAC0DASIAAhEBAxEB/8QAHwAAAQUBAQEBAQEAAAAAAAAAAAECAwQFBgcICQoL/8QAtRAAAgEDAwIEAwUFBAQAAAF9AQIDAAQRBRIhMUEGE1FhByJxFDKBkaEII0KxwRVS0fAkM2JyggkKFhcYGRolJicoKSo0NTY3ODk6Q0RFRkdISUpTVFVWV1hZWmNkZWZnaGlqc3R1dnd4eXqDhIWGh4iJipKTlJWWl5iZmqKjpKWmp6ipqrKztLW2t7i5usLDxMXGx8jJytLT1NXW19jZ2uHi4+Tl5ufo6erx8vP09fb3+Pn6/8QAHwEAAwEBAQEBAQEBAQAAAAAAAAECAwQFBgcICQoL/8QAtREAAgECBAQDBAcFBAQAAQJ3AAECAxEEBSExBhJBUQdhcRMiMoEIFEKRobHBCSMzUvAVYnLRChYkNOEl8RcYGRomJygpKjU2Nzg5OkNERUZHSElKU1RVVldYWVpjZGVmZ2hpanN0dXZ3eHl6goOEhYaHiImKkpOUlZaXmJmaoqOkpaanqKmqsrO0tba3uLm6wsPExcbHyMnK0tPU1dbX2Nna4uPk5ebn6Onq8vP09fb3+Pn6/9oADAMBAAIRAxEAPwD7LoxQOlFAHlX7S99bp4NtNKOr3Gm3N5dqyNby+W5RB8xz6ZZB9SK7P4a3UF34E0cwXT3Xk2kcEkrtuZnjUIxY9zkHnv1r50+J+tyeKvG+oXd1+6htLl7G0iZsbY4XIZiPVnyfoFHau8+Auvvaa8fDxZZba+jaZNrZ8uRByfoyjn3UetfPwzuUsw+rWfJt8/8Ag/5HxdPiJPPfqv2GuX57p/Pb7j3HApCKWkNfQH2go6UHpQOlB6UAfHGv+DNBm8Waxr+pz2yva63eTGG6G+OYG4kOCg5YdO4HPPGa674Lad4bPxl0/VdD2Ru1pMrxqiooyrFiip8oXOD6847VgeLNO06XxfqsF+7lTq16WG8gH98xHT2Ndf8AAnS9Nh+IVtLYKQYYJ/4iflwo7+7V5KzupUxCTbu/d+V/U+Aw+czWOhhbfaPomkNLSGvWPvxR0opAeKM0AfE/jO/vLrxbqV3cwtCJNTupORgDMhwo+gAzXoP7PmoLB8R7K2hAb7VbzxP7DaJM/nGB+NdT45+BdprHiLUdbtfEc9kb2Uy+Q1qJFjYnLYO4HBOeO2a2/hP8IrLwV4hl11tcutUna38mKOSJUSLJBZgATljjHsCa+SpZRiljlWlayd7+R8LTyDGPNI4mVklK/TVHqlIaM0GvrT7o/9k=', '2019-05-27 01:16:34', '2019-05-27 01:16:34'),
(4, 4, 'Coca Cola', 'Bebida sin alcohol', 1, '80', 1, 0, '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', '2019-05-27 01:16:34', '2019-05-27 01:16:34'),
(5, 5, 'Dry Martini', 'Trago', 1, '120', 1, 0, 'iVBORw0KGgoAAAANSUhEUgAAAOEAAADhCAMAAAAJbSJIAAAAOVBMVEXz9Pa5vsq2u8jN0dnV2N/o6u7w8fTi5OnFydO+ws3f4ee6v8vY2+H29/jy9Pbu7/LJztbCx9HR1ty/NMEIAAAC8ElEQVR4nO3b67ZrMBiFYaSh1HHd/8XuFap1SFolXb7s8T4/18EwOyNCiSIAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAACryrezAy2kulR+lVl6dqip7Jr412Zyeizj7yjODjYqvhRQTMQm/1rC/OxsvapIht3xehDeN1lIOBSrtt+ZW+t1Kh02GrciEvaDNLl4Ph1e+hqvEk4Z94SZ580WchJGJNyHhH/JlrDR+uC+iU6Yqf7c2JXNga0KTlj/xOP5ujuwdpabML0mz1VXUu7eqtyEP5OAvysdvXerYhMWs4C/a+e9uyg1YXVdXh7sXTtLTagXFcaJ2rlVqQmXgzSOu5f76J5shSasylXC/NVJUbknW6kJLx8lNPNu6WhRaMKPRmmtzB+7WpSasNk+09TjmdPeotSEVbfs0HW7LFXjh2FvUWrC1Z1F1yCt1aRtW4tiE0ZqPk4dp4NUzYaypUW5CaNuGtExjdSLz8HSouCEjRqvnuLcceE/b9D+UQhOGFWZys093e7S2IfoqkFbi5ITRv1NDN24ds7SoKVF4QlfsTa4bjHchOmPI+AiYrgJXQ0uB2qoCWt3g4sWQ034qsF5i4EkbBY3ol43OGsxjIT6luvp7NG+DfhsMYSElc7jpHteAL85BhcthpBQ38zPny1uadD8x3C9JT+habD/RXdfu21rsP822fy5/IR9g/GjxXpjg+ZSKoiEY4OPFrc2GEzCR4O9XL87D4aWcNrgEHFzvkASzhv8UAAJVw3+dwkPNRhAwoMNBpDwYIPiEx5uUHzCww1KT1htX7qEmnD9/SEJSXhutgEJSUjC8/lOKPs+jfla7ajh/qPUhP6Q8C+RcJdKUML7W0HK75vA9+/hrmenM8bHgr/y7pqS8O7a43nEb7x/6Pvo3iddPa3njYx3SKMoO37rwu4mo8LIPJB4fLG2lggZoz3d5l6PQuPWahHTzEgXF79KQQUCAAAAAAAAAAAAAAAAAAAAAAAAAAAAp/gHLTI30QIHnooAAAAASUVORK5CYII=', '2019-05-27 01:16:34', '2019-05-27 01:16:34'),
(6, 6, 'Mojito', 'Trago', 1, '120', 1, 0, '/9j/4AAQSkZJRgABAQAAAQABAAD/2wCEAAkGBxISERUTEhIVFRUWGBUXFRUVFRUYExcVFRUXFxUXFRcYHSggGBolGxYVITEhJykrLi4uFx8zODMsNygtLisBCgoKDg0OGxAQGi0lICUtLTcrLS0rLS0rLS0tNS0tLS0tLS4tLS0tLS0tLS0vLSstLS0uLTAtMC4tLystLSstLf/AABEIASIArgMBIgACEQEDEQH/xAAbAAEAAgMBAQAAAAAAAAAAAAAABAUCAwYBB//EADoQAAIBAgMFBQYFAwQDAAAAAAABAgMRBCExBRJBUWEGcYGRsRMiMqHB8CNictHhFDNSJEJT8QdDgv/EABkBAQADAQEAAAAAAAAAAAAAAAABAgMEBf/EACoRAQEAAgEDAwIFBQAAAAAAAAABAhEDBCExEhNBBSIyUeHw8WFxkbHR/9oADAMBAAIRAxEAPwD7iAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAGMqkU7NpN6JtXItk8jIAEgAAAAAAAAAAAAAAAAAAAAAHkpJK7yS4npVdocZCnSe /dWcuts0upny8k48LlV PC55TGPcVj1NWpysuMlrb8t1p18uaqKOMoSm6acJNaq6nK35m7t JxmK7SV8RKvRhu045wVRtqUZK0pXlaz93eXgUkaDp0lXgtydFXlF576bikrrVyve7zST7zw Xly5bvLy93i6D0497r9/L67hcS4SWbcHaLi3fdbdlJXztfK3UvDgtg7WVenG6lB1IrXWEnmln3p3O02biPaU1J65qX6ouz9Dr nc1u O39Pzn nmdXxXHukgA9VxAAAAAAAAAAAAGFWoopybslqBmRMbtGFJXbu S1/grMXtlyuoe6rP3n8XguBW0sO5yW4m9b7991dSly7dmkw15WU9tTupbq3W3ZLOTtrdljQ2nSk0k7N88vAr50orJ2bVopLJ820n6FbtjAzheSejTTWWj1a46/Mt8I7W6dZWqqKuz5F2r248RVnGNRxjTb/2uzV1FyX TTv0eVjssTtKpUw7jGyleyu3ZJrN82l73yKjA9n6CS/Ee/ZK8ox3Xu6LoeV1fr58/Rh4n9fNet9Py4unnucnn4/6p6Oz4whuqO65KU2m7uLcWk0lrdwTtdcc8zRtOjCdOnTt7rtNtRe62rNvnu8ujXedFhdmKnD2Wqa1ybSct5fNpdySKTa1GfwS3luwipShD8K0bbq0Wedrt2u3qefz8HJx6yy/h6fT9Rhy5WS P3tX7Pr1faus3eE52s GiVrZLKyt9v6r2YnenN8HO/i4RuvM c18NTp0aVK8Y1JNST301NRbcbx13r2W8 B9A7GRth3l/7Knqb9D36mf2ri pavDufnpfAA994AAAAAAAAAAABC2w37J242uTSq2lNybjdpLlxyIs3Ey6qkoRtNOL/nmmW0aeSc5f9cCPDCpLJ5 BKne1sr2Ixmotld3bDE1k3m1dJNZcndPlwZW4yrObc8rXvu5q3DPmT4xbd3q8rmFXCykrZfUmbR2VcMPvSi7XybVrv4rp2XPUk4ilvXipJOOTi72V9eT0N Ewrgs0pa8WvOx5UwKe83F70ne99E9d0yuHnXy1nJvW74QcHilUlKjCLe77zmt3dVsuL9L6mO1dnOrTlB/E1mouW7zjmrNq6XzRZ4PCwhH3Vuvja2aWdm t38uRjDDNS3opO 8s3kovRL9 LI9veOsp5X92Y5erG Hy/Y y97ERhuK6ee7FRUYx3ZXy14fdkfQ9jKUJXbylUlGK/wDt3l0StmSaGylGUpq28 L1te 7fjZihs6UGpb1 MrZatyyz8Th6bpeTj6i5Wdtdr/h2dV1mPNx626kEPAVpNWlm ZMPVeSAAAAAAAAAAAUW2q7hUVlqrvzL057tIvxIPo/UL4SXLVFV0lxaX3Y8/ruaNO/7qNVWaSItaTjlrf/AF0Lv55q/guLI K2rK27FeL1INk5X4GdSC7u9sr6mns4yt0Mc5a5L6kyrXjJRftEs81vLS3C/p0KeUlbJ6Gib5Mpln2a4dPLV9h6yjH 5d9ZJt5a5ZGuvtGnDee85PmrvwsskUm845vTuu/4NWJqOSus23zy 8tSl5dTs0nRzLLvey7w 3oyydN355eF88uBu2ni3CCiuKXvaP5feZz Dh7yXFst9sPNdyRHT8mWW7krz8GGGUmLqdlf2YPnFEsi7K/s0/0r0JR1POvkAAQAAAAAAAAFD2l KHj9C KXtGvgfeF8PxK1v3URapJ/2keUbkV1YdkenLM8rVG7O RnVjbMwULvNaGdbYyW7aXz RhKF30z6sl1MK3no9PI0ezaVmnfpx6cjHJvLNbQ6t961rrhe3mFBwTzzb/g3bsr5wazXVeayNsqN7XM8MfVtrlyakjzZVJ793r9CdtLNmrAwszfjFdnVx4enHUcfLyerPbrNmq1Gn iPoiSacIrU4L8sfQ3Grzb5AAEAAAAAAAABTdpPhj3v6FyU/aX4Iv81vNP9gvx/iinTyNE5G6OhpkiK7IwnBniRIpwu nHUlQoPJr765ldK3k12Q96 a  fgbINWu198Da4Wf7GqUCLjEzka8Q1lZZffM0OP3fMzm89G30z9DyUunyJxml7WzDrM21tUeUD2s813l45sr9zrqHwx7l6GZjT0XcjIOcAAAAAAAAAAAqO06/BT5SX1RblX2lX nl3x9Qvhfuigou6PGjyhojOxLpt7sFUtb743N6rLXTgk C4mqVNhU/IjSLqttXE5O1vDTMhSfG9uZvjTyzyZhKmNIlkaYx6vvvnmN zPasbcb5Z8u7qR98it8O8TqMxWl7ytzRroSFLOrFfmXqTPDHLH7tu5R6AHIAAAAAAAAAAAV 31/p5931LAhbZjehUX5QnHy5bCv3TaQ8JPIlwdyze3ukJ5GyCTy /FcTVSXcbKdVRebWXIhTaRKjlnrwVs0vDLma6t913tZWsraN66m lLefxRtqRcViVlmms7q dtNEQTe1djIu37L7uV7gWs7uLv4LPLTPyZDmkQ7MLZGVBG7Z8b14fqXqaoMkbHd68O8t8Mc/l2YAIcgAAAAAAAAAABH2gr0p/pl6MkGuuvdl3P0A4DDyN6myPSWbJMYEuuxhOUuZ4pz/AMn55Zm908jW6avr xB2LTSzur6Pi146mKa 7m2rHL4r93J8SKteL9PPgQvNN1SfXMyklzuFTXHLq19s93Bs7sEStgq Ij4v5GicbIl9mo3rp8lL9vqWZ5ZfbXXgAhygAAAAAAAAAAHklkegD5zRdpyXV pNgyNiYWr1FynL1ZLpotXV6txnGWVjb7OKenDLv hrgs9G/voWODpPiueq05FWdqrqwu9NeWSSy4eDzNcaTXBPgy/dCzvxfDLK1rWRjPDJvLy43CZnYp3GNuok RNrYbLT74kd0LEaX9xGraE/spH8WT5RfzaK vGyLnsnT OXcizPK9nQgAhiAAAAAAAAAAAAAOI2rTtianffzszbRgZdoVbFPrGL h7ReRb4a43slYSKTJ1N2XX6EKgrljTprV5feRVFZez4vuMY0n4fMlxmnkFTyCNolWHcyrrxZczRXYymEyqXEI6DsvH8JvnL0KHEo6Ts7G1BdW39PoTVclmACFQAAAAAAAAAAAABzHaij LCXONvJt/Ui0S37S0Lxg1wfyZU0S0XlS6ESUm/8n8v2IlFllQgQVgt5u7u /8Ag9pynd3lYmwSNNeCYRtpqYiSV8mRMRW3jfVRG3FcG1RtCR1exIWoQ7jlNpW3suZ2eDhu04R5RivJIVFrcACEAAAAAAAAAAAAACq7R19ykpcN5J9zvn52KGlWvodPtekpUKiaveMvTXwPnOAxrsTEyuqpTzJ Hq5nPYas5aFrh/aLSITtcqdlcj1a5jGrUtnSbI9ajUee40Qgr1iNUxFlcwr0prVW72VeIx25qr9OAQx9pv1YR5yivNn0BHzrstN1cbHlFOVvQ igAAAAAAAAAAAAAAAAY1I3TXNNeZ8npUHGpUj/AIykvmfWjg9q7OqPETq04q0npf558WBhgItM6nAM53D1lF /Fx70y5wmJi/hlHzQF7ATI1KrLp5o9q1XbMCs2o8jj9oUpN5I63F4umvikvO5V4vEynlRpt9bbq82BH/8fYZ 2qza0il5v/s7w5/sfh3CnNTXvuV5O97p6eWZ0AAAAAAAAAAAAAAAAAGNR2T7mVPsi1rLIj yAhqmYvCwesIvvSJ3sj1UwK/ gp/8cfJD gp/8cfJFjuDcAgKhFaRS7kg6ZNdM89kBp2bC0n1X1LIjUYWZJAAAAAAAAAAAAAAAAA8aPN0yAGNhumQAx3RYyAGNhumQAxSMgAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAD//Z', '2019-05-27 01:16:34', '2019-05-27 01:16:34'),
(7, 7, 'Margarita', 'Trago mexicano', 1, '170', 1, 5, '', '2019-05-27 01:16:34', '2019-05-27 01:16:34'),
(8, 8, 'Frozen Margarita', 'Trago', 1, '222', 1, 0, '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', '2019-05-27 01:16:34', '2019-05-27 01:16:34'),
(9, 9, 'Locro', 'Plato argentino', 3, '110', 1, 0, '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', '2019-05-27 01:16:34', '2019-05-27 01:16:34'),
(0, 10, 'Mondongo', 'El producto de la casa', 3, '150', 1, 0, NULL, '2019-05-27 01:16:34', '2019-05-27 01:16:34'),
(0, 11, 'Destornillador', 'Cocktail hecho de vokda y jugo de naranja.', 1, '200', 1, 0, NULL, '2019-05-27 01:16:34', '2019-05-27 01:16:34'),
(0, 12, 'Paloma', 'Cocktail hecho con tequila y gaseosa de pomelo', 1, '150', 1, 0, NULL, '2019-05-27 01:16:34', '2019-05-27 01:16:34');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `reservas`
--

CREATE TABLE `reservas` (
  `id` int(11) NOT NULL,
  `id_cliente` int(11) NOT NULL,
  `id_mesa` int(11) NOT NULL,
  `fecha` datetime NOT NULL,
  `fecha_alta` datetime NOT NULL,
  `confirmada` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `reservas`
--

INSERT INTO `reservas` (`id`, `id_cliente`, `id_mesa`, `fecha`, `fecha_alta`, `confirmada`) VALUES
(1, 2, 2, '2019-09-01 00:00:00', '2019-05-27 22:47:27', 0),
(2, 2, 2, '2019-09-01 00:00:00', '2019-05-27 22:50:19', 0),
(3, 2, 2, '2019-09-01 00:00:00', '2019-05-27 22:51:20', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `rol`
--

CREATE TABLE `rol` (
  `id_rol` int(11) NOT NULL,
  `nombre_rol` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `rol`
--

INSERT INTO `rol` (`id_rol`, `nombre_rol`) VALUES
(1, 'socio'),
(2, 'mozo'),
(3, 'bartender'),
(4, 'cervecero'),
(5, 'cocinero'),
(6, 'pastelera'),
(7, 'admin');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sector`
--

CREATE TABLE `sector` (
  `id_sector` int(11) NOT NULL,
  `nombre` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `sector`
--

INSERT INTO `sector` (`id_sector`, `nombre`) VALUES
(1, 'barra_tragos'),
(2, 'barra_choppera'),
(3, 'cocina'),
(4, 'candy_bar');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `clientes`
--
ALTER TABLE `clientes`
  ADD PRIMARY KEY (`id_cliente`);

--
-- Indices de la tabla `cliente_visita`
--
ALTER TABLE `cliente_visita`
  ADD PRIMARY KEY (`id_cliente_visita`);

--
-- Indices de la tabla `cocina`
--
ALTER TABLE `cocina`
  ADD PRIMARY KEY (`id_cocina`);

--
-- Indices de la tabla `empleados`
--
ALTER TABLE `empleados`
  ADD PRIMARY KEY (`id_empleado`),
  ADD KEY `fk_id_roll` (`id_rol`);

--
-- Indices de la tabla `encuestas`
--
ALTER TABLE `encuestas`
  ADD PRIMARY KEY (`id_encuesta`);

--
-- Indices de la tabla `estado_mesa`
--
ALTER TABLE `estado_mesa`
  ADD PRIMARY KEY (`id_estadomesa`);

--
-- Indices de la tabla `estado_pedidos`
--
ALTER TABLE `estado_pedidos`
  ADD PRIMARY KEY (`id_estado_pedido`);

--
-- Indices de la tabla `logueos`
--
ALTER TABLE `logueos`
  ADD PRIMARY KEY (`numero`),
  ADD KEY `id_empleado` (`id_empleado`);

--
-- Indices de la tabla `mesas`
--
ALTER TABLE `mesas`
  ADD PRIMARY KEY (`id_mesa`);

--
-- Indices de la tabla `pedidos`
--
ALTER TABLE `pedidos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `productos`
--
ALTER TABLE `productos`
  ADD PRIMARY KEY (`id_producto`),
  ADD KEY `id_cocina` (`id_cocina`);

--
-- Indices de la tabla `rol`
--
ALTER TABLE `rol`
  ADD PRIMARY KEY (`id_rol`);

--
-- Indices de la tabla `sector`
--
ALTER TABLE `sector`
  ADD PRIMARY KEY (`id_sector`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `clientes`
--
ALTER TABLE `clientes`
  MODIFY `id_cliente` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de la tabla `cliente_visita`
--
ALTER TABLE `cliente_visita`
  MODIFY `id_cliente_visita` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `encuestas`
--
ALTER TABLE `encuestas`
  MODIFY `id_encuesta` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `logueos`
--
ALTER TABLE `logueos`
  MODIFY `numero` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `mesas`
--
ALTER TABLE `mesas`
  MODIFY `id_mesa` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT de la tabla `pedidos`
--
ALTER TABLE `pedidos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT de la tabla `productos`
--
ALTER TABLE `productos`
  MODIFY `id_producto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
