-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1:3306
-- Tiempo de generación: 24-01-2021 a las 08:14:59
-- Versión del servidor: 10.4.10-MariaDB
-- Versión de PHP: 5.6.40

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `proyecto`
--
CREATE DATABASE IF NOT EXISTS `proyecto` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `proyecto`;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `comments`
--

DROP TABLE IF EXISTS `comments`;
CREATE TABLE IF NOT EXISTS `comments` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `codigo_proyecto` int(11) NOT NULL,
  `id_seguimiento` int(11) NOT NULL,
  `id_entregable` int(11) NOT NULL,
  `comentario` varchar(10000) NOT NULL,
  `id_user` int(11) NOT NULL,
  `rol` varchar(100) NOT NULL,
  `fecha` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`),
  KEY `comments_ibfk_1` (`codigo_proyecto`),
  KEY `id_entregable` (`id_entregable`),
  KEY `id_seguimiento` (`id_seguimiento`)
) ENGINE=InnoDB AUTO_INCREMENT=30 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `comments`
--

INSERT INTO `comments` (`id`, `codigo_proyecto`, `id_seguimiento`, `id_entregable`, `comentario`, `id_user`, `rol`, `fecha`) VALUES
(19, 545, 48, 1, 'hola colombia', 1, 'administrador', '2021-01-20 09:54:08'),
(20, 545, 48, 1, 'jajajaja', 1, 'administrador', '2021-01-20 10:21:06'),
(21, 545, 48, 1, 'fg fdgfd gfd gfd df gdfgdfg dfg df\r\n', 1, 'administrador', '2021-01-20 11:44:58'),
(22, 2021, 55, 10, 'fase 4 comentario', 121, 'estudiante', '2021-01-20 11:55:04'),
(23, 2021, 53, 8, 'fase 2 activada muy bien', 121, 'estudiante', '2021-01-20 11:59:39'),
(24, 2021, 53, 8, 'buen trabajo', 1, 'administrador', '2021-01-20 12:02:02'),
(25, 2021, 53, 8, 'gs dfhjghf gkjdfhs kghdfkh kgfdhk gfdkh kghdfk hgkdfh kghkh khgfk hgkdfhk ghdkfh gkdhfk hgfdkh gkdhfkh gkdhkg hdkgk dfk gkdfk ghkdfh kghfdk hgdkfhk ghdfk hgkdfhgk dhf', 1, 'administrador', '2021-01-20 12:39:19'),
(26, 2021, 53, 8, 'que bien gracias', 121, 'estudiante', '2021-01-20 12:53:54'),
(27, 2021, 53, 8, 'jajajaj\r\n', 99, 'Coinvestigador', '2021-01-20 13:01:30'),
(28, 2021, 53, 8, 'buen trabajo carolina', 96, 'Inv Principal', '2021-01-20 13:04:12'),
(29, 2020, 56, 11, 'hola jhfs jdhjs hfjd fsd', 121, 'estudiante', '2021-01-20 16:43:23');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cronograma`
--

DROP TABLE IF EXISTS `cronograma`;
CREATE TABLE IF NOT EXISTS `cronograma` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `codigo_proyecto` varchar(100) NOT NULL,
  `fecha_inicio` date NOT NULL,
  `fecha_fin` date NOT NULL,
  PRIMARY KEY (`id`),
  KEY `codigo_proyecto` (`codigo_proyecto`)
) ENGINE=InnoDB AUTO_INCREMENT=67 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `cronograma`
--

INSERT INTO `cronograma` (`id`, `codigo_proyecto`, `fecha_inicio`, `fecha_fin`) VALUES
(55, '545', '2021-01-19', '2021-01-27'),
(59, '2021', '2021-01-20', '2021-01-23'),
(60, '2020', '2021-01-22', '2021-01-23'),
(61, '2323', '2021-01-20', '2021-01-23'),
(62, '12121', '2021-01-21', '2021-01-23'),
(63, '454545', '2021-01-21', '2021-01-28'),
(64, '234', '2021-01-21', '2021-01-30'),
(65, '123', '2021-01-21', '2021-01-22'),
(66, '202098', '2021-01-29', '2021-01-30');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `entregables`
--

