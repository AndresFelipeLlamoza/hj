-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 02-01-2023 a las 02:36:32
-- Versión del servidor: 10.4.24-MariaDB
-- Versión de PHP: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `huevosjireth`
--

DELIMITER $$
--
-- Procedimientos
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_DATOSGRAFICO_BAR` ()   SELECT Producto, SUM(Total) FROM reservas WHERE Producto = 'Huevos Pequeños' AND Estado='Retirado'
UNION
SELECT Producto, SUM(Total) FROM reservas WHERE Producto = 'Huevos Medianos' AND Estado='Retirado'
UNION
SELECT Producto, SUM(Total) FROM reservas WHERE Producto = 'Huevos Triple A' AND Estado='Retirado'
UNION
SELECT Producto, SUM(Total) FROM reservas WHERE Producto = 'Huevos Doble Yema' AND Estado='Retirado'$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_DATOSGRAFICO_CANT` ()   SELECT Producto, SUM(Cantidad) FROM reservas WHERE Producto='Huevos Pequeños' AND Estado='Retirado'
UNION
SELECT Producto, SUM(Cantidad) FROM reservas WHERE Producto='Huevos Medianos' AND Estado='Retirado'
UNION
SELECT Producto, SUM(Cantidad) FROM reservas WHERE Producto='Huevos Triple A' AND Estado='Retirado'
UNION
SELECT Producto, SUM(Cantidad) FROM reservas WHERE Producto='Huevos Doble Yema' AND Estado='Retirado'$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_DATOSGRAFICO_MAS` ()   SELECT Producto, COUNT(Producto) FROM reservas WHERE Producto='Huevos Pequeños' AND Estado='Retirado'
UNION
SELECT Producto, COUNT(Producto) FROM reservas WHERE Producto='Huevos Medianos' AND Estado='Retirado'
UNION
SELECT Producto, COUNT(Producto) FROM reservas WHERE Producto='Huevos Triple A' AND Estado='Retirado'
UNION
SELECT Producto, COUNT(Producto) FROM reservas WHERE Producto='Huevos Doble Yema' AND Estado='Retirado'$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_DATOSGRAFICO_PARAMETRO_GANACIAS` (IN `FECHAINICIO` VARCHAR(10), IN `FECHAFIN` VARCHAR(10))   SELECT
productos.Nombre,
SUM(reservas.Total) AS TOTALVENTAS
FROM
reservas
INNER JOIN productos ON reservas.Producto = productos.Nombre
WHERE Estado = "Retirado" AND YEAR(reservas.Fecha) BETWEEN FECHAINICIO AND FECHAFIN
GROUP BY productos.idProducto$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_DATOSGRAFICO_PARAMETRO_UNIDADES` (IN `FECHAINICIO` VARCHAR(10), IN `FECHAFIN` VARCHAR(10))   SELECT
productos.Producto,
SUM(reservas.Cantidad) AS CANTIDAD
FROM
reservas 
INNER JOIN productos ON reservas.Producto = productos.Producto
WHERE Estado = "Retirado" AND YEAR(reservas.Fecha) BETWEEN FECHAINICIO AND FECHAFIN
GROUP BY productos.idProducto$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_DATOSGRAFICO_PARAMETRO_VENTAS` (IN `FECHAINICIO` VARCHAR(10), IN `FECHAFIN` VARCHAR(10))   SELECT
productos.Producto,
COUNT(reservas.Producto) AS PRODUCTO
FROM
reservas 
INNER JOIN productos ON reservas.Producto = productos.Producto
WHERE Estado = "Retirado" AND YEAR(reservas.Fecha) BETWEEN FECHAINICIO AND FECHAFIN
GROUP BY productos.idProducto$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `mensajes`
--

