-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 11-07-2025 a las 20:14:25
-- Versión del servidor: 10.4.32-MariaDB
-- Versión de PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `panaderia_db`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categorias`
--

CREATE TABLE `categorias` (
  `id_categoria` int(11) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `descripcion` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='Categorías para los productos (ej. Panes, Pasteles, Bebidas)';

--
-- Volcado de datos para la tabla `categorias`
--

INSERT INTO `categorias` (`id_categoria`, `nombre`, `descripcion`) VALUES
(1, 'Panadería Tradicional', 'Panes clásicos como conchas, bolillos, etc.'),
(2, 'Pastelería y Postres', 'Pasteles completos, rebanadas y postres individuales.'),
(3, 'Bebidas', 'Café, jugos y refrescos.'),
(4, 'Salados y Bocadillos', 'Sándwiches, empanadas y otros productos salados.');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `clientes`
--

CREATE TABLE `clientes` (
  `id_cliente` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `apellido` varchar(100) DEFAULT NULL,
  `telefono` varchar(20) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `fecha_registro` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='Clientes registrados (para programas de lealtad, etc.)';

--
-- Volcado de datos para la tabla `clientes`
--

INSERT INTO `clientes` (`id_cliente`, `nombre`, `apellido`, `telefono`, `email`, `fecha_registro`) VALUES
(1, 'Laura', 'Torres', '5512345678', 'laura.t@email.com', '2025-06-18 13:05:13'),
(2, 'Marcos', 'Solis', '5587654321', 'marcos.solis@email.com', '2025-06-18 13:05:13'),
(3, 'carlos', 'marino', '6015884256', 'carlos@marino.com', '2025-06-18 20:35:50');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalle_venta`
--