DROP TABLE IF EXISTS `entregables`;
CREATE TABLE IF NOT EXISTS `entregables` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `codigo_proyecto` varchar(100) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `fecha_entrega` varchar(100) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `codigo_proyecto` (`codigo_proyecto`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `entregables`
--

INSERT INTO `entregables` (`id`, `codigo_proyecto`, `nombre`, `fecha_entrega`) VALUES
(1, '545', 'fase 1', '2021-01-26'),
(4, 'sas11', 'fase 1', '2021-01-19'),
(5, 'sas11', 'fase 2', '2021-01-28'),
(6, 'sas11', 'fase 2', '2021-01-21'),
(7, '2021', 'fase 1', '2021-01-21'),
(8, '2021', 'fase 2', '2021-01-28'),
(9, '2021', 'fase 3', '2021-02-05'),
(10, '2021', 'fase 4', '2021-02-03'),
(11, '2020', 'fase 1', '2021-01-21'),
(12, '2020', 'fase 2', '2021-01-23'),
(13, '2020', 'fase 3', '2021-01-24'),
(14, '2323', 'fase 1', '2021-01-21'),
(15, '12121', 'fase 3', '2021-01-30'),
(16, '454545', 'wer', '2021-01-29'),
(17, '234', 'fase 4', '2021-01-29'),
(18, '123', 'diseÃ±o', '2021-01-28'),
(19, '202098', 'entregable 1', '2021-01-22'),
(20, '202098', 'entregable 2', '2021-01-29');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `estudiantes_proyecto`
--

DROP TABLE IF EXISTS `estudiantes_proyecto`;
CREATE TABLE IF NOT EXISTS `estudiantes_proyecto` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `codigo_proyecto` varchar(100) NOT NULL,
  `estudiante` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `estudiante` (`estudiante`),
  KEY `id` (`id`),
  KEY `id_2` (`id`),
  KEY `estudiante_2` (`estudiante`)
) ENGINE=InnoDB AUTO_INCREMENT=101 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `estudiantes_proyecto`
--

INSERT INTO `estudiantes_proyecto` (`id`, `codigo_proyecto`, `estudiante`) VALUES
(53, '2021', 106),
(55, 'dd', 106),
(57, 'sa1', 106),
(58, 'sa1', 107),
(59, 'sa1', 108),
(60, 'sa1', 110),
(65, '545', 106),
(66, '545', 107),
(75, '2021', 107),
(76, '2021', 108),
(77, '2021', 110),
(78, '2020', 106),
(79, '2020', 107),
(80, '2020', 108),
(81, '2020', 110),
(82, '2323', 106),
(83, '2323', 108),
(84, '12121', 106),
(85, '12121', 108),
(86, '454545', 106),
(87, '454545', 107),
(88, '234', 107),
(89, '234', 108),
(93, '202098', 108),
(97, '20213', 117),
(98, '353', 106),
(100, '324', 106);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `events`
--

DROP TABLE IF EXISTS `events`;
CREATE TABLE IF NOT EXISTS `events` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `start` datetime NOT NULL,
  `end` datetime NOT NULL,
  `color` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `grupos`
--

DROP TABLE IF EXISTS `grupos`;
CREATE TABLE IF NOT EXISTS `grupos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre_grupo` varchar(100) NOT NULL,
  `nombre_programa` int(11) NOT NULL,
  `estado` varchar(100) NOT NULL,
  `fecha_agregado` date NOT NULL,
  PRIMARY KEY (`id`),
  KEY `nombre_programa` (`nombre_programa`),
  KEY `nombre_programa_2` (`nombre_programa`)
) ENGINE=InnoDB AUTO_INCREMENT=53 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `grupos`
--

INSERT INTO `grupos` (`id`, `nombre_grupo`, `nombre_programa`, `estado`, `fecha_agregado`) VALUES
(51, 'keyner', 27, 'activo', '2021-01-18'),
(52, 'eduar', 28, 'activo', '2021-01-18');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `grupo_proyecto`
--

DROP TABLE IF EXISTS `grupo_proyecto`;
CREATE TABLE IF NOT EXISTS `grupo_proyecto` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_grupo` int(11) NOT NULL,
  `codigo_proyecto` varchar(100) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id_grupo` (`id_grupo`),
  KEY `codigo_proyecto` (`codigo_proyecto`)
) ENGINE=InnoDB AUTO_INCREMENT=62 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `grupo_proyecto`
--