CREATE TABLE `mensajes` (
  `idMensaje` int(11) NOT NULL,
  `Nombre` varchar(50) NOT NULL,
  `Correo` varchar(30) NOT NULL,
  `Telefono` varchar(10) NOT NULL,
  `Mensaje` varchar(500) NOT NULL,
  `idUsuario` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `mensajes`
--

INSERT INTO `mensajes` (`idMensaje`, `Nombre`, `Correo`, `Telefono`, `Mensaje`, `idUsuario`) VALUES
(1, 'jamsyckxxx', 'jamsyck123@gmail.com', '3216549870', 'los productos son muy buenos la verdad', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productos`
--

CREATE TABLE `productos` (
  `idProducto` int(11) NOT NULL,
  `Nombre` varchar(30) NOT NULL,
  `Precio` int(11) NOT NULL,
  `Cantidad` int(11) NOT NULL,
  `Descripcion` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `productos`
--

INSERT INTO `productos` (`idProducto`, `Nombre`, `Precio`, `Cantidad`, `Descripcion`) VALUES
(101, 'Huevos Pequeños', 10500, 104, 'Los huevos más pequeños, con el precio más barato y accesibles para nuestros clientes.'),
(202, 'Huevos Medianos', 15400, 82, 'Huevos de tamaño mediano, económicos con un precio razonable.'),
(303, 'Huevos Triple A', 18500, 96, 'El huevo más grande que vendemos, cuenta con una clara y yema más grande y alta proteína.'),
(404, 'Huevos Doble Yema', 22000, 98, 'Los huevos que contienen doble sorpresa por dentro, los más costosos y con mejor aceptación de nuestros clientes.');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `reservas`
--

CREATE TABLE `reservas` (
  `idReserva` int(11) NOT NULL,
  `Cliente` varchar(50) NOT NULL,
  `Producto` varchar(30) NOT NULL,
  `Precio` int(11) NOT NULL,
  `Cantidad` int(11) NOT NULL,
  `Total` int(11) GENERATED ALWAYS AS (`Precio` * `Cantidad`) VIRTUAL,
  `Fecha` date NOT NULL,
  `Hora` time NOT NULL,
  `Estado` varchar(15) NOT NULL DEFAULT 'Vigente',
  `idUsuario` int(11) DEFAULT NULL,
  `idProducto` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `reservas`
--

INSERT INTO `reservas` (`idReserva`, `Cliente`, `Producto`, `Precio`, `Cantidad`, `Fecha`, `Hora`, `Estado`, `idUsuario`, `idProducto`) VALUES
(1, 'jamsyckxxx', 'Huevos Pequeños', 10500, 1, '2022-09-05', '20:07:00', 'Retirado', NULL, NULL),
(2, 'jamsyckxxx', 'Huevos Medianos', 15400, 2, '2022-09-07', '20:07:00', 'Retirado', NULL, NULL),
(3, 'jamsyckxxx', 'Huevos Triple A', 18500, 3, '2022-09-08', '20:08:00', 'Retirado', NULL, NULL),
(4, 'jamsyckxxx', 'Huevos Doble Yema', 22000, 4, '2022-09-08', '20:08:00', 'Retirado', NULL, NULL),
(5, 'jamsyckxxx', 'Huevos Triple A', 18500, 5, '2022-10-09', '08:08:00', 'Retirado', NULL, NULL),
(6, 'andres guzman', 'Huevos Doble Yema', 22000, 8, '2022-10-09', '08:09:00', 'Retirado', NULL, NULL),
(7, 'andres guzman', 'Huevos Medianos', 15400, 4, '2022-10-09', '08:09:00', 'Retirado', NULL, NULL),
(8, 'andres guzman', 'Huevos Medianos', 15400, 9, '2022-10-10', '08:09:00', 'Retirado', NULL, NULL),
(9, 'andres guzman', 'Huevos Pequeños', 10500, 6, '2022-10-10', '20:09:00', 'Retirado', NULL, NULL),
(10, 'santa ceballos', 'Huevos Medianos', 15400, 5, '2022-11-11', '20:10:00', 'Retirado', NULL, NULL),
(11, 'santa ceballos', 'Huevos Doble Yema', 22000, 1, '2022-11-10', '20:10:00', 'Retirado', NULL, NULL),
(12, 'mariana herrera', 'Huevos Triple A', 18500, 5, '2022-11-11', '20:10:00', 'Retirado', NULL, NULL),
(13, 'mariana herrera', 'Huevos Pequeños', 10500, 4, '2022-11-06', '08:11:00', 'Retirado', NULL, NULL),
(14, 'mariana herrera', 'Huevos Medianos', 15400, 6, '2022-11-03', '08:11:00', 'Retirado', NULL, NULL),
(15, 'felipe llamosa', 'Huevos Medianos', 15400, 5, '2022-11-02', '08:11:00', 'Retirado', NULL, NULL),
(16, 'felipe llamosa', 'Huevos Triple A', 18500, 2, '2022-08-01', '08:12:00', 'Retirado', NULL, NULL),
(17, 'felipe llamosa', 'Huevos Triple A', 18500, 4, '2022-08-01', '08:12:00', 'Retirado', NULL, NULL),
(18, 'felipe llamosa', 'Huevos Medianos', 15400, 5, '2022-08-01', '20:12:00', 'Retirado', NULL, NULL),
(19, 'edwin ayala', 'Huevos Pequeños', 10500, 6, '2022-08-08', '08:13:00', 'Retirado', NULL, NULL),
(20, 'edwin ayala', 'Huevos Pequeños', 10500, 3, '2022-08-21', '08:13:00', 'Retirado', NULL, NULL),
(21, 'mariana herrera', 'Huevos Triple A', 18500, 4, '2022-07-22', '08:13:00', 'Retirado', NULL, NULL),
(22, 'mariana palma', 'Huevos Medianos', 15400, 5, '2022-07-22', '08:14:00', 'Retirado', NULL, NULL),
(23, 'mariana palma', 'Huevos Triple A', 18500, 5, '2022-07-24', '08:14:00', 'Cancelado', NULL, NULL),
(24, 'mariana palma', 'Huevos Triple A', 18500, 8, '2022-07-23', '08:14:00', 'Retirado', NULL, NULL),
(25, 'mariana palma', 'Huevos Doble Yema', 22000, 3, '2022-07-23', '08:14:00', 'Retirado', NULL, NULL),
(26, 'mariana palma', 'Huevos Pequeños', 10500, 5, '2022-12-22', '08:20:00', 'Cancelado', NULL, NULL),
(27, 'gloria ramos', 'Huevos Medianos', 15400, 3, '2022-12-22', '08:20:00', 'Retirado', NULL, NULL),
(28, 'gloria ramos', 'Huevos Pequeños', 10500, 4, '2022-12-23', '08:21:00', 'Retirado', NULL, NULL),
(29, 'gloria ramos', 'Huevos Doble Yema', 22000, 1, '2022-12-10', '20:21:00', 'Retirado', NULL, NULL),
(30, 'leidy jhoana', 'Huevos Triple A', 18500, 4, '2022-12-11', '20:21:00', 'Retirado', NULL, NULL),
(31, 'leidy jhoana', 'Huevos Doble Yema', 22000, 1, '2022-12-12', '08:22:00', 'Retirado', NULL, NULL),
(32, 'leidy jhoana', 'Huevos Medianos', 15400, 3, '2022-12-11', '08:22:00', 'Retirado', NULL, NULL),
(33, 'jesus manuel', 'Huevos Medianos', 15400, 5, '2022-12-10', '08:22:00', 'Retirado', NULL, NULL),
(34, 'jesus manuel', 'Huevos Doble Yema', 22000, 10, '2022-12-11', '20:23:00', 'Retirado', NULL, NULL),
(35, 'william getial', 'Huevos Medianos', 15400, 5, '2022-12-10', '08:25:00', 'Retirado', NULL, NULL),
(36, 'yeison alejandro', 'Huevos Medianos', 15400, 4, '2022-12-11', '08:26:00', 'Retirado', NULL, NULL),
(37, 'yeison alejandro', 'Huevos Pequeños', 10500, 4, '2022-12-11', '08:26:00', 'Retirado', NULL, NULL),
(38, 'oscar herrera', 'Huevos Doble Yema', 22000, 5, '2022-06-12', '08:26:00', 'Retirado', NULL, NULL),
(39, 'oscar herrera', 'Huevos Medianos', 15400, 4, '2022-06-12', '08:26:00', 'Retirado', NULL, NULL),
(40, 'oscar herrera', 'Huevos Pequeños', 10500, 1, '2022-06-11', '08:27:00', 'Retirado', NULL, NULL),
(41, 'andres arenas', 'Huevos Medianos', 15400, 2, '2022-06-12', '08:27:00', 'Retirado', NULL, NULL),
(42, 'andres arenas', 'Huevos Triple A', 18500, 2, '2022-06-12', '08:27:00', 'Retirado', NULL, NULL),
(43, 'sara herrera', 'Huevos Medianos', 15400, 3, '2022-06-11', '08:27:00', 'Retirado', NULL, NULL),
(44, 'sara herrera', 'Huevos Triple A', 18500, 4, '2022-06-12', '08:28:00', 'Retirado', NULL, NULL),
(45, 'juan carlos', 'Huevos Medianos', 15400, 2, '2022-12-12', '11:00:00', 'Cancelado', NULL, NULL),
(46, 'jamsyckxxx', 'Huevos Pequeños', 10500, 5, '2022-12-11', '19:04:00', 'Retirado', NULL, NULL),
(47, 'jamsyckxxx', 'Huevos Pequeños', 10500, 4, '2022-12-12', '08:51:00', 'Cancelado', NULL, NULL),
(48, 'jamsyckxxx', 'Huevos Doble Yema', 22000, 3, '2022-12-13', '08:51:00', 'Cancelado', NULL, NULL),
(49, 'jamsyckxxx', 'Huevos Doble Yema', 22000, 4, '2022-12-12', '08:53:00', 'Retirado', NULL, NULL),
(50, 'jamsyckxxx', 'Huevos Doble Yema', 22000, 4, '2022-12-12', '08:53:00', 'Retirado', NULL, NULL),
(51, 'jamsyckxxx', 'Huevos Doble Yema', 22000, 8, '2022-12-12', '20:53:00', 'Retirado', NULL, NULL),
(52, 'mariana palma', 'Huevos Triple A', 18500, 8, '2022-12-12', '10:04:00', 'Retirado', NULL, NULL),
(53, 'gloria ramos', 'Huevos Doble Yema', 22000, 3, '2022-12-13', '10:13:00', 'Cancelado', NULL, NULL),
(54, 'jamsyckxxx', 'Huevos Pequeños', 10500, 6, '2022-12-14', '08:55:00', 'Cancelado', NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `roles`
--

CREATE TABLE `roles` (
  `idRol` int(11) NOT NULL,
  `Perfil` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `roles`
--

INSERT INTO `roles` (`idRol`, `Perfil`) VALUES
(1, 'Administrador'),
(2, 'Cliente');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `idUsuario` int(11) NOT NULL,
  `Nombre` varchar(50) NOT NULL,
  `Correo` varchar(30) NOT NULL,
  `Contraseña` varchar(150) NOT NULL,
  `idRol` int(11) DEFAULT 2
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`idUsuario`, `Nombre`, `Correo`, `Contraseña`, `idRol`) VALUES
(1, 'Sandra Muñoz', 'sandrapatricia-225@hotmail.com', '5c37c334d9adb20fb51f38c433a378cd6e74b5feac2fee4071b349e9ceed67c39c32f1585deada468fb8de39a9ddabb44b801e64cead76b039486df0af8a39ef', 1),
(2, 'andres guzman', 'afgr@gmail.com', 'ba3253876aed6bc22d4a6ff53d8406c6ad864195ed144ab5c87621b6c233b548baeae6956df346ec8c17f5ea10f35ee3cbc514797ed7ddd3145464e2a0bab413', 2),
(3, 'felipe llamosa', 'llamozin@gmail.com', 'ba3253876aed6bc22d4a6ff53d8406c6ad864195ed144ab5c87621b6c233b548baeae6956df346ec8c17f5ea10f35ee3cbc514797ed7ddd3145464e2a0bab413', 2),
(4, 'yeison alejandro', 'yeison@gmail.com', 'ba3253876aed6bc22d4a6ff53d8406c6ad864195ed144ab5c87621b6c233b548baeae6956df346ec8c17f5ea10f35ee3cbc514797ed7ddd3145464e2a0bab413', 2),
(5, 'jesus manuel', 'jesus@gmail.com', 'ba3253876aed6bc22d4a6ff53d8406c6ad864195ed144ab5c87621b6c233b548baeae6956df346ec8c17f5ea10f35ee3cbc514797ed7ddd3145464e2a0bab413', 2),
(6, 'santiago hernandez', 'santiago@gmail.com', 'ba3253876aed6bc22d4a6ff53d8406c6ad864195ed144ab5c87621b6c233b548baeae6956df346ec8c17f5ea10f35ee3cbc514797ed7ddd3145464e2a0bab413', 2),
(7, 'andres arenas', 'gemelo1@gmail.com', 'ba3253876aed6bc22d4a6ff53d8406c6ad864195ed144ab5c87621b6c233b548baeae6956df346ec8c17f5ea10f35ee3cbc514797ed7ddd3145464e2a0bab413', 2),
(8, 'felipe arenas', 'gemelo2@gmail.com', '816d8d4fa68c44c57b59eacc08fa8eaee4e1b550c8e0a058c13bb7117a773414cd6feaca12dabcf15f58fc9a5bd071f26b716f43d7f69df5054caabf2f58e74c', 2),
(9, 'william getial', 'william@gmail.com', 'ba3253876aed6bc22d4a6ff53d8406c6ad864195ed144ab5c87621b6c233b548baeae6956df346ec8c17f5ea10f35ee3cbc514797ed7ddd3145464e2a0bab413', 2),
(10, 'diana carolina', 'diana@gmail.com', '816d8d4fa68c44c57b59eacc08fa8eaee4e1b550c8e0a058c13bb7117a773414cd6feaca12dabcf15f58fc9a5bd071f26b716f43d7f69df5054caabf2f58e74c', 2),
(11, 'juan gongora', 'gongora@gmail.com', '9d5561d166e1af9d96ecb8f358547c99af7f7ff57ba92b7be5ea3cb340f7e5bfdccfd7f055286f3d504731aaedceaad265c9892c7d772e80e778e7cac8ea7ee6', 2),
(12, 'mariana palma', 'mariana@gmail.com', 'ba3253876aed6bc22d4a6ff53d8406c6ad864195ed144ab5c87621b6c233b548baeae6956df346ec8c17f5ea10f35ee3cbc514797ed7ddd3145464e2a0bab413', 2),
(13, 'luisa valencia', 'luisa@gmail.com', '816d8d4fa68c44c57b59eacc08fa8eaee4e1b550c8e0a058c13bb7117a773414cd6feaca12dabcf15f58fc9a5bd071f26b716f43d7f69df5054caabf2f58e74c', 2),
(14, 'santa ceballos', 'santa@gmail.com', 'ba3253876aed6bc22d4a6ff53d8406c6ad864195ed144ab5c87621b6c233b548baeae6956df346ec8c17f5ea10f35ee3cbc514797ed7ddd3145464e2a0bab413', 2),
(15, 'edwin ayala', 'edwin@gmail.com', 'ba3253876aed6bc22d4a6ff53d8406c6ad864195ed144ab5c87621b6c233b548baeae6956df346ec8c17f5ea10f35ee3cbc514797ed7ddd3145464e2a0bab413', 2),
(16, 'jhon guelpaz', 'guelpaz@gmail.com', '816d8d4fa68c44c57b59eacc08fa8eaee4e1b550c8e0a058c13bb7117a773414cd6feaca12dabcf15f58fc9a5bd071f26b716f43d7f69df5054caabf2f58e74c', 2),
(17, 'gloria ramos', 'gloria@gmail.com', 'ba3253876aed6bc22d4a6ff53d8406c6ad864195ed144ab5c87621b6c233b548baeae6956df346ec8c17f5ea10f35ee3cbc514797ed7ddd3145464e2a0bab413', 2),
(18, 'guillermo antonio', 'guillermo@gmail.com', '816d8d4fa68c44c57b59eacc08fa8eaee4e1b550c8e0a058c13bb7117a773414cd6feaca12dabcf15f58fc9a5bd071f26b716f43d7f69df5054caabf2f58e74c', 2),
(19, 'jenifer guzman', 'jeny@gmail.com', '816d8d4fa68c44c57b59eacc08fa8eaee4e1b550c8e0a058c13bb7117a773414cd6feaca12dabcf15f58fc9a5bd071f26b716f43d7f69df5054caabf2f58e74c', 2),
(20, 'leidy jhoana', 'leidy@gmail.com', 'ba3253876aed6bc22d4a6ff53d8406c6ad864195ed144ab5c87621b6c233b548baeae6956df346ec8c17f5ea10f35ee3cbc514797ed7ddd3145464e2a0bab413', 2),
(21, 'oscar herrera', 'oscar@gmail.com', 'ba3253876aed6bc22d4a6ff53d8406c6ad864195ed144ab5c87621b6c233b548baeae6956df346ec8c17f5ea10f35ee3cbc514797ed7ddd3145464e2a0bab413', 2),
(22, 'mariana herrera', 'marianita@gmail.com', 'ba3253876aed6bc22d4a6ff53d8406c6ad864195ed144ab5c87621b6c233b548baeae6956df346ec8c17f5ea10f35ee3cbc514797ed7ddd3145464e2a0bab413', 2),
(23, 'sara herrera', 'sarita@gmail.com', 'ba3253876aed6bc22d4a6ff53d8406c6ad864195ed144ab5c87621b6c233b548baeae6956df346ec8c17f5ea10f35ee3cbc514797ed7ddd3145464e2a0bab413', 2),
(24, 'jamsyckxxx', 'jamsyck123@gmail.com', 'ba3253876aed6bc22d4a6ff53d8406c6ad864195ed144ab5c87621b6c233b548baeae6956df346ec8c17f5ea10f35ee3cbc514797ed7ddd3145464e2a0bab413', 2),
(25, 'juan carlos', 'juan@gmail.com', 'ba3253876aed6bc22d4a6ff53d8406c6ad864195ed144ab5c87621b6c233b548baeae6956df346ec8c17f5ea10f35ee3cbc514797ed7ddd3145464e2a0bab413', 2),
(27, 'manuel ortega', 'ortega@gmail.com', '816d8d4fa68c44c57b59eacc08fa8eaee4e1b550c8e0a058c13bb7117a773414cd6feaca12dabcf15f58fc9a5bd071f26b716f43d7f69df5054caabf2f58e74c', 2),
(28, 'marta rosa', 'rosa@gmail.com', '816d8d4fa68c44c57b59eacc08fa8eaee4e1b550c8e0a058c13bb7117a773414cd6feaca12dabcf15f58fc9a5bd071f26b716f43d7f69df5054caabf2f58e74c', 2),
(29, 'pepito perez', 'pepe@gmail.com', 'aeae379a6e857728e44164267fdb7a0e27b205d757cc19899586c89dbb221930f1813d02ff93a661859bc17065eac4d6edf3c38a034e6283a84754d52917e5b0', 2),
(30, 'juana perez', 'juana@gmail.com', 'ba3253876aed6bc22d4a6ff53d8406c6ad864195ed144ab5c87621b6c233b548baeae6956df346ec8c17f5ea10f35ee3cbc514797ed7ddd3145464e2a0bab413', 2);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `mensajes`
--
ALTER TABLE `mensajes`
  ADD PRIMARY KEY (`idMensaje`),
  ADD KEY `idUsuario` (`idUsuario`);

--
-- Indices de la tabla `productos`
--
ALTER TABLE `productos`
  ADD PRIMARY KEY (`idProducto`);

--
-- Indices de la tabla `reservas`
--
ALTER TABLE `reservas`
  ADD PRIMARY KEY (`idReserva`),
  ADD KEY `idUsuario` (`idUsuario`),
  ADD KEY `idProducto` (`idProducto`);

--
-- Indices de la tabla `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`idRol`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`idUsuario`),
  ADD KEY `idRol` (`idRol`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `mensajes`
--
ALTER TABLE `mensajes`
  MODIFY `idMensaje` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `reservas`
--
ALTER TABLE `reservas`
  MODIFY `idReserva` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=55;

--
-- AUTO_INCREMENT de la tabla `roles`
--
ALTER TABLE `roles`
  MODIFY `idRol` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `idUsuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `mensajes`
--
ALTER TABLE `mensajes`
  ADD CONSTRAINT `fk_msg_user` FOREIGN KEY (`idUsuario`) REFERENCES `usuarios` (`idUsuario`);

--
-- Filtros para la tabla `reservas`
--
ALTER TABLE `reservas`
  ADD CONSTRAINT `fk_rsv_prd` FOREIGN KEY (`idProducto`) REFERENCES `productos` (`idProducto`),
  ADD CONSTRAINT `fk_rsv_user` FOREIGN KEY (`idUsuario`) REFERENCES `usuarios` (`idUsuario`);

--
-- Filtros para la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD CONSTRAINT `fk_user_rol` FOREIGN KEY (`idRol`) REFERENCES `roles` (`idRol`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