CREATE TABLE `detalle_venta` (
  `id_detalle` int(11) NOT NULL,
  `id_venta` int(11) NOT NULL,
  `id_producto` int(11) NOT NULL,
  `cantidad` int(11) NOT NULL CHECK (`cantidad` > 0),
  `precio_unitario_venta` decimal(10,2) NOT NULL COMMENT 'Precio al momento de la venta para histórico',
  `subtotal` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='Líneas de productos dentro de cada venta';

--
-- Volcado de datos para la tabla `detalle_venta`
--

INSERT INTO `detalle_venta` (`id_detalle`, `id_venta`, `id_producto`, `cantidad`, `precio_unitario_venta`, `subtotal`) VALUES
(1, 1, 1, 2, 15.50, 31.00),
(2, 1, 5, 1, 35.00, 35.00),
(3, 2, 2, 1, 25.00, 25.00),
(4, 2, 4, 1, 22.00, 22.00),
(5, 3, 3, 1, 350.00, 350.00),
(6, 3, 7, 1, 55.00, 55.00),
(7, 4, 3, 1, 350.00, 350.00),
(8, 4, 15, 1, 1.50, 1.50),
(9, 4, 4, 1, 22.00, 22.00),
(12, 6, 8, 2, 2.00, 4.00),
(13, 7, 4, 12, 22.00, 264.00),
(14, 8, 3, 1, 350.00, 350.00),
(15, 9, 5, 2, 35.00, 70.00),
(16, 10, 5, 1, 35.00, 35.00),
(17, 11, 5, 1, 35.00, 35.00),
(18, 12, 5, 1, 35.00, 35.00),
(19, 13, 1, 1, 15.50, 15.50),
(20, 14, 8, 3, 2.00, 6.00),
(21, 15, 15, 1, 1.50, 1.50);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `empleados`
--

CREATE TABLE `empleados` (
  `id_empleado` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `apellido` varchar(100) NOT NULL,
  `username` varchar(50) NOT NULL,
  `puesto` varchar(50) DEFAULT NULL COMMENT 'Ej. Cajero, Panadero, Gerente',
  `password` varchar(255) NOT NULL,
  `fecha_contratacion` date DEFAULT NULL,
  `activo` tinyint(1) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='Información de los empleados de la panadería';

--
-- Volcado de datos para la tabla `empleados`
--

INSERT INTO `empleados` (`id_empleado`, `nombre`, `apellido`, `username`, `puesto`, `password`, `fecha_contratacion`, `activo`) VALUES
(1, 'Ana', 'García', 'admin', 'Administrador', '$2y$10$klT4fbyTvKQdcTft08Wr7.UVgYCBBUQ6v8RIiyPjTlqL02NYBh2TC', '2022-01-15', 1),
(2, 'Carlos', 'Ruiz', 'cajero1', 'Cajero', '$2y$10$sGCojmrrsahvvtpylCbtzunKeHhTAWPv9Qpd9uR9xCS6W7bev9qPu', '2021-11-20', 1),
(4, 'juan', 'martinez', 'juan', 'Administrador', '$2y$10$EsPWFFouYzljmMvGplwDqeV2rDoTkI2I1LBDonmD3MHVuRhEDQLd.', '2025-06-17', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productos`
--

CREATE TABLE `productos` (
  `id_producto` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `descripcion` text DEFAULT NULL,
  `precio_venta` decimal(10,2) NOT NULL CHECK (`precio_venta` >= 0),
  `stock_actual` int(11) NOT NULL DEFAULT 0,
  `id_categoria` int(11) NOT NULL,
  `fecha_creacion` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='Catálogo de productos de la panadería';

--
-- Volcado de datos para la tabla `productos`
--

INSERT INTO `productos` (`id_producto`, `nombre`, `descripcion`, `precio_venta`, `stock_actual`, `id_categoria`, `fecha_creacion`) VALUES
(1, 'Concha de Vainilla', 'Pan dulce tradicional con cubierta de azúcar sabor vainilla.', 15.50, 49, 1, '2025-06-18 13:05:13'),
(2, 'Baguette', 'Pan francés alargado y crujiente.', 25.00, 30, 1, '2025-06-18 13:05:13'),
(3, 'Pastel de Chocolate', 'Pastel completo de chocolate para 10 personas.', 350.00, 0, 2, '2025-06-18 13:05:13'),
(4, 'Croissant de Mantequilla', 'Clásico croissant hojaldrado.', 22.00, 27, 1, '2025-06-18 13:05:13'),
(5, 'Café Americano', 'Café de grano recién molido (12 oz).', 35.00, 195, 3, '2025-06-18 13:05:13'),
(6, 'Jugo de Naranja Natural', 'Jugo recién exprimido (500 ml).', 40.00, 20, 3, '2025-06-18 13:05:13'),
(7, 'Sándwich de Jamón y Queso', 'Preparado con nuestro pan de caja artesanal.', 55.00, 15, 4, '2025-06-18 13:05:13'),
(8, 'Croissant de Almendras', 'Delicioso croissant relleno de crema de almendras', 2.00, 25, 1, '2025-06-18 13:32:59'),
(15, 'Pan de Bono Tradicional', 'Elaborado con almidón de yuca y queso fresco.', 1.50, 16, 1, '2025-06-18 14:57:08'),
(16, 'Pan de Yuca Artesanal', 'Pan de yuca con queso 100% natural.', 10.00, 0, 1, '2025-06-19 00:32:12');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ventas`
--

CREATE TABLE `ventas` (
  `id_venta` int(11) NOT NULL,
  `fecha_venta` timestamp NOT NULL DEFAULT current_timestamp(),
  `total_venta` decimal(10,2) NOT NULL,
  `id_empleado` int(11) NOT NULL,
  `id_cliente` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='Cabecera de cada ticket de venta';

--
-- Volcado de datos para la tabla `ventas`
--

INSERT INTO `ventas` (`id_venta`, `fecha_venta`, `total_venta`, `id_empleado`, `id_cliente`) VALUES
(1, '2025-06-16 13:05:13', 66.00, 1, NULL),
(2, '2025-06-16 13:05:13', 47.00, 1, 1),
(3, '2025-06-18 13:05:13', 405.00, 2, NULL),
(4, '2025-06-13 15:27:32', 373.50, 1, NULL),
(6, '2025-06-18 15:50:35', 4.00, 1, NULL),
(7, '2025-06-18 16:26:15', 264.00, 1, 1),
(8, '2025-06-18 22:04:35', 350.00, 1, NULL),
(9, '2025-06-18 22:10:42', 70.00, 1, NULL),
(10, '2025-06-18 22:13:13', 35.00, 1, NULL),
(11, '2025-06-18 22:17:45', 35.00, 1, NULL),
(12, '2025-06-18 23:05:03', 35.00, 2, NULL),
(13, '2025-06-18 23:06:18', 15.50, 2, NULL),
(14, '2025-06-18 23:10:37', 6.00, 2, NULL),
(15, '2025-06-18 23:30:17', 1.50, 1, NULL);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `categorias`
--
ALTER TABLE `categorias`
  ADD PRIMARY KEY (`id_categoria`),
  ADD UNIQUE KEY `nombre` (`nombre`);

--
-- Indices de la tabla `clientes`
--
ALTER TABLE `clientes`
  ADD PRIMARY KEY (`id_cliente`),
  ADD UNIQUE KEY `telefono` (`telefono`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indices de la tabla `detalle_venta`
--
ALTER TABLE `detalle_venta`
  ADD PRIMARY KEY (`id_detalle`),
  ADD KEY `id_venta` (`id_venta`),
  ADD KEY `id_producto` (`id_producto`);

--
-- Indices de la tabla `empleados`
--
ALTER TABLE `empleados`
  ADD PRIMARY KEY (`id_empleado`),
  ADD UNIQUE KEY `username` (`username`);

--
-- Indices de la tabla `productos`
--
ALTER TABLE `productos`
  ADD PRIMARY KEY (`id_producto`),
  ADD KEY `id_categoria` (`id_categoria`);

--
-- Indices de la tabla `ventas`
--
ALTER TABLE `ventas`
  ADD PRIMARY KEY (`id_venta`),
  ADD KEY `id_empleado` (`id_empleado`),
  ADD KEY `id_cliente` (`id_cliente`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `categorias`
--
ALTER TABLE `categorias`
  MODIFY `id_categoria` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `clientes`
--
ALTER TABLE `clientes`
  MODIFY `id_cliente` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `detalle_venta`
--
ALTER TABLE `detalle_venta`
  MODIFY `id_detalle` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT de la tabla `empleados`
--
ALTER TABLE `empleados`
  MODIFY `id_empleado` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `productos`
--
ALTER TABLE `productos`
  MODIFY `id_producto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT de la tabla `ventas`
--
ALTER TABLE `ventas`
  MODIFY `id_venta` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `detalle_venta`
--
ALTER TABLE `detalle_venta`
  ADD CONSTRAINT `detalle_venta_ibfk_1` FOREIGN KEY (`id_venta`) REFERENCES `ventas` (`id_venta`) ON DELETE CASCADE,
  ADD CONSTRAINT `detalle_venta_ibfk_2` FOREIGN KEY (`id_producto`) REFERENCES `productos` (`id_producto`);

--
-- Filtros para la tabla `productos`
--
ALTER TABLE `productos`
  ADD CONSTRAINT `productos_ibfk_1` FOREIGN KEY (`id_categoria`) REFERENCES `categorias` (`id_categoria`);

--
-- Filtros para la tabla `ventas`
--
ALTER TABLE `ventas`
  ADD CONSTRAINT `ventas_ibfk_1` FOREIGN KEY (`id_empleado`) REFERENCES `empleados` (`id_empleado`),
  ADD CONSTRAINT `ventas_ibfk_2` FOREIGN KEY (`id_cliente`) REFERENCES `clientes` (`id_cliente`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