INSERT INTO `grupo_proyecto` (`id`, `id_grupo`, `codigo_proyecto`) VALUES
(50, 51, '545'),
(54, 51, '2021'),
(55, 51, '2020'),
(56, 51, '2323'),
(57, 51, '12121'),
(58, 52, '454545'),
(59, 51, '234'),
(60, 51, '123'),
(61, 51, '202098');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `investigadores_proyecto`
--

DROP TABLE IF EXISTS `investigadores_proyecto`;
CREATE TABLE IF NOT EXISTS `investigadores_proyecto` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `codigo_proyecto` varchar(100) NOT NULL,
  `investigador` int(11) NOT NULL,
  `rol` varchar(100) NOT NULL,
  KEY `investigador` (`investigador`),
  KEY `id` (`id`),
  KEY `investigador_2` (`investigador`),
  KEY `codigo_proyecto` (`codigo_proyecto`),
  KEY `codigo_proyecto_2` (`codigo_proyecto`)
) ENGINE=InnoDB AUTO_INCREMENT=108 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `investigadores_proyecto`
--

INSERT INTO `investigadores_proyecto` (`id`, `codigo_proyecto`, `investigador`, `rol`) VALUES
(67, 'sa1', 105, 'Inv Principal'),
(69, 'sa1', 111, 'Coinvestigador'),
(74, '545', 105, 'Inv Principal'),
(75, '545', 111, 'Coinvestigador'),
(76, '5445', 105, 'Coinvestigador'),
(84, '2021', 105, 'Inv Principal'),
(86, '2021', 111, 'Coinvestigador'),
(87, '2020', 105, 'Inv Principal'),
(89, '2020', 111, 'Coinvestigador'),
(90, '2323', 105, 'Inv Principal'),
(92, '12121', 105, 'Inv Principal'),
(94, '454545', 105, 'Inv Principal'),
(96, '234', 105, 'Inv Principal'),
(97, '234', 111, 'Coinvestigador'),
(98, '123', 105, 'Inv Principal'),
(102, '20213', 105, 'Inv Principal'),
(104, '423', 105, 'Inv Principal'),
(105, '33', 105, 'Inv Principal'),
(107, '324', 105, 'Inv Principal');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `miembros`
--

