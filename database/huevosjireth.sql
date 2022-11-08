-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 08-11-2022 a las 02:00:02
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
(101, 'Huevos Pequeños', 10500, 150, 'Los huevos más pequeños, con el precio más barato y accesibles para nuestros clientes.'),
(202, 'Huevos Medianos', 15400, 150, 'Huevos de tamaño mediano, económicos con un precio razonable.'),
(303, 'Huevos Triple A', 18500, 150, 'El huevo más grande que vendemos, cuenta con una clara y yema más grande y alta proteína.'),
(404, 'Huevos Doble Yema', 22000, 150, 'Los huevos que contienen doble sorpresa por dentro, los más costosos y con mejor aceptación de nuestros clientes.');

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
(1, 'Andres Guzman', 'afgr@gmail.com', '82a844967e7a71871447348bea08c9226d4cc9f280f2ba5c383ec75ba997afa0c335275fa2b8eb41785613090d0357e82e1cc0e0cacaddd02197d70b40a4320c', 1),
(2, 'Felipe Llamosa', 'llamozin@gmail.com', 'ba3253876aed6bc22d4a6ff53d8406c6ad864195ed144ab5c87621b6c233b548baeae6956df346ec8c17f5ea10f35ee3cbc514797ed7ddd3145464e2a0bab413', 2);

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
  MODIFY `idMensaje` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `reservas`
--
ALTER TABLE `reservas`
  MODIFY `idReserva` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `roles`
--
ALTER TABLE `roles`
  MODIFY `idRol` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `idUsuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

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
