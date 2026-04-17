-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 17-04-2026 a las 21:32:22
-- Versión del servidor: 10.4.32-MariaDB
-- Versión de PHP: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `tu_dulce_eleccion2`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `clientes`
--

CREATE TABLE `clientes` (
  `clientes_id` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `telefono` varchar(20) NOT NULL,
  `direccion` varchar(200) DEFAULT NULL,
  `contrasena_hash` varchar(255) DEFAULT NULL,
  `rol` enum('cliente','admin') NOT NULL DEFAULT 'cliente',
  `fecha_registro` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `clientes`
--

INSERT INTO `clientes` (`clientes_id`, `nombre`, `email`, `telefono`, `direccion`, `contrasena_hash`, `rol`, `fecha_registro`) VALUES
(1, 'Admin Principal', 'admin@pasteleria.com', '111111111', 'Oficina Central', '$2y$10$EjemploHashAdmin123', 'admin', '2026-04-14 23:13:02'),
(2, 'Laura Martínez', 'laura@pasteleria.com', '222222222', 'Sucursal Norte', '$2y$10$EjemploHashLaura456', 'admin', '2026-04-14 23:13:02'),
(3, 'Juan Pérez', 'juan@email.com', '123456789', 'Calle Principal 123', NULL, 'cliente', '2026-04-14 23:13:02'),
(4, 'María Gómez', 'maria@email.com', '987654321', 'Avenida Central 456', NULL, 'cliente', '2026-04-14 23:13:02'),
(5, 'Carlos López', 'carlos@email.com', '555555555', 'Plaza Mayor 789', '$2y$10$ClienteConCuenta789', 'cliente', '2026-04-14 23:13:02'),
(6, 'Ana Rodríguez', 'ana@email.com', '444444444', 'Barrio Los Pinos 321', NULL, 'cliente', '2026-04-14 23:13:02');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `coberturas`
--

CREATE TABLE `coberturas` (
  `coberturas_id` int(11) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `precio_extra` decimal(10,2) DEFAULT 0.00
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `coberturas`
--

INSERT INTO `coberturas` (`coberturas_id`, `nombre`, `precio_extra`) VALUES
(1, 'Merengue', 0.00),
(2, 'Chocolate', 500.00),
(3, 'Crema', 0.00),
(4, 'Granulado', 300.00),
(5, 'Frutas', 800.00),
(6, 'Fondant', 1000.00),
(7, 'Buttercream', 400.00);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pedidos`
--

CREATE TABLE `pedidos` (
  `pedidos_id` int(11) NOT NULL,
  `clientes_id` int(11) NOT NULL,
  `fecha_pedido` date NOT NULL,
  `fecha_entrega` date DEFAULT NULL,
  `total` decimal(10,2) NOT NULL,
  `estado` enum('pendiente','en preparacion','listo','entregado') DEFAULT 'pendiente'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `pedidos`
--

INSERT INTO `pedidos` (`pedidos_id`, `clientes_id`, `fecha_pedido`, `fecha_entrega`, `total`, `estado`) VALUES
(1, 3, '2026-04-14', '2026-04-17', 9400.00, 'pendiente');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `rellenos`
--

CREATE TABLE `rellenos` (
  `rellenos_id` int(11) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `precio_extra` decimal(10,2) DEFAULT 0.00
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `rellenos`
--

INSERT INTO `rellenos` (`rellenos_id`, `nombre`, `precio_extra`) VALUES
(1, 'Dulce de leche', 0.00),
(2, 'Crema pastelera', 0.00),
(3, 'Frutilla', 600.00),
(4, 'Durazno', 600.00),
(5, 'Chocolate', 700.00),
(6, 'Coco', 500.00),
(7, 'Manjar', 400.00),
(8, 'Mousse de chocolate', 800.00),
(9, 'Crema de limon', 500.00);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sabores`
--

CREATE TABLE `sabores` (
  `sabores_id` int(11) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `precio_extra` decimal(10,2) DEFAULT 0.00
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `sabores`
--

INSERT INTO `sabores` (`sabores_id`, `nombre`, `precio_extra`) VALUES
(1, 'Chocolate', 0.00),
(2, 'Vainilla', 0.00),
(3, 'Frutilla', 500.00),
(4, 'Limon', 500.00),
(5, 'Cafe', 800.00),
(6, 'Naranja', 600.00),
(7, 'Coco', 700.00);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tamanos`
--

CREATE TABLE `tamanos` (
  `tamanos_id` int(11) NOT NULL,
  `nombre` varchar(30) NOT NULL,
  `porciones` int(11) NOT NULL,
  `precio_base` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `tamanos`
--

INSERT INTO `tamanos` (`tamanos_id`, `nombre`, `porciones`, `precio_base`) VALUES
(1, 'Pequeña', 4, 5000.00),
(2, 'Mediana', 8, 8000.00),
(3, 'Grande', 12, 12000.00);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tortas`
--

CREATE TABLE `tortas` (
  `tortas_id` int(11) NOT NULL,
  `pedidos_id` int(11) NOT NULL,
  `sabores_id` int(11) NOT NULL,
  `coberturas_id` int(11) NOT NULL,
  `tamanos_id` int(11) NOT NULL,
  `precio_unitario` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `tortas`
--

INSERT INTO `tortas` (`tortas_id`, `pedidos_id`, `sabores_id`, `coberturas_id`, `tamanos_id`, `precio_unitario`) VALUES
(1, 1, 5, 1, 2, 9400.00);

--
-- Disparadores `tortas`
--
DELIMITER $$
CREATE TRIGGER `actualizar_total_pedido` AFTER INSERT ON `tortas` FOR EACH ROW BEGIN
    UPDATE pedidos p
    SET p.total = (
        SELECT SUM(t.precio_unitario)
        FROM tortas t
        WHERE t.pedidos_id = NEW.pedidos_id
    )
    WHERE p.pedidos_id = NEW.pedidos_id;
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `actualizar_total_pedido_delete` AFTER DELETE ON `tortas` FOR EACH ROW BEGIN
    UPDATE pedidos p
    SET p.total = (
        SELECT COALESCE(SUM(t.precio_unitario), 0)
        FROM tortas t
        WHERE t.pedidos_id = OLD.pedidos_id
    )
    WHERE p.pedidos_id = OLD.pedidos_id;
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `actualizar_total_pedido_update` AFTER UPDATE ON `tortas` FOR EACH ROW BEGIN
    UPDATE pedidos p
    SET p.total = (
        SELECT SUM(t.precio_unitario)
        FROM tortas t
        WHERE t.pedidos_id = NEW.pedidos_id
    )
    WHERE p.pedidos_id = NEW.pedidos_id;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tortas_rellenos`
--

CREATE TABLE `tortas_rellenos` (
  `tortas_id` int(11) NOT NULL,
  `rellenos_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `tortas_rellenos`
--

INSERT INTO `tortas_rellenos` (`tortas_id`, `rellenos_id`) VALUES
(1, 1),
(1, 4);

-- --------------------------------------------------------

--
-- Estructura Stand-in para la vista `vista_pedidos_completos`
-- (Véase abajo para la vista actual)
--
CREATE TABLE `vista_pedidos_completos` (
`pedidos_id` int(11)
,`cliente_nombre` varchar(100)
,`cliente_telefono` varchar(20)
,`cliente_email` varchar(100)
,`fecha_pedido` date
,`fecha_entrega` date
,`total` decimal(10,2)
,`estado` enum('pendiente','en preparacion','listo','entregado')
,`dias_preparacion` int(7)
);

-- --------------------------------------------------------

--
-- Estructura Stand-in para la vista `vista_pedidos_detalle`
-- (Véase abajo para la vista actual)
--
CREATE TABLE `vista_pedidos_detalle` (
`pedidos_id` int(11)
,`cliente_nombre` varchar(100)
,`cliente_telefono` varchar(20)
,`cliente_email` varchar(100)
,`fecha_pedido` date
,`fecha_entrega` date
,`fecha_pedido_formato` varchar(10)
,`fecha_entrega_formato` varchar(10)
,`dias_preparacion` int(7)
,`total` decimal(10,2)
,`estado` enum('pendiente','en preparacion','listo','entregado')
,`tortas_id` int(11)
,`sabor` varchar(50)
,`sabor_precio_extra` decimal(10,2)
,`cobertura` varchar(50)
,`cobertura_precio_extra` decimal(10,2)
,`tamaño` varchar(30)
,`porciones` int(11)
,`precio_base` decimal(10,2)
,`rellenos` mediumtext
,`rellenos_con_precio` mediumtext
,`total_extra_rellenos` decimal(32,2)
,`precio_unitario` decimal(10,2)
);

-- --------------------------------------------------------

--
-- Estructura Stand-in para la vista `vista_pedido_unico`
-- (Véase abajo para la vista actual)
--
CREATE TABLE `vista_pedido_unico` (
`pedidos_id` int(11)
,`cliente` varchar(100)
,`telefono` varchar(20)
,`direccion` varchar(200)
,`fecha_pedido` varchar(10)
,`fecha_entrega` varchar(10)
,`total` varchar(18)
,`estado` enum('pendiente','en preparacion','listo','entregado')
,`tortas_id` int(11)
,`sabor` varchar(50)
,`rellenos` mediumtext
,`cobertura` varchar(50)
,`tamaño` varchar(30)
,`porciones` int(11)
,`precio_unitario` varchar(18)
);

-- --------------------------------------------------------

--
-- Estructura para la vista `vista_pedidos_completos`
--
DROP TABLE IF EXISTS `vista_pedidos_completos`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `vista_pedidos_completos`  AS SELECT `p`.`pedidos_id` AS `pedidos_id`, `c`.`nombre` AS `cliente_nombre`, `c`.`telefono` AS `cliente_telefono`, `c`.`email` AS `cliente_email`, `p`.`fecha_pedido` AS `fecha_pedido`, `p`.`fecha_entrega` AS `fecha_entrega`, `p`.`total` AS `total`, `p`.`estado` AS `estado`, to_days(`p`.`fecha_entrega`) - to_days(`p`.`fecha_pedido`) AS `dias_preparacion` FROM (`pedidos` `p` join `clientes` `c` on(`p`.`clientes_id` = `c`.`clientes_id`)) ;

-- --------------------------------------------------------

--
-- Estructura para la vista `vista_pedidos_detalle`
--
DROP TABLE IF EXISTS `vista_pedidos_detalle`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `vista_pedidos_detalle`  AS SELECT `p`.`pedidos_id` AS `pedidos_id`, `c`.`nombre` AS `cliente_nombre`, `c`.`telefono` AS `cliente_telefono`, `c`.`email` AS `cliente_email`, `p`.`fecha_pedido` AS `fecha_pedido`, `p`.`fecha_entrega` AS `fecha_entrega`, date_format(`p`.`fecha_pedido`,'%d/%m/%Y') AS `fecha_pedido_formato`, date_format(`p`.`fecha_entrega`,'%d/%m/%Y') AS `fecha_entrega_formato`, to_days(`p`.`fecha_entrega`) - to_days(`p`.`fecha_pedido`) AS `dias_preparacion`, `p`.`total` AS `total`, `p`.`estado` AS `estado`, `t`.`tortas_id` AS `tortas_id`, `s`.`nombre` AS `sabor`, coalesce(`s`.`precio_extra`,0) AS `sabor_precio_extra`, `co`.`nombre` AS `cobertura`, coalesce(`co`.`precio_extra`,0) AS `cobertura_precio_extra`, `tm`.`nombre` AS `tamaño`, `tm`.`porciones` AS `porciones`, `tm`.`precio_base` AS `precio_base`, coalesce(group_concat(distinct `r`.`nombre` order by `r`.`nombre` ASC separator ' + '),'Sin relleno') AS `rellenos`, coalesce(group_concat(distinct concat(`r`.`nombre`,' ($',format(coalesce(`r`.`precio_extra`,0),0),')') separator ', '),'Sin relleno') AS `rellenos_con_precio`, coalesce(sum(`r`.`precio_extra`),0) AS `total_extra_rellenos`, `t`.`precio_unitario` AS `precio_unitario` FROM (((((((`pedidos` `p` join `clientes` `c` on(`p`.`clientes_id` = `c`.`clientes_id`)) join `tortas` `t` on(`p`.`pedidos_id` = `t`.`pedidos_id`)) join `sabores` `s` on(`t`.`sabores_id` = `s`.`sabores_id`)) join `coberturas` `co` on(`t`.`coberturas_id` = `co`.`coberturas_id`)) join `tamanos` `tm` on(`t`.`tamanos_id` = `tm`.`tamanos_id`)) left join `tortas_rellenos` `tr` on(`t`.`tortas_id` = `tr`.`tortas_id`)) left join `rellenos` `r` on(`tr`.`rellenos_id` = `r`.`rellenos_id`)) GROUP BY `t`.`tortas_id`, `p`.`pedidos_id`, `c`.`clientes_id`, `s`.`sabores_id`, `co`.`coberturas_id`, `tm`.`tamanos_id` ;

-- --------------------------------------------------------

--
-- Estructura para la vista `vista_pedido_unico`
--
DROP TABLE IF EXISTS `vista_pedido_unico`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `vista_pedido_unico`  AS SELECT `p`.`pedidos_id` AS `pedidos_id`, `c`.`nombre` AS `cliente`, `c`.`telefono` AS `telefono`, `c`.`direccion` AS `direccion`, date_format(`p`.`fecha_pedido`,'%d/%m/%Y') AS `fecha_pedido`, date_format(`p`.`fecha_entrega`,'%d/%m/%Y') AS `fecha_entrega`, concat('S/. ',format(`p`.`total`,2)) AS `total`, `p`.`estado` AS `estado`, `t`.`tortas_id` AS `tortas_id`, `s`.`nombre` AS `sabor`, (select group_concat(`r`.`nombre` separator ' + ') from (`tortas_rellenos` `tr` join `rellenos` `r` on(`tr`.`rellenos_id` = `r`.`rellenos_id`)) where `tr`.`tortas_id` = `t`.`tortas_id`) AS `rellenos`, `co`.`nombre` AS `cobertura`, `tm`.`nombre` AS `tamaño`, `tm`.`porciones` AS `porciones`, concat('S/. ',format(`t`.`precio_unitario`,2)) AS `precio_unitario` FROM (((((`pedidos` `p` join `clientes` `c` on(`p`.`clientes_id` = `c`.`clientes_id`)) join `tortas` `t` on(`p`.`pedidos_id` = `t`.`pedidos_id`)) join `sabores` `s` on(`t`.`sabores_id` = `s`.`sabores_id`)) join `coberturas` `co` on(`t`.`coberturas_id` = `co`.`coberturas_id`)) join `tamanos` `tm` on(`t`.`tamanos_id` = `tm`.`tamanos_id`)) ;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `clientes`
--
ALTER TABLE `clientes`
  ADD PRIMARY KEY (`clientes_id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indices de la tabla `coberturas`
--
ALTER TABLE `coberturas`
  ADD PRIMARY KEY (`coberturas_id`),
  ADD UNIQUE KEY `nombre` (`nombre`),
  ADD KEY `nombre_2` (`nombre`);

--
-- Indices de la tabla `pedidos`
--
ALTER TABLE `pedidos`
  ADD PRIMARY KEY (`pedidos_id`),
  ADD KEY `clientes_id` (`clientes_id`),
  ADD KEY `fecha_pedido` (`fecha_pedido`);

--
-- Indices de la tabla `rellenos`
--
ALTER TABLE `rellenos`
  ADD PRIMARY KEY (`rellenos_id`),
  ADD UNIQUE KEY `nombre` (`nombre`);

--
-- Indices de la tabla `sabores`
--
ALTER TABLE `sabores`
  ADD PRIMARY KEY (`sabores_id`),
  ADD UNIQUE KEY `nombre` (`nombre`);

--
-- Indices de la tabla `tamanos`
--
ALTER TABLE `tamanos`
  ADD PRIMARY KEY (`tamanos_id`),
  ADD UNIQUE KEY `nombre` (`nombre`);

--
-- Indices de la tabla `tortas`
--
ALTER TABLE `tortas`
  ADD PRIMARY KEY (`tortas_id`),
  ADD KEY `pedidos_id` (`pedidos_id`),
  ADD KEY `sabores_id` (`sabores_id`),
  ADD KEY `coberturas_id` (`coberturas_id`),
  ADD KEY `tamanos_id` (`tamanos_id`);

--
-- Indices de la tabla `tortas_rellenos`
--
ALTER TABLE `tortas_rellenos`
  ADD PRIMARY KEY (`tortas_id`,`rellenos_id`),
  ADD KEY `rellenos_id` (`rellenos_id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `clientes`
--
ALTER TABLE `clientes`
  MODIFY `clientes_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `coberturas`
--
ALTER TABLE `coberturas`
  MODIFY `coberturas_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `pedidos`
--
ALTER TABLE `pedidos`
  MODIFY `pedidos_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `rellenos`
--
ALTER TABLE `rellenos`
  MODIFY `rellenos_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de la tabla `sabores`
--
ALTER TABLE `sabores`
  MODIFY `sabores_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `tamanos`
--
ALTER TABLE `tamanos`
  MODIFY `tamanos_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `tortas`
--
ALTER TABLE `tortas`
  MODIFY `tortas_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `pedidos`
--
ALTER TABLE `pedidos`
  ADD CONSTRAINT `fk_pedidos_cliente` FOREIGN KEY (`clientes_id`) REFERENCES `clientes` (`clientes_id`) ON UPDATE CASCADE;

--
-- Filtros para la tabla `tortas`
--
ALTER TABLE `tortas`
  ADD CONSTRAINT `fk_tortas_cobertura` FOREIGN KEY (`coberturas_id`) REFERENCES `coberturas` (`coberturas_id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_tortas_pedido` FOREIGN KEY (`pedidos_id`) REFERENCES `pedidos` (`pedidos_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_tortas_sabor` FOREIGN KEY (`sabores_id`) REFERENCES `sabores` (`sabores_id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_tortas_tamano` FOREIGN KEY (`tamanos_id`) REFERENCES `tamanos` (`tamanos_id`) ON UPDATE CASCADE;

--
-- Filtros para la tabla `tortas_rellenos`
--
ALTER TABLE `tortas_rellenos`
  ADD CONSTRAINT `fk_tr_relleno` FOREIGN KEY (`rellenos_id`) REFERENCES `rellenos` (`rellenos_id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_tr_torta` FOREIGN KEY (`tortas_id`) REFERENCES `tortas` (`tortas_id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