DROP TABLE IF EXISTS `miembros`;
CREATE TABLE IF NOT EXISTS `miembros` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(100) NOT NULL,
  `cedula` varchar(100) NOT NULL,
  `email` varchar(1000) NOT NULL,
  `rol` varchar(100) NOT NULL,
  `grupo` int(11) NOT NULL,
  `rand` varchar(1000) NOT NULL,
  `estado` varchar(100) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`),
  KEY `grupo` (`grupo`)
) ENGINE=InnoDB AUTO_INCREMENT=139 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `miembros`
--

INSERT INTO `miembros` (`id`, `nombre`, `cedula`, `email`, `rol`, `grupo`, `rand`, `estado`) VALUES
(105, 'carlos', '1234567', 'carlos@hotmail.com', 'Investigador', 51, '25856', 'activo'),
(106, 'maria', '123456767', 'maria@hotmail.com', 'Estudiante', 52, '25856', 'activo'),
(107, 'caro', '22255', 'caro@hotmail.com', 'Estudiante', 51, '25856', 'activo'),
(108, 'carolina', '222558', 'carolinao@hotmail.com', 'Estudiante', 52, '25856', 'activo'),
(110, 'marcela', '787879', 'marcela@hotmail.com', 'Estudiante', 51, '25856', 'activo'),
(111, 'dora', '78787902', 'dra@hotmail.com', 'Investigador', 52, '25856', 'activo'),
(117, 'mario', '2321434', 'mario@gmail.com', 'Estudiante', 52, '12345', 'activo'),
(138, 'catalina', '342342', 'catalina@hotmail.com', 'Estudiante', 51, 'f6kZLdi', 'activo');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `programas`
--

DROP TABLE IF EXISTS `programas`;
CREATE TABLE IF NOT EXISTS `programas` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `programa` varchar(100) NOT NULL,
  `estado` varchar(100) NOT NULL,
  `fecha_agregado` date NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=29 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `programas`
--

INSERT INTO `programas` (`id`, `programa`, `estado`, `fecha_agregado`) VALUES
(27, 'sistema', 'activo', '2021-01-18'),
(28, 'contaduria', 'activo', '2021-01-18');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `programa_proyecto`
--

DROP TABLE IF EXISTS `programa_proyecto`;
CREATE TABLE IF NOT EXISTS `programa_proyecto` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_programa` int(11) NOT NULL,
  `codigo_proyecto` varchar(100) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id_programa` (`id_programa`),
  KEY `codigo_proyecto` (`codigo_proyecto`)
) ENGINE=InnoDB AUTO_INCREMENT=62 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `programa_proyecto`
--

INSERT INTO `programa_proyecto` (`id`, `id_programa`, `codigo_proyecto`) VALUES
(50, 27, '545'),
(54, 27, '2021'),
(55, 28, '2020'),
(56, 28, '2323'),
(57, 27, '12121'),
(58, 28, '454545'),
(59, 27, '234'),
(60, 27, '123'),
(61, 27, '202098');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `proyecto`
--

DROP TABLE IF EXISTS `proyecto`;
CREATE TABLE IF NOT EXISTS `proyecto` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `codigo` varchar(100) NOT NULL,
  `nombre_proyecto` varchar(100) NOT NULL,
  `presupuesto` int(11) NOT NULL,
  `descripcion` longtext NOT NULL,
  `estado` varchar(11) NOT NULL,
  `fecha_agregado` date NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `codigo_2` (`codigo`),
  KEY `codigo` (`codigo`)
) ENGINE=InnoDB AUTO_INCREMENT=90 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `proyecto`
--

INSERT INTO `proyecto` (`id`, `codigo`, `nombre_proyecto`, `presupuesto`, `descripcion`, `estado`, `fecha_agregado`) VALUES
(78, '545', 'ecopetrol', 454545, 'Serial oros instalacion windows 8\r\n\r\nXKY4K-2NRWR-8F6P2-448RF-CRYQH\r\nNG4HW-VH26C-733KW-K6F98-J8CK4\r\nRR3BN-3YY9P-9D7FC-7J4YF-QGJXW\r\n\r\nUpadate license key :\r\n\r\nTK8TP-9JN6P-7X7WW-RFFTV-B7QPF\r\nXky4K-2Nrwr-8F6P2-448Rf-Cryqh', 'terminado', '2021-01-19'),
(82, '2021', 'ajover', 2550000, 'proyecto de prueba', 'activo', '2021-01-20'),
(83, '2020', 'mantenimiento de cuentas', 11545444, 's fasdh fds jfhjdh sdhkf sdk kdk fahksdh kfhds', 'activo', '2021-01-20'),
(84, '2323', 'recursos humanos', 534534534, 'vxcvcx', 'activo', '2021-01-20'),
(85, '12121', 'colombia', 23213, 'fd dg  fd fd fd fd gf', 'activo', '2021-01-21'),
(86, '454545', 'estados unidos', 3423, ' dgdgfg fdg  gfd g5fd45 gg fd', 'activo', '2021-01-21'),
(87, '234', 'oseano', 213, 'dfss', 'activo', '2021-01-21'),
(88, '123', 'paraiso', 2321313, 'f sf', 'activo', '2021-01-21'),
(89, '202098', 'particiancio', 2000000, 'organizacion', 'activo', '2021-01-21');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `seguimientos`
--

DROP TABLE IF EXISTS `seguimientos`;
CREATE TABLE IF NOT EXISTS `seguimientos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `codigo_proyecto` varchar(100) NOT NULL,
  `documento` varchar(100) NOT NULL,
  `id_seg` int(100) NOT NULL,
  `descripcion` varchar(1000) NOT NULL,
  `id_miembros` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `codigo_proyecto` (`codigo_proyecto`),
  KEY `id_miembros` (`id_miembros`),
  KEY `id_seg` (`id_seg`)
) ENGINE=InnoDB AUTO_INCREMENT=58 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `seguimientos`
--

INSERT INTO `seguimientos` (`id`, `codigo_proyecto`, `documento`, `id_seg`, `descripcion`, `id_miembros`) VALUES
(47, '545', '1611051919_a84b593d-0e01-4a5c-bee9-102eb0f387cd.jpg', 1, 'jhj', 107),
(48, '545', '1611055511_a84b593d-0e01-4a5c-bee9-102eb0f387cd.jpg', 1, 'prueba', 106),
(52, '2021', '1611143593_a84b593d-0e01-4a5c-bee9-102eb0f387cd.jpg', 7, 'prueba 1', 108),
(53, '2021', '1611143600_a84b593d-0e01-4a5c-bee9-102eb0f387cd.jpg', 8, 'prueba 2', 108),
(54, '2021', '1611143610_a84b593d-0e01-4a5c-bee9-102eb0f387cd.jpg', 9, 'prueba 3 fdk gfd gdf', 108),
(55, '2021', '1611143620_a84b593d-0e01-4a5c-bee9-102eb0f387cd.jpg', 10, 'ksjf jdsj ldlg lfdjlg jfdlj ldf gldfl gdfl l', 108),
(56, '2020', '1611160830_Imagen1.png', 11, 'hjj jjgjgjgjgjgj jjgj', 108),
(57, '2323', '1611160881_Imagen1.png', 14, 'hjj jjgjgjgjgjgj jjgj', 108);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `servicios`
--

DROP TABLE IF EXISTS `servicios`;
CREATE TABLE IF NOT EXISTS `servicios` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `servicio` varchar(3000) NOT NULL,
  `estado` varchar(10) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `solicitudes`
--

DROP TABLE IF EXISTS `solicitudes`;
CREATE TABLE IF NOT EXISTS `solicitudes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(100) NOT NULL,
  `servicio` varchar(100) NOT NULL,
  `presupuesto` int(11) NOT NULL,
  `descripcion` text NOT NULL,
  `proveedor` int(11) NOT NULL,
  `estado` varchar(10) NOT NULL,
  `fecha` date NOT NULL,
  PRIMARY KEY (`id`),
  KEY `proveedor` (`proveedor`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `solicitudes`
--

INSERT INTO `solicitudes` (`id`, `nombre`, `servicio`, `presupuesto`, `descripcion`, `proveedor`, `estado`, `fecha`) VALUES
(8, 'ecopetrol', 'clases onlineg', 2342342, 'hola mundo', 1, 'en espera', '2020-03-30'),
(10, 'thaliana', 'servicios play', 333, 'dgdg', 1, 'procesada', '2020-03-30'),
(11, 'thaliana acosta herrera', 'clases onlineg', 666, 'yyy', 1, 'rechazada', '2020-03-30');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

DROP TABLE IF EXISTS `usuarios`;
CREATE TABLE IF NOT EXISTS `usuarios` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `rol` varchar(100) NOT NULL,
  `codigo_proyecto` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=167 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id`, `username`, `password`, `rol`, `codigo_proyecto`) VALUES
(1, 'admin', 'd033e22ae348aeb5660fc2140aec35850c4da997', 'administrador', 'null'),
(96, 'carlos@hotmail.com', '8cb2237d0679ca88db6464eac60da96345513964', 'Inv Principal', '545'),
(97, 'maria@hotmail.com', '8cb2237d0679ca88db6464eac60da96345513964', 'estudiante', '545'),
(98, 'caro@hotmail.com', '8cb2237d0679ca88db6464eac60da96345513964', 'estudiante', '545'),
(99, 'dra@hotmail.com', '8cb2237d0679ca88db6464eac60da96345513964', 'Coinvestigador', '545'),
(117, 'carlos@hotmail.com', '8cb2237d0679ca88db6464eac60da96345513964', 'Inv Principal', '2021'),
(118, 'camila@hotmail.com', '8cb2237d0679ca88db6464eac60da96345513964', 'Coinvestigador', '2021'),
(119, 'dra@hotmail.com', '8cb2237d0679ca88db6464eac60da96345513964', 'Coinvestigador', '2021'),
(120, 'caro@hotmail.com', '8cb2237d0679ca88db6464eac60da96345513964', 'estudiante', '2021'),
(121, 'carolinao@hotmail.com', '8cb2237d0679ca88db6464eac60da96345513964', 'estudiante', '2021'),
(122, 'marcela@hotmail.com', '8cb2237d0679ca88db6464eac60da96345513964', 'estudiante', '2021'),
(123, 'carlos@hotmail.com', '8cb2237d0679ca88db6464eac60da96345513964', 'Inv Principal', '2020'),
(124, 'camila@hotmail.com', '8cb2237d0679ca88db6464eac60da96345513964', 'Coinvestigador', '2020'),
(125, 'dra@hotmail.com', '8cb2237d0679ca88db6464eac60da96345513964', 'Coinvestigador', '2020'),
(126, 'maria@hotmail.com', '8cb2237d0679ca88db6464eac60da96345513964', 'estudiante', '2020'),
(127, 'caro@hotmail.com', '8cb2237d0679ca88db6464eac60da96345513964', 'estudiante', '2020'),
(128, 'carolinao@hotmail.com', '8cb2237d0679ca88db6464eac60da96345513964', 'estudiante', '2020'),
(129, 'marcela@hotmail.com', '8cb2237d0679ca88db6464eac60da96345513964', 'estudiante', '2020'),
(130, 'carlos@hotmail.com', '8cb2237d0679ca88db6464eac60da96345513964', 'Inv Principal', '2323'),
(131, 'camila@hotmail.com', '8cb2237d0679ca88db6464eac60da96345513964', 'Coinvestigador', '2323'),
(132, 'maria@hotmail.com', '8cb2237d0679ca88db6464eac60da96345513964', 'estudiante', '2323'),
(133, 'carolinao@hotmail.com', '8cb2237d0679ca88db6464eac60da96345513964', 'estudiante', '2323'),
(134, 'carlos@hotmail.com', '8cb2237d0679ca88db6464eac60da96345513964', 'Inv Principal', '12121'),
(135, 'camila@hotmail.com', '8cb2237d0679ca88db6464eac60da96345513964', 'Coinvestigador', '12121'),
(136, 'maria@hotmail.com', '8cb2237d0679ca88db6464eac60da96345513964', 'estudiante', '12121'),
(137, 'carolinao@hotmail.com', '8cb2237d0679ca88db6464eac60da96345513964', 'estudiante', '12121'),
(138, 'carlos@hotmail.com', '8cb2237d0679ca88db6464eac60da96345513964', 'Inv Principal', '454545'),
(139, 'camila@hotmail.com', '8cb2237d0679ca88db6464eac60da96345513964', 'Coinvestigador', '454545'),
(140, 'maria@hotmail.com', '8cb2237d0679ca88db6464eac60da96345513964', 'estudiante', '454545'),
(141, 'caro@hotmail.com', '8cb2237d0679ca88db6464eac60da96345513964', 'estudiante', '454545'),
(142, 'carlos@hotmail.com', '8cb2237d0679ca88db6464eac60da96345513964', 'Inv Principal', '234'),
(143, 'dra@hotmail.com', '8cb2237d0679ca88db6464eac60da96345513964', 'Coinvestigador', '234'),
(144, 'caro@hotmail.com', '8cb2237d0679ca88db6464eac60da96345513964', 'estudiante', '234'),
(145, 'carolinao@hotmail.com', '8cb2237d0679ca88db6464eac60da96345513964', 'estudiante', '234'),
(146, 'carlos@hotmail.com', '8cb2237d0679ca88db6464eac60da96345513964', 'Inv Principal', '123'),
(147, 'camila@hotmail.com', '8cb2237d0679ca88db6464eac60da96345513964', 'Coinvestigador', '123'),
(148, 'maria@hotmail.com', '8cb2237d0679ca88db6464eac60da96345513964', 'estudiante', '123'),
(149, 'caro@hotmail.com', '8cb2237d0679ca88db6464eac60da96345513964', 'estudiante', '123'),
(150, 'carlos@hotmail.com', '8cb2237d0679ca88db6464eac60da96345513964', 'Inv Principal', '202098'),
(151, 'camila@hotmail.com', '8cb2237d0679ca88db6464eac60da96345513964', 'Coinvestigador', '202098'),
(152, 'maria@hotmail.com', '8cb2237d0679ca88db6464eac60da96345513964', 'estudiante', '202098'),
(153, 'carolinao@hotmail.com', '8cb2237d0679ca88db6464eac60da96345513964', 'estudiante', '202098'),
(155, 'daza@hotmail.com', '8cb2237d0679ca88db6464eac60da96345513964', 'estudiante', '32423'),
(156, 'carlos@hotmail.com', '8cb2237d0679ca88db6464eac60da96345513964', 'Inv Principal', '20213'),
(157, 'camila@hotmail.com', '8cb2237d0679ca88db6464eac60da96345513964', 'Coinvestigador', '20213'),
(159, 'mario@gmail.com', '8cb2237d0679ca88db6464eac60da96345513964', 'estudiante', '20213'),
(160, 'carlos@hotmail.com', 'cc9a361c967e093f6f38ddc9966f388b642bb5ad', 'Inv Principal', '423'),
(161, 'maria@hotmail.com', 'cc9a361c967e093f6f38ddc9966f388b642bb5ad', 'estudiante', '353'),
(162, 'carlos@hotmail.com', 'cc9a361c967e093f6f38ddc9966f388b642bb5ad', 'Inv Principal', '33'),
(163, 'maria@hotmail.com', 'cc9a361c967e093f6f38ddc9966f388b642bb5ad', 'estudiante', '33'),
(164, 'carlos@hotmail.com', 'cc9a361c967e093f6f38ddc9966f388b642bb5ad', 'Inv Principal', '32432'),
(165, 'carlos@hotmail.com', 'cc9a361c967e093f6f38ddc9966f388b642bb5ad', 'Inv Principal', '324'),
(166, 'maria@hotmail.com', 'cc9a361c967e093f6f38ddc9966f388b642bb5ad', 'estudiante', '324');

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `comments`
--
ALTER TABLE `comments`
  ADD CONSTRAINT `comments_ibfk_2` FOREIGN KEY (`id_entregable`) REFERENCES `entregables` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `comments_ibfk_3` FOREIGN KEY (`id_seguimiento`) REFERENCES `seguimientos` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `cronograma`
--
ALTER TABLE `cronograma`
  ADD CONSTRAINT `cronograma_ibfk_1` FOREIGN KEY (`codigo_proyecto`) REFERENCES `proyecto` (`codigo`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `estudiantes_proyecto`
--
ALTER TABLE `estudiantes_proyecto`
  ADD CONSTRAINT `estudiantes_proyecto_ibfk_1` FOREIGN KEY (`estudiante`) REFERENCES `miembros` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `grupos`
--
ALTER TABLE `grupos`
  ADD CONSTRAINT `grupos_ibfk_1` FOREIGN KEY (`nombre_programa`) REFERENCES `programas` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `grupo_proyecto`
--
ALTER TABLE `grupo_proyecto`
  ADD CONSTRAINT `grupo_proyecto_ibfk_1` FOREIGN KEY (`id_grupo`) REFERENCES `grupos` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `grupo_proyecto_ibfk_2` FOREIGN KEY (`codigo_proyecto`) REFERENCES `proyecto` (`codigo`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `investigadores_proyecto`
--
ALTER TABLE `investigadores_proyecto`
  ADD CONSTRAINT `investigadores_proyecto_ibfk_1` FOREIGN KEY (`investigador`) REFERENCES `miembros` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `miembros`
--
ALTER TABLE `miembros`
  ADD CONSTRAINT `miembros_ibfk_1` FOREIGN KEY (`grupo`) REFERENCES `grupos` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `programa_proyecto`
--
ALTER TABLE `programa_proyecto`
  ADD CONSTRAINT `programa_proyecto_ibfk_1` FOREIGN KEY (`id_programa`) REFERENCES `programas` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `programa_proyecto_ibfk_2` FOREIGN KEY (`codigo_proyecto`) REFERENCES `proyecto` (`codigo`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `seguimientos`
--
ALTER TABLE `seguimientos`
  ADD CONSTRAINT `seguimientos_ibfk_1` FOREIGN KEY (`codigo_proyecto`) REFERENCES `proyecto` (`codigo`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `seguimientos_ibfk_2` FOREIGN KEY (`id_miembros`) REFERENCES `miembros` (`id`),
  ADD CONSTRAINT `seguimientos_ibfk_3` FOREIGN KEY (`id_seg`) REFERENCES `entregables` (`id`);

--
-- Filtros para la tabla `solicitudes`
--
ALTER TABLE `solicitudes`
  ADD CONSTRAINT `solicitudes_ibfk_1` FOREIGN KEY (`proveedor`) REFERENCES `usuarios` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
